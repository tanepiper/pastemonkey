<?php
	header('Content-type: text/plain');
	header('Content-Disposition: attachment; filename="paste-'.$paste['Paste']['id'].'.'.$ext.'"');
	e('// ' . __('This file was downloaded from', true) . ' ' . Configure::read('Site.url') . "\n");
	e('// @author ' . $paste['Paste']['author'] . "\n\n");
	e($paste['Paste']['paste']);		
?>