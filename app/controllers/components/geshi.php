<?php

class GeshiComponent extends Object {

	function startup(&$controller) {
		$this->controller = $controller;
	}

	function generate($source,$lang) {
		vendor('geshi/geshi');
		
		$geshi =& new GeSHi($source,$lang);
		$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 2);
		$geshi->set_line_style('background: #fff;', 'background: #eee;');
		$geshi->set_header_type(GESHI_HEADER_DIV);
		
		return $geshi->parse_code();
	}
}
?>