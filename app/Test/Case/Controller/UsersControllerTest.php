<?php
App::uses('UsersController', 'Controller');

/**
 * UsersController Test Case
 */
class UsersControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.message',
		'app.message_content'
	);

/**
 * testIndex method
 *
 * @return void
 */
	/*public function testIndex() {
		$this->markTestIncomplete('testIndex not implemented.');
	}*/

/**
 * testView method
 *
 * @return void
 */
	public function oooView() {
		$this->testAction('/users/view/100');
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$data = array(
			'User' => array(
				'name' => 'John Doe',
				'email' => 'john@testing.com',
				'password' => 'test',
				'confirm_password' => 'test'
			)
		);
		$this->testAction(
			'/users/add',
			array(
				'data' => $data,
				'method' => 'post'
			)
		);
		$this->assertContains('/users/thanks', $this->headers['Location']);
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$this->testAction('/users/edit/1');
	}

	public function testChangepassword() {
		$this->testAction('/users/changepassword/1');
	}

	public function testThanks() {
		$this->testAction('/users/thanks');
	}

}
