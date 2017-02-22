<?php
namespace App\Controllers;
use App\Core\App;
use App\Core\Controller;
use App\Core\Request;
class PagesController extends Controller {

    public function home(Request $request)
    {
        return view('index');
    }

    public function about(Request $request)
    {
        return view('about');
    }

    public function contact(Request $request)
    {
        return view('contact');
    }

}
