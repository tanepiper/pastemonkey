<?php
/* SVN FILE: $Id: posts_tag_fixture.php 5579 2007-08-25 03:59:21Z gwoo $ */
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
 * @version			$Revision: 5579 $
 * @modifiedby		$LastChangedBy: gwoo $
 * @lastmodified	$Date: 2007-08-25 04:59:21 +0100 (Sat, 25 Aug 2007) $
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
/**
 * Short description for class.
 *
 * @package		cake.tests
 * @subpackage	cake.tests.fixtures
 */
class PostsTagFixture extends CakeTestFixture {
	var $name = 'PostsTag';
	var $fields = array(
		'post_id' => array('type' => 'integer', 'null' => false),
		'tag_id' => array('type' => 'integer', 'null' => false),
		'indexes' => array('UNIQUE_TAG' => array('column'=> array('post_id', 'tag_id'), 'unique'=> 1))
	);
	var $records = array(
		array('post_id' => 1, 'tag_id' => 1),
		array('post_id' => 1, 'tag_id' => 2),
		array('post_id' => 2, 'tag_id' => 1),
		array('post_id' => 2, 'tag_id' => 3)
	);
}

?>