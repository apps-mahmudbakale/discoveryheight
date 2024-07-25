<?php 
/**
 * 
 */
class Section 
{
	private $config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
	private $table = 'section';
	public $conn;
	public $section;
	public $section_id;
	public $sectionclass;
	public $sec_class_id;
	function __construct()
	{
		$this->conn = new Sqli($this->config);
	}


	public function getSections()
	{
		$query = "SELECT * FROM section";

		$this->conn->setFetchMode(2);

		$result = $this->conn->Rows($query);

		return $result;
	}

	public function getSectionClass()
	{
		$query = "SELECT * FROM section s INNER JOIN section_class sc ON s.section_id = sc.section_id INNER JOIN class c ON c.class_id= sc.class_id";

		$this->conn->setFetchMode(2);

		$result = $this->conn->Rows($query);

		return $result;
	}

	public function MakeSection()
	{
		$this->conn->Insert($this->table, 
			array('section'),
			array($this->section)
		);
		return true;
	}


	public function UpdateSection()
	{
		$this->conn->query("UPDATE ".$this->table." SET section ='".$this->section."' WHERE section_id =".$this->section_id);

		return true;
	}

	public function DeleteSection()
	{
		$this->conn->query("DELETE FROM ".$this->table." WHERE section_id =".$this->section_id);

		return true;
	}

	public function MakeSectionClass()
	{
		foreach ($this->sectionclass as $class) {
			$this->conn->Insert('section_class',
				array('section_id','class_id'),
				array($this->section_id, $class)
			);

		}
		return true;
	}

	public function DeleteSectionClass()
	{
		$this->conn->query("DELETE FROM section_class WHERE sec_class_id =".$this->sec_class_id);

		return true;
	}

}
 ?>