<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\Validator;

class AuthController extends Controller
{
    function __construct()
    {
        $this->validator=new Validator();
    }

    public function showlogin(Request $request){
        return view('login');
    }
    public function login(Request $request){
        $errors=$this->validator->validate($request,[
            'name'=>'required',
            'email'=>'required|email'
        ]);
        return view('index',['errors'=>$errors]);
    }
    public function showregister(Request $request){
        return view('register');
    }
    public function register(Request $request){

    }
}