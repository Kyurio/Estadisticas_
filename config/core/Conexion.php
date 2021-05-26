<?php

require_once("../../config/config.php");

class Conexion{


  private $host = HOST;
  private $user = USER;
  private $password = PASSWORD;
  private $db = NAME_BD;

  //conexion a la bd
  public function __construct(){

    $ConnectionString = "mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8";
    try {

      $this->connect = new PDO($ConnectionString,$this->user,$this->password);
      $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (Exception $e) {

      $this->connect = "ERROR de conexion";
      echo "ERROR: ".$e->getMessage();
    }


  }

  //metodo que retorna la conexion
  public function connect(){
    return $this->connect;

  }



}
