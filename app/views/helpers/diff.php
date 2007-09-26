<?php

class DiffHelper extends Helper {

	function generate($old, $new) {
		vendor('diff');
		$diff = PHPDiff($old,$new);
		return $diff;
	}

}
?>