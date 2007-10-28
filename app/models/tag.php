<?php
class Tag extends AppModel {
	
	var $hasAndBelongsToMany = array(
			'Paste' => array('className' => 'Paste',
						'joinTable' => 'pastes_tags',
						'foreignKey' => 'tag_id',
						'associationForeignKey' => 'paste_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'unique' => true),
	);
	
	function tagcloud() {
		return $this->query("SELECT `Tag`.`id`, `Tag`.`tag`, (SELECT COUNT(`pastes_tags`.`paste_id`) FROM `pastes_tags` WHERE `pastes_tags`.`tag_id` = `Tag`.`id`) AS `count` FROM `tags` AS `Tag` ORDER BY RAND() LIMIT 30;");
	}
}
?>