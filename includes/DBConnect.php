<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 10/19/17
 * Time: 2:08 AM
 */

class DBConnect
{

public $con = null;

    /**
     * DBConnect constructor.
     * @param null $con
     */
    public function __construct()
    {
        try {
            $this->con = new PDO("mysql:host=localhost;dbname=kapeeler_db", "kapeeler", "kapeeler");

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public function getConnection()
    {
        return $this->con;
    }



}