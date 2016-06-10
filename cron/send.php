<?php
require 'includes.php';

//On prépare notre contrôleur principal pour manipuler les modeles
$controller = new Controller_SW(null, null);
$controller->loadModel('Track');
$controller->loadModel('Newsletter');

$replacements = array();



//On selectionne les 100 prochains mails à envoyer
$toSend = $controller->Track->find(array(
	'fields' => 'Track.id tracker_id, Subscriber.email, Newsletter.title, Newsletter.content, Track.subscriber_id, Track.newsletter_id',
	'join' => array('newsletters Newsletter' => 'Track.newsletter_id = Newsletter.id', 'subscribers Subscriber' => 'Track.subscriber_id = Subscriber.id'),
	'conditions' => array('type' => 'send', 'data' => 0, 'Subscriber.newsletter' => 1),
	'limit' => '0,100'
));

foreach($toSend as $mail){
	$replacements[$mail->email] = array(
    '{sid}'=>$mail->subscriber_id
  );
}

//On utilise un transporteur distant en attendant (mail epsi)
$transport = Swift_SmtpTransport::newInstance('smtp.office365.com', 587, 'tls')
  ->setUsername('paul.frinchaboy@epsi.fr')
  ->setPassword('914QAQ');


$mailer = Swift_Mailer::newInstance($transport);

$decorator = new Swift_Plugins_DecoratorPlugin($replacements);
$mailer->registerPlugin($decorator);

$numSent = 0;
$newsletters = array();
$fails = array();

foreach($toSend as $mail){

	//On formate les liens pour les remplacer par des trackers
	if(empty($newsletters[$mail->newsletter_id])){
		$nl = $mail->content;
		$nl = preg_replace_callback('/((http[s]?:|www[.])[^\s"]*)/i', 
			function($matches) use($mail){
				if(preg_match('#(jpg|jpeg|png|gif|bmp)#',$matches[0])){
					return $matches[0];
				}
				return Router::url('tracks/link/'.base64_encode($matches[0]).'/'.$mail->newsletter_id.'/{sid}');
			}, $nl);
		$newsletters[$mail->newsletter_id] = $nl;
	}

	//On créer le message
	$message = Swift_Message::newInstance($mail->title)
	  ->setFrom(array('paul.frinchaboy@epsi.fr' => 'No-Reply'))
	  ->setTo(array($mail->email))
	  ->setBody($newsletters[$mail->newsletter_id], 'text/html')
	  ;

	 // On l'envoi et on regarde si ça s'est bien passé
	$update = array(
		'data' => 1,
		'id' => $mail->tracker_id
	);
	if($mailer->send($message, $fails)){
		$numSent++;
	}else{
		$update['data'] = 2;
	}
	$controller->Track->save($update);
}




printf("Sent %d messages\nFails : \n", $numSent);
print_r($fails);

include 'end.php';
?>