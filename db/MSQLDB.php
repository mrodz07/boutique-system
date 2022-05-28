<?php

class MSQLDB extends PDO {
  //instance
  private static $instance = null;
	//dbname
	private $dbname = "tec";
	//host
	private $host = "localhost";
	//user database
	private $user = "tec";
	//password user
	private $pass = "tecpass";
 
	//connect with mysql and pdo
	private function __construct(){
	  try {
	    $this->instance = parent::__construct("mysql:host=$this->host;dbname=$this->dbnamme;charset=UTF8");
	  } catch(PDOException $e) {
	      echo  $e->getMessage();
	  } 
	}

  public static function getInstance() {
    if (self::$instance === null) {
      self::$instance = new MSQLDB();
    }

    return self::$instance;
  }
 
	//función para cerrar una conexión pdo
	public function close(){
    	$this->instance = null;
	} 
}

?>
