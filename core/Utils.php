<?php
    function view($view,$data=[])
    {
        extract($data);
        return require "app/views/{$view}.view.php";
    }

    function partial($part,$data=[])
    {
        extract($data);
        return require "app/views/partial/{$part}.part.php";
    }

    function redirect($path,$data){
        \App\Core\Session::w('response',$data);
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
function method_field($method){
    return '<input type="hidden" name="_method" value='.$method.' />';
}
function start_form($method,$action,$option=null){
    if($method!='post'||$method!='get'){
        echo '<form action="'.$action.'" method="post" '.'>';
        echo method_field($method);
    }else{
        echo '<form action="'.$action.'" method="'.$method.' >';
    }
}
function close_form(){
    echo '</form>';
}