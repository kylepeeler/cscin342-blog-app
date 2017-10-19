<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 10/18/17
 * Time: 11:06 PM
 */

include_once ('DBConnect.php');
//check if the password is 10 characters or greater
function match_pw_length($pw){
    return strlen($pw) > 11;
}

//function to check if the string has a letter in it, if so return true
function has_letters($string){
    return preg_match('/[A-Za-z]/', $string);
}

//function to check if the string has a number in it, if so return true
function has_numbers($string){
    return preg_match('/[0-9]/', $string);
}

//function to generate a string with a random set of characters of a given length
function generate_activation_code($length){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

//function to check if activation code is 50 characters and has a letter and number
function valid_activation_code($code){
    return strlen($code) == 50 && has_letters($code) && has_numbers($code);
}

//function to generate and send a valid email
function send_activation_email($address, $activation_code){
    $message = "Thank you for registering! Please click the link/go to the following URL below to activate your account: \n\n http://corsair.cs.iupui.edu:21231/courseProject/app/register.php?email=".htmlspecialchars($address)."&code=".$activation_code;
    mail($address, "Please activate account", $message);
}


function get_db_user_count($email, $pwd){
    $con = new DBConnect();
    $sql = "Call SP_COUNT_USER('".$email."', '".$pwd."');";
    $stmt = $con->getConnection()->query($sql);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return (int)$result->c;
}

function get_db_email_count($email){
    $con = new DBConnect();
    $sql = "Call SP_COUNT_EMAIL('".$email."');";
    $stmt = $con->getConnection()->query($sql);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return (int)$result->c;
}
