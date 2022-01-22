<?php

//Class for db connection
class dbConnection{
	
	function __construct(){
		$this->conn = $this->OpenCon();
		$this->debug = false;
		if($this->debug) print("Connected Successfully");
	} 
	function OpenCon(){
		$database = include('config.php');
		
		$dbhost = $database['host'];
		$dbuser = $database['user'];
		$dbpass = $database['pass'];
		$db = $database['name'];
		$this->conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $this->conn->error);
		return $this->conn;
	}
	function CloseCon($conn){
		$conn -> close();
	}

    // Check user is exist in the database.
    function checkUserExist($username, $password){
        if(!empty($username) && !empty($password)){

            $username = $this->conn->real_escape_string($username);
            $password = $this->conn->real_escape_string($password);

            $sql = "SELECT * FROM users WHERE username='" . $username . "'AND password='" . md5($password) . "'";
            if($this->debug){print($sql. '<br/>');}
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                return true;
            }
        }
        return false;
    }
}
$classVar = new dbConnection();

?>