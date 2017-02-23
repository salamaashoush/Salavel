<?php
namespace App\Core;

class Router{
    public $routes=[
        'GET'=>[],
        'POST'=>[],
        'PUT'=>[],
        'DELETE'=>[]
    ];
    protected $resources=[];
    protected $models=[];
    protected $parameters;
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
        $this->routes['GET'][$uri."/{id}"]=$controller."@show";
        $this->routes['PUT'][$uri."/{id}"]=$controller."@update";
        $this->routes['DELETE'][$uri."/{id}"]=$controller."@destroy";
        $this->routes['GET'][$uri."/{id}/edit"]=$controller."@edit";
        $this->resources[$uri]=$uri;
    }

    public function direct($request)
    {
        $uri = $this->parseUri($request);
        if(array_key_exists($uri,$this->routes[$request->method()])){
            if(is_callable($this->routes[$request->method()][$uri])){
                App::call($this->routes[$request->method()][$uri],$request);
            }else{
                return $this->callAction($request,
                    ... explode('@',$this->routes[$request->method()][$uri])
                );
            }
        }else{
            throw new \Exception("No route defined for this URI");
        }

    }


    protected function callAction($request,$controller,$action)
    {
        $controller="App\\Controllers\\{$controller}";
        $controller=new $controller();
        $id=isset($this->parameters[0])?$this->parameters[0]:null;
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

    protected function parseUri($request)
    {
        $string = $request->uri();
        $pattern = '/([0-9]+)/';
        $replacement = '{id}';
        preg_match($pattern, $string, $this->parameters);;
        $uri = preg_replace($pattern, $replacement, $string);
        return $uri;
    }

//    public function matches($url)
//    {
//        $pattern = $this->pattern;
//
//        // get keys
//        preg_match_all("#:([a-zA-Z0-9]+)#", $pattern, $keys);
//
//        if (sizeof($keys) && sizeof($keys[0]) && sizeof($keys[1]))
//        {
//            $keys = $keys[1];
//        }
//        else
//        {
//            // no keys in the pattern, return a simple match
//            return preg_match("#^{$pattern}$#", $url);
//        }
//
//        // normalize route pattern
//        $pattern = preg_replace("#(:[a-zA-Z0-9]+)#", "([a-zA-Z0-9-_]+)", $pattern);
//
//        // check values
//        preg_match_all("#^{$pattern}$#", $url, $values);
//
//        if (sizeof($values) && sizeof($values[0]) && sizeof($values[1]))
//        {
//            // unset the matched url
//            unset($values[0]);
//
//            // values found, modify parameters and return
//            $derived = array_combine($keys, ArrayMethods::flatten($values));
//            $this->parameters = array_merge($this->parameters, $derived);
//
//            return true;
//        }
//
//        return false;
//    }
//}
// private function parseWildCard($model,$uri){
//        $route=;
//     $pattern = '/'.$model.'(\/)([0-9]+)/';
//     $replacement = '{${2}}';
//     if()
//     preg_replace($pattern, $replacement, $uri);
// }

}
