<?php
	header('Content-type: text/plain');
	header('Content-Disposition: attachment; filename="paste-'.$paste['Paste']['id'].'.'.$ext.'"');
	e($paste['Paste']['paste']);		
?>