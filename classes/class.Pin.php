<?php 
/**
 * 
 */
class Pin
{
	private $config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
	public $conn;
	private $table = 'pin';
	public $pin_id;
	public $card_number;
	
	function __construct()
	{
		$this->conn = new Sqli($this->config);
	}


	public function getPins()
	{
		$result = $this->conn->Rows("SELECT * FROM pin");

		return $result;
	}

	public function MakePin()
	{
		$this->conn->Insert($this->table,
			array('card_number'),
			array($this->card_number)
		);

		return true;
	}

	public function DeletePin()
	{
		$this->conn->query("DELETE FROM ".$this->table." WHERE pin_id =".$this->pin_id);

		return true;
	}
}


 ?>