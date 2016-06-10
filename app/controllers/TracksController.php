<?php

class TracksController extends AppController{

    public $requiredModels = array('Subscriber', 'Track', 'Newsletter');

   
		public function link($url, $nid, $sid){
			$url = base64_decode($url);
			$data = array(
				'type' => 'link',
				'data' => $url,
				'newsletter_id' => $nid,
				'subscriber_id' => $sid
			);
			$this->Track->save($data);

			
			$this->response->redirect($url);
		}

		public function open($nid, $sid){
			$data = array(
				'type' => 'open',
				'data' => 1,
				'newsletter_id' => $nid,
				'subscriber_id' => $sid
			);
			$this->Track->save($data);
			
			header ('Content-Type: image/png');
			readfile(WWWROOT.'/img/transp.png');
			exit;
		}

  }


?>