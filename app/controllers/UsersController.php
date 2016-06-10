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

    public function manage($page=1){
        if($page < 1) $page = 1;
        $articlesPerPage = 10;
        $nbArticles = $this->User->findCount();

        $nbPages = ceil($nbArticles/$articlesPerPage);
        if($page > $nbPages) $page = $nbPages;
        $startAt = ($page-1)*$articlesPerPage;

        $this->view->bind(array(
            'currentPage' => $page,
            'nbPages' => $nbPages,
        ));

        $v['req'] = $this->User->find(array(
            'fields' => '*',
            'limit' => $startAt.','.$articlesPerPage,
        ));

        $v['userLogged'] = $this->Session->get('User')->id;
    
        $this->view->bind($v);
    }

    public function delete($id){
        if(!isset($this->Session->get('User')->id))
            Core::throwError(404);
        if($id == $this->Session->get('User')->id){
            $user = $this->Session->get('User');
            $this->User->delete($id);
            $this->Session->setFlash('Votre compte à été supprimer.');
            $this->Session->delete('User');
            $this->response->redirect('users/login');
        }
        else{
            Core::throwError(404);
        }       
    }

    public function create(){
        if(isset($this->request->datas['User'])){
            $this->User->validate($this->request->datas['User'], 'Register');
            if(empty($this->User->validateErrors['Register'])){
                $datas = array(
                    'lastname' => $this->request->datas['User']['lastname'],
                    'firstname' => $this->request->datas['User']['firstname'],
                    'email' => $this->request->datas['User']['email'],
                    'password' => sha1($this->request->datas['User']['password']),
                    'created' => date("Y-m-d H:i:s",time()),
                );

                $this->User->save($datas);
                $this->Session->setFlash('L\'administrateur a bien été créé.', 'success');
                $this->response->redirect('users/manage');
            }
            else{
                $this->Session->setFlash('Les champs ne sont pas correctement remplis.', 'error');
            }
        }
    }

    public function settings(){
        if(null !== ($this->Session->get('User')) ){
            $this->User->prefill($this->Session->get('User')->id);
        }
        else{
            Core::throwError(404);
        }
        if(isset($this->request->datas['User'])){
            $this->User->validate($this->request->datas['User'], 'Register');
            if(empty($this->User->validateErrors['Register'])){
                $datas = array(
                    'id' => $this->Session->get('user')->id,
                    'lastname' => $this->request->datas['User']['lastname'],
                    'firstname' => $this->request->datas['User']['firstname'],
                    'email' => $this->request->datas['User']['email'],
                    'password' => sha1($this->request->datas['User']['password']),
                    'created' => date("Y-m-d H:i:s",time()),
                );

                $this->User->save($datas);
                $this->Session->setFlash('Les modifications ont bien été sauvegardée.', 'success');
                $this->response->redirect('users/settings');
            }
            else{
                $this->Session->setFlash('Les champs ne sont pas correctement remplis.', 'error');
            }
        }
    }
}

?>