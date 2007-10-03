<?php
/* SVN FILE: $Id: behavior.php 5676 2007-09-20 15:16:25Z nate $ */

/**
 * Model behaviors base class.
 *
 * Adds methods and automagic functionality to Cake Models.
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
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.libs.model
 * @since			CakePHP(tm) v 1.2.0.0
 * @version			$Revision: 5676 $
 * @modifiedby		$LastChangedBy: nate $
 * @lastmodified	$Date: 2007-09-20 16:16:25 +0100 (Thu, 20 Sep 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for file
 *
 * Long description for file
 *
 * @package		cake
 * @subpackage	cake.cake.libs.model
 */
class ModelBehavior extends Object {

/**
 * Contains configuration settings for use with individual model objects.  This
 * is used because if multiple models use this Behavior, each will use the same
 * object instance.  Individual model settings should be stored as an
 * associative array, keyed off of the model name.
 *
 * @var array
 * @access public
 */
	var $settings = array();
/**
 * Allows the mapping of preg-compatible regular expressions to public or
 * private methods in this class, where the array key is a /-delimited regular
 * expression, and the value is a class method.  Similar to the functionality of
 * the findBy* / findAllBy* magic methods.
 *
 * @var array
 * @access public
 */
	var $mapMethods = array();

	function setup(&$model, $config = array()) { }

	function beforeFind(&$model, $query) { }

	function afterFind(&$model, $results, $primary) { }

	function beforeValidate(&$model) { }

	function beforeSave(&$model) { }

	function afterSave(&$model, $created) { }

	function beforeDelete(&$model) { }

	function afterDelete(&$model) { }

	function onError(&$model, $error) { }
}

?>