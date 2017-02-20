<?php
class PagesController{

    public function home()
    {
        $tasks=App::get('database')->selectAll('todos');
        return view('index',['tasks'=>$tasks]);
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

}
