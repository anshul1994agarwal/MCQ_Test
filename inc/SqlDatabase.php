<?php
	if (session_status() == PHP_SESSION_NONE) session_start();
	require_once("config.php");


class UiDB{
	protected static $conn;
	public function connect()
	{

		if(!isset(self::$conn))
		{
			self::$conn = new mysqli(DB_HOST,DB_USER, DB_PASSWORD,DB_NAME);
		}
	
		// If connection was not successful, handle the error
		if(self::$conn === false) 
		{
			// Handle error - notify administrator, log to a file, show an error screen, etc.
			return false;
		}
		//else
		//echo "db connected";
		return self::$conn;
	}
	public function disconnect()
	{
		$this->close();
	}
	public function freeResult()
	{
		$this->next_result();
	}
	public function query($query)
	{
		$dbconn = $this->connect();
		$result = $dbconn->query($query);
		return $result;
	}

	public function getError()
	{
		//$dbconn = $this->connect();
		$result = self::$conn->error;
		return $result;
	}
		/**		 * Fetch rows from the database (SELECT query)
	 *
	 * @param $query The query string
	 * @return bool False on failure / array Database rows on success
	 */
	public function select($query) {
		$rows = array();
		$result = $this -> query($query);
		if($result === false) {
			return false;
		}
		//echo "test1 query= $query";
		while ($row = $result -> fetch_assoc()) {
			$rows[] = $row;
			//echo "test2 : row =".$row[0];
		}
		$result->free();
		return $rows;
	}


	public function selectSingle($query) {
		$rows = array();
		$result = $this -> query($query);
		if($result === false) {
			return false;
		}
		//echo "test1 query= $query";
		$row = $result -> fetch_assoc();
		return $row;
	}

	public function UserSignup($username,$email,$password){
		$salt = rand(10000,99999);
		$newpass = $password.$salt;
		$hashes = hash("sha512",$newpass);

		$sql1 = "Select COUNT(id) as total from users where username = '".$username."' or email = '".$email."'";
		$result_count = $this->selectSingle($sql1);
		if($result_count["total"] > 0){
			return "exist";
		}
		else{
			$sql="INSERT INTO `users`(`username`, `email`, `password`, `salt`) VALUES ('$username','$email','$hashes','$salt')";

			$result=$this->query($sql);
			return $result;
		}
	}
	public function UserLogin($username,$password){
		$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
			$result = $this->select($sql);
			$send = "";
			if($result !="" || $result !=false || $result !=null){
				foreach ($result as $row) {
					$pass = $row["password"];
					$salt = $row["salt"];

					$newpass = $password.$salt;
					$hashes = hash("sha512",$newpass);

					if($hashes == $pass){
						$_SESSION["userIDTesting"] = $row["id"];
						$_SESSION["name"] = $row["username"];
						if($row["is_admin"] == 1){
							$send = "Admin";
						}else{
							$send = "Success";
						}

						
					}else{
						$send = "Invalid Password";
					}

				}
			}else{
				$send = "Something went wrong try again later";
			}

			return $send;
	}

	public function getallrecords(){
		$sql = "SELECT user_result.marks_obtained,user_result.created_date,users.username FROM user_result INNER JOIN users ON user_result.user_id = users.id";

		$result = $this->select($sql);
		return $result;
	}

	public function InsertResult($user_id,$marks){

		$sql="INSERT INTO `user_result`(`user_id`, `marks_obtained`) VALUES ($user_id,$marks)";

			$result=$this->query($sql);
			return $result;

	}
}
?>