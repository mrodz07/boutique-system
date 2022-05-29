<?php

class MSQLDB extends PDO {
  //instance
  private static $instance = null;
  //config
  private $config = null;
 
	//connect with mysql and pdo
	private function __construct(){
    $config =  = parse_ini_file('psql.ini');
	  try {
	    $instance = parent::__construct("pgsql:host=" . $config['host'] . ";port=" . $config['port'] . ";dbname=" . $config['dbname'] . ";user=" . $config['user'] . ";password=" . $config['password']);
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
    	$instance = null;
	} 
}

?>
