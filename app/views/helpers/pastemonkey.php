<?php

class PastemonkeyHelper extends TimeHelper {

	function timeAgo($timestamp) {
	
		$pasted = $this->toUnix($timestamp);
		$ago = (time() - $pasted);
		if ($ago < 60) {
			$output = __('Pasted') . round($ago) . __('Seconds') . ' ' . __('Ago');
		} else if ($ago >= 60 && $ago < 3600) {
			$output = __('Pasted') . round($ago / 60)  . __('Minutes') . ' ' . __('Ago');
		} else if ($ago >= 3600 && $ago < 86400) {
			$output = __('Pasted') . round($ago / 3600)  . __('Hours') . ' ' . __('Ago');
		} else if ($ago >= 86400) {
			$output = __('Pasted') . round($ago / 86400)  . __('Days') . ' ' . __('Ago');
		}
		
		return $output;
	}

}
?>