<?php
$router->get('','PagesController@home');
$router->get('about','PagesController@about');
$router->get('contact','PagesController@contact');
$router->get('tasks','TasksController@index');
$router->post('tasks','TasksController@store');
$router->post('login','AuthController@login');
$router->post('register','AuthController@register');
$router->get('login','AuthController@showlogin');
$router->get('register','AuthController@showregister');
$router->get('test',function ($request){
    echo
    '<form action="/test" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="files" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
    </form>';
});
$router->post('test',function ($request){
   upload($request->getfile("files"));
});
$router->resource('users','UserController');