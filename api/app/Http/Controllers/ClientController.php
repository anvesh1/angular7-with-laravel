<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addClient(Request $request)
    {
         $validator = Validator::make($request->input(),[
            'client_name'=>'required|string|min:2',
            'email_id'=>'required|email|max:30',
            'mobile'=>'required||regex:/[0-9]{9}/',
            'address'=>'required',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>'500','message'=>$validator->messages()->first()]);
        }else{
            $client = new Client();
            \Helper::sendResponse($client->addClient($request->input()));
            
        }
    }

    public function getClientList(Request $request){
        $data = $request->all();
        $client = new Client();
        $responseData = $client->getClientList($data);

        if(count($responseData->paginate->toArray()) &&
        ($responseData->paginate->toArray()['current_page'] > $responseData->paginate->toArray()['last_page'])){

        $data['page'] = $responseData->paginate->toArray()['last_page'];
        
        die(json_encode($client->getClientList($data)));
        }
        die(json_encode($responseData));
    }

    public function getAllClientList(Request $request){
        $data = $request->all();
        $client = new Client();
        $responseData = $client->getAllClientList();
        die(json_encode($responseData));
    }

    public function deleteClient(Request $request){
        $data = $request->all();
        $client = new Client();
        $deletedStatus = $client->deleteClient($data);
        
        $responseData = $client->getClientList($data);

        if(count($responseData->paginate->toArray()) &&
        ($responseData->paginate->toArray()['current_page'] > $responseData->paginate->toArray()['last_page'])){

        $data['page'] = $responseData->paginate->toArray()['last_page'];
        
        die(json_encode($client->getClientList($data)));
        }

        die(json_encode($responseData));
    }

    public function getClientById(Request $request){
        $data = $request->all();
        $client = new Client();
        $clientDetail = $client->getParticularClient($data);
        die(json_encode($clientDetail));
    }

}
