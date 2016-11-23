<?php
class database{
    /*
    public $host="mysql13.000webhost.com";
    public $user="a7586449_plus";
    public $pass="Lu7h0nd4";
    public $db="a7586449_db";
    */
    public $host="localhost";
    public $user="root";
    public $pass="qasw";
    public $db="novaFOOD";
    private static $instancia;

     function getDB(){
            $con=new PDO("mysql:host=$this->host;dbname=$this->db; charset=utf8mb4",$this->user,$this->pass);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $con;
        }
}
