<?php
$router->get('','PagesController@home');
$router->get('about','PagesController@about');
$router->get('contact','PagesController@contact');
$router->get('tasks','TasksController@index');
$router->post('tasks','TasksController@store');
