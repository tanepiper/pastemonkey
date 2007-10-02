<?php
class PastesController extends AppController {

	var $name = 'Pastes';
	var $helpers = array('Html', 'Form' );

	var $paginate = array('fields'=>array('Paste.id', 'Paste.paste', 'Paste.note', 'Paste.author', 'Paste.parent_id', 'Paste.language_id' ,'Paste.created' ,'Paste.expiry' , 'Language.id' ,'Language.language'),'limit'=>5, 'order'=>array('Paste.created'=>'DESC'));

	function index() {
		$this->cacheAction = '1 hour';
		$this->Paste->recursive = 0;
		$this->set('pastes', $this->paginate());
		
		$remove = $this->Paste->findAll('Paste.expiry < NOW()');
		foreach ($remove as $paste) {
			$this->Paste->delete($paste['Paste']['id']);
		}
	}

	function view($id = null) {
		$this->cacheAction = '1 hour';
		if (!$id) {
			$this->Session->setFlash('<strong>' . __('Warning', true) . '</strong><br />' . __('Paste ID', true) . ' ' . $id . ' ' . __('does not exist.'), 'default', array('sev'=>'warning'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('paste', $this->Paste->read(null, $id));
	}

	function add($name = null) {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Paste->create();
			$this->data['Paste']['expiry'] = $this->_generateDate($this->data['Paste']['expire_type']);
			
			if($this->data['Paste']['remember_me']) {
				$this->Session->write('author_name', $this->data['Paste']['author']);
			} else {
				$this->Session->write('author_name', '');
			}
			
			if (isset($this->params['form']['recaptcha_challenge_field']) && isset($this->params['form']['recaptcha_response_field'])) {
				$captcha = $this->_checkCaptcha('', $_SERVER["REMOTE_ADDR"], $this->params['form']['recaptcha_challenge_field'],$this->params['form']['recaptcha_response_field']);
				if ($captcha['result']) {
					if ($this->Paste->save($this->data)) {
						if ($this->params['isAjax']) {
						
						} else {
							$this->Session->setFlash('<strong>' . __('Notice', true) . '</strong><br />' . __('Your paste has been saved.', true), 'default', array('sev'=>'notice'));
							$this->redirect(array('action'=>'view', $this->Paste->getLastInsertID()), null, true);
						}	
					} else {
						$this->Session->setFlash('<strong>' . __('Warning', true) . '</strong><br />' . __('The paste could not be saved.', true) . '<br />' .  __('Please check all fields required are entered.', true) . '<br />' . __('Please, try again.', true), 'default', array('sev'=>'warning'));
					}
				} else {
					$this->Session->setFlash('<strong>' . __('Warning', true) . '</strong><br />' . __('You have entered the ReCaptcha incorrectly.', true) . '<br />' .  __('Please, try again.', true), 'default', array('sev'=>'warning'));
					$this->set('error',  $captcha['error']);
				}
			} else {
				$this->Session->setFlash('<strong>' . __('Fatal Error', true) . '</strong><br />' . __('Captcha library has failed to load.', true) . '<br />' . __('Please refresh the page', true) . '<br />' . __('If failure continues, please contact the system administator', true), 'default', array('sev'=>'fatal'));
			}
		}
		
		if (isset($name)) {
			$this->set('name', $name);
		} else if ($this->Session->read('author_name')) {
			$this->set('name', $this->Session->read('author_name'));
		} else {
			$this->set('name', 'Anonymous');
		}
		
		$expiry_types = array('day'=>'Day','week'=>'Week','month'=>'Month','never'=>'Never');
		$parents = $this->Paste->Parent->generateList();
		$languages = $this->Paste->Language->generateList(null,null,null,'{n}.Language.id','{n}.Language.language');
		$this->set(compact('parents', 'languages'));
		$this->set('expiry_types',$expiry_types);
		$this->set('error', null);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Paste');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->data['Paste']['parent_id'] = $id;
			$this->data['Paste']['id'] = null;
			$this->data['Paste']['expiry'] = $this->_generateDate($this->data['Paste']['expire_type']);
			$this->cleanUpFields();
			$this->Paste->create();

			if($this->data['Paste']['remember_me']) {
				$this->Session->write('author_name', $this->data['Paste']['author']);
			} else {
				$this->Session->write('author_name', '');
			}			
			
			if (isset($this->params['form']['recaptcha_challenge_field']) && isset($this->params['form']['recaptcha_response_field'])) {
				$captcha = $this->_checkCaptcha('', $_SERVER["REMOTE_ADDR"], $this->params['form']['recaptcha_challenge_field'],$this->params['form']['recaptcha_response_field']);
				if ($captcha['result']) {
					if ($this->Paste->save($this->data)) {
						if ($this->params['isAjax']) {
						
						} else {
							$this->Session->setFlash('<strong>' . __('Notice', true) . '</strong><br />' . __('Your paste has been saved.', true));
							$this->redirect(array('action'=>'view', $this->Paste->getLastInsertID()), null, true);
						}	
					} else {
						$this->Session->setFlash('<strong>' . __('Warning', true) . '</strong><br />' . __('The paste could not be saved.', true) . '<br />' .  __('Please check all fields required are entered.', true) . '<br />' . __('Please, try again.', true));
					}
				} else {
					$this->Session->setFlash('<strong>' . __('Warning', true) . '</strong><br />' . __('You have entered the ReCaptcha incorrectly.', true) . '<br />' .  __('Please, try again.', true));
					$this->set('error',  $captcha['error']);
				}
			} else {
				$this->Session->setFlash('<strong>' . __('Fatal Error', true) . '</strong><br />' . __('Captcha library has failed to load.', true) . '<br />' . __('Please refresh the page', true) . '<br />' . __('If failure continues, please contact the system administator', true), 'default', array('sev'=>'fatal'));
			}
		}

		if (empty($this->data)) {
			$this->data = $this->Paste->read(null, $id);
		}
		
		if ($this->Session->read('author_name')) {
			$this->set('name', $this->Session->read('author_name'));
		} else {
			$this->set('name', $this->data['Paste']['author']);
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
	
	function _generateDate($expiry_type) {
		switch ($expiry_type) {
				case "day":
					$output = date('Y-m-d H:i:s', time() + (24 * 3600));
					break;
				case "week":
					$output = date('Y-m-d H:i:s', time() + ((24 * 3600) * 7));
					break;
				case "month":
					$output = date('Y-m-d H:i:s', time() + ((24 * 3600) * 30));
					break;
				case "never":
					$output = null;
					break;
			}
			return $output;
	}
	
	function _checkCaptcha ($privateKey, $remote, $challange, $response) {
		vendor('recaptchalib');
		$validate = recaptcha_check_answer ($privateKey, $remote, $challange, $response);
		$output = array();
		if ($validate->is_valid) {
			$output['result'] = true;
			$output['Error'] = null;
		} else {
			$output['result'] = false;
			$output['Error'] = $validate->error;
		}
		return $output;
	}
	
	function find() {
		/* Improve: Add search for language and tags too */
		if($this->params['isAjax']) {
			$search = $this->params['url']['q'];
		} else {
			$search = $this->data['Paste']['livesearch'];
		}
		$this->set('items', $this->Paste->findAll(array('Paste.paste'=>'LIKE %' . $search . '%')));
		$this->set('term', $search);
	}

}
?>