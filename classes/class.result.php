<?php 
/**
 * 
 */
class Result 
{
	public $conn;
	private $admNo; //this is representation of student_id
	private $session;
	private $class;// sub_class_id
	private $term;
	public $subjects;
	private static $total;
	private static $grade;
	public $average;
	public $position;
	public $students;
	public $totalMarks;

	public function __construct($admNo, $class, $session,$term) 
	{
		$this->conn = mysqli_connect('localhost', 'mahmudbakale', 'root', 'skul');
		$this->admNo = $admNo;
		$this->session = $session;
		$this->class = $class;
		$this->term = $term;
		$this->GetSubjects();
		$this->Average($admNo,$class,$session,$term);
	    $this->studentInClass();
	}

	private function studentInClass() {
	   $db = $this->conn;
	   $class_id = $this->class;
	   $rows = mysqli_num_rows(mysqli_query($db,"SELECT * FROM student WHERE class_id ='$class_id'"));
	   $this->students = $rows;
	}

	private function Average($admNo,$class,$session,$term) {
			$db = $this->conn;
	        $query = sprintf("SELECT * FROM (SELECT student_id,class_id,subject_id,AVG(first_ca+second_ca+exam) average
                          FROM student_score WHERE class_id=%d AND session='%s' AND term=%d GROUP BY student_id) m
                          WHERE class_id=%d
                          ORDER BY average DESC
	                        ",
	                        $class,$session,$term,$class);

