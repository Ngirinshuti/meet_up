<?php

/**
 * New user file
 */
require "../config.php";
require $ROOT_DIR .  "/classes/DB.php";


/**
 * Interacts with users table
 */
class User
{
    public string $username;
    public string $email;
    public string $password;
    public string $fname;
    public string $lname;
    public string $dob;
    public string $sex;
    public string $about;
    public string $profile_pic;
    public string $address;
    public string $status;
    public string $code;
    public bool $verified;
    public string $remember_me;





    /**
     * Create user
     *
     * @param string $fname    user fisrtname
     * @param string $email    user email
     * @param string $username user username
     * @param string $password user password
     * @param string $lname    user lastname
     * 
     * @return User
     */
    public static function create(
        string $fname,
        string $email,
        string $username,
        string $password,
        string $lname = "",
        string $dob = "",
        string $sex = "",
        string $about = "",
        string $profile_pic = "",
        string $address = "",
        string $status = "offline",
        string $code = "",
        bool $verified = false,
        string $remember_me = ""
    ): User {
        $query = "INSERT INTO `users` 
            (
                `fname`,
                `email`,
                `username`,
                `password`,
                `lname`,
                `dob`,
                `sex`,
                `about`,
                `profile_pic`,
                `address`,
                `status`,
                `code`,
                `verified`,
                `remember_me`
            )
            VALUES (
                :fname,
                :email,
                :username,
                :password,
                :lname,
                :dob,
                :sex,
                :about,
                :profile_pic,
                :address,
                :status,
                :code,
                :verified,
                :remember_me
            )
        ";
        $conn = DB::conn();
        $stmt = $conn->prepare($query);
        $stmt->execute(
            [
                ":fname" => $fname,
                ":email" => $email,
                ":username" => $username,
                ":password" => $password,
                ":lname" => $lname,
                ":dob" => $dob,
                ":sex" => $sex,
                ":about" => $about,
                ":profile_pic" => $profile_pic,
                ":address" => $address,
                ":status" => $status,
                ":code" => $code,
                ":verified" => $verified,
                ":remember_me" => $remember_me
            ]
        );

        return User::findOne($username);
    }

    /**
     * Get a user by username or email
     *
     * @param string $username user username
     * @param string $email    user email
     * 
     * @return User|boolean
     */
    public static function findOne(
        string $username = "",
        string $email = ""
    ): User|bool {
        $query = "SELECT * FROM `users` WHERE `username` = ? OR `email` = ?";
        $stmt = DB::conn()->prepare($query);
        $stmt->execute([$username, $email]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        return $stmt->fetch();
    }

    /**
     * Get specific column value for the user (like username, etc)
     *
     * @param string $property column name to retrieve
     * 
     * @return mixed column value
     */
    public function getProperty(string $property)
    {
        $query = "SELECT `$property` FROM `users` WHERE `username` = ?";
        $stmt = DB::conn()->prepare($query);
        $stmt->execute([$this->username]);

        return $stmt->fetch()[$property];
    }


    /**
     * Update user specific column value
     *
     * @param string $property the column name
     * @param mixed  $value    column new value
     * 
     * @return bool
     */
    public function setProperty(string $property, mixed $value): bool
    {
        $query = "UPDATE `users` SET `$property`= ? WHERE `username` = ?";
        $stmt = DB::conn()->prepare($query);
        $stmt->execute([$value, $this->username]);

        return (bool) $stmt->rowCount();
    }
}
