<?php
/* SVN FILE: $Id: component.test.php 5460 2007-07-25 04:38:28Z phpnut $ */
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
 * @subpackage		cake.tests.cases.libs.controller
 * @since			CakePHP(tm) v 1.2.0.5436
 * @version			$Revision: 5460 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2007-07-25 05:38:28 +0100 (Wed, 25 Jul 2007) $
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
uses('controller' . DS . 'component');
/**
 * Short description for class.
 *
 * @package    cake.tests
 * @subpackage cake.tests.cases.libs.controller
 */
class ComponentTest extends CakeTestCase {

	function skip() {
		$this->skipif (true, 'ComponentTest not implemented');
	}
}
?>