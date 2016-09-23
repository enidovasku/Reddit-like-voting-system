<?php
include_once("db.php");

class Auth
{
	//the database model
	private $db;
	public $errorMessage;

	public function __construct()
	{
		$this->db = new Database();
	}

	public function register($username, $email, $password)
	{
		//encrypting password
		$hashed_password = $password;

		//insert values in users table using insert function
		$this->db->insert("INSERT INTO users (username, email, password) 
		VALUES (:username, :email, :password)", [':username'=>$username, ':email'=>$email, 'password'=>$hashed_password]);
		//error handling
		if($this->db->errorMessage == null) return 1;	
		else 
		{
			$this->errorMessage = $this->db->errorMessage;
			return 0;	
		}
	}

	public function login($username, $password)
	{
		//encrypting password
		$hashed_password = $password;

		//find user
		$result = $this->db->select("SELECT*FROM users WHERE username = :username", 
			[':username'=>$username]);
		if(!$result)
		{
			$this->errorMessage = "User does not exist!";
			return 0;
		}
		else
		{
			//username match
			if($hashed_password == $result['password'])
				return $result['id'];
			else
			{
				$this->errorMessage = "Wrong password";
				return 0;
			}
		}
	}	
}

$auth = new Auth();