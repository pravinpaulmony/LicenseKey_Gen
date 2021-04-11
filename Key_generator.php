<?php

class License_Generator {
    public function generate($email) {
		
		$user_id = "99447261"; /* UNIQUE USER ID FROM DATABASE */
		$product_id = "P767R2340K12EY49"; /* UNIQUE PRODUCT ID FROM DATABASE */
		
		$key = base64_encode(md5($email."-".$user_id."-".$product_id)); /* GENERATES A UNIQUE KEY BY ENCODING USER EMAIL, USER ID AND PRODUCT ID */
		
		$License = '';
		for($i=0;$i<5;$i++) {
			$License .= strtoupper(substr($key, $i, 5)) . '-'; /* CONVERSION OF GENERATED KEY INTO STANDARD LICENSEE KEY FORMAT */
		}
		
		return trim($License,'-'); /* RETURNS A 25 DIGIT ALPHANUMERIC KEY */
	}
}

?>