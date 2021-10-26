<?php 

require_once __DIR__ . "/../classes/DB.php";

class Comment {
    public int $id;
    public int $post_id;
    public string $comment;
    public string $username;
    public User $owner;

    /**
     * Create new comment
     *
     * @param string $username
     * @param integer $post_id
     * @param string $comment
     * 
     * @return Comment
     */
    public static function create(string $username, int $post_id, string $comment):Comment
    {
        $query = "INSERT INTO 
            `comments` (`username`, `post_id`, `comment`)
            VALUES (:username, :post_id, :comment)
        ";
        
        $conn = DB::conn();
        $stmt = $conn->prepare($query);
        $stmt->execute([":username" => $username, ":post_id" => $post_id, ":comment" => $comment]);
        $comment_id = $conn->lastInsertId("id");

        return Comment::findOne($comment_id);
    }

    /**
     * Select comment by id
     *
     * @param integer $id
     * 
     * @return Comment
     */
    public static function findOne(int $id):Comment
    {
        $query  = "SELECT * FROM `comments` WHERE `id` = ?";
        $stmt = DB::conn()->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    /**
     * Select comments by post
     *
     * @param integer $post_id
     * @return array
     */
    public function findByPost(int $post_id):array
    {
        $query  = "SELECT * FROM `comments` WHERE `post_id` = ? ORDER BY `created_at` DESC";
        $stmt = DB::conn()->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        $stmt->execute([$post_id]);

        return $stmt->fetchAll();
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

        $query = "INSERT INTO `comment_likes` (`username`, `comment_id`) VALUES (?,?)";
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
        $query = "SELECT * FROM `comment_likes` WHERE `username` = ? AND `comment_id` = ?";
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
        
        $query = "DELETE FROM `comment_likes` WHERE `username` = ? AND `comment_id` = ?";
        
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
        $query = "SELECT COUNT(`comment_likes`.`username`) as likes FROM `comment_likes` WHERE `comment_id` = ?";

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


?>