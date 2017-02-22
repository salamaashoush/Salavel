<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\Validator;
use App\Models\User;

class AuthController extends Controller
{
    function __construct($model)
    {
        $this->validator=new Validator();
        $this->model=new User();
    }

    public function showlogin(Request $request){
        return view('login');
    }
    public function login(Request $request){
        $errors=$this->validator->validate($request,[
            'name'=>'required|max:5',
            'email'=>'required|email|min:5'
        ]);
        return view('index',['errors'=>$errors]);
    }
    public function showregister(Request $request){
        return view('register');
    }
    public function register(Request $request){
        $errors=$this->validator->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);
        if($errors){
            redirect('register',$errors);
        }else{
            $this->model->create([
                'name'=>$request->get('name'),
                'email'=>$request->get('email'),
                'password'=>$request->get('password')
            ]);
            $users= $this->model->all();
            return view('index',['users'=>$users,'errors'=>$errors]);
        }

    }
}