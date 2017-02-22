<?php
namespace App\Controllers;
use App\Core\App;
use App\Core\Controller;

class TasksController extends Controller {


    public function index(Request $request)
    {
        $tasks=App::get('database')->selectAll('todos');
        return view('tasks',['tasks'=>$tasks]);
    }

    public function store(Request $request)
    {
        App::get('database')->insert('todos',[
            'description'=>$_POST['desc'],
            'complated'=>false
        ]);
        redirect('tasks');
    }

}

