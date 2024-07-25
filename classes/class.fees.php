<?php 
/**
 * 
 */
class Fees
{
	private $config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
	public $conn;
	private $table = 'fees_item';
	public $fees_id;
	public $fees_name;	

	function __construct()
	{
		$this->conn = new Sqli($this->config);
	}

	public function getFeesItem()
	{
		$this->conn->setFetchMode(2);

		$result = $this->conn->Rows("SELECT * FROM ".$this->table);

		return $result;
	}

	public function MakeFeesItem()
	{
		$this->conn->Insert($this->table,
			array('fees_name'),
			array($this->fees_name)
		);

		return true;
	}

	public function UpdateFeesItem()
	{
		$this->conn->query("UPDATE ".$this->table." SET fees_name ='".$this->fees_name."' WHERE fees_id =".$this->fees_id);

		return true;
	}

	public function DeleteFeesItem()
	{
		$this->conn->query("DELETE FROM ".$this->table." WHERE fees_id =".$this->fees_id);

		return true;
	}
}



 ?>