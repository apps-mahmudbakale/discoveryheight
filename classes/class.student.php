<?php 

class Student 
{
	private $config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
	private $table ='applicant';
	public $admNo;
	public $student_id;
	public $section_id;
	public $class_id;
	
	function __construct()
	{
		$this->conn = new Sqli($this->config);
	}

	public function getStudents()
	{
		$this->conn->setFetchMode(2);

		if (!empty($this->section_id)) {
			$result = $this->conn->Rows("SELECT * FROM ".$this->table." INNER JOIN applicant USING(app_id)");

		}else{
			$result = $this->conn->Rows("SELECT * FROM ".$this->table." INNER JOIN class USING(class_id)");
		}
		return $result;
	}

	public function FormMasterStudents()
	{
		$result = $this->conn->Rows("SELECT * FROM ".$this->table." INNER JOIN applicant USING(app_id) INNER JOIN class USING(class_id) WHERE class_id ='".$this->class_id."'");

	}
}
 ?>