<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid User.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			
			if ($this->data['User']['openid_url']) {
				
			}
			
			$this->cleanUpFields();
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash('The User has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The User could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid User');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash('The User saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The User could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for User');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash('User #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}
	
	function login() {
		if ($this->Auth->user()) {
			if (!empty($this->data)) {
				if (empty($this->data['User']['remember_me'])) {
					$this->Cookie->del('User');
				}
				else {
					$cookie = array();
					$cookie['email'] = $this->data['User']['email'];
					$cookie['token'] = $this->data['User']['pasword'];
					$this->Cookie->write('User', $cookie, true, '+2 weeks');
				}
				unset($this->data['User']['remember_me']);
			}
			$this->redirect($this->Auth->redirect());
		}
	}

}
?>