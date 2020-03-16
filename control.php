<?php

// Verifying that user is 18+
function dob_verify($dob){
	
	if(time() < strtotime('+18 years', strtotime($dob))){
			
		return false; 
			
	} else{
			
		return true;
		}		
}

/*verifying that password is valid:
	-at least 8 characters
	-includes letter(s)
	-includes number(s)*/ 
function pass_verify($password){
	
	$pattern = '/^(?=.*[A-Za-z])(?=.*[0-9]).{8,}$/';
	
	if(preg_match($pattern, $password)){

		return true;
	
	}else{
		return false;
	}
}

//Verifying that row queried does not exist
// Used to verify that email is not already in use by another account
function row_verify($query){
	
	if($query->rowCount() > 0) {
		
			return true;
			
		}else{
			return false;
		}
		
}

?>