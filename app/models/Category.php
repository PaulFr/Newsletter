<?php

class Category extends AppModel{
	public $validateRules = array(
		'name' => array(
			'rule'    => '([a-zA-Z0-9]+)',
			'message' => 'Le nom est incorrect.',
		),
		'id' => array(    
			'rule'    => '([0-9]+)',
			'message' => 'Le id doit etre numerique.',
		),
	);
}

?>