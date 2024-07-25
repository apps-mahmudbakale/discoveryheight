<?php 
/**
 * 
 */
class Payment
{
	private $config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
	public $conn;
	private $table = 'verified_payment';
	function __construct()
	{
		$this->conn = new Sqli($this->config);
	}


	public function FullPayments()
	{
		$this->conn->setFetchMode(2);
		$result = $this->conn->Rows("SELECT * FROM ".$this->table." INNER JOIN student_payment USING(payment_id) INNER JOIN student USING(admission_number) INNER JOIN applicant USING(app_id) INNER JOIN section ON section.section_id = applicant.section_id INNER JOIN users USING(user_id) INNER JOIN class USING(class_id)");

		return $result;
	}

	public function ByPartPayments()
	{
		$this->conn->setFetchMode(2);
		$result = $this->conn->Rows("SELECT DISTINCT applicant.first_name, applicant.other_names,varified_part_payment.invoice, varified_part_payment.amount_paid,student.admission_number,class.class, section.section, varified_part_payment.teller_no, users.firstname, users.lastname,student_payment.term FROM `varified_part_payment` INNER JOIN temp_invoice USING(invoice) INNER JOIN student ON temp_invoice.admno = student.admission_number INNER JOIN class ON student.class_id = class.class_id INNER JOIN applicant ON student.app_id = applicant.app_id INNER JOIN section ON section.section_id = applicant.section_id INNER JOIN users ON users.user_id = varified_part_payment.user_id INNER JOIN student_payment ON temp_invoice.admno = student_payment.admission_number");

		return $result;
	}


	public function PinPurchase()
	{
		$this->conn->setFetchMode(2);
		$result = $this->conn->Rows("SELECT * FROM issued_pin INNER JOIN users USING(user_id) INNER JOIN section ON issued_pin.section_id = section.section_id");

		return $result;
	}
}


 ?>