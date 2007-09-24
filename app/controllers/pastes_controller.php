<?php
class PastesController extends AppController {

	var $name = 'Pastes';
	var $helpers = array('Html', 'Form' );

	var $paginate = array('fields'=>array('Paste.id', 'Paste.paste', 'Paste.note', 'Paste.author', 'Paste.parent_id', 'Paste.language_id' ,'Paste.created' ,'Paste.expiry' , 'Language.id' ,'Language.language', 'Paste.tags'),'limit'=>5, 'order'=>array('Paste.created'=>'DESC'));

	function index() {
		$this->Paste->recursive = 0;
		
		$pastes = $this->paginate();
		$i = 0;
		foreach ($pastes as $paste) {
			$lang = $this->Paste->Language->find(array('id' => $paste['Paste']['language_id']));			
			$lang = strtolower($lang['Language']['language']);
			$pastes[$i]['Paste']['paste_formatted'] = $this->Geshi->generate($paste['Paste']['paste'],$lang);
			$i++;
		}
		$this->set('pastes', $pastes);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Paste.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		
		$paste = $this->Paste->read(null, $id);

		$lang = $this->Paste->Language->find(array('id' => $paste['Paste']['language_id']));			
		$lang = strtolower($lang['Language']['language']);
		$paste['Paste']['paste_formatted'] = $this->Geshi->generate($paste['Paste']['paste'],$lang);
		
		$this->set('paste', $paste);
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Paste->create();		
			
			if ($this->data['Paste']['author'] == '') {
				$this->data['Paste']['author'] = 'Anonymous';
			}
						
			if ($this->Paste->save($this->data)) {
				$this->Session->setFlash('The Paste has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Paste could not be saved. Please, try again.');
			}
		}
		$parents = $this->Paste->Parent->generateList();
		$languages = $this->Paste->Language->generateList(null,null,null,'{n}.Language.id','{n}.Language.language');
		$this->set(compact('parents', 'languages'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Paste');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Paste->save($this->data)) {
				$this->Session->setFlash('The Paste saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Paste could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Paste->read(null, $id);
		}
		$parents = $this->Paste->Parent->generateList();
		$languages = $this->Paste->Language->generateList();
		$this->set(compact('parents','languages'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Paste');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Paste->del($id)) {
			$this->Session->setFlash('Paste #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}
	
	function latest($num = 10) {
		$latest = $this->Paste->findAll(null,array('Paste.id','Paste.author','Paste.created'),array('Paste.created'=>'DESC'),10);
		$this->set('latest',$latest);
		return $latest;
	}

}
?>