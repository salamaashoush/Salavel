<?php
namespace App\Core;

class Request{
    protected $query;
    protected $parameters=[];
    public function uri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/');
    }
    public function getQuery(){
        if(isset($_SERVER['QUERY_STRING'])){
             $query=[];
             $this->query=parse_str($_SERVER['QUERY_STRING'],$query);
             return $query;
        } else {
            return [];
        }

    }
    public function method()
    {
        if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['_method'])){
            return strtoupper($_POST['_method']);
        }
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

    public function getAll()
    {
        if($this->method()=='GET'){
            if(!empty($_GET)){
                return $_GET;
            }else{
                throw new \Exception("there no request parameters");
            }
        }else if($this->method()=='POST'){
            if(isset($_POST['_method'])){
                unset($_POST['_method']);
                return $_POST;
            }else{
                return $_POST;
            }
        }else{
            throw new \Exception("unsupported method");
        }
    }

    public function getParameters($uri)
    {
        if(isset($this->parameters[$uri])){
            return $this->parameters[$uri];
        }
        return null;

    }
    public function setParameters($uri,$parameters)
    {
        $this->parameters[$uri]=$parameters;
    }


}
