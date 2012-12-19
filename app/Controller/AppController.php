<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array('Js' => array('Jquery'),'Html', 'Javascript', 'Ajax');
	public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => '/admin',
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
        )
    );

    public function isAuthorized($user = null) {
        // Any registered user can access public functions
//         var_dump($this->request->params);
// 		var_dump($user);
        if (empty($user) && empty($this -> request -> params['admin'])) {
            return true;
        }

        // Only admins can access admin functions
        if (isset($this -> request -> params['admin'])) {
            return (bool) ($user['role'] === 'admin');
        }

        // Default deny
        return false;
    }

    public function beforeFilter() {
//         $this -> Auth -> authorize = array('Controller');
        $this->Auth->allow();
    }

//     function beforeRender() {
// 		debug($this); die;
//         $user = $this -> User -> getSessionInfo($this -> Auth -> user('id'));
//         $this -> set('user', $user);

//         $title = $this -> Setting -> getValue('webpage_title');
//         if (!$title)
//             $title = "Social and Loyal";
//         $this -> set('cakeDescription', $title);
// 
//         $value = $this -> Setting -> getValue('header_image');
//         if ($value)
//             $this -> set('header_image_for_layout', $value);
//     }
}
