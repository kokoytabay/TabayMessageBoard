<?php
App::uses('MessageContent', 'Model');

/**
 * MessageContent Test Case
 */
class MessageContentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.message_content',
		'app.message',
		'app.from'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MessageContent = ClassRegistry::init('MessageContent');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MessageContent);

		parent::tearDown();
	}

}
