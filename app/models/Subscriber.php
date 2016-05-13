<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 19/11/2015
 * Time: 16:02
 */ 

class Subscriber extends AppModel{

	public $validateRules = array(
			'create' => array(
				'firstname' => array(
					'rule' => '^([a-zA-Z0-9-_\.]{2,})$',
					'message' => 'Le prénom doit contenir au moins 2 caractères.',
				),
				'lastname' => array(
					'rule' => '^([a-zA-Z0-9-_\.]{2,})$',
					'message' => 'Le nom doit contenir au moins 2 caractères.',
				),
				'email' => array(
					'rule' => '([a-zA-Z0-9\-\_\.]+)@([a-zA-Z0-9\-\_\.]+)\.([a-zA-Z0-9]{2,5})',
					'message' => 'L\'adresse email n\'est pas valide',
				),
			),
		);

}