	      $this->position = $position;
	      $this->average = sprintf('%.2f',round($average,2));
	      $query = mysqli_query($db,$query);
	      $all = array();
	      $x = 0;
	      while($row = mysqli_fetch_array($query)) {
	         $x++;
	         $all[] = array(
	                      'student_id'=>$row['student_id'],
	                      'sub_class_id'=>$row['sub_class_id'],
	                      'average' => $row['average'],
	                      'position' => $x
	                  );

	      }
	      foreach($all as $b) {
	        if(($b['student_id'] == $admNo)) {
	            $avg = $b['average'];
	            $p = $b['position'];
	        }
	      }
	      $min = array();
	      foreach($all as $c) {         
	         if($c['average'] == $avg) {
	              $min[] = $c['position'];
	         }
	         if(($c['average'] == $avg) && ($c['student_id'] != $admNo)) {
	            $position = $min[0];
	         } else {
	            sort($min);
	            $position = $min[0];
	         }
	      }
	       $this->position = self::SuperScript($position);
	      $this->average = sprintf('%.2f',round($avg,2));
	      
	}


	  private static function GetGradeAndTotal($ca1,$ca2,$exam) {
	         $total = $ca1 + $ca2 + $exam;
	         if($total >= 70)
	         	$grade = "A";
	         elseif($total >= 60)
	         	$grade = "B";
	         elseif($total >= 50)
	         	$grade = "C";
	         elseif($total >= 45)
	         	$grade = "D";
	         elseif($total >= 40)
	         	$grade = "E";
	         else
	         	$grade = "F";

	         self::$total = $total;
	         self::$grade = $grade;
	    }

	    private function GetSubjects() {
	    	$db = $this->conn;
	        $admNo = $this->admNo;
	        $session = $this->session;
	        $class = $this->class;
	        $term = $this->term;
	        $query = sprintf("SELECT student_id,first_ca,second_ca,exam,subject_id,subject_name
	                          FROM student_score INNER JOIN subject USING(subject_id) 
	                          WHERE student_id=%d AND class_id=%d AND session='%s' AND term=%d
	                          ORDER BY order_index",
	        	               $admNo,$class,$session,$term);
	        $res = mysqli_query($db,$query);
	        $allTotal = 0;
	        while($row = mysqli_fetch_array($res)) {

	        	  self::GetGradeAndTotal($row["first_ca"],$row["second_ca"],$row["exam"]);
	        	  $total = self::$total;
	        	  $grade = self::$grade;
	            $allTtototal += $total;
	                $query = sprintf("SELECT SUM(first_ca+second_ca+exam) total FROM student_score WHERE 
	                                  student_id=%d AND session='%s' AND subject_id=%d  AND term <= %d
	                                  GROUP BY student_id ",$admNo,$session,$row['subject_id'],$term);

	                $res2 = mysqli_query($db,$query);
	                $row2 = mysqli_fetch_array($res2);
	                $terms_query = sprintf("SELECT term FROM student_score WHERE student_id=%d
	                                       AND subject_id=%d
	                                       AND session='%s'",$admNo,$row['subject_id'],$session);
	                //echo $terms_query."<br/>";
	                $terms_query = mysqli_query($db,$query);
	                $terms = mysqli_num_rows($terms_query);
	                $cumTotal = round($row2['total']/$terms,2);

	        	$subjectPosition = self::SubjectPosition($admNo,$session,$class,$row["subject_id"],$term);
	            $maxScore = self::MaxSubjectScore($session,$class,$term,$row['subject_id']);
	            $minScore = self::MinSubjectScore($session,$class,$term,$row['subject_id']);
	            $avgScore = self::AvgSubjectScore($session,$class,$term,$row['subject_id']);
	            $passFail = ($total >= 40) ? 'P' : 'F';
	            $this->subjects[] = $row["subject_name"]."?".$row['first_ca']."?".$row['second_ca']."?".$row['exam']."?".$total."?".$row['subject_id']."?".$avgScore."?".$grade."?".$passFail."?".$subjectPosition;
	        }
	        $this->totalMarks = $allTtototal;
		}

		  private function MaxSubjectScore($session,$class,$term,$subject_id) {
		  	$db = mysqli_connect('localhost', 'mahmudbakale','root', 'skul');
		     $query = "SELECT * FROM (SELECT (first_ca+second_ca+exam) AS total FROM student_score
		               WHERE subject_id=%d AND session='%s' AND class_id='%s' 
		               AND term='%d') m ORDER BY total DESC";
		     $query = sprintf($query,$subject_id,$session,$class,$term);
		     $res = mysqli_query($db,$query);
		     $row = mysqli_fetch_array($query);
		     return $row['total'];
		  }
		  private function MinSubjectScore($session,$class,$term,$subject_id) {
		  	$db = $this->conn;
		     $query = "SELECT * FROM (SELECT (first_ca+second_ca+exam) AS total FROM student_score
		               WHERE subject_id=%d AND session='%s' AND class_id='%s' 
		               AND term='%d') m ORDER BY total ASC";
		     $query = sprintf($query,$subject_id,$session,$class,$term);
		     $res = mysqli_query($db,$query);
		     $row = mysqli_fetch_array($query);
		     return $row['total'];
		  }
		  private function AvgSubjectScore($session,$class,$term,$subject_id) {
		  	$db = $this->conn;
		     $query = "SELECT * FROM (SELECT AVG(first_ca+second_ca+exam) AS total FROM student_score
		               WHERE subject_id=%d AND session='%s' AND class_id='%s' 
		               AND term='%d') m ORDER BY total DESC";
		     $query = sprintf($query,$subject_id,$session,$class,$term);
		     $res = mysqli_query($db,$query);
		     $row = mysqli_fetch_array($res);
		     return round($row['total'],2);
		  }
	private static function SubjectPosition($admNo,$session,$class,$subject_id,$term) {  
				$db = mysqli_connect('localhost', 'mahmudbakale','root', 'skul');
		        $query = sprintf("SELECT * FROM (SELECT student_id,class_id,subject_id,(SUM(first_ca+second_ca+exam)/%d) total
		                          FROM student_score WHERE  subject_id=%d
		                          AND class_id=%d AND session='%s' AND term<=%d GROUP BY student_id) m
		                          WHERE class_id=%d AND subject_id=%d
		                          ORDER BY total DESC
		                          ",
		                          $term,$subject_id,$class,$session,$term,$class,$subject_id);
		     
		      $query = mysqli_query($db,$query);
		      $all = array();
		      $x = 0;
		      $tot = 0;
		      while($row = mysqli_fetch_array($query)) {
		           $x++;
		           $tot = $row['total'];
		          
		           $all[] = array(
		                        'student_id'=>$row['student_id'],
		                        'sub_class_id'=>$row['sub_class_id'],
		                        'sub_id' => $row['subject_id'],
		                        'score' => $row['total'],
		                        'position' => $x
		                    );
		      }
		      foreach($all as $b) {
		          if(($b['student_id'] == $admNo) && ($b['sub_id'] == $subject_id)) {
		              $score = $b['score'];
		              $p = $b['position'];
		          }
		      }
		      $y = 0;
		      $min = array();
		      foreach($all as $c) {         
		         if($c['score'] == $score && $c['sub_id'] == $subject_id) {
		              $min[] = $c['position'];
		         }
		         if(($c['score'] == $score) && ($c['student_id'] != $admNo) && ($c['sub_id'] == $subject_id)) {
		            $position = $min[0];
		         } else {
		            sort($min);
		            $position = $min[0];
		         }
		      }
		     
		      return $position;
		  }

		private function SuperScript($number) {
		  // $locale ='en_US';

		  // $nf = new NumberFormatter($locale, NumberFormatter::ORDINAL);

		  // return $nf->format($number);

		 $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th','th', 'th', 'th');

		 if ((($number % 100) >= 11) && (($number % 100) <= 13)) {
		 	return $number.'<sup>th</sup>';
		 }else{
		 	return $number.'<sup>'.$ends[$number % 10].'</sup>';
		 }
	    }
	}



 ?>