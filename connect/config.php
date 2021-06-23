<?php

Class Database{
 
	private $server = "mysql:host=localhost;dbname=nawarni";
	private $username = "root";
	private $password = "";
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
	protected $conn;


 	//Set connection and open database
	public function open(){
 		try{
 			$this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
 			return $this->conn;
 		}
 		catch (PDOException $e){
 			echo "There is some problem in connection: " . $e->getMessage();
 		}
 
    }
 

    //Close connection 
	public function close(){
   		$this->conn = null;
 	}


     //Query
     public  function query($query, $params = array()) {
         $statement = $this->open()->prepare($query);
         $statement->execute($params);

         if(explode(' ', $query)[0] == 'SELECT' ) {
             $data = $statement->fetchAll();
             return $data;
         }
         
     }
 
}

$pdo = new Database();
 
?>