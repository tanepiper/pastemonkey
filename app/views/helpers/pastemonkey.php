<?php

class PastemonkeyHelper extends Helper {

	class timeAgo($timestamp) {
	
		$pasted = $time->toUnix($timestamp);
		$ago = (time() - $pasted);
		if ($ago < 60) {
			$output = 'Pasted ' . round($ago) . ' Seconds Ago';
		} else if ($ago >= 60 && $ago < 3600) {
			$output = 'Pasted ' . round($ago / 60) . ' Minutes Ago';
		} else if ($ago >= 3600 && $ago < 86400) {
			$output = 'Pasted ' . round($ago / 3600) . ' Hours Ago';
		} else if ($ago >= 86400) {
			$output = 'Pasted ' . round($ago / 86400) . ' Days Ago';
		}
		
		return $output;
	}

}
?>