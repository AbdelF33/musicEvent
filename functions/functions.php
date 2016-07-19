<?php
	// echape les quotes dans les chaines de caractères
	function eq($content){
		//(condition ? si vrai : si faux)
		return (isset($content) ? "'".str_replace("'", "\'", $content)."'" : "NULL");
	}

	//function send mail
	function sendMail($to, $userName){
		$subject = "New user at Music Events Application";
		$message =  "hello ".$userName."\r\n".
					"Welcome to music Event Applicaton \r\n".
					"Your account has been created \r\n";

		//send mail
		mail($to, $subject, $message);
	}
?>