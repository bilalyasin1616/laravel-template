<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ResponseModel;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function Signup(Request $request){
        $user = User::Create($request->input());
        return response()->json(new ResponseModel($user,"User inserted successfully",200));
    }

    public function Signin(Request $request){
        $user = User::where('email',$request->email)->where('password',$request->password)->First();
        if ($user==null)
            return response()->json(new ResponseModel(null,"User not exists",500));
        $credentials = $request->only('email', 'password');
        dd(JWTAuth::fromUser($user));
        return response()->json(new ResponseModel($user,"User signin successfully",200));
    }

    public function GetAll(){
        $users = User::All();
        return response()->json(new ResponseModel($users,"Retrieved users successfully",200));
    }

    public function Get(Request $request){
        $user = User::Find($request->id);
        if ($user!=null)
            return response()->json(new ResponseModel($user,"Retrieve user successfully",200));
        return response()->json(new ResponseModel($user,"User not found",500));
    }
}