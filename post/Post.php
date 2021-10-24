<?php

/**
 * Post php file
 *
 * @category Social_App
 * @package  MeetUp
 * @author   ISHIMWE <ishimwedeveloper@gmail.com>
 * @license  MIT url
 * @link     https://meet_up.com
 */

// require db connection file
require_once __DIR__ . "/../classes/DB.php";
/**
 * Post php class
 *
 * @category Social_App
 * @package  MeetUp
 * @author   ISHIMWE <ishimwedeveloper@gmail.com>
 * @license  MIT url
 * @link     https://meet_up.com
 */

class Post
{
    public int $id;
    public string $post;
    public string $image;
    public string $video;
    public string $username;
    public string $date;


    /**
     * Create post into database
     *
     * @param array  $post     post text description
     * @param string $username owner username
     * @param string $image    uploaded image name
     * @param string $video    uploaded video name
     * 
     * @return Post
     */
    public static function create(string $post,
        string $username, string $image = "", string $video= ""
    ): Post {
        $sql = <<<QR
            INSERT INTO `posts` (`post`, `username`, `image`, `video`) 
            VALUES (?, ?, ?, ?)
        QR;
        $conn = DB::conn();
        $stmt = $conn->prepare($sql);
        $stmt->execute([$post, $username, $image, $video]);
        $post_id = $conn->lastInsertId();
        $post = Post::findOne($post_id);
        
        return $post;
    }

    /**
     * Get one post from database
     *
     * @param integer $id Post id
     *
     * @return Post|bool
     */
    public static function findOne(int $id): Post|bool
    {

        // query to select post
        $stmt = DB::conn()->prepare(
            "SELECT * FROM `posts` WHERE `id` = '$id'"
        );

        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Get posts from friends
     *
     * @param string $username posts viewer
     *
     * @return array<Story>
     */
    public static function getFriendsPosts(string $username):array 
    {
        $we_are_friends = <<<QE
        (friend = `posts`.`username` AND partener = :user)
        OR
        (partener = `posts`.`username` AND friend = :user)
        QE;

        $query = <<<QUERY
            SELECT *, COUNT(`posts`.`id`) as post_count
             FROM `posts` WHERE EXISTS
             (SELECT * FROM `friends` WHERE ($we_are_friends))
             OR `posts`.`username` = :me
             GROUP BY `posts`.`username`
             ORDER BY `posts`.`date` DESC
        QUERY;

        $stmt = DB::conn()->prepare("SELECT * FROM `posts` Order By `date` Desc Limit 10");

        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        $stmt->execute();
        $data = $stmt->fetchAll();
        // var_dump($data[0]->owner());

        return $data;

    }


    /**
     * Like a post
     * 
     * @param string $username liker username
     * 
     * @return bool
     */
    public function like(string $username)
    {
        // exit("Oka");
        if ($this->likedBy($username)) {
            return true;
        }

        $query = "INSERT INTO `post_likes` (`username`, `post_id`) VALUES (?,?)";
        $stmt = DB::conn()->prepare($query);
        $stmt->execute([$username, $this->id]);
      
        return $stmt->rowCount() > 0;
    }

    /**
     * Check if user liked a post
     * 
     * @param string $username user username
     * 
     * @return bool
     */
    public function likedBy(string $username)
    {
        $query = "SELECT * FROM `post_likes` WHERE `username` = ? AND `post_id` = ?";
        $stmt = DB::conn()->prepare($query);
        $stmt->execute([$username, $this->id]);

        return $stmt->rowCount() > 0;
    }
    
    /**
     * Unlike post
     * 
     * @param string username liker username
     * 
     * @return bool
     */
    public function unlike(string $username)
    {
        if (!$this->likedBy($username)) {
            return true;
        }
        
        $query = "DELETE FROM `post_likes` WHERE `username` = ? AND `post_id` = ?";
        
        $stmt = DB::conn()->prepare($query);
        $stmt->execute([$username, $this->id]);
    
        return $stmt->rowCount() > 0;
    }
    
    /**
     * Get post likes count
     * 
     * @return int likes
     */
    public function likes()
    {
        $query = "SELECT COUNT(`post_likes`.`username`) as likes FROM `post_likes` WHERE `post_id` = ?";

        $stmt = DB::conn()->prepare($query);
        $stmt->execute([$this->id]);
        $likes = $stmt->fetch(PDO::FETCH_OBJ)->likes;
    
        return $likes;
    }

    /**
     * Get post owner
     * 
     * @return object post owner
     */
    public function owner()
    {
        if (isset($this->owner)) {
            return $this->owner;
        }
        $query = "SELECT * FROM USERS WHERE `username` = ?";
        $stmt = DB::conn()->prepare($query);
        $stmt->execute([$this->username]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $this->owner = $user;
        return $this->owner;
    }
    
}
