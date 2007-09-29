<?php

class MenuHelper extends Helper {
	
	var $primary_menu = array();
	var $secondary_menu = array();
	
	function addMenu($menu = 'primary', $link, $text, $class='primary-link') {
		
		switch ($menu) {
			case "primary":
				array_push($this->primary_menu, '<a href="' . $link . '" class="' . $class . '">' . $text / '</a>');
			break;
			case "secondary":
				array_push($this->secondary_menu, '<a href="' . $link . '" class="' . $class . '">' . $text / '</a>');
			break;
		}		
		pr($this->primary_menu);
	}
	
	function renderMenu($menu = 'primary') {
		switch ($menu) {
			case "primary":
				$output = '<ul id="primary-nav">';
				foreach($this->primary_menu as $item) {
					$output .= '<li>' . $item . '</li>';
				}
			break;
			case "secondary":
				return $this->secondary_menu;
			break;
		}		
		return $output;
	}
	
}

?>