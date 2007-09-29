<?php
class PastesController extends AppController {

	var $name = 'Pastes';
	var $helpers = array('Html', 'Form' );

	var $paginate = array('fields'=>array('Paste.id', 'Paste.paste', 'Paste.note', 'Paste.author', 'Paste.parent_id', 'Paste.language_id' ,'Paste.created' ,'Paste.expiry' , 'Language.id' ,'Language.language'),'limit'=>5, 'order'=>array('Paste.created'=>'DESC'));

	function index() {
		$this->cacheAction = '1 hour';
		$this->Paste->recursive = 0;
		$this->set('pastes', $this->paginate());
		
		$remove = $this->Paste->query('SELECT `Paste`.`id` FROM `pastes` AS `Paste` WHERE `Paste`.`expiry` < NOW()');
		foreach ($remove as $paste) {
			$this->Paste->delete($paste['Paste']['id']);
		}
	}

	function view($id = null) {
		$this->cacheAction = '1 hour';
		if (!$id) {
			$this->Session->setFlash('Invalid Paste.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('paste', $this->Paste->read(null, $id));
	}

	function add($name = null) {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Paste->create();
			
			switch ($this->data['Paste']['expire_type']) {
				case "day":
					$this->data['Paste']['expiry'] = date('Y-m-d H:i:s', time() + (24 * 3600));
					break;
				case "week":
					$this->data['Paste']['expiry'] = date('Y-m-d H:i:s', time() + ((24 * 3600) * 7));
					break;
				case "month":
					$this->data['Paste']['expiry'] = date('Y-m-d H:i:s', time() + ((24 * 3600) * 30));
					break;
				case "never":
					$this->data['Paste']['expiry'] = null;
					break;
			}
			
			if ($this->Paste->save($this->data)) {
				$this->Session->setFlash('The Paste has been saved');
				$this->redirect(array('action'=>'view', $this->Paste->getLastInsertID()), null, true);
			} else {
				$this->Session->setFlash('The Paste could not be saved. Please, try again.');
			}
		}
		
		if (isset($name)) {
			$this->set('name', $name);
		} else {
			$this->set('name', 'Anonymous');
		}
		
		$expiry_types = array('day'=>'Day','week'=>'Week','month'=>'Month','never'=>'Never');
		$parents = $this->Paste->Parent->generateList();
		$languages = $this->Paste->Language->generateList(null,null,null,'{n}.Language.id','{n}.Language.language');
		$this->set(compact('parents', 'languages'));
		$this->set('expiry_types',$expiry_types);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Paste');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->data['Paste']['parent_id'] = $id;
			$this->data['Paste']['id'] = null;
			$this->cleanUpFields();
			$this->Paste->create();			
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
		$expiry_types = array('day'=>'Day','week'=>'Week','month'=>'Month','never'=>'Never');
		$languages = $this->Paste->Language->generateList(null,null,null,'{n}.Language.id','{n}.Language.language');
		$this->set(compact('languages'));
		$this->set('this_id', $id);
		$this->set('expiry_types',$expiry_types);
	}

	/*function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Paste');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Paste->del($id)) {
			$this->Session->setFlash('Paste #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}*/
	
	function latest($num = 10) {
		$latest = $this->Paste->findAll(null,array('Paste.id','Paste.author','Paste.created'),array('Paste.created'=>'DESC'),10);
		$this->set('latest',$latest);
		return $latest;
	}
	
	function download($id = null) {
		$ok = false;		
		$this->layout = 'download';
		$paste = $this->Paste->read(null, $id);
		$lang = $this->Paste->Language->find(array('id' => $paste['Paste']['language_id']));			
		$lang = strtolower($lang['Language']['language']);
		$ext="txt";
			switch($lang)
			{
				case 'bash':
					$ext='sh';
					break;
				case 'actionscript':
					$ext='html';
					break;
				case 'html4strict':
					$ext='html';
					break;
				case 'javascript':
					$ext='js';
					break;
				case 'perl':
					$ext='pl';
					break;
				case 'php':
				case 'c':
				case 'cpp':
				case 'css':
				case 'xml':
					$ext=$lang;
					break;
			}
			
			$this->set('paste', $paste);
			$this->set('ext',$ext);
			header('Content-type: text/plain');
			header('Content-Disposition: attachment; filename="paste-'.$paste['Paste']['id'].'.'.$ext.'"');
			$ok=true;
			return $ok;
	}
	
	function diff($id1, $id2) {
		$this->layout = 'download';
		$this->set('old', $this->Paste->read(null, $id1));
		$this->set('new', $this->Paste->read(null, $id2));
	}

}
?>