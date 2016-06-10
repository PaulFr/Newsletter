<?php

class DashboardController extends AppController{
	
	public $requiredPlugins = array('Session');
	public $requiredModels = array('Track', 'Subscriber', 'Liste', 'Newsletter');
	
	public function index(){

		$nbSending = $this->Track->findCount(array(
			'type' => 'send',
			'data' => 0
		));

		$nbSent = $this->Track->findCount(array(
			'type' => 'send',
			'data' => 1
		));

		$nbFailed = $this->Track->findCount(array(
			'type' => 'send',
			'data' => 2
		));

		$nbOpened = $this->Track->findCount(array(
			'type' => 'open',
		));

		$nbClicked = $this->Track->findCount(array(
			'type' => 'link',
		));

		$nbSubs = $this->Subscriber->findCount();
		$nbLists = $this->Liste->findCount();
		$nbCampaigns = $this->Newsletter->findCount();

		$counts = array(
			'nbSending' => $nbSending,
			'nbSent' => $nbSent,
			'nbFailed' => $nbFailed,
			'nbOpened' => $nbOpened,
			'nbClicked' => $nbClicked,
			'nbSubs' => $nbSubs,
			'nbLists' => $nbLists,
			'nbCampaigns' => $nbCampaigns,
		);

		$this->view->bind($counts);

	}

}

?>