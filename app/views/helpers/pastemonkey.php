<?php

class PastemonkeyHelper extends TimeHelper {

	function timeAgo($timestamp) {
	
		$pasted = $this->toUnix($timestamp);
		$ago = (time() - $pasted);
		if ($ago < 60) {
			$output = __('Pasted', true) . ' ' . round($ago) . ' ' . __('Seconds', true) . ' ' . __('Ago', true);
		} else if ($ago >= 60 && $ago < 3600) {
			$output = __('Pasted', true) . ' ' . round($ago / 60) . ' ' .  __('Minutes', true) . ' ' . __('Ago', true);
		} else if ($ago >= 3600 && $ago < 86400) {
			$output = __('Pasted', true) . ' ' . round($ago / 3600) . ' ' . __('Hours', true) . ' ' . __('Ago', true);
		} else if ($ago >= 86400) {
			$output = __('Pasted', true) . ' ' . round($ago / 86400) . ' ' . __('Days', true) . ' ' . __('Ago', true);
		}
		
		return $output;
	}
	
	function curPageURL($overide = null, $trim = false) {
  		$pageURL = 'http';
 		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
  		$pageURL .= "://";
  		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  		if ($trim == true) {$pageURL = rtrim($pageURL, '/');}
  		return $pageURL;
	}

}
?>