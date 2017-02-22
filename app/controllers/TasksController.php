<?php
namespace App\Controllers;
use App\Core\Validator;
use App\Core\Controller;
use App\Models\Task;
use App\Core\Request;

class TasksController extends Controller {
    function __construct()
    {
        $this->validator=new Validator();
        $this->model=new Task();
    }
    public function index(Request $request)
    {
        $tasks=$this->model->all('todos');
        return view('tasks',['tasks'=>$tasks]);
    }

    public function store(Request $request)
    {
        $this->model->create([
            'description'=>$_POST['desc'],
            'complated'=>false
        ]);
        redirect('tasks');
    }

}

