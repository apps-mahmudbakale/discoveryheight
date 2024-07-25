<?php 

/**
 * Simple Sql Query Class
 *
 *@author 		Mahmud Bakale 
 *@license 		GNU General Public Lincense 3 (http://www.gnu.org/lincenses/) 
 */
class Sqli
{
	private $fetchMode = MYSQLI_BOTH;
	//private $config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');

	function __construct($db)
	{
		$this->mysqli = new mysqli($db['host'], $db['user'], $db['pass'], $db['db']);

		if (mysqli_connect_errno())
		 {
			printf("<b>Connection failed:</b> %s\n", mysqli_connect_errno());
			exit;
		}

		$this->mysqli->query("SET NAMES 'utf8'");
		$this->mysqli->query("SET CHARACTER SET utf8");
		$this->mysqli->query("SET COLLATION_CONNECTION = 'utf8_turkish_ci'");
	}

	public function setFetchMode($type)
	{
		switch ($type)
		 {
			case 1:
				$this->fetchMode = MYSQLI_NUM;
				break;
			
			case 2:
				$this->fetchMode = MYSQLI_ASSOC;
				break;

			default:
				$this->fetchMode = MYSQLI_BOTH;
				break;
		}
	}


	public function query($sql)
	{
		$this->sql = $this->mysqli->real_escape_string($sql);
		$this->result = $this->mysqli->query($sql);

		if ($this->result == true) 
		{
			return true;
		}else
		{
			printf("<b>Problem with Sql:</b> %s\n", $this->sql);
			exit;

		}
	}

	public function Row($query)
	{
		self::query($query);
		return $this->result->fetch_array($this->fetchMode);
	}

	public function Rows($query)
	{
		self::query($query);
		$data = array();

			while ($row = $this->result->fetch_array($this->fetchMode)) 
			{
				array_push($data, $row);
			}
		return $data;
	}


	public function Insert($table,$fields,$values) {
		$query = "INSERT INTO $table (".implode(',', $fields) .") VALUES(";
        for($i=0; $i<=count($values)-1; $i++) {
        	if($i != count($values)-1) {
			   $query .= "'%s',"; 
			}else {
			   $query .= "'%s'";
			}
			
        }
        $query .= ")";
        $query = vsprintf($query,$values);
		$res = self::query($query);
	}

	public function Update($table,$fields,$values,$whereFields,$whereValues) {
       $query = "UPDATE $table SET ";
        for($i=0; $i<=count($values)-1; $i++) {
        	if($i != count($values)-1) {
			   $query .= "$fields[$i]='%s', "; 
			}else {
			   $query .= "$fields[$i]='%s' ";
			}
			
        }
        $query .= " WHERE ";
        for($j=0; $j<=count($whereFields)-1; $j++) {
        	if($j !== count($whereValues)-1)
        		$query .= " $whereFields[$j]='%s' AND";  
        	else
        		$query .= " $whereValues[$j]='%s' ";  
        }
        $query = vsprintf($query,array_merge($values,$whereValues));
        echo $query;
		$res = self::query($query);
		//$this->query = $query;
	}


	public function SqlRows($table,$fields,$values) {
		$query = "SELECT * FROM $table WHERE ";
		for($i=0; $i<=count($values)-1; $i++) {
        	if($i != count($values)-1) 
        		$query .= " $fields[$i]='%s' AND ";
        	else
        		$query .= "  $fields[$i]='%s' ";
        }
        $query = vsprintf($query,$values);
        //echo $query;
        $res = self::query($query);
        return mysqli_num_rows($this->result);
        //$this->query = $query;
	}

	public function NumRows($query) {
        //echo $query;
        $res = self::query($query);
        return mysqli_num_rows($this->result);
        //$this->query = $query;
	}

	public function __destruct()
	{
		$this->mysqli->close();
	}
}

 ?>