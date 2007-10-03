<?php

class OpenidComponent extends Component {

	function check(){
	
		vendor('Auth/OpenID/Consumer');
		vendor('Auth/OpenID/MySQLStore');
		vendor('Auth/OpenID/SReg');
	
	}
}
?>