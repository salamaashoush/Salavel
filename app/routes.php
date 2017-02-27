<?php
$router->get('','PagesController@home');
$router->post('login','AuthController@login');
$router->post('register','AuthController@register');
$router->get('login','AuthController@showlogin');
$router->get('logout','AuthController@logout');
$router->get('register','AuthController@showregister');
//$router->get('user/{id}',function ($id))
$router->get('search',function ($request){
   return toJson(\App\Models\Post::retrieveByTitle($request->get('q'))) ;
});
$router->post('test',function ($request){
   $files=upload($request->getfile("files"));
   var_dump($files['metas'][0]['name']);
});
$router->resource('users','UserController');
$router->resource('posts','PostController');