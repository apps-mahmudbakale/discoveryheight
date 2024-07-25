<?php 
/**
 * 
 */
class Subject 
{
	private $config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
	public $conn;
	private $table = 'subject';
	public $subject_id;
	public $subject_name;
	public $section_id;
	public $order_index;
	
	function __construct()
	{
		$this->conn = new Sqli($this->config);
	}


	public function getSubjects()
	{
		$this->conn->setFetchMode(2);
		if (!empty($this->section_id)) {
			$result = $this->conn->Rows("SELECT * FROM ".$this->table." INNER JOIN section USING(section_id) WHERE section.section_id =".$this->section_id);
		}else{
			$result = $this->conn->Rows("SELECT * FROM ".$this->table." INNER JOIN section USING (section_id)");
		}

		return $result;
	}


	public function MakeSubject()
	{
		$this->conn->Insert($this->table,
			array('section_id','subject_name', 'order_index'),
			array($this->section_id,$this->subject_name,'1')
		);

		return true;
	}


	public function UpdateSubject()
	{
		$this->conn->query("UPDATE ".$this->table." SET subject_name ='".$this->subject_name."', section_id='".$this->section_id."' WHERE subject_id='".$this->subject_id."'");

		return true;	
	}

	public function DeleteSubject()
	{
		$this->conn->query("DELETE FROM ".$this->table." WHERE subject_id='".$this->subject_id."'");

		return true;	
	}
}



 ?>