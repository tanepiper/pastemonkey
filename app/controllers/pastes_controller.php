<?php
/**
  *	@package pastemonkey.controllers
  * @author Tane Piper <digitalspaghetti@gmail.com>
  * @name paste_controller.php
  * @Version 0.6
  * 
  */
class PastesController extends AppController {

	// Load Security Component to stop forms being ammended at runtime.
	var $components = array('Security');
	// Default Pagination Settings
	var $paginate = array('fields'=>array('Paste.id', 'Paste.paste', 'Paste.note', 'Paste.author', 'Paste.parent_id', 'Paste.language_id' , 'Paste.private', 'Paste.created' ,'Paste.expiry' , 'Language.id' ,'Language.language', 'Language.class'), 'order'=>array('Paste.created'=>'DESC'));

  /** Set the plain text id for default */	
	var $plain_text_id = 48;
	
	/**
	 * Inheret the beforeFilter from the AppController
	 */
	function beforeFilter() {
	  parent::beforeFilter();
	}
	
	
	/**
	  *	Function index
	  */
	
	function index() {
		// Declare Class Variables
		$this->cacheAction = '1 hour';
		$this->Paste->recursive = 0;	// Were only pulling basic data.

		// Allows the limit to be overidden
		if (!isset($this->passedArgs['limit'])) {
			$this->passedArgs['limit'] = 5;
		}
		
		$this->set('pastes', $this->paginate('Paste', array('Paste.private'=>'0')));
		$this->Paste->_purge();	// Purge Old Pastes
	}

