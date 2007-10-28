<?php
class LanguagesController extends AppController {

	var $name = 'Languages';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Language->recursive = 0;
		$this->set('languages', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Language.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('language', $this->Language->read(null, $id));
	}

	/*function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Language->create();
			if ($this->Language->save($this->data)) {
				$this->Session->setFlash('The Language has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Language could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Language');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Language->save($this->data)) {
				$this->Session->setFlash('The Language saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Language could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Language->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Language');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Language->del($id)) {
			$this->Session->setFlash('Language #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}*/
	
	function find(){
		$search = $this->params['url']['q'];
		$this->set('languages', $this->Language->findAll(array('Language.language'=>'LIKE ' . $search . '%')));
	}

}
?>