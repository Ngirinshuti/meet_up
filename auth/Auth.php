<?php

/**
 * Authentication file
 */

require "../config.php";
require "./User.php";
require "./Mail.php";

/**
 * Authentication class
 */
class Auth
{

    /**
     * Login a user
     *
     * @param string $password    user password
     * @param string $email       user email
     * @param string $username    user username
     * @param string $remember_me user auto login
     * 
     * @return User|bool
     */
    public static function login(
        string $password,
        string $email = "",
        string $username = "",
        bool $remember_me = false
    ): User|bool {
        $user = User::findOne($username, $email);

        if (!$user) {
            throw new AuthException("Incorrect credentials");
        }
        
        // compare password
        if (!password_verify($password, $user->password)) {
            throw new AuthException("Incorrect credentials");
        }

        return $user;
    }

    /**
     * Singup a user
     *
     * @param string $fname    user firstname
     * @param string $email    user email
     * @param string $username user username
     * @param string $password user pasword
     * @param string $lname    user lastname 
     * 
     * @throws AuthException
     * @return User|boolean
     */
    public static function signup(
        string $fname,
        string $email,
        string $username,
        string $password,
        string $lname = ""
    ): User|bool {
        $username_exists = User::findOne(username: $username);
        $email_exists = User::findOne(email: $email);

        // if username was already taken (throw an exception)
        if ($username_exists) {
            throw new AuthException("username '$username' already exists.");
        }

        // if email was already taken (throw an exception)
        if ($email_exists) {
            throw new AuthException("email  '$email' already exists.");
        }

        // hash user password
        $password = password_hash($password, PASSWORD_DEFAULT);
        // create a new user

        $user = User::create(
            ...compact(
                "fname",
                "email",
                "username",
                "password",
                "lname",
            )
        );

        return $user;
    }

    /**
     * Verify email
     *
     * @param string $email             user email
     * @param string $verification_code verification code
     * 
     * @throws AuthException
     * @return bool
     */
    public static function verifyEmail(string $email, string $verification_code): bool
    {
        $user = User::findOne(email: $email);

        if (!$user) {
            throw new AuthException("User with email '$email' not found!");
        }
        
        if ($user->verified) {
            throw new AuthException("This account is already verified!");
        }

        if ($user->code === $verification_code) {
            $user->setProperty('verified', 1);
            return true;
        } else {
            throw new AuthException("Provided verification code is invalid!");
        }
    }

    /**
     * Sends an email verification code
     *
     * @param User $user user to be verified
     * 
     * @return void
     */
    public static function sendVerficationCode(User $user)
    {
        // verification code
        $code = random_int(100000, 999999);
        $user->setProperty('code', $code);

        if (Mail::send($user->email, "CODE: $code")) {
            return true;
        } else {
            throw new AuthException("Email could not be sent!");
        }
    }

    /**
     * Remember user
     *
     * @param string $username user username
     * 
     * @return void
     */
    public static function remember(string $username): void
    {
        $user = User::findOne(username: $username);
        $remember_me_cookie = bin2hex(random_bytes(32));
        $remember_me_token = password_hash($remember_me_cookie, PASSWORD_DEFAULT);

        $user->setProperty(
            "remember_me",
            $remember_me_token
        );

        $expiration = time() + (60 * 60 * 24 * 7);
        setcookie("remember_me", $remember_me_cookie, $expiration);
    }

    /**
     * Check if there is a remembered user
     *
     * @return User|boolean
     */
    public static function checkRemembered(): User|bool
    {
        if (!isset($_COOKIE['remember_me'])) {
            return false;
        }

        $remember_me_cookie = $_COOKIE['remember_me'];
        $remember_me_token  = password_hash($remember_me_cookie, PASSWORD_DEFAULT);
        $query = "SELECT * FROM `users` WHERE `remember_me` = ?";
        $stmt = DB::conn()->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
        $stmt->execute([$remember_me_token]);
        $user = $stmt->fetch();

        if (!($user && password_verify($remember_me_cookie, $user->remember_me))) {
            return false;
        }

        return $user;
    }

    /**
     * Authenticates a user
     *
     * @param User $user a user 
     * 
     * @return bool true on success false on failure
     */
    public static function authenticate(User $user): bool
    {

        $_SESSION['auth_user'] = $user->username;
        return true;
    }

    /**
     * Get current User
     *
     * @return User|bool
     */
    public static function currentUser(): User|bool
    {
        if (!isset($_SESSION['auth_user'])) {
            return false;
        }

        $user = User::findOne(username: $_SESSION['auth_user']);

        if (!$user) {
            return false;
        }

        return $user;
    }

    /**
     * Logout current user
     *
     * @return void
     */
    public static function logout(): void
    {
        // destroy current user session
        session_unset();
        session_destroy();
        setcookie('remember_me', '', time() - 3600);
    }
}


/**
 * Authentication exeption class
 */
class AuthException extends Exception
{
}
