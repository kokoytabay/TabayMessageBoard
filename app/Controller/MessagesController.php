<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
class MessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Message->recursive = 2;
		$this->Paginator->settings = array(
			'conditions' => array(
				'OR' => array(
					array('Message.to_id' => $this->Auth->user('id')),
					array('Message.from_id' => $this->Auth->user('id'))
				)
			),
	        'order' => array('Message.created' => 'desc'),
	        'limit' => 10
	    );
		$this->set('messages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->Paginator->settings = array(
			'conditions' => array(
				'OR' => array(
					array('Message.to_id' => $this->Auth->user('id')),
					array('Message.from_id' => $this->Auth->user('id'))
				),
				'MessageContent.message_id' => $id
			),
	        'order' => array('MessageContent.created' => 'desc'),
	        'limit' => 10
	    );
	    $this->set('id', $id);
		$this->set('messages', $this->Paginator->paginate('MessageContent'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Message->create();
			$this->request->data['Message']['from_id'] = $this->Auth->user('id');
			if ($this->Message->save($this->request->data)) {
				$this->request->data['MessageContent'] = $this->request->data['Message'];
				$this->request->data['MessageContent']['message_id'] = $this->Message->id;
				$this->loadModel('MessageContent');
				$this->MessageContent->create();
				$this->MessageContent->save($this->request->data);
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
		}
		$messageTos = $this->Message->MessageTo->find('list',
			array(
				'conditions' => array(
					'MessageTo.id !=' => $this->Auth->user('id')
				)
			)
		);
		$this->set(compact('messageTos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function edit($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Message->save($this->request->data)) {
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
		}
		$messageTos = $this->Message->MessageTo->find('list');
		$messageFroms = $this->Message->MessageFrom->find('list');
		$this->set(compact('messageTos', 'messageFroms'));
	}*/

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
			exit;
		}
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$message = $this->Message->find('first', $options);
		if ($message['Message']['from_id'] != $this->Auth->user('id')) {
			throw new NotFoundException(__('Invalid message'));
			exit;
		}

		if ($this->Message->delete()) {
			echo 'The message has been deleted.';
		} else {
			echo 'The message could not be deleted. Please, try again.';
		}
		exit;
	}

	public function deletecontent($id = null) {
		$this->loadModel('MessageContent');
		$this->MessageContent->id = $id;
		if (!$this->MessageContent->exists()) {
			throw new NotFoundException(__('Invalid message'));
			exit;
		}
		$options = array('conditions' => array('MessageContent.' . $this->MessageContent->primaryKey => $id));
		$message = $this->MessageContent->find('first', $options);
		if ($message['MessageContent']['from_id'] != $this->Auth->user('id')) {
			throw new NotFoundException(__('Invalid message'));
			exit;
		}

		if ($this->MessageContent->delete()) {
			$options = array('conditions' => array('MessageContent.message_id' => $message['MessageContent']['message_id']));
			$firstMessage = $this->MessageContent->find('first', $options);
			if (empty($firstMessage)) {
				$this->Message->id = $message['MessageContent']['message_id'];
				$this->Message->delete();
				echo 'redirect'; exit;
			}
			echo 'The message has been deleted.';
		} else {
			echo 'The message could not be deleted. Please, try again.';
		}
		exit;
	}

	public function addcontent() {
		$this->layout = 'ajax';

		if ($this->request->is('post')) {
			$this->loadModel('MessageContent');
			$this->MessageContent->create();
			$this->request->data['MessageContent']['from_id'] = $this->Auth->user('id');
			if ($this->MessageContent->save($this->request->data)) {
				$options = array('conditions' => array('MessageContent.' . $this->MessageContent->primaryKey => $this->MessageContent->id));
				$this->set('message', $this->MessageContent->find('first', $options));
			}
		}
	}

	public function search() {
		$this->layout = 'ajax';

		$this->loadModel('MessageContent');
		$options = array(
			'conditions' => array(
				'OR' => array(
					array('Message.to_id' => $this->Auth->user('id')),
					array('Message.from_id' => $this->Auth->user('id'))
				),
				'MessageContent.content LIKE' => '%' . $this->request->query['search'] .'%'
			),
	        'order' => array('MessageContent.created' => 'desc'),
	    );
		$this->set('messages', $this->MessageContent->find('all', $options));
	}
}
