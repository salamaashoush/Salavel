<?php
namespace App\Core;
class Session
{
    protected static $message;

    public static function setFlash($message)
    {
        self::$message=$message;
    }

    public static function hasFlash()
    {
        return !is_null(self::$message);
    }

    public static function flash()
    {
        echo self::$message;
        self::$message=null;
    }

    public static function set($key,$value)
    {
        $_SESSION[$key]=$value;
    }

    public static function get($key)
    {
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return null;
    }

    public static function delete($key)
    {
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }

    public static function destroy()
    {
        session_destroy();
    }

    public static function getId()
    {
        return session_id();
    }

    public static function newId($deleteOldSession = false)
    {
        return session_regenerate_id($deleteOldSession);
    }

    public static function setCookie($key,$value){
        setcookie ($key, $value, time()+3600*24*7);
    }

    public static function getCookie($cookie)
    {
        if(isset($_COOKIE[$cookie])) {
           return $cookie;
        } else {
            return null;
        }
    }
    public static function deleteCookie($cookie)
    {
        setcookie($cookie, "", time() - 3600);
    }

    public static function saveLogin($username,$role,$password)
    {
        self::set('username',$username);
        self::set('password',$password);
        self::set('role',$role);
    }

    public static function rememberLogin($username,$role,$password)
    {
        self::setCookie('username',$username);
        self::setCookie('password',$password);
        self::setCookie('role',$role);
    }

    public static function forgetLogin()
    {
        self::deleteCookie('username');
        self::deleteCookie('password');
        self::deleteCookie('role');
    }

    public static function isLogin()
    {
        if(self::get('username')||self::getCookie('username')){
            return true;
        }
        return false;
    }

}
