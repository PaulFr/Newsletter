<?php

class SubscribersListsController extends AppController{

    public $requiredModels = array('User', 'SubscriberList', 'Liste');
    public $requiredPlugins = array('Session');

    public function create($id=0){
    	$id = (int) $id;
    	if($id > 0){
			$subscriberList = $this->SubscriberList->find(array(
				'fields' => '*',
				'group' => 'Subscriber.id',
				'join' => array(
					'lists as List' => 'SubscriberList.list_id = List.id',
					'subscribers as Subscriber' => 'SubscriberList.subscriber_id = Subscriber.id'
				),
				'conditions' => array('SubscriberList.list_id' => $id),                                                                                                               
			));
			if(!$subscriberList){ 
				Core::throwError(404); 
			}
			$this->SubscriberList->prefill($id);
		}

        if(isset($this->request->datas['subscriberList'])){
			$this->SubscriberList->validate($this->request->datas['SubscriberList'], 'create');
			if(empty($this->SubscriberList->validateErrors['create'])){
				
					$datas = array(
						'name' => $this->request->datas['SubscriberList'][0]['name'],
						'description' => $this->request->datas['SubscriberList'][0]['description'],
					);

					if(isset($this->request->datas['SubscriberList']['id'])){
						$datas['id'] = $this->request->datas['SubscriberList']['id'];
					}

					$this->SubscriberList->save($datas);
					$this->Session->setFlash('La liste a bien été '.(($id > 0) ? 'editée' : 'créée').'.', 'success');
					$this->response->redirect('SubscriberList');
				
				}
			}
			$this->view->bind(array('id' => $id));
		}

		public function view($id){
			$this->view->setLayout('campaign');

			$v['SubscriberList'] = $this->SubscriberList->findFirst(array(
				'fields' => 'List.name, List.description, Subscriber.email',
				'join' => array(
					'lists as List' => 'SubscriberList.list_id = List.id',
					'subscribers as Subscriber' => 'SubscriberList.list_subscriber = Subscriber.id'
				),
				'conditions' => array('SubscriberList.id' => $id),                                                                                                               
			));
						var_dump($v['SubscriberList']);

			if(!$v['SubscriberList']){ 
				Core::throwError(404); 
			}
			$this->view->setTitle($v['SubscribersLists']->title);
			$this->view->bind($v);
		}

		public function deleteSubscriber($id_list, $id_subscriber){
			$subscriberList = $this->SubscriberList->findFirst(array(
				'fields' => 'SubscriberList.subscriber_id',
				'conditions' => array(
					'SubscriberList.subscriber_id' => $id_subscriber,
					'SubscriberList.list_id' => $id_list
					),                                                                                                               
			));
			if(!$subscriberList){
				Core::throwError(404);
			}

			$this->SubscriberList->delete($id);

			$this->Session->setFlash('L\'abonné a bien été supprimé.', 'success');
			$this->response->redirect('SubscribersLists');
		}

		public function deleteList($id){
			$subscriberList = $this->SubscriberList->findFirst(array(
				'fields' => 'List.id',
				'join' => array(
					'lists as List' => 'SubscriberList.list_id = List.id',
				),
				'conditions' => array('SubscriberList.list_id' => $id),                                                                                                               
			));
			if(!$subscriberList){
				Core::throwError(404);
			}
			$this->SubscriberList->delete($id);
			$this->Session->setFlash('La liste a bien été supprimé.', 'success');
			$this->response->redirect('SubscribersLists');
		}


		public function index($page=1){
			if($page < 1) $page = 1;
			$articlesPerPage = 10;
			$nbArticles = $this->SubscriberList->findCount();
			$nbPages = ceil($nbArticles/$articlesPerPage);
			if($page > $nbPages) $page = $nbPages;
			$startAt = ($page-1)*$articlesPerPage;

			$this->view->bind(array(
				'currentPage' => $page,
				'nbPages' => $nbPages,
			));

			$v['req'] = $this->SubscriberList->find(array(
				'fields' => 'SubscriberList.list_id, COUNT(SubscriberList.subscriber_id) as count, List.name, List.description',
				'order' => 'List.name',
				'group' => 'SubscriberList.list_id',
				'join' => array(
					'lists as List' => 'SubscriberList.list_id = List.id',
				),
				'limit' => $startAt.','.$articlesPerPage,
			));
			var_dump($this->SubscriberList);
			$this->view->bind($v);
		}

  }


?>