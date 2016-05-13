<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 19/11/2015
 * Time: 16:04
 */ 


class Newsletter extends AppModel{

    public $validateRules = array(
        'create' => array(
            'title' => array(
                'rule' => 'notEmpty',
                'message' => 'Le titre ne doit pas être vide.',
            ),
           
           'content' => array(
                'rule' => 'notEmpty',
                'message' => 'Le contenu ne doit pas être vide.',
            ),

        ),
    );

}

?>