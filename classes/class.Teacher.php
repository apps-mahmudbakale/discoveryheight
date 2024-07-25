<?php 

class Teacher 
{
		private $config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
		public $conn;
		private $table = 'teacher_subject';
		public $section;
		public $user_id;
		public $subject_id;
		public $class_id;
		
		function __construct()
		{
			$this->conn =  new Sqli($this->config);
		}


		public function getTeachers()
		{
			$query = "SELECT u.user_id, u.firstname, u.lastname, u.username, u.phone, r.role, s.section, u.section_id, sb.subject_name FROM users u LEFT JOIN user_role ur ON u.user_id = ur.user_id LEFT JOIN roles r ON ur.role_id = r.role_id LEFT JOIN section s ON s.section_id = u.section_id LEFT JOIN teacher_subject ts ON u.user_id = ts.user_id LEFT JOIN subject sb ON ts.subject_id = sb.subject_id  WHERE r.role ='Teacher' AND u.section_id ='".$this->section."'";
			$this->conn->setFetchMode(2);

			$result = $this->conn->Rows($query);

			return $result;
		}

		public function assignSubject()
		{
			$this->conn->Insert($this->table, array('user_id', 'subject_id', 'class_id'), array($this->user_id, $this->subject_id, $this->class_id));
			return true;
		}

		public function assignFormMaster()
		{
			$this->conn->Insert('form_master', array('user_id', 'class_id'), array($this->user_id, $this->class_id));
			return true;
		}

		public function getFormMasters()
		{
			$query = "SELECT * FROM users u INNER JOIN user_role ur ON u.user_id = ur.user_id INNER JOIN roles r ON ur.role_id = r.role_id INNER JOIN section s ON s.section_id = u.section_id INNER JOIN form_master fm ON u.user_id = fm.user_id INNER JOIN class c ON fm.class_id = c.class_id WHERE r.role ='Teacher' AND u.section_id ='".$this->section."'";
			$this->conn->setFetchMode(2);

			$result = $this->conn->Rows($query);

			return $result;
		}


		public function FormMasterClass()
		{
			$query = "SELECT class_id FROM form_master WHERE user_id ='".$this->user_id."'";
			$result = $this->conn->Row($query);

			return $result;
		}
}

 ?>