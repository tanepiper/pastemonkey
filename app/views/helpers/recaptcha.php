<?php

	class RecaptchaHelper extends JavascriptHelper {
	
		var $helpers = array('Javascript');
	
		function render($publicKey, $error) {
			if ($this->params['isAjax']) {
				e('<div id="recaptcha_div" class="' . $publicKey . '"></div>');;
			} else {
				vendor('recaptchalib');
				return recaptcha_get_html($publicKey, $error);
			} 
		}
	
	}
?>