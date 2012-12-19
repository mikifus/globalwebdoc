<?php
class Video extends AppModel {
	public $name = 'Video';
	public $belongsTo = array('Documentary','AvailableLanguage');

	public function getVideoTypeFromHtml($html){
		return 'youtube';
	}
}
