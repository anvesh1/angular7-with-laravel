<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email_id', 'password','device_token','address','device_type','contact_no','status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function registerUser($data){
        $resData=array();

        if(isset($data['user_profile_image']) && $data['user_profile_image']){

            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data['user_profile_image']));
            $imagePath = '/user-image/'.$this->id . "-" . md5($this->email).date('Y-m-d H:i:s'). '.png';  
            file_put_contents(public_path(). $imagePath, $imageData);
            $data['user_profile_image']=$imagePath;    
        }else{
                $data['user_profile_image'] = '';
        }

        $data['password'] = bcrypt($data['password']);


        $resultSet= $this->where('email_id',$data['email_id'])
                            ->select('email_id')
                            ->get()
                            ->toArray();
        $invalidMessage = (!empty($resultSet)) ? 'Email already Exist.' : '';

        if(!$invalidMessage){
            $resultSet= $this->where('contact_no',$data['contact_no'])
                ->select('contact_no')
                ->get()
                ->toArray();
            $invalidMessage = (!empty($resultSet)) ? 'Contact already Exist.' : '';
        }
        
        if($invalidMessage){
                $resData['status']  = 204;
                $resData['message'] = $invalidMessage;
                return $resData;
        }

        try{

            foreach ($data as $key => $value) {
                if(($value == 0 || $value) && !in_array($key, array('address'))){
                    $this->$key = $value;
                }

            }

            if($this->save()){
                $resData['status']  = 200;
                $resData['message'] = "User Created Successfully.";
                $resData['data']    = $this->toArray();
                return $resData;
            }
        }catch(\Exception $e){

            $resData['status'] = 503;
            $resData['message']    = 'Something went wrong, please try again.';
            return $resData;
        }
    }
    
    public function changeUserPassword($data){
        $resData = array();
        try{
                $user = \JWTAuth::parseToken()->toUser();
                $userData =User::find($user->id);

            if (\Hash::check($data['old_password'], $user['password']))
            {
                $user->password = $data['new_password'] ? bcrypt($data['new_password']) :'';
                
                if($user->save()){
                    $resData['status']='200';
                    $resData['message']='Password Reset Successfully.';
                    return $resData;

                 }else{
                    $resData['status']='204';
                    $resData['message']='Invalid Credential... Password Reset fails.';
                    return $resData;
                    }
            }else{
                $resData['status']='204';
                $resData['message']='Invalid Password.';
                return $resData;
            }
        }catch(\Exception $e){
                $resData['status']='503';
                $resData['message']='Something Went Wrong. Plz try Again.';
                return $resData;
        }
    }

    public function updateUserInfo($data){
        $resData=array();
        try{
            $user = \JWTAuth::parseToken()->toUser();
            $userData = $this->find($user->id);

            if(!$userData->id && $user->email_id != $userData->email_id){
                $resData['status']  = 400;
                $resData['message'] = "User Not Found";
                return $resData;
            }

            /*
            if(isset($data['user_profile_image']) && $data['user_profile_image']){

                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data['user_profile_image']));
                $imagePath = '/user-image/'.$this->id . "-" . md5($this->email).date('Y-m-d H:i:s') . '.png';
                file_put_contents(public_path(). $imagePath , $imageData);
                $data['user_profile_image']=$imagePath;       
            }else{
                $data['user_profile_image'] = '';
            }
            */

            foreach ($data as $key => $value) {

                if(($value == 0 || $value) && !in_array($key, array('id'))){
                    $userData->$key = $value;
                }
             }

             if($userData->save()){
                $resData['status']  = 200;
                $resData['message'] = "User created successfully.";
                return $resData;
            }else{
                $resData['status']  = 400;
                $resData['message'] = "Something went wrong, please try again.";
                return $resData;
            }
            
        }catch(\Exception $e){
            $resData['status'] = 503;
            $resData['message']    = 'Something went wrong, please try again.';
            //$resData['message']    = $e->getMessage();
            return $resData;
        }
    }

    public function getUser($filter=null){

        $user = \JWTAuth::parseToken()->toUser();
        $users = $this
            ->select( array('users.*'))
        //->where('id','!=',$user->id);
        ->where('device_type','!=','web');

        $users = $this->conditionCreator($filter['search'], $users);

        $response = new \stdClass();
        $recordPerPage = 20;

        if(isset($filter['sort']['field'])){
            $users = $users->orderBy($filter['sort']['field'], $filter['sort']['type']);
        }

        if(isset($filter['page'])){
            $page = $filter['page'];

            $limit = $recordPerPage*($page-1);

            $response->result = $users
                ->skip($limit)->take($recordPerPage)->get();

            $response->paginate = $users
                ->paginate($recordPerPage);

            return $response;
        }

        $users =  $users
            // ->toSql();
            ->get()->toArray();

        //echo "<pre>";print_r($users);exit;
        return $users;
    }


    public function getUserFieldsbyFilter($fields = null, $filter = null){
        $users = $this
            ->select($fields)
            ->where('device_type','!=','web');

        $users = $this->conditionCreator($filter, $users);
        return $users->get()
                    ->toArray();

    }

    public function deleteUser($id)
    {
        $dataToReturn = array();
        try{
            if($this->where('id', '=', $id)->delete()){
                $dataToReturn['status'] = 200;
                $dataToReturn['message']    = 'User Deleted Successfully';
                return $dataToReturn;
            }

        }catch(\Exception $e){
            $dataToReturn['status']  = 503;
            $dataToReturn['message']     = $e->getMessage();
            return $dataToReturn;
        }
    }


    public function conditionCreator($filter, $obj){

        foreach($filter as $key => $value){

            if($value == 0 || $value){

            }else{
                continue;
            }

            switch(strtolower($key)){
                case 'id'                   : $obj->whereIn('users.id', $value);break;
                case 'email_id'             : $obj->where('users.email_id', $value);break;
                case 'contact_no'           : $obj->where('users.contact_no', $value);break;
                case 'device_type'          : $obj->where('users.device_type', $value);break;
                case 'is_active'            : $obj->where('users.is_active', $value);break;
                case 'device_type'          : $obj->where('users.device_type', $value);break;
                case 'first_name'           : $obj->where('users.first_name','LIKE', "%{$value}%");break;
                default: '';
            }
        }
        return $obj;
    }
    
}
