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
$router->get('test/{id}',function ($request){
    $query=$request->getParameters('test');
    var_dump($query);
});
$router->resource('users','UserController');