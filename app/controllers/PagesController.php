<?php
namespace App\Controllers;
use App\Core\Controller;
class PagesController extends Controller {

    public function home()
    {
        return view('pages/index');
    }

    public function about()
    {
        return view('pages/about');
    }

    public function contact()
    {
        return view('pages/contact');
    }

}
