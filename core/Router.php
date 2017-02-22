<?php
namespace App\Core;

class Router{
    public $routes=[
        'GET'=>[],
        'POST'=>[],
        'PUT'=>[],
        'DELETE'=>[]
    ];
    protected $resoures=[];
    protected $callbacks;
    public static function load($file)
    {
        $router=new static;
        require $file;
        return $router;
    }
    public function define($routes)
    {
        $this->routes=$routes;
    }

    public function get($uri,$controller=null,callable $callback=null)
    {
        if(is_null($controller)&&!is_null($callback)){
            $this->callbacks=$callback;
        }else if(is_null($callback)&&!is_null($controller)){
            $this->routes['GET'][$uri]=$controller;
        }else{
            throw new \Exception("you must specify callback or controller for the route");
        }
    }

    public function post($uri,$controller=null,callable $callback=null)
    {
        if(is_null($controller)&&!is_null($callback)){
            $this->routes['GET'][$uri]=$callback;
        }else if(is_null($callback)&&!is_null($controller)){
            $this->routes['GET'][$uri]=$controller;
        }else{
            throw new \Exception("you must specify callback or controller for the route");
        }
    }

    public function resource($uri,$controller){
        $this->routes['POST'][$uri]=$controller."@store";
        $this->routes['GET'][$uri]=$controller."@index";
        $this->routes['GET'][$uri."/create"]=$controller."@create";
        $this->routes['GET'][$uri."/{{$uri}}"]=$controller."@show";
        $this->routes['PUT'][$uri."/{{$uri}}"]=$controller."@update";
        $this->routes['DELETE'][$uri."/{{$uri}}"]=$controller."@destroy";
        $this->routes['GET'][$uri."/{{$uri}}/edit"]=$controller."@edit";
        $this->resoures[$uri]=$controller;
    }

    public function direct($request)
    {

        if(array_key_exists($request->uri(),$this->routes[$request->method()])){
            if(is_callable($this->routes[$request->method()][$request->uri()])){
                App::call($this->routes[$request->method()][$request->uri()],$request);
            }else{
                return $this->callAction($request,
                    ... explode('@',$this->routes[$request->method()][$request->uri()])
                );
            }
        }else{
            throw new \Exception("No route defined for this URI");
        }

    }


    protected function callAction($request,$controller,$action)
    {

        $res=explode("/",$request->uri());
        if($controller==$this->resources[$res[0]]){

        }
        $controller="App\\Controllers\\{$controller}";
        $controller=new $controller();

        if(! method_exists($controller,$action)){
            throw new \Exception("{$controller} does not respond to the {$action} action.");
        }
        switch ($action){
            case "store":
                return $controller->$action($request);
                break;
            case "show":
                return $controller->$action($id);
                break;
            case "edit":
                return $controller->$action($id);
                break;
            case "update":
                return $controller->$action($request,$id);
                break;
            case "destroy":
                return $controller->$action($id);
                break;
            default:
                return $controller->$action();

        }

    }
// private function parseWildCard($model,$uri){
//        $route=;
//     $pattern = '/'.$model.'(\/)([0-9]+)/';
//     $replacement = '{${2}}';
//     if()
//     preg_replace($pattern, $replacement, $uri);
// }

}
