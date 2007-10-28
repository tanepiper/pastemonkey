<?php 
/*<!--App schema generated on: 2007-10-25 22:10:35 : 1193346395-->*/


class AppSchema extends CakeSchema {

	var $name = 'App';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $comments = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'extra' => 'auto_increment'),
			'paste_id' => array('type'=>'integer', 'null' => false, 'default' => ''),
			'line_position' => array('type'=>'integer', 'null' => false, 'default' => '', 'length' => 5),
			'comment' => array('type'=>'text', 'null' => false, 'default' => ''),
			'author' => array('type'=>'string', 'null' => false, 'default' => ''),
			'created' => array('type'=>'datetime', 'null' => true, 'default' => null),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);

	var $languages = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'extra' => 'auto_increment'),
			'language' => array('type'=>'string', 'null' => false, 'default' => ''),
			'class' => array('type'=>'string', 'null' => false, 'default' => ''),
			'weight' => array('type'=>'integer', 'null' => false, 'default' => 0, 'length' => 3),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);

	var $pastes = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'extra' => 'auto_increment'),
			'priv_stub' => array('type'=>'string', 'null' => false, 'default' => '', 'length' => 36),
			'paste' => array('type'=>'text', 'null' => false, 'default' => ''),
			'note' => array('type'=>'text', 'null' => true, 'default' => null),
			'author' => array('type'=>'string', 'null' => true, 'default' => null),
			'tags' => array('type'=>'text', 'null' => true, 'default' => null),
			'highlight_lines' => array('type'=>'string', 'null' => true, 'default' => null),
			'parent_id' => array('type'=>'integer', 'null' => true, 'default' => null),
			'language_id' => array('type'=>'integer', 'null' => false, 'default' => ''),
			'private' => array('type'=>'boolean', 'null' => false, 'default' => 0),
			'created' => array('type'=>'datetime', 'null' => true, 'default' => null),
			'expiry' => array('type'=>'datetime', 'null' => true, 'default' => null),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);

	var $pastes_tags = array(
			'paste_id' => array('type'=>'integer', 'null' => false, 'default' => ''),
			'tag_id' => array('type'=>'integer', 'null' => false, 'default' => '', 'key' => 'primary'),
			'indexes' => array()
		);

	var $tags = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'extra' => 'auto_increment'),
			'tag' => array('type'=>'string', 'null' => false, 'default' => ''),
			'created' => array('type'=>'datetime', 'null' => true, 'default' => null),
			'modified' => array('type'=>'datetime', 'null' => true, 'default' => null),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);


}

?>