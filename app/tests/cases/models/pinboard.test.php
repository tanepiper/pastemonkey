<?php 

loadModel('Pinboard');

class PinboardTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new Pinboard();
	}

	function tearDown() {
		unset($this->TestObject);
	}

	/*
	function testMe() {
		$result = $this->TestObject->findAll();
		$expected = 1;
		$this->assertEqual($result, $expected);
	}
	*/
}
?>