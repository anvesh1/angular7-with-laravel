<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use JWTAuth;

class UserAccess extends Model
{
    public function getUserDetails(){

        // $user = JWTAuth::parseToken()->toUser();
        $userData = User::find($user->id);
        
        return $userData;
        
        }
}
