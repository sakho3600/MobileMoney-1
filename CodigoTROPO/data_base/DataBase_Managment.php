<?php

/**
 * Created by PhpStorm.
 * User: Jonan
 * Date: 10/24/2016
 * Time: 6:17 PM
 */
class DataBase_Managment
{

    private $host= "localhost";
    private $user = "tecnomad_root";
    private $password = "admin123";
    private $dataBase = "tecnomad_arduino_problema";

    /**
     * DataBase_Managment constructor.
     * @param string $host
     */
    


    //-------------------------------Connection to the Data Base---------------------------------------------
    public function db_Connection(){
        $connection = new mysqli($this->host, $this->user, $this->password, $this->dataBase);
        if (!$connection) {
            die('Could not connect: ' .$connection->connect_error);
        }
        //echo 'Connected successfully';
        return $connection;
    }



}
?>