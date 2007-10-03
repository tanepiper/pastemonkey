<?php
/* SVN FILE: $Id: configure.test.php 5498 2007-08-07 15:38:20Z nate $ */
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
 * @subpackage		cake.tests.cases.libs
 * @since			CakePHP(tm) v 1.2.0.5432
 * @version			$Revision: 5498 $
 * @modifiedby		$LastChangedBy: nate $
 * @lastmodified	$Date: 2007-08-07 16:38:20 +0100 (Tue, 07 Aug 2007) $
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
uses('configure');
/**
 * Short description for class.
 *
 * @package    cake.tests
 * @subpackage cake.tests.cases.libs
 */
class ConfigureTest extends UnitTestCase {

	function setUp() {
		$this->Configure =& Configure::getInstance();
	}

	function testListCoreObjects() {
		$result = $this->Configure->listObjects('class', CAKE_CORE_INCLUDE_PATH . DS . LIBS);
		$this->assertTrue(in_array('Xml', $result));
		$this->assertTrue(in_array('Cache', $result));
		$this->assertTrue(in_array('HttpSocket', $result));
	}

	function tearDown() {
		unset($this->Configure);
	}
}

?>