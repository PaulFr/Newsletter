<h1><img src="<?= Router::wwwroot('img/icons/lock-closed.png') ?>" alt=""/>Connexion</h1>
<?php

$this->controller->loadPlugin('Form');

$this->controller->Form->create('User',null, 'POST', 'Login');

$this->controller->Form->separator('<br />');

$this->controller->Form->addField('email', array('label' => 'E-Mail'));
$this->controller->Form->addField('password', array('label' => 'Mot de Passe', 'type' => 'password'));

echo $this->controller->Form->build('Connexion !');
?>
