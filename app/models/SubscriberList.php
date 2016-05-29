<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 19/11/2015
 * Time: 16:03
 */ 

class SubscriberList extends AppModel{

	public function  __construct(){
		parent::__construct();
		$this->primaryKey = 'list_id';
		$this->noPrimary = true;
	}

}