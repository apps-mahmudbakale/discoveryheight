<?php
class Validation {
	public $errors;
	public $out;
	public function __construct($fields,$type='POST') {
		$status = 1;
		$global = ($type == 'POST') ? $_POST : $_GET;
		$all = array();
		foreach($fields as $field) {
            if($field['isRequired'] == true) {
            	if(!Validation::Required($global[$field['name']])) {
            		$status = 0;
            		$this->errors[] = $field['app_name']. ' '. ' Required.';
            	}
            }

            if($field['str-only'] == true) {
            	if(!Validation::StrOnly($global[$field['name']])) {
            		$status = 0;
            		if(@!in_array($field['app_name']. ' '. ' Required.',$this->errors))
            			$this->errors[] = $field['app_name']. ' '. ' in wrong format.';
            		
            	}
            }

            if($field['chr-only'] == true) {
            	if(!Validation::ChrOnly($global[$field['name']])) {
            		$status = 0;
            		if(@!in_array($field['app_name']. ' '. ' Required.',$this->errors))
            			$this->errors[] = $field['app_name']. ' '. ' in wrong format.';
            	}
            }
            if(!empty($field['match-with'])) {

                if(!Validation::Match($global[$field['match-with']],$global[$field['name']])) {
                	$status = 0;

            		if(@!in_array($field['app_name']. ' '. ' Required.',$this->errors))
            			$this->errors[] = $field['app_name']. ' '. ' mismatch.';
                }
            }
            if(!empty($field['min-len'])) {
                if(!Validation::MinLen($global[$field['name']],$field['min-len'])) {
                	$status = 0;
            		if(@!in_array($field['app_name']. ' '. ' Required.',$this->errors))
            			$this->errors[] = $field['app_name'] . " must at least be at least ".$field['min-len'] . " characters";
                }
            }
            if($field['dig-only'] == true) {
            	if(!Validation::DigitsOnly($global[$field['name']])) {
            		$status = 0;
            		if(@!in_array($field['app_name']. ' '. ' Required.',$this->errors))
            			$this->errors[] = $field['app_name']. ' '. ' in wrong format.';
            	}
            }
		}

        $this->out = $status;
	}

	public static function Required($field) {
        if(empty($field))
        	return false;
        else 
        	return true;
	}

	public static function Match($field,$matcher) {
		if($field !== $matcher)
			return false;
		else
			return true;
	}

	public static function MinLen($field,$num) {
		 if(strlen($field) < $num)
		 	return false;
		 else
		 	return true;
	}

	public function ChrOnly($field) {
		if(!preg_match("/^[a-z A-Z]+$/", $field))
			return false;
		else
			return true;
	}

	public function DigitsOnly($field) {
		if(!preg_match("/^[0-9.]+$/", $field))
			return false;
		else
			return true;
	}

	public function StrOnly($field) {
		if(!preg_match("/^[a-z A-Z 0-9,]+$/", $field))
			return false;
		else
			return true;
	}
}
?>