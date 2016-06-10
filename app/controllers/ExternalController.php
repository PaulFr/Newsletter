<?php

class ExternalController extends AppController{

    public $requiredModels = array('User', 'Subscriber');
    public $requiredPlugins = array('Session');

  

		public function unsub($sid, $token){
			if($token != sha1($sid.'aZs874m@!')) Core::throwError(404);

			$data = array('newsletter' => 0, 'id' => $sid);
			$this->Subscriber->save($data);

			$this->Session->setFlash('Vous avez bien été retiré de la liste d\'inscription.', 'success');
			$this->response->redirect('');
		}


  }


?>