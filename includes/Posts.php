<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 10/19/17
 * Time: 8:42 AM
 */
include_once ('DBConnect.php');
include_once ('User.php');
include_once ('PostCategories.php');
class Posts
{

    public static function createPost($title, $content, $status, $created_time, $updated_time, $author_user_id, $post_category_id){
        $db = new DBConnect();
        $sql = "Call SP_CREATE_POST('$title', '$content', '$status', null, null, $author_user_id, $post_category_id)";
        $db->getConnection()->query($sql);
    }

    public static function displayPostsTable(){
        $db = new DBConnect();
        $sql = "Call SP_GET_POSTS()";
        $result = $db->getConnection()->query($sql);
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $postAuthor = new User();
            $postAuthor->fetchUserFromDB($row['author_user_id']);
            $postCategoryID = (int) $row['post_category_id'];
            $postCategoryTitle = PostCategories::getCategoryName($postCategoryID);
            echo "<tr>";
            echo "<td>" . $row['post_id'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $postAuthor->getFirstname() .  " " . $postAuthor->getLastname() . "</td>";
            echo "<td>" . $postCategoryTitle . "</td>";
            echo "<td><a href='./createpost.php?edit=" . $row['post_id'] . "'>Edit</a></td>";
            echo "<td><a href='./createpost.php?delete=" . $row['post_id'] . "' class=\"text-danger\">Delete</a></td>";
            echo "</tr>";
        }
    }

    public static function displayPosts(){
        $db = new DBConnect();
        $sql = "Call SP_GET_POSTS()";
        $result = $db->getConnection()->query($sql);
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $postAuthor = new User();
            $postAuthor->fetchUserFromDB($row['author_user_id']);
            $postCategoryID = (int) $row['post_category_id'];
            $postCategoryTitle = PostCategories::getCategoryName($postCategoryID);
            echo "<div class='blog-post'>";
            echo "<h2 class=\"blog-post-title\">{$row['title']}</h2>";
            echo "<p class=\"blog-post-meta\">Posted by " . $postAuthor->getFirstname() . " " . $postAuthor->getLastname() . " in " . $postCategoryTitle . " </p>";
            echo "<p>";
            echo $row['content'];
            echo "</p>";
            echo "</div>";
        }
    }

    public static function deletePost($id){
        $db = new DBConnect();
        $sql = "Call SP_DELETE_POST(" . $id . ")";
        $db->getConnection()->query($sql);
    }

//    public static function getPost($id){
//        $db = new DBConnect();
//        $sql = "Call SP_GET_POST(" . $id . ")";
//        return $db->getConnection()->query($sql)->fetch(PDO::FETCH_OBJ);
//    }

    public static function updatePost($pid, $title, $content, $status, $author_user_id, $post_category_id){
        $db = new DBConnect();
        $sql = "Call SP_UPDATE_POST($pid, '$title', '$content', '$status', $author_user_id, $post_category_id)";
        $db->getConnection()->query($sql);
    }

}