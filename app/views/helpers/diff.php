<?php

class DiffHelper extends Helper {

	function generate($code1, $code2) {
			vendor('diff');
		$diff =& new Diff;
		
		$diff->Diff($code1,$code2);
		
		return $diff;
	}

}
?>