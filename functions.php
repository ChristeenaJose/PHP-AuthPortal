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

            //escapes special characters in a string
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

    // Insert values into the database.
    function addUserReg($arrUserReg){

	    if(!empty($arrUserReg)){

            //escapes special characters in a string
            $username = $this->conn->real_escape_string($arrUserReg['username']);
            $password = $this->conn->real_escape_string($arrUserReg['password']);
            $email = $this->conn->real_escape_string($arrUserReg['email']);
            $create_datetime = date("Y-m-d H:i:s");

            $sql    = "INSERT into users (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";

            if($this->debug){print($sql. '<br/>');}
            $result = $this->conn->query($sql);
            if ($result === TRUE) {
                return true;
            } else {
                print( "Error: " . $sql . "<br>" . $this->conn->error);
                return false;
            }
        }
        return false;
    }
}
$classVar = new dbConnection();

?>