	function view($id = null) {
		// Declare Class Variables
		$this->cacheAction = '1 hour';
		$this->recursive = 3;

		// If paste is not found, we have to notify the user
		if (!$id) {
			$this->Session->setFlash('<strong>' . __('Warning', true) . '</strong><br />' . __('Paste ID Invalid', true) . ' ' . $id . ' ' . __('does not exist.'), 'default', array('sev'=>'warning'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		
		$paste = $this->Paste->read(null, $id);
		
		// Check to see if there are any lines to highlight by exploding the line and creating an array from it to pass to GeSHi
		if ($paste['Paste']['highlight_lines']) {
			$lines = explode(',', $paste['Paste']['highlight_lines']);
			$paste['Paste']['highlight_lines'] = $lines;
		} else {
			$paste['Paste']['highlight_lines'] = array();
		}
				
		$this->set('paste', $paste);
		$this->Paste->_purge();
	}
	
	function add() {	
		if (!empty($this->data)) {
		
			// Kill the page if a spam bot enters into this
			if ($this->data['Paste']['i_am_a_human']) {
				die();
			}
		
			// Clean up paste before we save
			//$this->cleanUpFields();
			$this->Paste->create();
			
			// Write session data based on authors options
			$this->Session->write('author_name', $this->data['Paste']['author']);
			$this->Session->write('remember_me', $this->data['Paste']['remember_me']);
			
			// Sanatize fields that we don't want hijacked
			$this->data['Paste']['author'] = Sanitize::html($this->data['Paste']['author']);
			$this->data['Paste']['note'] = Sanitize::html($this->data['Paste']['note']);
			
			// We want to convert the language sent back to it's ID from description
			if($this->data['Paste']['language_id']) {
				$getlang = $this->Paste->Language->find(array('Language.language'=>$this->data['Paste']['language_id']));
				$this->data['Paste']['language_id'] = $getlang['Language']['id'];
			} else {
				$this->data['Paste']['language_id'] = $this->plain_text_id;
			}
			// Ok, now we save
			if ($this->Paste->save($this->data)) {
				$this->Session->setFlash('<strong>' . __('Notice', true) . '</strong><br />' . __('Your paste has been saved.', true), 'default', array('sev'=>'notice'));
					$this->redirect(array('controller'=>'pastes', 'action'=>'view', $this->Paste->getLastInsertID()), null, true);
			} else {
				$this->Session->setFlash('<strong>' . __('Error', true) . '</strong><br />' . __('The paste could not be saved.', true) . '<br />' .  __('Please check all fields required are entered.', true) . '<br />' . __('Please, try again.', true), 'default', array('sev'=>'error'));
			}
		}
		
		// Check to see if the authors name is set in the passed arguments
		if (isset($this->passedArgs['author'])) {
			$this->set('name', $this->passedArgs['author']);
		// Else check if the Session has the authors name
		} else if ($this->Session->read('author_name')) {
			$this->set('name', $this->Session->read('author_name'));
		// Ok, no name set, so we make it Anonymous
		} else {
			$this->set('name', 'Anonymous');
		}
		
		// Lets check if the user has set to remember the session name
		if ($this->Session->read('remember_me')) {
			$this->set('remember_me', 1);
		} else {
			$this->set('remember_me', 0);
		}
		
		// Check to see if the user has sent the language in the passed arguments
		if(isset($this->passedArgs['lang'])) {
			$find = $this->Paste->Language->find(array('Language.class'=>$this->passedArgs['lang']), 'Language.language');
			$ol = $find['Language']['language'];
		// Define the default language as Plain Text if no language is set
		} else {
			$ol = null;
		}
		// Now pass the overide language
		$this->set('overide_lang', $ol);

		// Generate a list of languages
		//$this->set('languages', $this->Paste->Language->generateList(null,array('Language.weight'=>'DESC', 'Language.language'=>'ASC'),null,'{n}.Language.id','{n}.Language.dropdown'));
		// Set Expiry types
		$this->set('expiry_types',$this->Paste->pasteExpiryTimes());
		// Purge all old pastes
		$this->Paste->_purge();
	}
	
	function edit($id = null) {	
	
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('<strong>' . __('Error', true) . '</strong><br />' . __('Invalid Paste ID.', true), 'default', array('sev'=>'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
	
		if (!empty($this->data)) {
			
			// Kill the page if a spam bot enters into this
			if ($this->data['Paste']['i_am_a_human']) {
				die();
			}
		
			// Clean up paste before we save
			$this->cleanUpFields();
			$this->Paste->create();
			
			// Write session data based on authors options
			$this->Session->write('author_name', $this->data['Paste']['author']);
			$this->Session->write('remember_me', $this->data['Paste']['remember_me']);
			
			// Sanatize fields that we don't want hijacked
			$this->data['Paste']['author'] = Sanitize::html($this->data['Paste']['author']);
			$this->data['Paste']['note'] = Sanitize::html($this->data['Paste']['note']);

			//We want to convert the language sent back to it's ID from description
			if($this->data['Paste']['language_id']) {
				$getlang = $this->Paste->Language->find(array('Language.language'=>$this->data['Paste']['language_id']));
				$this->data['Paste']['language_id'] = $getlang['Language']['id'];
			} else {
				$this->data['Paste']['language_id'] = $this->plain_text_id;
			}
			
			// Set the parent ID of this paste so we can generate a Diff file:
			$this->data['Paste']['parent_id'] = $id;
			
			// Ok, now we save
			if ($this->Paste->save($this->data)) {
				$this->Session->setFlash('<strong>' . __('Notice', true) . '</strong><br />' . __('Your paste has been saved.', true), 'default', array('sev'=>'notice'));
					$this->redirect(array('controller'=>'pastes', 'action'=>'view', $this->Paste->getLastInsertID()), null, true);
			} else {
				$this->Session->setFlash('<strong>' . __('Error', true) . '</strong><br />' . __('The paste could not be saved.', true) . '<br />' .  __('Please check all fields required are entered.', true) . '<br />' . __('Please, try again.', true), 'default', array('sev'=>'error'));
			}
		}
		
		// Check to see if the authors name is set in the passed arguments
		if (isset($this->passedArgs['author'])) {
			$this->set('name', $this->passedArgs['author']);
		// Else check if the Session has the authors name
		} else if ($this->Session->read('author_name')) {
			$this->set('name', $this->Session->read('author_name'));
		// Ok, no name set, so we make it Anonymous
		} else {
			$this->set('name', 'Anonymous');
		}
		
		// Lets check if the user has set to remember the session name
		if ($this->Session->read('remember_me')) {
			$this->set('remember_me', 1);
		} else {
			$this->set('remember_me', 0);
		}
		
		// Get the Paste data, as we don't need to overide in an Edit
		if (empty($this->data)) {
			$this->data = $this->Paste->read(null, $id);
			
			// Check to see if the user has sent the language in the passed arguments
			if(isset($this->passedArgs['lang'])) {
				$find = $this->Paste->Language->find(array('Language.class'=>$this->passedArgs['lang']), 'Language.language');
				$ol = $find['Language']['language'];
			// Define the default language as Plain Text if no language is set
			} else {
				$find = $this->Paste->Language->find(array('Language.id'=>$this->data['Paste']['language_id']));
				$ol = $find['Language']['language'];
			}
		// Now pass the overide language
		$this->set('overide_lang', $ol);	
		}
		// Set Expiry types
		$this->set('expiry_types',$this->expiry_types);
		// Purge all old pastes
		$this->Paste->_purge();
	}
	
/*
	function delete($id = null) {
	
		if (!$id && $this->data['Paste']['id']) {
			$id = $this->data['Paste']['id'];
		}
	
		if (!$id) {
			$this->Session->setFlash('Invalid id for Paste');
			$this->redirect(array('action'=>'index'), null, true);
		}
		
		$getDetails = $this->Paste->read(null, $id);
		
		if ($getDetails['Paste']['delete_password'] == md5($this->data['Paste']['delete_password'])) {
			if ($this->Paste->del($id)) {
				$this->Session->setFlash('Paste #'.$id.' deleted');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('Delete Failed');
			}
		} else {
			$this->Session->setFlash('Passwords Dont Match');
		}
	}
*/	
	function latest($num = 10) {
		$this->cacheAction = '1 hour';
		$latest = $this->Paste->find('all', array(
		  'conditions' => array('Paste.private'=>'0'),
		  'fields' => array('Paste.id','Paste.author','Paste.created'),
		  'order' => array('Paste.created'=>'DESC'),
		  'limit'=> 10));
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
		$this->cacheAction = '1 hour';
		if ($value && $this->params['isAjax']) {
			$search_term = $value;
		} else if ($this->data) {
			$search_term = $this->data['Paste']['search_term'];
		}
		$this->set('items', $this->paginate(array('conditions'=>array('Paste.paste'=>'LIKE %' . $search_term . '%', 'Paste.private'=>'0'))));
		$this->set('term', $search_term);
		$this->Paste->_purge();
	}
	
	function upload() {	
		if (!empty($this->data)) {
		
			// Kill the page if a spam bot enters into this
			if ($this->data['Paste']['i_am_a_human']) {
				die();
			}
		
			// Clean up paste before we save
			$this->cleanUpFields();
			$this->Paste->create();
			
			// Write session data based on authors options
			$this->Session->write('author_name', $this->data['Paste']['author']);
			$this->Session->write('remember_me', $this->data['Paste']['remember_me']);
			
			// Sanatize fields that we don't want hijacked
			$this->data['Paste']['author'] = Sanitize::html($this->data['Paste']['author']);
			$this->data['Paste']['note'] = Sanitize::html($this->data['Paste']['note']);
			
			// We want to convert the language sent back to it's ID from description
			if($this->data['Paste']['language_id']) {
				$getlang = $this->Paste->Language->find(array('Language.language'=>$this->data['Paste']['language_id']));
				$this->data['Paste']['language_id'] = $getlang['Language']['id'];
			} else {
				$this->data['Paste']['language_id'] = $this->plain_text_id;
			}
			// Ok, now we save
			if ($this->Paste->save($this->data)) {
				$this->Session->setFlash('<strong>' . __('Notice', true) . '</strong><br />' . __('Your paste has been saved.', true), 'default', array('sev'=>'notice'));
					$this->redirect(array('controller'=>'pastes', 'action'=>'view', $this->Paste->getLastInsertID()), null, true);
			} else {
				$this->Session->setFlash('<strong>' . __('Error', true) . '</strong><br />' . __('The paste could not be saved.', true) . '<br />' .  __('Please check all fields required are entered.', true) . '<br />' . __('Please, try again.', true), 'default', array('sev'=>'error'));
			}
		}
		
		// Check to see if the authors name is set in the passed arguments
		if (isset($this->passedArgs['author'])) {
			$this->set('name', $this->passedArgs['author']);
		// Else check if the Session has the authors name
		} else if ($this->Session->read('author_name')) {
			$this->set('name', $this->Session->read('author_name'));
		// Ok, no name set, so we make it Anonymous
		} else {
			$this->set('name', 'Anonymous');
		}
		
		// Lets check if the user has set to remember the session name
		if ($this->Session->read('remember_me')) {
			$this->set('remember_me', 1);
		} else {
			$this->set('remember_me', 0);
		}
		
		// Check to see if the user has sent the language in the passed arguments
		if(isset($this->passedArgs['lang'])) {
			$find = $this->Paste->Language->find(array('Language.class'=>$this->passedArgs['lang']), 'Language.language');
			$ol = $find['Language']['language'];
		// Define the default language as Plain Text if no language is set
		} else {
			$ol = null;
		}
		// Now pass the overide language
		$this->set('overide_lang', $ol);

		// Generate a list of languages
		//$this->set('languages', $this->Paste->Language->generateList(null,array('Language.weight'=>'DESC', 'Language.language'=>'ASC'),null,'{n}.Language.id','{n}.Language.dropdown'));
		// Set Expiry types
		$this->set('expiry_types',$this->expiry_types);
		// Purge all old pastes
		$this->Paste->_purge();
	}
}
?>
