<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthApiController extends BaseController
{
    public function login(Request $request)
    {
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            if($user->isAdmin){
                return $this->sendError('Пользователями могут быть только авторы', ['error'=>'Unauthorised']);
            }
            
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->firstName;
   
            return $this->sendResponse($success, 'User login successfully');
        } 
        else{ 
            return $this->sendError('Unauthorised', ['error'=>'Unauthorised']);
        } 
    }
}