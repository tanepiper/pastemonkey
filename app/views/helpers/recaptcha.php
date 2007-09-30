<?php

	class RecaptchaHelper extends JavascriptHelper {
	
		var $helpers = array('Javascript');
	
		function render($publicKey, $error) {
			if ($this->params['isAjax']) {
				e('<div id="recaptcha_div"></div>');
				e('document.write("http://api.recaptcha.net/js/recaptcha_ajax.js");');
				e('document.write("Recaptcha.create("' . $publicKey . '", "recaptcha_div");)');
			} else {
				vendor('recaptchalib');
				return recaptcha_get_html($publicKey, $error);
			} 
		}
	
	}
?>