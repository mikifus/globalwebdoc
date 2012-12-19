<?php
class UsersController extends AppController {
	public $helpers = array('Form');
	var $name = 'Users';
	var $scaffold = 'admin';

    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array('admin_login'/*,'logout'*/));
    }
	public function admin_login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}
}