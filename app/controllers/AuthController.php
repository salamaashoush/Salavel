<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Helper;
use App\Core\Request;
use App\Models\User;

class AuthController extends Controller
{

    public function showlogin(Request $request){
        return view('login');
    }
    public function login(Request $request){
        $errors=$this->validate($request,[
            'name'=>'required|max:5',
            'email'=>'required|email|min:5'
        ]);
        if($errors){
            redirect('register',$errors);
        }else{
            return view('index');
        }

    }
    public function showregister(Request $request){
        return view('register');
    }
    public function register(Request $request){
        $errors=$this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);
        if($errors){
            Helper::redirect('register',['errors'=>$errors]);
        }else{
            $user=new User();
            $user->name=$request->get('name');
            $user->email=$request->get('email');
            $user->password=$request->get('password');
            $user->save();
            $users= User::all();
            return view('index',['users'=>$users]);
        }

    }
}