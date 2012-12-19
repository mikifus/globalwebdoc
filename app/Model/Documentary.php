<?php
class Documentary extends AppModel {
	public $name = 'Documentary';
	public $hasAndBelongsToMany = array('Region','Topic','AvailableLanguage');
	public $hasMany = array('Video','Image');

	public function getFirstLanguage($id=0){
		if(!$id){
			$id = $this->id;
		}
		$this->AvailableLanguage = ClassRegistry::init('AvailableLanguage');
		$language_list = $this->AvailableLanguage->find('first',array(
			'contain'=>array('Documentary'=>array(
				'conditions'=>array('id'=>$id))
			)
		));
		return $language_list['AvailableLanguage']/*[0]*/['id'];
	}
}