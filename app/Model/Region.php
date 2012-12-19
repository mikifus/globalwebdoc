<?php
class Region extends AppModel {
	public $name = 'Region';
	public $hasAndBelongsToMany = array('Documentary');
}
