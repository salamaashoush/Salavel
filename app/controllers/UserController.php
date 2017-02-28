<?php
/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 22/02/17
 * Time: 12:18 م
 */

namespace App\Controllers;


use App\Core\Controller;
use App\Core\Helper;
use App\Core\Request;
use App\Core\ResourceInterface;
use App\Core\Session;
use App\Models\User;

class UserController extends Controller implements ResourceInterface
{

    public function index()
    {
       $users=User::all();
        return view('users/index',['users'=>$users]);
    }

    public function create()
    {
       return view('users/create');
    }

    public function store(Request $request)
    {
        $errors = $this->validator->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm' => 'required|min:8'
        ]);
        if ($request->get('password') !== $request->get('confirm')) {
            $errors['login'] = "Password not match";
        }
        if ($errors) {
            $request->saveToSession($errors);
            redirect('users/create', $request->getLastFromSession());
        } else {
            $user = new User();
            $user->firstname = $request->get('firstname');
            $user->lastname = $request->get('lastname');
            $user->username = $request->get('username');
            $user->email = $request->get('email');
            $user->password = password_hash($request->get('password'), PASSWORD_DEFAULT);
            $user->address = $request->get('address');
            try {
                $files = upload($request->getfile("image"));
                $user->image = $files['metas'][0]['name'];
            } catch (\Exception $e) {
                $e->getMessage();
            }
            $user->gender = $request->get('gender');
            $user->country = $request->get('country');
            $user->role = $request->get('role');
            $user->created_at = date("Y-m-d H:i:s");
            $user->updated_at = date("Y-m-d H:i:s");
            $user->save();
            Session::setFlash("User Added Successfully");
            redirect('users');
        }
    }

    public function show($id)
    {
        $user=User::retrieveByPK($id);
        return view('users/show',['user'=>$user]);
    }

    public function edit($id)
    {
        $user=User::retrieveByPK($id);
        return view('users/edit',['user'=>$user]);
    }

    public function update(Request $request, $id)
    {

        $user=User::retrieveByPK($id);
        $errors = $this->validator->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm' => 'required|min:8'
        ]);
        if ($request->get('password') !== $request->get('confirm')) {
            $errors['login'] = "Password not match";
        }
        if ($errors) {
            $request->saveToSession($errors);
            redirect('users/'.$user->id.'/edit', $request->getLastFromSession());
        } else {
            $user->firstname = $request->get('firstname');
            $user->lastname = $request->get('lastname');
            $user->username = $request->get('username');
            $user->email = $request->get('email');
            $user->password = password_hash($request->get('password'), PASSWORD_DEFAULT);
            $user->address = $request->get('address');
            if($request->getFile('image')){
                unlink("uploads/{$user->image}");
                try {
                    $files = upload($request->getfile("image"));
                    $user->image = $files['metas'][0]['name'];
                } catch (\Exception $e) {
                    $e->getMessage();
                }
            }
            $user->gender = $request->get('gender');
            $user->country = $request->get('country');
            $user->role = $request->get('role');
            $user->created_at = date("Y-m-d H:i:s");
            $user->updated_at = date("Y-m-d H:i:s");
            $user->update();
            Session::setFlash("User Updated Successfully");
            redirect('users');
        }
    }

    public function destroy($id)
    {
        $user=User::retrieveByPK($id);
        $user->delete();
        Session::setFlash("User Deleted Successfully");
        redirect('users');
    }
}