<?php
use App\Core\App;


App::bind('config',require 'config.php');

App::bind('database',new QueryBuilder(
    Connection::make(App::get('config')['database'])
));

function view($view,$data=[])
{
    extract($data);
    return require "app/views/{$view}.view.php";
}

function redirect($path,$data){
    session_start();
    $_SESSION['ERROR_MESSAGE']=$data;
    header("Location: /{$path}");
}
function resource($type,$name){
    if($type='css'){
        echo '<link rel="stylesheet" href="'."./public/${type}/${name}.${type}".'" >';
    }else if($type='js'){
        echo '<script type="text/javascript" src="'."./public/${type}/${name}.${type}".'" ></script>';
    }else{
        return "./public/${type}/${name}.${type}";
    }
    return "./public/${type}/${name}.${type}";
}