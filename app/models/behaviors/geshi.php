<?php

class GeshiBehavior extends ModelBehavior {
	
	function setup (&$model, $settings = array()) {
		$default = array(
			'colour1' => '#fff',
			'colour2' => '#eee'
		);
		
		if(!isset($this->settings[$model->name])) {
			$this->settings[$model->name] = $default;
		}
		
		$this->settings[$model->name] = array_merge($this->settings[$model->name], ife(is_array($settings), $settings, array()));	
	}
	
	function afterFind(&$model, $results) {
		foreach ($results as $key => $val) {
			if(isset($val['Paste']['paste'])) {
				$results[$key]['Paste']['paste_formatted'] = $this->_generate($val['Paste']['paste'], strtolower($val['Language']['language']), $model);
			}
		}
		
		return $results;
	}
	
	function _generate($source,$lang,&$model) {
		vendor('geshi/geshi');
		
		$geshi =& new GeSHi($source,$lang);
		$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 2);
		$geshi->set_line_style('background:' . $this->settings[$model->name]['colour1'] . ';', 'background:' . $this->settings[$model->name]['colour2'] . ';');
		$geshi->set_header_type(GESHI_HEADER_DIV);
		
		return $geshi->parse_code();
	}
}
?>