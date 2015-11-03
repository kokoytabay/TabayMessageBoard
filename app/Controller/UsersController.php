<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Resize');

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout', 'thanks');
    }

	public function login() {
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	        	$this->User->id = $this->Auth->user('id');
	        	$this->User->saveField('last_login_time', date('Y-m-d H:i:s'));
	            return $this->redirect($this->Auth->redirectUrl());
	        }
	        $this->Flash->error(__('Invalid username or password, try again'));
	    }
	}

	public function logout() {
	    return $this->redirect($this->Auth->logout());
	}

/**
 * index method
 *
 * @return void
 */
	/*public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}*/

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
		$this->set('genderOptions', $this->User->genderOptions);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			$clientIp = $this->request->clientIp();
			$this->request->data['User']['last_login_time'] = date('Y-m-d H:i:s');
			$this->request->data['User']['created_ip'] = $clientIp;
			$this->request->data['User']['modified_ip'] = $clientIp;
			if ($this->User->save($this->request->data)) {
		        $this->request->data['User']['id'] = $this->User->id;
		        unset($this->request->data['User']['password']);
		        unset($this->request->data['User']['confirm_password']);
		        unset($this->request->data['User']['last_login_time']);
		        unset($this->request->data['User']['created_ip']);
		        unset($this->request->data['User']['modified_ip']);
		        $this->Auth->login($this->request->data['User']);
				return $this->redirect(array('action' => 'thanks'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		} elseif ($id != $this->Auth->user('id')) {
			return $this->redirect(array('controller' => 'messages', 'action' => 'index'));
		}
		$imageErrors = array();
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['User']['id'] = $id;
			$this->request->data['User']['modified_ip'] = $this->request->clientIp();

			if (!empty($this->request->data['User']['avatar']['name'])) {
				$ext = strrchr($this->request->data['User']['avatar']['name'], '.');
				if ($ext != '.jpg' && $ext != '.jpeg' && $ext != '.gif' && $ext != '.png') {
					$imageErrors[] = 'Please only upload a photo in .jpg, .gif or .png format';
				} else {
					$avatarDir = 'img/avatars/';
					$filename = $avatarDir . basename($this->request->data['User']['avatar']['name']);
					$newFilename = $avatarDir . $id . $ext;
					move_uploaded_file($this->request->data['User']['avatar']['tmp_name'], $filename);

					$this->Resize->init($filename);
					$this->Resize->resizeImage(128, 128, 'auto');
					$this->Resize->saveImage($newFilename);
					if ($filename != $newFilename) {
						@unlink($filename);
					}

					$this->request->data['User']['image'] = str_replace('img/', '', $newFilename); 
				}
			}

			if (count($imageErrors) == 0 && $this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'view', $id));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$this->set('imageErrors', $imageErrors);
		$this->set('genderOptions', $this->User->genderOptions);
	}

	public function changepassword($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		} elseif ($id != $this->Auth->user('id')) {
			return $this->redirect(array('controller' => 'messages', 'action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['User']['id'] = $id;
			$this->request->data['User']['modified_ip'] = $this->request->clientIp();

			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The password has been saved.'));
			}
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/

	public function thanks(){}
}
