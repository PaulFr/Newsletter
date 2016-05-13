<?php

class UsersController extends AppController{

    public $requiredModels = array('User');
    public $requiredPlugins = array('Session');

    public function login(){
        $this->view->setLayout('login');
        if(isset($this->Session->get('User')->firstname))
            $this->response->redirect('dashboard');

        if(isset($this->request->datas['User'])){

            $this->User->validate($this->request->datas['User'], 'Login');
            if(empty($this->User->validateErrors['Login'])){

                $result = $this->User->checkPassword($this->request->datas['User']['email'], $this->request->datas['User']['password']);
                if($result){
                    $this->User->doConnection($result->id);
                    $this->Session->setFlash('Vous êtes maintenant connecté en tant que '.$result->firstname.' '.$result->lastname.'.', 'success');
                    $this->Session->set('User', $result);
                    $this->Session->set('Token', uniqid());
                    $this->response->redirect('dashboard');
                }else{
                    $this->Session->setFlash('La connexion a échoué. Veuillez vérifier les informations que vous avez entré.', 'error');
                }

            }
        }
    }

    public function logout($token){
        if(!isset($this->Session->get('User')->firstname))
            Core::throwError(404);
        $this->Session->setFlash('Vous êtes maintenant déconnecté.');
        $this->Session->delete('User');
        $this->response->redirect('users/login');
    }

    public function register(){
        if(isset($this->request->datas['User'])){
            $this->User->validate($this->request->datas['User'], 'Register');
            if(empty($this->User->validateErrors['Register'])){
                $user = $this->User->register($this->request->datas['User']);
                if(!$user){
                    $this->Session->setFlash('L\'inscription a échoué !');
                }else{
                    $this->Session->set('User', $user);
                    $this->Session->set('Token', uniqid());
                    $this->Session->setFlash('Félicitation '.$user->login.' ! Vous êtes maintenant inscrit !');
                    $this->response->redirect('');
                }
            }
        }
    }


}

?>