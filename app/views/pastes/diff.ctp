<?php 
	header('Content-type: text/plain');
	header('Content-Disposition: attachment; filename="diff-' . $old['Paste']['id'] . '-' . $new['Paste']['id'] . '.patch' . '"');
	e('// ' . __('This file was downloaded from', true) . ' ' . Configure::read('Site.url') . "\n");
	e('// @author ' . $old['Paste']['author'] . ' & ' . $new['Paste']['author'] . "\n\n");
	
	e($diff->generate($old['Paste']['paste'], $new['Paste']['paste']));
?>