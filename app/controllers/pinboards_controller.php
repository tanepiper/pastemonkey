<?php
class PinboardsController extends AppController {

	var $name = 'Pinboards';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Pinboard->recursive = 0;
		$this->set('pinboards', $this->paginate());
	}

/*	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Pinboard.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('pinboard', $this->Pinboard->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Pinboard->create();
			if ($this->Pinboard->save($this->data)) {
				$this->Session->setFlash('The Pinboard has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Pinboard could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Pinboard');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Pinboard->save($this->data)) {
				$this->Session->setFlash('The Pinboard saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Pinboard could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Pinboard->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Pinboard');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Pinboard->del($id)) {
			$this->Session->setFlash('Pinboard #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}
*/
}
?>