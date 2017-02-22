<?php
namespace App\Core;

class Request{
    public  function uri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/');
    }

    public  function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function get($key)
    {
        if($this->method()=='GET'){
            if(isset($_GET[$key])){
                return $_GET[$key];
            }else{
                throw new \Exception("$key is not found");
            }
        }else if($this->method()=='POST'){
            if(isset($_POST[$key])){
                return $_POST[$key];
            }else{
                throw new \Exception("$key is not found");
            }
        }else{
            throw new \Exception("unsupported method");
        }
    }


}
