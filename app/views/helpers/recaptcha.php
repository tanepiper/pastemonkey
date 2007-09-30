<?php

	class RecaptchaHelper extends Helper {
	
		var $helpers = array('Javascript');
	
		function render($publicKey, $error) {
			if ($this->params['isAjax']) {
				$javascript->link('http://api.recaptcha.net/js/recaptcha_ajax.js');
				$javascript->codeBlock('Recaptcha.create(' . $publicKey . ', "recaptcha_div"');
			} else {
				vendor('recaptchalib');
				return recaptcha_get_html($publicKey, $error);
			} 
		}
	
	}
?>