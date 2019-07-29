<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use JWTAuthException;


class WebController extends Controller
{
    public function _construct() {

    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        $token = null;
        $email = $request->input('email')?stripslashes(trim($request->input('email'))):'';
        try {
            if($email){
//                $status = DB::table('users')->where('email',$email)->first()->is_active;
                $status = DB::table('users')->where([['email',$email],['role','web_admin']])->first()->is_active;
                if($status == 0){
                    return response()->json(['message'=>'unverified','email'=>$email], 200);
                }
            }
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'invalid email or password'], 422);
            }
        } catch (JWTAuthException $e) {
            return response()->json(['message' => 'failed to authorize token'], 500);
        }
        return response()->json(compact('token'));
    }

}
