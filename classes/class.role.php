<?php 
/**
 * 
 */
class Role 
{
	private $config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
	public $conn;
	private $table = 'roles';
	protected $permissions;
	public $role;
	public $role_id;
	public $perm_id;
	function __construct()
	{
		$this->permissions = array();
		$this->conn = new Sqli($this->config);
	}


	public function getRoles()
	{
		$query = "SELECT * FROM roles";

		$this->conn->setFetchMode(2);

		$result = $this->conn->Rows($query);

		return $result;
	}

	public function MakeRole()
	{
		$this->conn->Insert($this->table,
			array('role'),
			array($this->role)
		);

		$row = $this->conn->Row("SELECT MAX(role_id) AS role_id FROM roles");
		$this->role_id = $row['role_id'];

		foreach ($this->perm_id as $perm) {
			$this->conn->Insert('role_perm',
				array('role_id', 'perm_id'), 
				array($this->role_id,$perm)
			);
		}

		return true;
	}

	public function UpdateRole()
	{
		$this->conn->query("UPDATE ".$this->table." SET role ='".$this->role."' WHERE role_id ='".$this->role_id."'");
		$this->conn->query("DELETE FROM role_perm WHERE role_id ='".$this->role_id."'");

		foreach ($this->perm_id as $perm) {
			$this->conn->Insert('role_perm',
				array('role_id', 'perm_id'), 
				array($this->role_id,$perm)
			);
		}

		return true;		

	}

	public function DeleteRole()
	{
		$this->conn->query("DELETE FROM ".$this->table." WHERE role_id =".$this->role_id);
		$this->conn->query("DELETE FROM role_perm WHERE role_id='".$this->role_id."'");

		return true;
	}

	public function getUserRole($user_id)
	{
		$row = $this->conn->Row("SELECT role_id FROM user_role WHERE user_id ='$user_id'");

		return $row;
	}


}
 ?>