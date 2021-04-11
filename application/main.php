<?php
/* PREDEFINED VARIABLES USED IN THE FORM */

$email1 = "";
$email2 = "";
$email_error = "";
$email_error1 = "";
$licenseKey = "";
$userkey = "";
$key_error = "";
$license_valid = "";
$expire_error  = "";
$exists_error  = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") { /* VALIDATE FORM SUBMISSION IS POST */
	
	if ($_POST["type"] == "generate") { /* NEW LICENSE KEY GENERATION FORM */

		$email1 = clean_input($_POST["new_email"]); /* REMOVE SPECIAL CHARACTERS AND EMPTY SPACES */
		$email_error = validate_email($email1); /* EMAIL FORMAT VALIDATION */
		
		if($email_error==""){  /* CHECKS IF EMAIL VALID */
			include_once 'application/Key_generator.php';
			$generator = new License_Generator();
			$licenseKey = $generator->generate($email1,"generate"); /* GENERATES NEW LICESNE KEY FOR USER */
			
			if(strpos($licenseKey, 'expired') === 0){

				$expire_error = "<button type='button' class='btn btn-danger bt-xs btn-block'>License Key Already Expired On <span class='badge badge-light'>".explode(" ",$licenseKey)[1]."</span> <br><br> Please Renew Your License Key !</button>"; /* KEY EXPIRED ERROR */
			}
			else if(strpos($licenseKey, 'exists') === 0){
				$exists_error = "<button type='button' class='btn btn-info bt-xs btn-block'>License Key Already Exists for this email account</button>"; /* KEY EXISTS ERROR */
			}
		}
	}
	else if ($_POST["type"] == "validate") { /* LICENSE KEY VALIDATION FORM */

		$email2 = clean_input($_POST["user_email"]); /* REMOVE SPECIAL CHARACTERS AND EMPTY SPACES */
		$userkey = trim($_POST["user_license"]);
		$key_error = key_format($userkey); /* LICENSE KEY FORMAT VALIDATION */
		$email_error1 = validate_email($email2); /* EMAIL FORMAT VALIDATION */

		if($key_error=="" && $email_error1==""){
			
			include_once 'application/Key_generator.php';
			include_once 'application/Key_validator.php';
			$validator = new License_Validator();
			
			if($validator->validate($email2, $userkey)) { /* VALIDATES LICESNE KEY BASED ON USER INPUT */
				$license_valid = "<label class='badge badge-success'>License Key is Valid</label>";  /* SUCCESS */
			} else {
				$license_valid = "<label class='badge badge-danger'>License Key is not Valid</label>"; /* FAILED */
			}
		}
	}
	
}

/* FUNCTION TO REMOVE SPECIAL CHARACTERS AND SPACES */
function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

/* FUNCTION FOR EMAIL FORMAT VALIDATION */
function validate_email($email) {
	
  if (empty($email)) {
		return "Email is required";
	 } else {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  return "Invalid Email Format";
		}
	}
}

/* FUNCTION FOR LICENSE KEY FORMAT VALIDATION */
function key_format($key) {

	if (empty($key)) {
		return "Key is required";
	 } else if (!preg_match('/^([A-Z1-9]{5})-([A-Z1-9]{5})-([A-Z1-9]{5})-([A-Z1-9]{5})-([A-Z1-9]{5})$/', $key)){
		return "License Key is not Valid";
	}
}

?>