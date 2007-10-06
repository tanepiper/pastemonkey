<?php
/***
	*	pastes_controller.php
	*	Author: Tane Piper (digitalspaghetti@gmail.com)
	*	Copyright: Tane Piper
	*	Licence: MIT Licence
	*	=======================================
	*	This code is the main controller for site pastes.
	*/

class PastesController extends AppController {

	var $paginate = array('fields'=>array('Paste.id', 'Paste.paste', 'Paste.note', 'Paste.author', 'Paste.parent_id', 'Paste.language_id' , 'Paste.private', 'Paste.created' ,'Paste.expiry' , 'Language.id' ,'Language.language', 'Language.class'),'limit'=>5, 'order'=>array('Paste.created'=>'DESC'));

	var $expiry_types = array('1 hour'=>'1 Hour', '1 day'=>'1 Day','1 week'=>'1 Week','1 month'=>'1 Month','never'=>'Never');

	var $simple_spam = array('no'=>'No', 'yes'=>'Yes');

	function index() {
		$this->cacheAction = '1 hour';
		$this->Paste->recursive = 0;
		$this->set('pastes', $this->paginate(array('conditions'=>array('Paste.private'=>'0'))));
		$this->Paste->_purge();
	}

	function view($id = null) {
		$this->cacheAction = '1 hour';
		if (!$id) {
			$this->Session->setFlash('<strong>' . __('Warning', true) . '</strong><br />' . __('Paste ID Invalid', true) . ' ' . $id . ' ' . __('does not exist.'), 'default', array('sev'=>'warning'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('paste', $this->Paste->read(null, $id));
		$this->Paste->_purge();
	}
	
	function add($name = null) {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Paste->create();
			
			$this->Session->write('author_name', $this->data['Paste']['author']);
			$this->Session->write('remember_me', $this->data['Paste']['remember_me']);
			if ($this->data['Paste']['i_am_human'] == 'yes') {
				if ($this->Paste->save($this->data)) {
					$this->Session->setFlash('<strong>' . __('Notice', true) . '</strong><br />' . __('Your paste has been saved.', true), 'default', array('sev'=>'notice'));
					$this->redirect(array('controller'=>'pastes', 'action'=>'view', $this->Paste->getLastInsertID()), null, true);
				} else {
					$this->Session->setFlash('<strong>' . __('Warning', true) . '</strong><br />' . __('The paste could not be saved.', true) . '<br />' .  __('Please check all fields required are entered.', true) . '<br />' . __('Please, try again.', true), 'default', array('sev'=>'warning'));
				}
			} else {
				$this->Session->setFlash('<strong>' . __('Warning', true) . '</strong><br />' . __('You haven\'t confirmed you are human.', true) . '<br />' . __('Please, try again.', true), 'default', array('sev'=>'warning'));
			}
		}
		
		if (isset($name)) {
			$this->set('name', $name);
		} else if ($this->Session->read('author_name')) {
			$this->set('name', $this->Session->read('author_name'));
		} else {
			$this->set('name', 'Anonymous');
		}
		
		if ($this->Session->read('remember_me')) {
			$this->set('remember_me', 1);
		} else {
			$this->set('remember_me', 0);
		}

		$this->set('languages', $this->Paste->Language->generateList(null,null,null,'{n}.Language.id','{n}.Language.language'));
		$this->set('expiry_types',$this->expiry_types);
		$this->set('i_am_human', $this->simple_spam);
		$this->Paste->_purge();
	}
	
	function edit($id = null) {
	
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('<strong>' . __('Warning', true) . '</strong><br />' . __('Invalid Paste ID.', true), 'default', array('sev'=>'warning'));
			$this->redirect(array('action'=>'index'), null, true);
		}
	
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Paste->create();
			
			/* Generate Sudo Fields*/
			
			$this->data['Paste']['parent_id'] = $id;
			
			$this->Session->write('author_name', $this->data['Paste']['author']);
			$this->Session->write('remember_me', $this->data['Paste']['remember_me']);
			
			if ($this->data['Paste']['i_am_human'] == 'yes') {
				if ($this->Paste->save($this->data)) {
					$this->Session->setFlash('<strong>' . __('Notice', true) . '</strong><br />' . __('Your paste has been saved.', true), 'default', array('sev'=>'notice'));
					$this->redirect(array('action'=>'view', $this->Paste->getLastInsertID()), null, true);	
				} else {
					$this->Session->setFlash('<strong>' . __('Warning', true) . '</strong><br />' . __('The paste could not be saved.', true) . '<br />' .  __('Please check all fields required are entered.', true) . '<br />' . __('Please, try again.', true), 'default', array('sev'=>'warning'));
				}
			} else {
				$this->Session->setFlash('<strong>' . __('Warning', true) . '</strong><br />' . __('You haven\'t confirmed you are human.', true) . '<br />' . __('Please, try again.', true), 'default', array('sev'=>'warning'));
			}
		}
		
		if (isset($name)) {
			$this->set('name', $name);
		} else if ($this->Session->read('author_name')) {
			$this->set('name', $this->Session->read('author_name'));
		} else {
			$this->set('name', 'Anonymous');
		}
		
		if ($this->Session->read('remember_me')) {
			$this->set('remember_me', 1);
		} else {
			$this->set('remember_me', 0);
		}

		if (empty($this->data)) {
			$this->data = $this->Paste->read(null, $id);
		}
		
		$this->set('languages', $this->Paste->Language->generateList(null,null,null,'{n}.Language.id','{n}.Language.language'));
		$this->set('expiry_types',$this->expiry_types);
		$this->set('this_id', $id);
		$this->set('i_am_human', $this->simple_spam);
		$this->Paste->_purge();
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
		$latest = $this->Paste->findAll(array('Paste.private'=>'0'),array('Paste.id','Paste.author','Paste.created'),array('Paste.created'=>'DESC'),10);
		$this->set('latest',$latest);
		return $latest;
	}
	
	function download($id = null) {
		$this->layout = 'download';
		$paste = $this->Paste->read(null, $id);
		$ext="txt";
			switch($paste['Language']['class'])
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
				case 'mysql':
					$ext='sql';
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
	}
	
	function diff($id1, $id2) {
		$this->layout = 'download';
		$this->set('old', $this->Paste->read(null, $id1));
		$this->set('new', $this->Paste->read(null, $id2));
	}
	
	function search($value = null) {
		if ($value && $this->params['isAjax']) {
			$search_term = $value;
		} else if ($this->data) {
			$search_term = $this->data['Paste']['search_term'];
		}
		$this->set('items', $this->paginate(array('conditions'=>array('Paste.paste'=>'LIKE %' . $search_term . '%', 'Paste.private'=>'0'))));
		$this->set('term', $search_term);
		$this->Paste->_purge();
	}
	
	function about(){
		// This function only generates a hard-coded view		
	}
	
	/* Private Functions */
	
}
?>