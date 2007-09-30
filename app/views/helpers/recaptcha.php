<?php

	class RecaptchaHelper extends JavascriptHelper {
	
		var $helpers = array('Javascript');
	
		function render($publicKey, $error) {
			if ($this->params['isAjax']) {
				e('<div id="recaptcha_div"></div>');
				e('<script type="text/javascript">document.write("http://api.recaptcha.net/js/recaptcha_ajax.js");</script>');
				e('<script type="text/javascript">document.write("Recaptcha.create("' . $publicKey . '", "recaptcha_div");")</script>');
			} else {
				vendor('recaptchalib');
				return recaptcha_get_html($publicKey, $error);
			} 
		}
	
	}
?>