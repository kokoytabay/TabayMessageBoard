<?php
App::uses('MessagesController', 'Controller');

/**
 * MessagesController Test Case
 */
class MessagesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.message',
		'app.user',
		'app.message_content'
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$this->testAction('/messages');
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$this->testAction('/messages/view/1');
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$data = array(
			'Message' => array(
				'to_id' => 2,
				'content' => 'Sample content'
			)
		);
		$this->testAction(
			'/messages/add',
			array(
				'data' => $data,
				'method' => 'post'
			)
		);
		$this->assertContains('/messages', $this->headers['Location']);
	}

/**
 * testEdit method
 *
 * @return void
 */
	/*public function testEdit() {
		$this->markTestIncomplete('testEdit not implemented.');
	}*/

}
