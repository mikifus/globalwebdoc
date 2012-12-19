<?php
class DocumentariesController extends AppController {
    var $scaffold = 'admin';
    var $components = array('Upload');
    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'id' => 'desc'
        ),
// 		'fields'=>array(
// 			'Documentary.id',
// 			'Documentary.name',
// 			'Documentary.director'),
        'contain' => array('AvailableLanguage'),
		'paramType' => 'querystring'
    );

    public function getMapList($id=0){
		if($id){
			$docus = $this->Documentary->findById($id);
		}else{
			$docus = $this->Documentary->find('all');
		}
		$this->layout = 'blank';
		$this->set('list',json_encode($docus));
    }

    public function index(){
		$d_list = $this->paginate();
		$this->set('documentary_list',$d_list);
    }

    public function view($id,$lang=0){
		$docus = $this->Documentary->findById($id);
		$video_set = false;
		$first_video = false;
		foreach($docus['Video'] as $video){
// 			foreach($video as $v){
				$first_video = $video;
				if($video['available_language_id']==$lang){
					$this->set('video_data',$video);
					$video_set = true;
				}
// 			}
		}
		if(!$video_set && !empty($first_video)){
			$this->set('video_data',$first_video);
		}
		$this->set('Documentary',$docus);
    }

    function admin_add(){
		//lang
		$this->AvailableLanguage = ClassRegistry::init('AvailableLanguage');
		$language_list = $this->AvailableLanguage->find('list');
		$this->set('availableLanguages',$language_list);
		//region
		$this->Region = ClassRegistry::init('Region');
		$region_list = $this->Region->find('list');
		$this->set('regions',$region_list);
		//Topic
		$this->Topic = ClassRegistry::init('Topic');
		$topic_list = $this->Topic->find('list');
		$this->set('topics',$topic_list);

		// Video
		$this->Video = ClassRegistry::init('Video');
		
		if(!empty($this->request->data['Documentary'])) {
			$new = $this->Documentary->id?false:true;
			$error = "";
			foreach($this->request->data['Documentary'] as $i => $v){
				if((empty($v) && $v!=='0')){ // ### Voucher exception
					$error = "Field $i is not valid";
					break;
				}
			}
			if($error) $this->Session->setFlash($error);
			else{
				if(!empty($this->request->data['Documentary']['tags'])){
					$tag_list = explode(",",$this->request->data['Documentary']['tags']);
					$tags = array();
					foreach($tag_list as $tag){
						$tags[] = trim(/*str_replace(' ','',*/$tag/*)*/);
					}
					$this->request->data['Documentary']['tags'] = implode(',',$tags);
				}
				$this->Documentary->save($this->request->data);
				if(!empty($this->request->data['Documentary']['embed_html'])){
					$html = $this->request->data['Documentary']['embed_html'];
					$video_list = $this->Video->find('first',array('conditions'=>array(
						'documentary_id'=>$this->Documentary->id
					),'order'=>'Video.id'));
					if(!empty($video_list)){
						$video_list['Video']['embed_html'] = $html;
					}else{
						$video_list = array('Video'=>array(
							'documentary_id' => $this->Documentary->id,
							'embed_html' => $html,
							'type' => $this->Video->getVideoTypeFromHtml($html),
							'available_language_id' => $this->Documentary->getFirstLanguage(),
						));
					}
					$this->Video->save($video_list);
				}
				$this->redirect(array('action'=>'edit',$this->Documentary->id));
			}
		}
    }
    function admin_edit($id){
		$this->Documentary->id = $id;

		//Image
		$this->Image = ClassRegistry::init('Image');

		// Video
		$this->Video = ClassRegistry::init('Video');

		if(!empty($this->request->data['Image'])){
			$data = pathinfo($this->request->data['Image']['filename']['name']);
			if(empty($data['extension'])){

			}else{
				$filename = md5(mt_rand()).'_'.md5(time()).'.'.$data['extension'];
				$up_file = $this->Upload->uploadFile(
					array(
						'filepath' => WEBROOT_DIR,
							//USE THIS PATH FOR LOCALHOST | CHANGE TO RELATIVE PATH WHEN APP GOES LIVE
						'directory' => 'img'.DS.'documentaries',
							//INIT THIS INDEX IF YOU WOULD LIKE TO CREATE A NEW FOLDER FOR EACH LOGGED IN USER | WILL CREATE DIRECTORY C:\wamp\www\myApp\webroot\1\
						'tmp_filename' => $this->request->data['Image']['filename']['tmp_name'],
							//MODEL[Image] | FORM FIELD NAME['filename'] | DO NOT CHANGE['tmp_name']
						'target_filename' => $filename
							//MODEL[Image] | FORM FIELD NAME['filename'] | DO NOT CHANGE['name']
						)
				);
				if($up_file == 'true'){
					$data = $this->request->data;
					$data['Image']['filename'] = $filename;
					$data['Image']['documentary_id'] = $this->Documentary->id;
					$this->Image->save($data);
				}
			}
		}
		$this->admin_add();

		$this->request->data = $this->Documentary->read();

		$video_list = $this->Video->find('first',array('conditions'=>array(
			'documentary_id'=>$this->Documentary->id
		),'order'=>'Video.id'));
		$this->request->data['Documentary']['embed_html'] = $video_list['Video']['embed_html'];
		
		$images = $this->Image->findAllByDocumentaryId($this->Documentary->id);
		if(empty($images)) $images= array();
		$this->set('images',$images);
		
		$this->render('admin_add');
    }
}