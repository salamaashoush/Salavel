<?php
/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 22/02/17
 * Time: 12:18 م
 */

namespace App\Controllers;


use App\Core\Controller;
use App\Core\Request;
use App\Core\ResourceInterface;
use App\Core\Validator;
use App\Models\User;
class UserController extends Controller implements ResourceInterface
{

    function __construct()
    {
        $this->validator=new Validator();
        $this->model=new User();
    }
    public function index()
    {
       $users=$this->model->all();
       return view('users/index',['users'=>$users]);
    }

    public function create()
    {
        // TODO: Implement create() method.
        echo "create also working";
    }

    public function store(Request $request)
    {
        if(verifyCSRF($request)){
            $errors=$this->validator->validate($request,[
                'name'=>'required',
                'email'=>'required|email',
                'password'=>'required|min:8'
            ]);
            if($errors){
                redirect('users',$errors);
            }else{
                $this->model->create([
                    'name'=>$request->get('name'),
                    'email'=>$request->get('email'),
                    'password'=>$request->get('password')
                ]);
                $users= $this->model->all();
                return view('users/index',['users'=>$users,'errors'=>$errors]);
            }
        }

    }

    public function show($id)
    {
        // TODO: Implement show() method.
        echo $id;
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
        echo "$id is edited";
    }

    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
        echo "$id id now";
    }

    public function destroy($id)
    {
       $this->model->delete(['id'=>$id]);
        $users= $this->model->all();
        return view('users/index',['users'=>$users]);
    }
}