<?php

	class RecaptchaHelper extends Helper {
	
		function render($publicKey, $error) {	
			vendor('recaptchalib');
			return recaptcha_get_html($publicKey, $error); 
		}
	
	}
?>