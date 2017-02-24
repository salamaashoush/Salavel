<?php
namespace App\Core;
/**
 * Session Helper Class
 *
 * A simple session wrapper class.
 *
 * Recommended for use with PHP 5.4.0 or higher. (Not required.)
 *
 * Usage Example:
 * <?php
 * try {
 *     Session::w('foo', 'bar');
 *
 *     echo Session::r('foo');
 * }
 * catch (Exception $e) {
 *     // do something
 * }
 * ?>
 */
if ( !class_exists('CustomException') ) {
    class CustomException extends \Exception {}
}
class SessionHandlerException extends CustomException {}
class SessionDisabledException extends SessionHandlerException {}
class InvalidArgumentTypeException extends SessionHandlerException {}
class ExpiredSessionException extends SessionHandlerException {}
class SessionUseOnlyCookiesException extends SessionHandlerException {}
class SessionHttpOnlyCookieException extends SessionHandlerException {}
class SessionCookieSecureException extends SessionHandlerException {}
//defined('CHECK_ACCESS') or die('Direct access is not allowed.');
class Session
{

    protected static $SESSION_AGE = 1800;

    public static function write($key, $value)
    {
        if ( !is_string($key) )
            throw new InvalidArgumentTypeException('Session key must be string value');
        self::_init();
        $_SESSION[$key] = $value;
        self::_age();
        return $value;
    }


    public static function w($key, $value)
    {
        return self::write($key, $value);
    }


    public static function read($key, $child = false)
    {
        if ( !is_string($key) )
            throw new InvalidArgumentTypeException('Session key must be string value');
        self::_init();
        if (isset($_SESSION[$key]))
        {
            self::_age();

            if (false == $child)
            {
                return $_SESSION[$key];
            }
            else
            {
                if (isset($_SESSION[$key][$child]))
                {
                    return $_SESSION[$key][$child];
                }
            }
        }
        return false;
    }


    public static function r($key, $child = false)
    {
        return self::read($key, $child);
    }


    public static function delete($key)
    {
        if ( !is_string($key) )
            throw new InvalidArgumentTypeException('Session key must be string value');
        self::_init();
        unset($_SESSION[$key]);
        self::_age();
    }


    public static function d($key)
    {
        self::delete($key);
    }


    public static function dump()
    {
        self::_init();
        echo nl2br(print_r($_SESSION));
    }

    public static function start()
    {
        // this function is extraneous
        return self::_init();
    }


    private static function _age()
    {
        $last = isset($_SESSION['LAST_ACTIVE']) ? $_SESSION['LAST_ACTIVE'] : false ;

        if (false !== $last && (time() - $last > self::$SESSION_AGE))
        {
            self::destroy();
            throw new ExpiredSessionException();
        }
        $_SESSION['LAST_ACTIVE'] = time();
    }


    public static function params()
    {
        $r = array();
        if ( '' !== session_id() )
        {
            $r = session_get_cookie_params();
        }
        return $r;
    }


    public static function close()
    {
        if ( '' !== session_id() )
        {
            return session_write_close();
        }
        return true;
    }


    public static function commit()
    {
        return self::close();
    }


    public static function destroy()
    {
        if ( '' !== session_id() )
        {
            $_SESSION = array();
            // If it's desired to kill the session, also delete the session cookie.
            // Note: This will destroy the session, and not just the session data!
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();
        }
    }


    private static function _init()
    {
        if (function_exists('session_status'))
        {
            // PHP 5.4.0+
            if (session_status() == PHP_SESSION_DISABLED)
                throw new SessionDisabledException();
        }

        if ( '' === session_id() )
        {
            $secure = true;
            $httponly = true;
            // Disallow session passing as a GET parameter.
            // Requires PHP 4.3.0
            if (ini_set('session.use_only_cookies', 1) === false) {
                throw new SessionUseOnlyCookiesException();
            }
            // Mark the cookie as accessible only through the HTTP protocol.
            // Requires PHP 5.2.0
            if (ini_set('session.cookie_httponly', 1) === false) {
                throw new SessionHttpOnlyCookieException();
            }
            // Ensure that session cookies are only sent using SSL.
            // Requires a properly installed SSL certificate.
            // Requires PHP 4.0.4 and HTTPS
            //if (ini_set('session.cookie_secure', 1) === false) {
            //    throw new SessionCookieSecureException();
            //}
            $params = session_get_cookie_params();
            session_set_cookie_params($params['lifetime'],
                $params['path'], $params['domain'],
                $secure, $httponly
            );
            return session_start();
        }
        // Helps prevent hijacking by resetting the session ID at every request.
        // Might cause unnecessary file I/O overhead?
        // TODO: create config variable to control regenerate ID behavior
        return session_regenerate_id(true);
    }
}
