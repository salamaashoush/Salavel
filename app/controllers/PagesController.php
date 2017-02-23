<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
class PagesController extends Controller {

    public function home()
    {
        return view('index');
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
