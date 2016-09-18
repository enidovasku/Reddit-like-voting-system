<?php
class Database
{
	//host config
	private $host = "localhost";
	private $username = "root";
	private $password = "";
	private $db = "voting-system";

	private $conn;
  	private $stmt;
  	private $result;
  	public $errorMessage;

  	public function __construct()
  	{
    	$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->username, $this->password);
    	$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  	}

  	//returns an array of results
  	public function select($sql,$bindingArray = null)
  	{
  		try
  		{
  			$this->stmt = $this->conn->prepare($sql);
    		$this->stmt->execute($bindingArray);
    		$this->result = $this->stmt->fetch();
    		return $this->result;
  		}
    	catch(Exception $e)
    	{
    		echo "Error ". $e->getMessage();
    	}
  	}

  	//insert into database
  	public function insert($sql,$bindingArray = null)
  	{
  		try
  		{
  			$this->stmt = $this->conn->prepare($sql);
    		$this->stmt->execute($bindingArray);
  		}
    	catch(Exception $e)
    	{
    		$this->errorMessage = $e->getMessage();
    	}
  	}

}




