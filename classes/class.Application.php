<?php 
/**
 * 
 */
class Application
{
	private $config = array('host' => 'localhost', 'user' => 'root', 'pass' => 'New@passw0rd', 'db' => 'skul');
	private $table ='applicant';
	public $conn;
    public $fname;
    public $lname;
	public $mname;
	public $gender;
	public $dob;
	public $image;
	public $nationality;
	public $state;
	public $address;
	public $home_phone;
	public $class_id;
	public $place_birth;
	public $phone;
	public $category;
	public $postal_code;
	public $blood;
	public $genotype;
	public $app_id;
	public $term;

	function __construct()
	{
		$this->conn = new Sqli($this->config);
	}


	public function MakeApplication()
	{
		$row = $this->conn->Row("SELECT MAX(app_id) AS app_id FROM ".$this->table);
		$app_id = $row['app_id'] +1;

			$this->conn->Insert($this->table,
				array('app_id','first_name', 'middle_name', 'last_name', 'image', 'gender', 'date_of_birth', 'state_id', 'class_id', 'category', 'phone_number', 'address', 'place_of_birth', 'admission_date', 'home_phone', 'nationality', 'postal_code', 'religion', 'blood', 'genotype'),
				array($app_id,$this->fname,$this->mname, $this->lname,$this->image,$this->gender,$this->dob,$this->state,$this->class_id,$this->category,$this->phone,$this->address,$this->place_birth,$this->admission_date,$this->home_phone,$this->nationality,$this->postal_code,$this->religion,$this->blood,$this->genotype)
			);
//			$this->conn->query("DELETE FROM pin WHERE card_number = '".$this->card_number."'");
			return true;
	}

	public function getStates()
	{
		$this->conn->setFetchMode(2);

		$result = $this->conn->Rows("SELECT * FROM state ORDER BY state_name");

		return $result;

	}

    public function getClasses()
    {
        $this->conn->setFetchMode(2);

        if (!empty($this->section_id)) {
            $result = $this->conn->Rows("SELECT * FROM ".$this->table." INNER JOIN section_class USING(class_id) WHERE section_class.section_id=".$this->section_id);
        }else{
            $result = $this->conn->Rows("SELECT * FROM class");
        }

        return $result;

    }

	public function getScreeningDate(){
		$row = $this->conn->Row("SELECT * FROM screening_date");
		$date = $row['screening_date'];
      return $date;
	}

    public function getMaxid(){
        $row = $this->conn->Row("SELECT MAX(app_id) AS app_id FROM ".$this->table);
        $app_id = $row['app_id'];
        return $app_id;
    }

	public function getApplicants()
	{
		$this->conn->setFetchMode(2);

		if (!empty($this->section)) {
			$result = $this->conn->Rows("SELECT CONCAT(first_name,' ',other_names) AS full_name,state_name,gender,guardian_full_name,address, app_id FROM ".$this->table."  INNER JOIN state  ON applicant.state_id = state.state_id WHERE ".$this->table.".status='0' AND ".$this->table.".section_id ='".$this->section."'");
		}else{

		$result = $this->conn->Rows("SELECT CONCAT(first_name,' ',other_names) AS full_name,state_name,gender,guardian_full_name,address, app_id FROM ".$this->table."  INNER JOIN state  ON applicant.state_id = state.state_id WHERE ".$this->table.".status='0'");
		}

		return $result;
	}

	public function approveApplication()
	{
		  $y = date('y').'/';
		  $date = date('Y-m-d');
		  $entry_year = date('Y');
		 $rows = $this->conn->NumRows("SELECT * FROM student");
		 $admNo = $y.sprintf('%03s',$rows +1);
		 $session = (date('Y')-1).'/'.date('Y');

		 $rowz = mysqli_num_rows($this->conn->query("SELECT * FROM student INNER JOIN class USING(class_id) WHERE class.class_id='".$this->class_id."' AND student.app_id='".$this->app_id."'"));

		 if ($rowz == 0) {
		 	$this->conn->Insert('student',
		 		array('app_id','admission_number','class_id','cur_class_id','entry_year','approval_date'),
		 		array($this->app_id, $admNo,$this->class_id,$this->class_id, $entry_year,$date)
		 	);

		 	$this->conn->query("UPDATE ".$this->table." SET status ='1' WHERE app_id =".$this->app_id);

		 	$this->conn->Insert('student_payment',
		 		array('admission_number','term','session'),
		 		array($admNo,$this->term,$session)
		 	);
		 	$r = $this->conn->Row("SELECT * FROM applicant INNER JOIN student USING(app_id) WHERE applicant.app_id='$app_id'");
		 	$phone = $r['phone_number'];

		 	//https://smsclone.com/api/sms/sendsms?username=xxx&password=xxx&sender=@@sender@@&recipient=@@recipient@@&message=@@message@@

		 	$url = "https://smsclone.com/api/sms/sendsms?";
		 	$url .= "username=bakale";
		 	$url .= "&password=bakale123";
		 	$url .= "&sender=Mar-quran";
		 	$url .= "&recipient=$phone";
		 	$message = "I am pleased to notify you that your child has been offered admission, his admission number is $admNo";
		 	$url .= "&message=".urlencode($message);
		 	$fp = @fopen($url, "r",255);

		 }
		 return true;
	}
}


 ?>