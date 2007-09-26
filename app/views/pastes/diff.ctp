<?php 
	header('Content-type: text/plain');
	header('Content-Disposition: attachment; filename="diff-' . $old['Paste']['id'] . '-' . $new['Paste']['id'] . '.patch' . '"');
	e($diff->generate($old['Paste']['paste'],$new['Paste']['paste']));
?>