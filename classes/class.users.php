<?php 
/**
 * 
 */
class User 
{
	private $config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
	public $conn;
	private $table = 'users';
	public $username;
	public $password; 
	public $firstname;
	public $lastname;
	public $phone;
	public $section;
	public $role_id;
	public $user_id;
	
	function __construct()
	{
		$this->conn =  new Sqli($this->config);
	}

	public function Auth()
	{
		$username = $this->username;
		$password = $this->password;
		$row = $this->conn->Row("SELECT * FROM users WHERE username ='".$username."'");

		if ($row >= 1) 
		{

			if (password_verify($password, $row['password'])) {
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['section'] = $row['section_id'];
				$_SESSION['username'] = $row['username'];
				echo "<script>window.location='dashboard.php'</script>";
			}else{
				echo error('Wrong Password');
			}
		}else{
				echo error('Wrong Details');
			}


	} 

	public function ReadUsers()
	{
		$query = "SELECT u.user_id, u.firstname, u.lastname, u.username, u.phone, r.role, s.section, u.section_id FROM ".$this->table." u LEFT JOIN user_role ur ON u.user_id = ur.user_id LEFT JOIN roles r ON ur.role_id = r.role_id LEFT JOIN section s ON s.section_id = u.section_id";
		$this->conn->setFetchMode(2);

		$result = $this->conn->Rows($query);

		return $result;
	}

	public function MakeUser()
	{
		$this->conn->Insert($this->table,
			array('section_id', 'firstname', 'lastname', 'username', 'password', 'phone'), 
			array($this->section,$this->firstname,$this->lastname,$this->username,$this->password,$this->phone)
		);
		$row = $this->conn->Row("SELECT MAX(user_id) AS user_id FROM users");
		$this->user_id = $row['user_id'];
		$this->conn->Insert('user_role',
			array('user_id', 'role_id'), 
			array($this->user_id,$this->role_id)
		);

		return true;
	}

	public function UpdateUser()
	{
		$this->conn->query("UPDATE ".$this->table." SET `section_id`='".$this->section."',`firstname`='".$this->firstname."',`lastname`='".$this->lastname."',`username`='".$this->username."',`phone`='".$this->phone."' WHERE `user_id` =".$this->user_id);
		$this->conn->query("UPDATE user_role SET role_id ='".$this->role_id."' WHERE user_id=".$this->user_id);

		return true;
	}

	public function DeleteUser()
	{
		$this->conn->query("DELETE FROM ".$this->table." WHERE user_id =".$this->user_id);
		$this->conn->query("DELETE FROM user_role WHERE user_id =".$this->user_id);
		return true;
	}

	public function id()
	{
		return $this->mysqli->insert_id;
	}
}
 ?>