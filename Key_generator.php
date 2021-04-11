<?php

class License_Generator {
    public function generate($email,$type) {
		
		$user_id = "99447261"; /* UNIQUE USER ID FROM DATABASE */
		$product_id = "P767R2340K12EY49"; /* UNIQUE PRODUCT ID FROM DATABASE */
		
		$purchased_on = date("d-m-Y");
		$expires_on = date('d-m-Y', strtotime("+1 year", strtotime(date("d-m-Y")))); /* EXPIRY DATE FOR 1 YEAR VALIDITY */
		
		$key = base64_encode(md5($email."-".$user_id."-".$product_id)); /* GENERATES A UNIQUE KEY BY ENCODING USER EMAIL, USER ID, PRODUCT ID */
		
		$License = '';
		for($i=0;$i<5;$i++) {
			$License .= strtoupper(substr($key, $i, 5)) . '-'; /* CONVERSION OF GENERATED KEY INTO STANDARD LICENSEE KEY FORMAT */
		}
		
		$License = trim($License,'-');  /* 25 DIGIT ALPHANUMERIC KEY */
		
		if($type=="validate"){ /* RETURNS KEY FOR VALIDATION */
			return $License; 
		} 
		
		$string = file_get_contents("DB.json"); /* GETTING OLD RECORDS FROM JSON FILE */
		$content = json_decode($string,true);
		
		/* INFORMATION STORED FOR A NEW USER */
		$new_record = array("email"=>$email,"product"=>$product_id,"key"=>$License,"purchased_on"=>$purchased_on,"expire_on"=>$expires_on);
		
		$key = array_search($email, array_column($content, 'email')); /* SEARCH WHETHER ALREADY EXISTS */
		
		// return $key;
		
		if($key!== false){ /* IF USER ALREADY EXISTS */
			
			$purchase = trim($content[$key]["purchased_on"]); /* GET PURCHASE DATE */
			$expiry = trim($content[$key]["expire_on"]); /* GET EXPIRY DATE */
			$today = date('Y-m-d'); /* CURRENT DATE */
 
			if(strtotime($today) > strtotime($expiry)){ /* CHECK VALIDITY EXPIRED OR NOT */
				return "expired ".$expiry; /* NOTIFY USER THAT KEY HAS EXPIRED FOR THIS ACCOUNT */
			}
			else{
				return "exists ".$purchase; /* NOTIFY USER THAT KEY ALREADY EXISTS FOR THIS ACCOUNT */
			}
		}
		else{ /* FOR NEW USER ACCOUNT */
		
			array_push($content, $new_record);
			file_put_contents("DB.json",json_encode($content)); /* STORE THE INFORMATION IN JSON FILE INSTEAD OF DATABASE FOR DEMO PURPOSE*/
			return $License; /* RETURNS A 25 DIGIT ALPHANUMERIC KEY */
		}
	}
}

?>