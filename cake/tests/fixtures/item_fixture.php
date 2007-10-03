<?php
/* SVN FILE: $Id: item_fixture.php 5630 2007-09-11 21:00:58Z mariano.iglesias $ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <https://trac.cakephp.org/wiki/Developement/TestSuite>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link				https://trac.cakephp.org/wiki/Developement/TestSuite CakePHP(tm) Tests
 * @package			cake.tests
 * @subpackage		cake.tests.fixtures
 * @since			CakePHP(tm) v 1.2.0.4667
 * @version			$Revision: 5630 $
 * @modifiedby		$LastChangedBy: mariano.iglesias $
 * @lastmodified	$Date: 2007-09-11 22:00:58 +0100 (Tue, 11 Sep 2007) $
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
/**
 * Short description for class.
 *
 * @package		cake.tests
 * @subpackage	cake.tests.fixtures
 */
class ItemFixture extends CakeTestFixture {
	var $name = 'Item';
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary', 'extra'=> 'auto_increment'),
		'syfile_id' => array('type' => 'integer', 'null' => false),
		'name' => array('type' => 'string', 'null' => false)
	);
	var $records = array(
		array ('id' => 1, 'syfile_id' => 1, 'name' => 'Item 1'),
		array ('id' => 2, 'syfile_id' => 2, 'name' => 'Item 2'),
		array ('id' => 3, 'syfile_id' => 3, 'name' => 'Item 3'),
		array ('id' => 4, 'syfile_id' => 4, 'name' => 'Item 4'),
		array ('id' => 5, 'syfile_id' => 5, 'name' => 'Item 5'),
		array ('id' => 6, 'syfile_id' => 6, 'name' => 'Item 6')
	);
}
?>