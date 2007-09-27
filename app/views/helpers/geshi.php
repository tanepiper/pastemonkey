<?php

class GeshiHelper extends Helper {

	var $defaults = array(
			'colour1' => '#fff',
			'colour2' => '#eee'
		);

	function generate($source,$lang,$options = array()) {
	
		$settings = array_merge($this->defaults, ife(is_array($options), $options, array()));
	
		vendor('geshi/geshi');
		
		$geshi =& new GeSHi($source,$lang);
		$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 2);
		$geshi->set_line_style('background:' . $settings['colour1'] . ';', 'background:' . $settings['colour2'] . ';');
		$geshi->set_header_type(GESHI_HEADER_DIV);
		
		return $geshi->parse_code();
	}
}

?>