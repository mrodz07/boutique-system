<?php

class PSQLDB extends PDO {
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
	//port
	private $port = 5432;
 
	//connect with postgresql and pdo
	private function __construct(){
	  try {
	    $this->instance = parent::__construct("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname;user=$this->user;password=$this->pass");
	  } catch(PDOException $e) {
	      echo  $e->getMessage();
	  } 
	}

  public static function getInstance() {
    if (self::$instance === null) {
      self::$instance = new PSQLDB();
    }

    return self::$instance;
  }
 
	//función para cerrar una conexión pdo
	public function close(){
    	$this->instance = null;
	} 
}

?>
