<?php
include_once('util.php');
/**
 * Created by PhpStorm.
 * user: kyle
 * Date: 9/22/17
 * Time: 4:31 PM
 */



class User{

    private $firstname = null;
    private $lastname = null;
    private $password = null;
    private $email = null;
    private $avatar_url = null;
    private $profile_desc = null;
    private $is_activated = false;
    private $is_admin = false;

    /**
     * User constructor.
     * @param null $passwordHash
     * @param null $email
     */
    public function setCredentials($email, $password)
    {
        $this->password = $password;
        $this->email = $email;
        if ($this->isRegistered()){
            $this->fetchFromDB();
        }
    }


    /**
     * User constructor.
     * @param $firstname
     * @param $lastname
     * @param $passwordHash
     * @param $email
     * @param $profile_desc
     */
    public function create($firstname, $lastname, $password, $email, $profile_desc)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->password = $password;
        $this->email = $email;
        $this->profile_desc = $profile_desc;
        $this->avatar_url = "https://ui-avatars.com/api/?name=" . $this->firstname . "+" . $this->lastname ."&rounded=true";
    }



    /**
     * @return mixed
     */
    public function getisActivated()
    {
        return $this->is_activated;
    }

    /**
     * @param null $avatar_url
     */
    public function setAvatarUrl($avatar_url)
    {
        $this->avatar_url = $avatar_url;
    }

    /**
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->is_admin;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAvatarUrl()
    {
        return $this->avatar_url;
    }

    /**
     * @return mixed
     */
    public function getProfileDesc()
    {
        return $this->profile_desc;
    }

    /**
     * @param mixed $profile_desc
     */
    public function setProfileDesc($profile_desc)
    {
        $this->profile_desc = $profile_desc;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function register(){
        if (get_db_email_count($this->getEmail()) == 0){
            $db = new DBConnect();
            $activation_code = generate_activation_code(50);
            $sql = "Call SP_REGISTER_USER('". $this->getEmail() . "','" . $this->getPassword() . "','" . $this->getFirstname() . "','" . $this->getLastname() . "','" . $this->getAvatarUrl() . "','" . $this->getProfileDesc() . "','" . $activation_code . "')";
            send_activation_email($this->getEmail(), $activation_code);
            $con = $db->getConnection();
            $con->query($sql);
            return true;
        }else{
            return false;
        }
    }

    public function isRegistered(){
        return get_db_email_count($this->getEmail());
    }

    public function isValidCredentials(){
        return get_db_user_count($this->getEmail(), $this->getPassword());
    }

    public function fetchFromDB(){
        if ($this->isRegistered()){
            $db = new DBConnect();
            $sql = "Call SP_FIND_USER('" . $this->getUID() . "')";
            $results = $db->getConnection()->query($sql);
            $dbuser = $results->fetch(PDO::FETCH_OBJ);
            $this->setPassword($dbuser->password);
            $this->setFirstname($dbuser->first_name);
            $this->setLastname($dbuser->last_name);
            $this->setProfileDesc($dbuser->profile_desc);
            $this->setAvatarUrl($dbuser->avatar_url);
            $this->is_admin = $dbuser->is_admin;
            $this->is_activated = $dbuser->is_activated;
        }
    }

    public function fetchUserFromDB($uid){
            $db = new DBConnect();
            $sql = "Call SP_FIND_USER('" . $uid . "')";
            $results = $db->getConnection()->query($sql);
            $dbuser = $results->fetch(PDO::FETCH_OBJ);
            $this->setPassword($dbuser->password);
            $this->setFirstname($dbuser->first_name);
            $this->setLastname($dbuser->last_name);
            $this->setProfileDesc($dbuser->profile_desc);
            $this->setAvatarUrl($dbuser->avatar_url);
            $this->is_admin = $dbuser->is_admin;
            $this->is_activated = $dbuser->is_activated;
    }

    public function updateDB(){
        if ($this->isValidCredentials()){
            $db = new DBConnect();
            $uid = $this->getUID();
            $update_sql = "Call SP_UPDATE_USER(" . $uid . ",'" . $this->getEmail() . "','" . $this->getPassword() . "','" . $this->getFirstname() . "','" . $this->getLastname() . "','" . $this->getAvatarUrl() . "','" . $this->getProfileDesc() . "'," . $this->is_activated . "," . $this->is_admin . ")";
            $db->getConnection()->query($update_sql);
        }else{
            echo 'invalid user credentials, try fetching from database first';
        }
    }

    public function activateUser($usr_activation_code){
        if ($this->isRegistered() && !$this->is_activated){
            $db = new DBConnect();
            $uid = $this->getUID();
            $sql = "Call SP_FIND_ACTIVATION_CODE(". $uid .")";
            $activation_code = $db->getConnection()->query($sql)->fetch(PDO::FETCH_OBJ)->activation_code;
            if ($usr_activation_code == $activation_code){
                $this->is_activated = true;
                $this->updateDB();
                return true;
            }
            return false;
        }else{
            return false;
        }
    }

    public function getUID(){
        if ($this->isRegistered()){
            $db = new DBConnect();
            $sql = "Call SP_FIND_USER_ID('" . $this->getEmail() . "')";
            $result = $db->getConnection()->query($sql)->fetch(PDO::FETCH_OBJ);
            return $uid = $result->user_id;
        }else return -1;
    }

    public function printUserInfo(){
        echo 'First Name: ' . $this->getFirstname() . '<br/>';
        echo 'Last Name: ' . $this->getLastname() . '<br/>';
        echo 'Password Hash: ' . $this->getPassword() . '<br/>';
        echo 'Email: ' . $this->getEmail() . '<br/>';
        echo 'Profile Description: ' . $this->getProfileDesc() . '<br/>';
        echo 'Avatar URL: ' . $this->getAvatarUrl() . '<br/>';
        echo 'Is Activated? ' . $this->is_activated ? 'true' : 'false' . '<br/>';
        echo 'Is Admin? ' . $this->is_admin ? 'true' : 'false';
    }



}