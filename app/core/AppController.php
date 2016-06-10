<?php

class AppController extends Controller_SW{
	public $requiredPlugins = array('Session');
	public function __construct($request, $response){
		parent::__construct($request, $response);
		if($request->controller != 'tracks' && $request->controller != 'users' && $request->controller != 'external' && !isset($this->Session->get('User')->firstname)){
			/*if(!(isset($this->Session->get('User')->rights) && $this->Session->get('User')->rights & Rights::get('ACCESS_ADMIN'))){
				Core::throwError(404);
			}*/
			$this->response->redirect('');
		}
	}
}




            