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
        $_SESSION['response']=$data;
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
    if($method==='post'||$method==='get'){
        echo '<form action="'.$action.'" method="'.$method.'" >';
        echo csrf_field();
    }else{
        echo '<form action="'.$action.'" method="post" '.'>';
        echo method_field($method);
        echo csrf_field();

    }
}
function close_form(){
    echo '</form>';
}
function generateCSRF(){
    if (empty($_SESSION['token'])) {
        $_SESSION['token']=bin2hex(random_bytes(32));
    }
    return $_SESSION['token'];
}
function verifyCSRF($request){
    if ($request->getCSRF()) {
        if (hash_equals($_SESSION['token'], $request->getCSRF())) {
           return true;
        } else {
            return false;
        }
    }
}

function csrf_field(){
    return '<input type="hidden" name="_token" value='.generateCSRF().' />';
}
