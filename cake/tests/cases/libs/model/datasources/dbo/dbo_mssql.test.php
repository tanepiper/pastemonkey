<?php
/* SVN FILE: $Id: dbo_mssql.test.php 5701 2007-09-30 18:13:46Z gwoo $ */
/**
 * DboMssql test
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link			http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.libs
 * @since			CakePHP(tm) v 1.2.0
 * @version			$Revision: 5701 $
 * @modifiedby		$LastChangedBy: gwoo $
 * @lastmodified	$Date: 2007-09-30 19:13:46 +0100 (Sun, 30 Sep 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */

uses('model' . DS . 'datasources' . DS . 'dbo_source',
	'model' . DS . 'datasources' . DS . 'dbo' . DS . 'dbo_mssql');
/**
 * The test class for the DboMssql
 *
 * @package		cake.tests
 * @subpackage	cake.tests.cases.libs.model.datasources.dbo
 */
class DboMssqlTest extends UnitTestCase {
/**
 * The Dbo instance to be tested
 *
 * @var object
 * @access public
 */
	var $Db = null;
/**
 * Skip if cannot connect to mysql
 *
 * @return void
 * @access public
 */
	function skip() {
		$skip = true;
		if(function_exists('mssql_connect')) {
			$skip = false;
		}
		$this->skipif ($skip, 'Mssql not installed');
	}
/**
 * Sets up a Dbo class instance for testing
 *
 * @return void
 * @access public
 */
	function setUp() {
		$this->Db =& new DboMssql(array());
		$this->Db->fullDebug = 0;
	}
/**
 * Sets up a Dbo class instance for testing
 *
 * @return void
 * @access public
 */
	function tearDown() {
		unset($this->Db);
	}
/**
 * Test Dbo value method
 *
 * @return void
 * @access public
 */
	function testValue() {
		$expected = 1.2;
		$result = $this->Db->value(1.2, 'float');
		$this->assertIdentical($expected, $result);

		$expected = "'1,2'";
		$result = $this->Db->value('1,2', 'float');
		$this->assertIdentical($expected, $result);
	}
}
?>