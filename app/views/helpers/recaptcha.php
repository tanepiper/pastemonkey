<?php

	class RecaptchaHelper extends JavascriptHelper {
	
		var $helpers = array('Javascript');
	
		function render($publicKey, $error) {
			if ($this->params['isAjax']) {
				e('<div id="recaptcha_div"></div>');
				e($this->link('http://api.recaptcha.net/js/recaptcha_ajax.js'));
				e($this->codeBlock('Recaptcha.create("' . $publicKey . '", "recaptcha_div")'));
			} else {
				vendor('recaptchalib');
				return recaptcha_get_html($publicKey, $error);
			} 
		}
	
	}
?>