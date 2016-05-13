<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 19/11/2015
 * Time: 16:01
 */


class User extends AppModel{

    public $validateRules = array(
        'Login' => array(
            'email' => array(

                'rule' => '([a-zA-Z0-9\-\_\.]+)@([a-zA-Z0-9\-\_]+)\.([a-zA-Z0-9]{2,4})',
                'message' => 'Votre adresse email n\'est pas valable',

            ),
            'password' => array(
                'rule' => '^.{4,}$',
                'message' => 'Votre mot de passe doit être composé d\'au moins 4 caractères.',
            ),
        ),
        'Register' => array(
            'firstname' => array(
                'rule' => '^([a-zA-Z0-9-_]{2,})$',
                'message' => 'Votre prénom doit contenir au minimum 2 caractères.',
            ),
            'lastname' => array(
                'rule' => '^([a-zA-Z0-9-_]{2,})$',
                'message' => 'Votre nom doit contenir au minimum 2 caractères.',
            ),
            'password' => array(
                'rule' => '^.{4,}$',
                'message' => 'Votre mot de passe doit être composé d\'au moins 4 caractères',
            ),
            'passwordcheck' => array(
                'rule' => 'same',
                'message' => 'Le mot de passe n\'est pas identique au premier',
                'relation' => 'password',
            ),
            'email' => array(

                'rule' => '([a-zA-Z0-9\-\_\.]+)@([a-zA-Z0-9\-\_]+)\.([a-zA-Z0-9]{2,4})',
                'message' => 'Votre adresse email n\'est pas valable',

            ),

        ),
    );

    public function checkPassword($email, $password){
        $user = $this->findFirst(array(
            'fields' => 'User.firstname, User.lastname, User.password, User.id, User.group_id',
            'conditions' => array('User.email' => $email),
        ));

        if(!empty($user)){
            if(sha1($password) == $user->password){
                return $user;
            }else{
                $this->validateErrors['password'] = 'Le mot de passe ne semble pas être correct.';
            }
        }else{
            $this->validateErrors['email'] = 'Le compte ne semble pas exister.';
        }
        return false;
    }

    public function doConnection($user_id){
        $datas = array(
            'id'      => $user_id,
            'visited' => date("Y-m-d H:i:s",time()),
            'ip'      => $_SERVER['REMOTE_ADDR'],
        );

        $this->save($datas);
    }

    public function register($datas){
        $check = $this->checkSingle(array(
            'email' => $datas['email'],
        ), 'Register');
        if(empty($check)){
            $userDatas = array(
                'lastname'    => $datas['lastname'],
                'firstname'    => $datas['firstname'],
                'password' => sha1($datas['password']),
                'email'    => $datas['email'],
                'created'  => date("Y-m-d H:i:s",time()),
                'visited'  => date("Y-m-d H:i:s",time()),
                'ip'       => $_SERVER['REMOTE_ADDR'],
                'group_id' => 1,
            );
            $this->save($userDatas);
            $user = $this->findFirst(array(
                'fields' => 'User.firstname, User.lastname, User.password, User.id, User.group_id',
                'conditions' => array('User.id' => $this->id),
            ));
            return $user;
        }
        return false;
    }

}

?>