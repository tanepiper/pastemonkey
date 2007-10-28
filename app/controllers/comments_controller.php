<?php
class CommentsController extends AppController {

/*
	function index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}
*/
	function view($id = null, $line=null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Comment.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->recursive = 0;
		$query = $this->Comment->findAll(array('Comment.paste_id'=>$id, 'Comment.line_position'=>$line), array('Comment.id', 'Comment.paste_id', 'Comment.line_position', 'Comment.author', 'Comment.comment', 'Comment.created'));		
		$this->set('comments', $query);
	}

	function add() {
		if (!empty($this->data)) {
		
			// Kill the page if a spam bot enters into this
			if ($this->data['Comment']['i_am_a_human']) {
				die();
			}
		
			$this->cleanUpFields();
			$this->Comment->create();
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash('The Comment has been saved');
				$this->redirect(array('controller'=>'pastes', 'action'=>'view', $this->data['Comment']['paste_id']), null, true);
			} else {
				$this->Session->setFlash('The Comment could not be saved. Please, try again.');
			}
		}
	}
/*
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Comment');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash('The Comment has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Comment could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Comment->read(null, $id);
		}
		$pastes = $this->Comment->Paste->generateList();
		$this->set(compact('pastes'));
	}
*/
/*
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Comment');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Comment->del($id)) {
			$this->Session->setFlash('Comment #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}
*/
}
?>