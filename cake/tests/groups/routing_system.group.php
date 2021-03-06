<?php
/* SVN FILE: $Id: routing_system.group.php 5517 2007-08-13 20:40:37Z nate $ */
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
 * @subpackage		cake.tests.groups
 * @since			CakePHP(tm) v 1.2.0.5517
 * @version			$Revision: 5517 $
 * @modifiedby		$LastChangedBy: nate $
 * @lastmodified	$Date: 2007-08-13 21:40:37 +0100 (Mon, 13 Aug 2007) $
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
/** RoutingSystemGroupTest
 *
 * This test group will run all the Router/Dispatcher (and related) tests
 *
 * @package    cake.tests
 * @subpackage cake.tests.groups
 */
class RoutingSystemGroupTest extends GroupTest {

	var $label = 'Routing system';

	function RoutingSystemGroupTest() {
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'dispatcher');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'router');
	}
}
?>