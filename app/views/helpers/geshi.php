exandria0<?php
class GeshiHelper extends Helper {

	var $defaults = array(
			'colour1' => '#fff',
			'colour2' => '#eee',
			'linenumbers'=>true,
			'linespacing'=>2,
			'lineids'=>false,
			'strictmode'=>true
		);

	function generate($source, $lang, $options = array()) {
	
		$settings = array_merge($this->defaults, ife(is_array($options), $options, array()));
		vendor('geshi/geshi');
		
		$geshi =& new GeSHi($source,$lang);
		if ($settings['linenumbers']) {
			$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, $settings['linespacing']);
		}
		$geshi->set_line_style('background:' . $settings['colour1'] . ';', 'background:' . $settings['colour2'] . ';');
		$geshi->set_header_type(GESHI_HEADER_DIV);
		$geshi->enable_ids($settings['lineids']);
		$geshi->enable_strict_mode($settings['strictmode']);
		return $geshi->parse_code();
	}
}

?>