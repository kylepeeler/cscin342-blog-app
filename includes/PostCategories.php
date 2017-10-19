<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 10/19/17
 * Time: 6:29 AM
 */

include_once('DBConnect.php');

class PostCategories
{
    public static function getCategoryDropdown($id){
        $db = new DBConnect();
        $sql = "Call SP_GET_POST_CATEGORIES()";
        $result = $db->getConnection()->query($sql);
        echo '<div class="form-group">';
        echo '<label for="exampleFormControlSelect1">Post Category</label>';
        echo '<select class="form-control" id="' . $id .'" name="' . $id .'">';
             echo "<option value='0' selected>" . "Uncategorized" . "</option>";
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo "<option value='".$row['post_category_id']."'>" . $row['title'] . "</option>";
        }
        echo '</select>';
        echo '</div>';
    }

    public static function displayCategories(){
        $db = new DBConnect();
        $sql = "Call SP_GET_POST_CATEGORIES()";
        $result = $db->getConnection()->query($sql);
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>";
                echo "<td>" . $row['post_category_id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['slug'] . "</td>";
        echo "<td><a href='./categories.php?edit=" . $row['post_category_id'] . "'>Edit</a></td>";
        echo "<td><a href='./categories.php?delete=" . $row['post_category_id'] . "' class=\"text-danger\">Delete</a></td>";
        echo "</tr>";
    }
}

public static function getCategory($id){
    $db = new DBConnect();
    $sql = "Call SP_GET_POST_CATEGORY(" . $id . ")";
    return $db->getConnection()->query($sql)->fetch(PDO::FETCH_OBJ);
}

public static function getCategoryName($id){
    if ($id != 0) {
        $db = new DBConnect();
        $sql = "Call SP_GET_POST_CATEGORY($id)";
        return $db->getConnection()->query($sql)->fetch(PDO::FETCH_OBJ)->title;
    }else return "Uncategorized";
    }

    public static function updateCategory($id, $title, $createuid, $slug){
        $db = new DBConnect();
        $sql = "Call SP_UPDATE_CATEGORY(" . $id .",'". $title."'," . $createuid.",'".$slug."')";
        $db->getConnection()->query($sql);
    }

    public static function createCategory($title, $createuid, $slug){
        $db = new DBConnect();
        $sql = "Call SP_CREATE_POST_CATEGORY('" . $title."'," . $createuid.",'".$slug."')";
        $db->getConnection()->query($sql);
    }

    public static function deleteCategory($id){
        $db = new DBConnect();
        $sql = "Call SP_DELETE_CATEGORY(" . $id . ")";
        $db->getConnection()->query($sql);
    }
}