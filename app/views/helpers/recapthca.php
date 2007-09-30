<?php

	class RecaptchaHelper extends Helper {
	
		function render($publicKey) {	
			vendor('recaptchalib');
			return recaptcha_get_html($publicKey); 
		}
	
	}
?>