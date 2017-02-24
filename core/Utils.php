<?php
function view($view, $data = [])
{
    extract($data);
    return require "app/views/{$view}.view.php";
}

function partial($part, $data = [])
{
    extract($data);
    return require "app/views/partial/{$part}.part.php";
}

function redirect($url,$data,$statusCode = 303)
{
    $_SESSION['response'] = $data;
    header('Location: ' . $url, true, $statusCode);
    die();
}

function resource($type, $name)
{
    if ($type = 'css') {
        echo '<link rel="stylesheet" href="' . "./public/${type}/${name}.${type}" . '" >';
    } else if ($type = 'js') {
        echo '<script type="text/javascript" src="' . "./public/${type}/${name}.${type}" . '" ></script>';
    } else {
        return "./public/${type}/${name}.${type}";
    }
    return "./public/${type}/${name}.${type}";
}

function method_field($method)
{
    return '<input type="hidden" name="_method" value=' . $method . ' />';
}

function start_form($method, $action, $option = null)
{
    if ($method === 'post' || $method === 'get') {
        echo '<form action="' . $action . '" method="' . $method . '" >';
        echo csrf_field();
    } else {
        echo '<form action="' . $action . '" method="post" ' . '>';
        echo method_field($method);
        echo csrf_field();

    }
}

function close_form()
{
    echo '</form>';
}

function generateCSRF()
{
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['token'];
}

function verifyCSRF($request)
{
    if ($request->getCSRF()) {
        if (hash_equals($_SESSION['token'], $request->getCSRF())) {
            return true;
        } else {
            return false;
        }
    }
}

function csrf_field()
{
    return '<input type="hidden" name="_token" value=' . generateCSRF() . ' />';
}
function getErrors(){
    $errors=false;
    if(isset($_SESSION['response'])){
        $response=$_SESSION['response'];
        unset($_SESSION['response']);
        if(isset($response['errors'])){
            $errors=$response['errors'];
        }
    }
    return $errors;
}
function getResponse(){
    $response=false;
    if(isset($_SESSION['response'])){
        $response=$_SESSION['response'];
    }
    return $response;
}

function upload($file){
    $uploader = new \App\Core\Uploader();
    $data = $uploader->upload($file, array(
        'limit' => 10, //Maximum Limit of files. {null, Number}
        'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
        'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
        'required' => false, //Minimum one file is required for upload {Boolean}
        'uploadDir' => 'uploads/', //Upload directory {String}
        'title' => array('auto', 10), //New file name {null, String, Array} *please read documentation in README.md
        'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
        'replace' => false, //Replace the file if it already exists  {Boolean}
        'perms' => null, //Uploaded file permisions {null, Number}
        'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
        'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
        'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
        'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
        'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
        'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
    ));
    if($data['isComplete']){
        $files = $data['data'];
        print_r($files);
    }
    if($data['hasErrors']){
        $errors = $data['errors'];
        throw new Exception(print_r($errors));
    }
}
function onFilesRemoveCallback($removed_files){
    foreach($removed_files as $key=>$value){
        $file = '../uploads/' . $value;
        if(file_exists($file)){
            unlink($file);
        }
    }
    return $removed_files;
}
