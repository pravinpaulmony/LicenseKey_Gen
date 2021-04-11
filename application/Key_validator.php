<?php

class License_Validator {
    public function validate($email,$license) {
        $generator = new License_Generator(); 
        $newKey = $generator->generate($email,"validate"); /* GENETARES THE LICENSE BASED ON THE USER INPUTS */
        if($license === $newKey) { /* VALIDATE WHETHER THE GENERATED KEY AND USER INPUT KEY MATCHES */
            return true; /* KEY GETS MATCHED */
        } else {
            return false; /* KEY IS NOT MATCHED */
        }
    }
}
