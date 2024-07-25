<?php 
/**
 * 
 */
class Classes
{
	private $config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
	public $conn;
	private $table = 'class';	
	public $class_id;
	public $class;
	public $average;
	public $class_price_id;
	public $fees_id;
	public $term;
	public $price;
	public $section_id;
	function __construct()
	{
		$this->conn = new Sqli($this->config);
	}

	public function getClasses()
	{
		$this->conn->setFetchMode(2);

		if (!empty($this->section_id)) {
			$result = $this->conn->Rows("SELECT * FROM ".$this->table." INNER JOIN section_class USING(class_id) WHERE section_class.section_id=".$this->section_id);
		}else{
			$result = $this->conn->Rows("SELECT * FROM ".$this->table);
		}

	return $result;

	}

	public function MakeClass()
	{
		$this->conn->Insert($this->table, 
			array('class','average'),
			array($this->class, $this->average)
		);

		return true;
	}

	public function UpdateClass()
	{
		$this->conn->query("UPDATE ".$this->table." SET class='".$this->class."', average ='".$this->average."' WHERE class_id =".$this->class_id);

		return true;
	}


	public function DeleteClass()
	{
		$this->conn->query("DELETE FROM ".$this->table." WHERE class_id =".$this->class_id);

		return true;
	}

	public function getClassFees()
	{
		$this->conn->setFetchMode(2);

		$result = $this->conn->Rows("SELECT * FROM `class_price`cp INNER JOIN class c ON cp.class_id = c.class_id INNER JOIN fees_item f ON cp.fees_id = f.fees_id");

		return $result;

	}


	public function MakeClassFees()
	{
		$this->conn->Insert('class_price',
			array('class_id','term','fees_id','price'),
			array($this->class_id,$this->term,$this->fees_id,$this->price)
	);

		return true;
	}


	public function UpdateClassFees()
	{
		$this->conn->query("UPDATE class_price SET class_id ='".$this->class_id."', term ='".$this->term."', fees_id = '".$this->fees_id."', price ='".$this->price."' WHERE class_price_id =".$this->class_price_id);

		return true;
	}

	public function DeleteClassFees()
	{
		$this->conn->query("DELETE FROM class_price WHERE class_price_id =".$this->class_price_id);

		return true;
	}
}

 ?>