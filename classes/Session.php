<?php 

class Session
{
    // seen keys session key
    protected static string $seen_key = "session.seen";

    /**
     * Initialize session
     *
     * @return Session
     */
    public static function init()
    {
        Session::set(Session::$seen_key, []);
    }

    /**
     * Set session key as seen
     *
     * @param string $key key 
     * 
     * @return Session
     */
    public static function setAsSeen(string $key):Session
    {
        if (!Session::has(Session::$seen_key)) {
            Session::se();
        }

        array_push($_SESSION[Session::$seen_key], [$key]);
        return Session;
    }

    public static function clearSeen()
    {
        if (!Session::has(Session::$seen_key)) {
            Session::init();
        }

        $seen = Session::get(Session::$seen_key);

        foreach ($seen as $value) {
            if (Session::has($value)) {
                Session::remove($value);
            }
        }
    }

    /**
     * Check if session key is set
     *
     * @param string $key session key
     * 
     * @return boolean
     */
    public static function has(string $key):bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Get a session key and set as seen
     *
     * @param string $key         session key
     * @param mixed|null $default default value
     * 
     * @return mixed
     */
    public static function see(string $key, ?mixed $default):mixed
    {
        Session::setAsSeen($key);
        return Session::get($key, $default);
    }

    /**
     * Get session key value
     *
     * @param string $key         key
     * @param mixed|null $default default value
     * 
     * @return mixed
     */
    public static function get(string $key, ?mixed $default):mixed
    {
        return Session::has($key) ? $_SESSION[$key] : $default;
    }

    /**
     * Set session key & value
     *
     * @param string $key  session key
     * @param mixed $value session value
     * 
     * @return Session
     */
    public static function set(string $key, mixed $value):Session
    {
        $_SESSION[$key] === $value;
        return Session;
    }

    /**
     * Unset session key
     *
     * @param string $key key
     * 
     * @return Session
     */
    public static function remove(string $key):Session
    {
        unset($_SESSION[$key]);
        return Session;
    }

}