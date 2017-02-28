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
$router->get('push',function ($request){
    return view('push');
});
$router->get('weather',function ($request){

    return toJson([
        'london'=>'http://api.openweathermap.org/data/2.5/weather?q=London,uk&APPID=989463c75ec0c46a34213695b2d6eb39',
        'paris'=>'http://api.openweathermap.org/data/2.5/weather?q=Paris,uk&APPID=989463c75ec0c46a34213695b2d6eb39',
        'madrid'=>'http://api.openweathermap.org/data/2.5/weather?q=Madrid,uk&APPID=989463c75ec0c46a34213695b2d6eb39',
        'cairo'=>'http://api.openweathermap.org/data/2.5/weather?q=Cairo,uk&APPID=989463c75ec0c46a34213695b2d6eb39'
    ]);
});
$router->get('sse',function ($request){
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    $time = date('r');
    echo "event: salama\n";
    echo "data: The server time is: {$time}\n";
    echo "id: 15424654\n\n";
    flush();
});
$router->post('test',function ($request){
   $files=upload($request->getfile("files"));
   var_dump($files['metas'][0]['name']);
});
$router->resource('users','UserController');
$router->resource('posts','PostController');
$router->resource('comments','CommentController');