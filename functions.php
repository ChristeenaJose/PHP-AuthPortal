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

    // Check user is exist in the database for Login.
    function checkUserLogin($username, $password){
        if(!empty($username) && !empty($password)){

            //escapes special characters in a string
            $username = $this->conn->real_escape_string($username);
            $password = $this->conn->real_escape_string($password);

            $sql = "SELECT * FROM users WHERE username='" . $username . "'AND password='" . md5($password) . "' AND active = 1";
            if($this->debug){print($sql. '<br/>');}
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                return true;
            }
        }
        return false;
    }

    // Check user is exist in the database for Registration.
    function chkUserExist($email){
        if(!empty($email)){
            //escapes special characters in a string
            $email = $this->conn->real_escape_string($email);

            $sql = "SELECT * FROM users WHERE email='" . $email . "'";
            if($this->debug){print($sql. '<br/>');}
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                return true;
            }
        }
        return false;
    }

    // Check user is exist in the database for Registration.
    function activateUser($userId){
        if(!empty($userId) && $userId > 0){

            $sql = "UPDATE users SET  active =  '1' WHERE id ='" . $userId . "'";
            if($this->debug){print($sql. '<br/>');}
            $result = $this->conn->query($sql);
            if ($result === TRUE) {
                return true;
            }else {
                print( "Error: " . $sql . "<br>" . $this->conn->error);
                return false;
            }
        }
        return false;
    }

    // Check user is exist in the database by ID.
    function chkUserExistById($userId){
        if(!empty($userId) && $userId > 0){

            $sql = "SELECT * FROM users WHERE id='" . $userId . "'";
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

                // Send mail for confirming email.
                $regId = $this->conn->insert_id;
                if($this->sendConfirmationMail($regId, $arrUserReg)){
                    return true;
                }
                else{
                    return false;
                }

            } else {
                print( "Error: " . $sql . "<br>" . $this->conn->error);
                return false;
            }
        }
        return false;
    }

    // Send mail for confirming email.
    function sendConfirmationMail($regId, $arrUserReg){

        $subject = "Registration Confirmation";

        $to = "christyjose.m.j@gmail.com";
        $from = "christyjose.m.j@gmail.com";

        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $mailTemplate = file_get_contents("module/email_template.html");
        $actUrl =  str_replace('registration.php', 'activate.php',$_SERVER['HTTP_REFERER']);
        $actUrl = $actUrl . '?id=' . base64_encode($regId);
        $message = str_replace('%%$USERNAME%%', $arrUserReg['username'], $mailTemplate);
        $message = str_replace('%%$CONFIRMATIONLINK%%', $actUrl,$message);
        $message = str_replace('%%$CONFIRMATIONLINK2%%', $actUrl,$message);


        if(mail($to,$subject,$message,$headers)){
            return true;
        }
        else{
            return false;
        }
    }
}
$classVar = new dbConnection();

?>