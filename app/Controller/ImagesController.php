<?php
/**
/ * More info about this:
/ * https://thoughtwm.com/code/
/ *
/ **/
class ImagesController extends AppController {
    var $name = 'Images';
    public $scaffold = 'admin';
//     var $components = array('Upload');
//     public $helpers = array('Form');
// 
//     public function admin_add(){
// 		if(!empty($this->data[$this->name])){
// 			$data = pathinfo($this->data[$this->name]['filename']['name']);
// 			$filename = md5(mt_rand()).'_'.md5(time()).'.'.$data['extension'];
// 			$up_file = $this->Upload->uploadFile(
// 				array(
// 					'filepath' => WEBROOT_DIR,
// 						//USE THIS PATH FOR LOCALHOST | CHANGE TO RELATIVE PATH WHEN APP GOES LIVE
// 					'directory' => 'img'.DS.'documentaries',
// 						//INIT THIS INDEX IF YOU WOULD LIKE TO CREATE A NEW FOLDER FOR EACH LOGGED IN USER | WILL CREATE DIRECTORY C:\wamp\www\myApp\webroot\1\
// 					'tmp_filename' => $this->data[$this->name]['filename']['tmp_name'],
// 						//MODEL[Image] | FORM FIELD NAME['filename'] | DO NOT CHANGE['tmp_name']
// 					'target_filename' => $filename
// 						//MODEL[Image] | FORM FIELD NAME['filename'] | DO NOT CHANGE['name']
// 					)
// 			);
// 			if($up_file == 'true'){
// 				$data = $this->data;
// 				$data[$this->name]['filename'] = $filename;
// 				$this->{$this->name}->save($data);
// 			}else{
// // 				$this->flash($up_file,true);
// 			}
// 		}
// // 		$this->layout = 'default_cakephp';
// 		$this->Documentary = ClassRegistry::init('Documentary');
// 		$d = $this->Documentary->find('list');
//         $this->set(compact('Documentaries', 'd'));
//     }
}