<?php

class CampaignsController extends AppController{

    public $requiredModels = array('User', 'Newsletter', 'Subscriber', 'SubscriberList', 'Liste', 'Track');
    public $requiredPlugins = array('Session');

    public function create($id=0){
    	$id = (int) $id;
    	if($id > 0){
			$newsletter = $this->Newsletter->findFirst(array(
				'fields' => '*',
				'conditions' => array('Newsletter.id' => $id),                                                                                                               
			));
			if(!$newsletter){ 
				Core::throwError(404); 
			}
			$this->Newsletter->prefill($id);
		}

        if(isset($this->request->datas['Newsletter'])){
			$this->Newsletter->validate($this->request->datas['Newsletter'], 'create');
			if(empty($this->Newsletter->validateErrors['create'])){
				
					$datas = array(
						'title' => $this->request->datas['Newsletter']['title'],
						'category' => $this->request->datas['Newsletter']['category'],
						'content' => $this->request->datas['Newsletter']['content'],
						'created' => date("Y-m-d H:i:s",time()),
					);

					if(isset($this->request->datas['Newsletter']['id'])){
						$datas['id'] = $this->request->datas['Newsletter']['id'];
					}else{
						$datas['users_id'] = $this->Session->get('User')->id;
					}

					$this->Newsletter->save($datas);
					$this->Session->setFlash('Votre newsletter a bien été '.(($id > 0) ? 'editée' : 'créée').'.', 'success');
					$this->response->redirect('campaigns');
				
				}
			}
			$this->view->bind(array('id' => $id));
		}

		public function view($id){
			$this->view->setLayout('campaign');

			$v['newsletter'] = $this->Newsletter->findFirst(array(
				'fields' => 'Newsletter.content, Newsletter.title',
				'conditions' => array('Newsletter.id' => $id),                                                                                                               
			));
			if(!$v['newsletter']){ 
				Core::throwError(404); 
			}

			$this->view->setTitle($v['newsletter']->title);
			$this->view->bind($v);
		}

		public function stats($id){
			$this->view->setLayout('empty');
			$nbSending = $this->Track->findCount(array(
				'type' => 'send',
				'data' => 0,
				'newsletter_id' => $id
			));

			$nbSent = $this->Track->findCount(array(
				'type' => 'send',
				'data' => 1,
				'newsletter_id' => $id
			));

			$nbFailed = $this->Track->findCount(array(
				'type' => 'send',
				'data' => 2,
				'newsletter_id' => $id
			));

			$nbOpened = $this->Track->findCount(array(
				'type' => 'open',
				'newsletter_id' => $id
			));

			$nbClicked = $this->Track->findCount(array(
				'type' => 'link',
				'newsletter_id' => $id
			));

			$links = $this->Track->find(array(
				'fields' => 'Track.data as link, COUNT(Track.id) as nbClick',
				'conditions' => array('Track.newsletter_id' => $id, 'Track.type' => 'link'),
				'group' => 'Track.data',
				'order' => 'nbClick DESC'
			));


			$counts = array(
				'nbSending' => $nbSending,
				'nbSent' => $nbSent,
				'nbFailed' => $nbFailed,
				'nbOpened' => $nbOpened,
				'nbClicked' => $nbClicked,
				'links' => $links
			);

			$this->view->bind($counts);
		}

		public function delete($id){
			$nl = $this->Newsletter->findFirst(array(
				'fields' => 'Newsletter.id',
				'conditions' => array('Newsletter.id' => $id),                                                                                                               
			));
			if(!$nl){
				Core::throwError(404);
			}

			$this->Newsletter->delete($id);

			$this->Session->setFlash('La newsletter a bien été supprimée.', 'success');
			$this->response->redirect('campaigns');
		}



		public function index($category='all', $page=1){
			$conditions = array();
			if($category != 'all')
				$conditions['category'] = $category;
			if($page < 1) $page = 1;
			$articlesPerPage = 10;
			$nbArticles = $this->Newsletter->findCount($conditions);
			if($nbArticles <= 0)
				Core::throwError(404, 'Cette catégorie est inexistante ou vide !');
			$nbPages = ceil($nbArticles/$articlesPerPage);
			if($page > $nbPages) $page = $nbPages;
			$startAt = (intval($page)-1)*$articlesPerPage;
			$this->view->bind(array(
				'currentPage' => $page,
				'nbPages' => $nbPages,
				'currentCategory' => $category,
			));
			$v['req'] = $this->Newsletter->find(array(
				'fields' => 'Newsletter.id, Newsletter.title, Newsletter.category, DATE_FORMAT(Newsletter.created, \'%d/%m/%Y\') as created, User.id as user_id, User.lastname, User.firstname',
				'join' => array(
					'users as User' => 'Newsletter.users_id = User.id',
				),
				'conditions' => $conditions, 
				'group' => 'Newsletter.id',
				'order' => 'Newsletter.created DESC',
				'limit' => $startAt.','.$articlesPerPage,
			));
			$this->view->bind($v);
		}

		public function send($idCampagne=0){
			$idCampagne = (int) $idCampagne;
			$subscriberList = array();

			//Affichage du formulaire d'envoi
			if($idCampagne > 0){
				$subscriberList = $this->Liste->find(array(
				'fields' => 'Liste.*, Count(*) as nbAbonnes',
				'group' => 'Liste.id',  
				'join' => array(
					'subscriber_lists as SubscriberList' => 'SubscriberList.list_id = Liste.id',
				),                                                                                                           
				));
				$this->view->setLayout('empty');
				$this->view->bind(array('id' => $idCampagne, 'subscriberList' => $subscriberList));
			}

			//Gestion de l'envoi
			if(isset($this->request->datas['SubscriberList']['list'])){
				$lists = implode(',', array_keys($this->request->datas['SubscriberList']['list']));
				$subscribers = $this->SubscriberList->find(array(
					'fields' => 'subscriber_id',
					'conditions' => 'list_id IN ('.$lists.')'
				));

				foreach ($subscribers as $subscriber) {
					$this->Track->save(array(
						'type' => 'send',
						'data' => 0,
						'subscriber_id' => $subscriber->subscriber_id,
						'newsletter_id' => $idCampagne
					));
				}
				$this->Session->setFlash('La campagne va être envoyée, cela peut prendre du temps', 'success');
				$this->response->redirect('campaigns/send/'.$idCampagne);


			}

		}


  }


?>