<?php

class Database extends PDO {
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
  //instance
	private $dbh;
 
	//connect with postgresql and pdo
	private function __construct(){
	  try {
	    $this->dbh = parent::__construct("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname;user=$this->user;password=$this->pass");
	  } catch(PDOException $e) {
	      echo  $e->getMessage();
	  } 
	}

  public static function getInstance() {
    if (self::$instance === null) {
      self::$instance = new Database();
    }

    return self::$instance;
  }
 
	//función para cerrar una conexión pdo
	public function close(){
    	$this->dbh = null;
	} 
}

?>
