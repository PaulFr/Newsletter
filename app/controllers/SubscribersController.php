<?php

class SubscribersController extends AppController{

    public $requiredModels = array('User', 'Subscriber');
    public $requiredPlugins = array('Session');

    public function create($id=0){
    	$id = (int) $id;
    	if($id > 0){
			$subscriber = $this->Subscriber->findFirst(array(
				'fields' => '*',
				'conditions' => array('Subscriber.id' => $id),                                                                                                               
			));
			if(!$subscriber){ 
				Core::throwError(404); 
			}
			$this->Subscriber->prefill($id);
		}

        if(isset($this->request->datas['Subscriber'])){
			$this->Subscriber->validate($this->request->datas['Subscriber'], 'create');
			if(empty($this->Subscriber->validateErrors['create'])){
				
					$datas = array(
						'lastname' => $this->request->datas['Subscriber']['lastname'],
						'firstname' => $this->request->datas['Subscriber']['firstname'],
						'email' => $this->request->datas['Subscriber']['email'],
						'created' => date("Y-m-d H:i:s",time()),
					);

					if(isset($this->request->datas['Subscriber']['id'])){
						$datas['id'] = $this->request->datas['Subscriber']['id'];
					}

					$this->Subscriber->save($datas);
					$this->Session->setFlash('L\'abonné a bien été '.(($id > 0) ? 'edité' : 'créé').'.', 'success');
					$this->response->redirect('subscribers');
				
				}
			}
			$this->view->bind(array('id' => $id));
		}

		public function view($id){
			$this->view->setLayout('campaign');

			$v['Subscriber'] = $this->Subscriber->findFirst(array(
				'fields' => 'Subscriber.content, Subscriber.title',
				'conditions' => array('Subscriber.id' => $id),                                                                                                               
			));
			if(!$v['Subscriber']){ 
				Core::throwError(404); 
			}

			$this->view->setTitle($v['Subscriber']->title);
			$this->view->bind($v);
		}

		public function delete($id){
			$subscriber = $this->Subscriber->findFirst(array(
				'fields' => 'Subscriber.id',
				'conditions' => array('Subscriber.id' => $id),                                                                                                               
			));
			if(!$subscriber){
				Core::throwError(404);
			}

			$this->Subscriber->delete($id);

			$this->Session->setFlash('L\'abonné a bien été supprimé.', 'success');
			$this->response->redirect('subscribers');
		}



		public function index($page=1){
			if($page < 1) $page = 1;
			$articlesPerPage = 10;
			$nbArticles = $this->Subscriber->findCount();

			$nbPages = ceil($nbArticles/$articlesPerPage);
			if($page > $nbPages) $page = $nbPages;
			$startAt = ($page-1)*$articlesPerPage;

			$this->view->bind(array(
				'currentPage' => $page,
				'nbPages' => $nbPages,
			));

			$v['req'] = $this->Subscriber->find(array(
				'fields' => 'Subscriber.id, Subscriber.lastname, Subscriber.firstname, DATE_FORMAT(Subscriber.created, \'%d/%m/%Y\') as created, Subscriber.email',
				'order' => 'Subscriber.created DESC',
				'limit' => $startAt.','.$articlesPerPage,
			));
		
			$this->view->bind($v);
		}

		public function csv(){
			if (isset($_FILES['importList']) && !empty($_FILES['importList'])){
				if(is_uploaded_file($_FILES['importList']['tmp_name'])){
					$handle = fopen($_FILES['importList']['tmp_name'], "r");
					$nbNewSub=0;
					$nbFailSub=0;
					while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
						$prenom = $data[0];
						$nom = $data[1];
						$mail = $data[2];
						
						$newSub = array(
							'lastname' => $nom,
							'firstname' => $prenom,
							'email' => $mail,
							'created' => date("Y-m-d H:i:s", time())
							);
						if($this->Subscriber->save($newSub))
							$nbNewSub++;
						else $nbFailSub++;
					}
							$this->Session->setFlash($nbNewSub.' nouveaux abonnés ajoutés'.($nbFailSub>0 ? ' et '.$nbFailSub.' doublons détectées' : ''),'success');
							$this->response->redirect('subscribers');
				}
				else{
					$this->Session->setFlash('Impossible d\'importer le fichier csv','error');
					$this->response->redirect('subscribers');
				}
			}
			else{
					$this->Session->setFlash('Veuillez selectionner un fichier csv','error');
					$this->response->redirect('subscribers');
				}
		}


  }


?>