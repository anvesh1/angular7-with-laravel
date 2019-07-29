<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use App\User;
use App\LoginHistory;
use JWTAuthException;
use App\NotificationHistory;


use Illuminate\Support\Facades\Validator;
use App\Client;
use Mockery\Exception;

//use DB;

class ApiController extends Controller
{
    private $user;
    public function __construct(){

    }
    public function getUser1(){
        exit;
    }
    //function to validate user and insert into database.
    public function registerUser(Request $request){
        // dd($request->all());
        //validation start
        $validator = Validator::make($request->all(),[
            'first_name'=>'required|string|min:2',
            'last_name'=>'required|string|min:2',
            'email_id'=>'required|email|max:50',
            // 'address'=>'required',
            //'designation'=>'required|min:2',
            'contact_no'=>'required',
            'password'=>'required|min:5',
            'device_token'=>'required',
            'device_type'=>'required'
        ]);
        if($validator->fails()){
            return response()->json(['status'=>'500','message'=>$validator->messages()->first(),'data'=>'']);
        }else{
            //validation end

            $user = new User();
            // die($request->all());
            $this->sendResponse($user->registerUser($request->all()));
        }
    }

    //function to login user
    public function login(Request $request){
        //validation
        $validator = Validator::make($request->all(),[
            'email_id'=>'required|email|min:5',
            'password'=>'required',
            'device_token'=>'required|min:1',
            'device_type' =>'Required:min:3'
        ]);
        if($validator->fails()){
            return response()->json(['status'=>'500','message'=>$validator->messages()->first(),'data'=>'']);
        }else{
            //operation started..
            $credentials =  $request->only('email_id','password');
            $token = null;
            try
            {
                if (!$token = JWTAuth::attempt($credentials)) {
                    return response()->json(['status'=>'422','message'=>'Invalid Email or Password']);
                }
            } catch (JWTAuthException $e) {
                return response()->json(['status'=>'422','message'=>'Failed to Create Token']);
            }
            //validate if token found.
            if($token!=null){
                $ip = $request->ip();
                $userAgent = $request->header('User_Agent');
                $deviceType = $request->device_type;
                $loginHistory = new LoginHistory();
                $this->sendResponse($loginHistory->insertLoginHistory($token,$ip,$userAgent,$deviceType));
            }
        }
    }

    //function to logout user
    public function userLogout(Request $request){
        try{
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['status'=>'200','message'=>'User logout successfully.']);
        }catch (\Exception $e){
            return response()->json(['status'=>'500','message'=>'Something Went Wrong. Plz try Again.']);
        }

    }


    //function to change user password
    public function changeUserPassword(Request $request){
        $validator = Validator::make($request->all(),[
            'old_password'=>'required|min:5',
            'new_password'=>'required|min:5',
        ]);
        if($validator->fails()){
            return response()->json(
                ['status'=>'500','message'=>$validator->messages()->first(),
                    'messageTitle'=>'Error', 'messageType' => 'warning']);
        }else{
            $user = new User();
            $this->sendResponse($user->changeUserPassword($request->all()));
        }
    }

    //function to update UserProfile.(basic updation).
    public function updateUserInfo(Request $request){

        $data = $request->all();
        $user = new User();
        $this->sendResponse($user->updateUserInfo($data));
    }



    //function to get user list
    public function getUserList(Request $request){
        $data = $request->all();
        $user = new User();

        $responseData = $user->getUser($data);

        if(!isset($responseData->paginate)){
            die(json_encode(array('result' => $responseData)));
        }

        if(count($responseData->paginate->toArray()) &&
            ($responseData->paginate->toArray()['current_page'] > $responseData->paginate->toArray()['last_page'])){

            $data['page'] = $responseData->paginate->toArray()['last_page'];

            die(json_encode($user->getUser($data)));
        }
        die(json_encode($responseData));
    }

    public function getUserDetails(Request $request){
        $filter = $request->all();
        $user = new User();

        $responseData = $user->getUser($filter);

        $this->sendResponse($responseData);
    }


    public function notifyUsers(Request $request){
        $data = $request->all();

        $userModel  = new User();
        if(isset($data['id'])){
            $deviceToken = $userModel->getUserFieldsbyFilter(array('device_token'), array('device_type' => 'android', 'id' => $data['id']));
        }else{
            $deviceToken = $userModel->getUserFieldsbyFilter(array('device_token'), array('device_type' => 'android'));
        }

        $responseData = array();

        //echo "<pre>";print_r($deviceToken);exit;
        if($deviceToken){

            $pushMessage = array(
                'message'    => $data['message'],
                'title'      => 'Alert!',
                'vibrate'	 => 1,
                'sound'		 => 1
            );

            $androidToken =  array_column($deviceToken, 'device_token');
            $responseData = sendPushNotification($androidToken, $pushMessage);
        }

        if(isset($data['id'])) {
            $deviceToken = $userModel->getUserFieldsbyFilter(array('device_token'), array('device_type' => 'ios', 'id' => $data['id']));
        }else{
            $deviceToken = $userModel->getUserFieldsbyFilter(array('device_token'), array('device_type' => 'ios'));
        }

        if($deviceToken){

            $payload = [];

            // Create the payload body
            $body['aps'] = array(
                'alert' => $data['message'],
                'badge' => 0,
                //'sound' => 'siren.wav'
            );

            // Encode the payload as JSON
            $payload = json_encode($body);

            $iosToken =  array_column($deviceToken, 'device_token');
            sendIosNotification($iosToken, $payload);
            //$responseData = sendIosNotification($iosToken, $payload);
            if(!$responseData){
                $responseData['status'] = 200;
                $responseData['result']     = '';
                $responseData['message']    = 'Notification Sent Successfully.';
            }
        }

        if(isset($responseData)){
            if(isset($data['id'])){
                $this->saveNotification($data['message'], implode(",",$data['id']));
            }
            $this->sendResponse($responseData);

        }

    }

    //Save user notification history
    public function saveNotification($message=null, $ids=null){
        $notification = new NotificationHistory();
        $response = $notification->addNotification(array('text'=> $message, 'user_ids' => $ids));
        //echo "<pre>";print_r($response);exit;
    }

    //delete User
    public function deleteUser(Request $request){
        $data = $request->all();

        $user  = new User();

        $responseData = $user->deleteUser($data['id']);

        $this->sendResponse($responseData);
    }

    //get Notification
    public function getNotification(Request $request){
        $data = $request->all();

        $id = isset($data['id']) ? $data['id'] : '';
        $notification  = new NotificationHistory();

        $responseData = $notification->getNotificationsById($id);

        $this->sendResponse($responseData);

    }

    //common function to send response in global proper way.
    public function sendResponse($responseData){
        $response = new \stdClass();
        if($responseData['status'] == 200){

            $response->result = isset($responseData['result']) ? $responseData['result'] : '' ;
            $response->message = $responseData['message'];
            $response->messageType = 'success';
            $response->messageTitle = 'Success..!';
            $response->status = '200';

            die(json_encode($response));
        }

        $response->message = $responseData['message'];
        $response->messageType = 'warning';
        $response->messageTitle = 'Error..!';
        $response->status = $responseData['status'];
        die(json_encode($response));
    }

}
