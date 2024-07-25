<?php 
/**
 * 
 */
class Permission 
{
	private $roles;
	private $config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
	private $table = 'permissions';
	public $conn;
	public $perm_id;
	public $perm;
	public $user_id;
	
	
	function __construct()
	{
		$this->conn = new Sqli($this->config);

	}


	public function ReadPermissions()
	{
		$query = "SELECT * FROM ".$this->table;
		$this->conn->setFetchMode(2);

		$result = $this->conn->Rows($query);

		return $result;
	}

	public function MakePermission()
	{
		$this->conn->Insert($this->table,
			array('perm'),
			array($this->perm)
		);
		return true;
	}

	public function UpdatePermission()
	{
		$this->conn->query("UPDATE ".$this->table." SET perm ='".$this->perm."' WHERE perm_id =".$this->perm_id);
		return true;
	}

	public function DeletePermission()
	{
		$this->conn->query("DELETE FROM ".$this->table." WHERE perm_id =".$this->perm_id);
		$this->conn->query("DELETE FROM role_perm WHERE perm_id='".$this->perm_id."'");
	}

	public function getRolePerms($role_id)
	{
		$perms = $this->conn->Rows("SELECT p.perm FROM role_perm as r JOIN ".$this->table." as p ON r.perm_id = p.perm_id WHERE r.role_id ='$role_id'");
		return $perms;
	}

	public function hasPerm($perm,$permArray)
	{
		$perms = array();
		foreach ($permArray as $value) {array_push($perms, $value['perm']);}

		if (in_array($perm, $perms)) {
			return true;
		}else{
			return false;
		}
	}

	public function IsFormMaster()
	{
		$value = $this->conn->NumRows("SELECT * FROM form_master WHERE user_id ='".$this->user_id."'");

		if ($value >= 1) {
			return true;
		}else{
			return false;
		}
	}

	public function FormMasterClass()
	{
			$query = "SELECT class_id FROM form_master WHERE user_id ='".$this->user_id."'";

			$this->conn->setFetchMode(2);

			$result = $this->conn->Row($query);

			return $result;
	}


	public function getTeachingSubject()
	{
		$query = "SELECT teacher_subject.class_id, teacher_subject.subject_id, subject.subject_name, subject.section_id FROM teacher_subject INNER JOIN subject USING(subject_id) INNER JOIN class USING(class_id) WHERE teacher_subject.user_id ='".$this->user_id."'";

		$this->conn->setFetchMode(2);

		$result = $this->conn->Row($query);

		return $result;
	}
}


 ?>