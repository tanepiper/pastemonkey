<?php
/* SVN FILE: $Id: aros_aco_fixture.php 5573 2007-08-23 22:38:04Z gwoo $ */
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
 * @version			$Revision: 5573 $
 * @modifiedby		$LastChangedBy: gwoo $
 * @lastmodified	$Date: 2007-08-23 23:38:04 +0100 (Thu, 23 Aug 2007) $
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
/**
 * Short description for class.
 *
 * @package		cake.tests
 * @subpackage	cake.tests.fixtures
 */
class ArosAcoFixture extends CakeTestFixture {
	var $name = 'ArosAco';
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary', 'extra'=> 'auto_increment'),
		'aro_id' => array('type' => 'integer', 'length' => 10, 'null' => false),
		'aco_id' => array('type' => 'integer', 'length' => 10, 'null' => false),
		'_create' => array('type' => 'string', 'length' => 2, 'null' => false, 'default' => '0'),
		'_read' => array('type' => 'string', 'length' => 2, 'null' => false, 'default' => '0'),
		'_update' => array('type' => 'string', 'length' => 2, 'null' => false, 'default' => '0'),
		'_delete' => array('type' => 'string', 'length' => 2, 'null' => false, 'default' => '0')
	);
	var $records = array(
	);
}

?>