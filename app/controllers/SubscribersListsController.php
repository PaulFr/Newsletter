<?php

class SubscribersListsController extends AppController{

	public $requiredModels = array('User', 'SubscriberList', 'Subscriber', 'Liste');
	public $requiredPlugins = array('Session');

	public function create($id=0){
		$id = (int) $id;
		$subscribers = array();
		$subscriberList = array();

		if($id > 0){

			$subscribers = $this->Subscriber->find(array(
				'fields' => '*, Subscriber.id as client_id, (SELECT 1 FROM subscriber_lists SL WHERE SL.list_id='.$id.' AND SL.subscriber_id = Subscriber.id) as in_list ',
				'group' => 'Subscriber.id',
				'join' => array(
					'subscriber_lists as SubscriberList' => 'SubscriberList.subscriber_id = Subscriber.id',
					'lists as List' => 'SubscriberList.list_id = List.id'
					),                                                                                                            
				));
			$subscriberList = $this->Liste->find(array(
				'fields' => 'Liste.id as list_id, Liste.*',
				'group' => 'Liste.id',
				'conditions' => array('Liste.id' => $id),                                                                                                               
				));

			if(!$subscriberList){ 
				Core::throwError(404); 
			}
		}else{
			$subscribers = $this->Subscriber->find(array(
				'fields' => '*, Subscriber.id as client_id, 0 as in_list',
				'group' => 'Subscriber.id',                                                                                                          
				));
		}

		if(isset($this->request->datas['SubscriberList'])){
			$datas = array(
				'name' => $this->request->datas['SubscriberList']['name'],
				'description' => $this->request->datas['SubscriberList']['description'],
				// AJOUTER LES SUBSCRIBERS DE LA TABLE ET DU TEXTAREA
				);

			

			$subslist = $this->addExternalSubscribers($this->request->datas['SubscriberList']['externes']);
			foreach($this->request->datas['SubscriberList']['subscribers'] as $id_sub => $v){
				$subslist[] = $id_sub;
			}


			if(isset($this->request->datas['SubscriberList']['list_id'])){
				$datas['id'] = $this->request->datas['SubscriberList']['list_id'];
			}

			

			$this->Liste->save($datas);
			$this->addSubscribers($subslist, $id > 0 ? $id : $this->Liste->id);

			$this->Session->setFlash('La liste a bien été '.(($id > 0) ? 'editée' : 'créée').'.', 'success');
			$this->response->redirect('SubscribersLists');


		}
		$this->view->bind(array('id' => $id, 'subscriberList' => $subscriberList, 'subscribers' => $subscribers));
	}

	public function addSubscribers($subscribers, $id){
		$this->SubscriberList->Db->query('DELETE FROM subscriber_lists WHERE list_id='.$id);
		foreach($subscribers as $subscriber){
			$insert = $this->SubscriberList->save(array('list_id'=>$id, 'subscriber_id' => $subscriber));
		}
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

		if(!$v['SubscriberList']){ 
			Core::throwError(404); 
		}
		$this->view->setTitle($v['SubscribersLists']->title);
		$this->view->bind($v);
	}

	public function addExternalSubscribers($emails){
		$subscribers = array();
		$emails = explode("\r\n", $emails);
		
		foreach($emails as $email){
			$email = trim($email);
			if(!empty($email)){
				$subscriber = $this->Subscriber->findFirst(array(
					'fields' => 'Subscriber.id',
					'conditions' => array('Subscriber.email' => $email),
				));

				if($subscriber){
					$subscribers[] = $subscriber->id;
				}else{
					$insert = $this->Subscriber->save(array('email' => $email, 'created' => date("Y-m-d H:i:s",time())));
					if($insert) $subscribers[] = (int) $this->Subscriber->id;
				}
			}
		}

		return $subscribers;
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
		$List = $this->Liste->findFirst(array(
			'fields' => 'Liste.id',
			'conditions' => array('Liste.id' => $id),                                                                                                               
			));

		if(!$List){
			Core::throwError(404);
		}
		$this->Liste->delete($id);
		$this->Session->setFlash('La liste a bien été supprimé.', 'success');
		$this->response->redirect('SubscribersLists');
	}


	public function index($page=1){
		if($page < 1) $page = 1;
		$articlesPerPage = 10;
		$nbArticles = $this->Liste->findCount();
		$nbPages = ceil($nbArticles/$articlesPerPage);
		if($nbPages <= 0) $nbPages = 1;
		if($page > $nbPages) $page = $nbPages;
		$startAt = ($page-1)*$articlesPerPage;

		$this->view->bind(array(
			'currentPage' => $page,
			'nbPages' => $nbPages,
			));

		$v['req'] = $this->Liste->find(array(
			'fields' => 'Liste.id as list_id, COUNT(SubscriberList.subscriber_id) as count, Liste.name, Liste.description',
			'order' => 'Liste.name',
			'group' => 'SubscriberList.list_id',
			'join' => array(
				'subscriber_lists as SubscriberList' => 'SubscriberList.list_id = Liste.id',
				),
			'limit' => $startAt.','.$articlesPerPage,
			));
		$this->view->bind($v);
	}

}


?>
