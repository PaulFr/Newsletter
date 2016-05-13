<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 19/11/2015
 * Time: 16:02
 */ 

class Liste extends AppModel{

	public $table = 'lists';
	public $validateRules = array(
			'create' => array(
				'name' => array(
					'rule' => '^([a-zA-Z0-9-_\.]{2,})$',
					'message' => 'Le nom de la liste doit contenir au moins 2 caractères.',
				),
				'description' => array(
					'rule' => '^([a-zA-Z0-9-_\.]{2,})$',
					'message' => 'La description doit contenir au moins 2 caractères.',
				),
			),
		);

}