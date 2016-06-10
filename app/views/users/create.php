<h1><img src="<?php echo Router::wwwroot('img/icons/document-2-add.png'); ?>" alt=""> Liste de diffusion</h1>

<div class="bloc">
    <div class="title">Ajouter un nouvel administrateur</div>
    <div class="content">
		<?php
      $this->controller->loadPlugin('Form');
      $this->controller->Form->create('User',null, 'POST', 'Register');
      $this->controller->Form->separator('<br />');
      $this->controller->Form->addField('lastname', array('label' => 'Nom de l\'administrateur'));
      $this->controller->Form->addField('firstname', array('label' => 'Prénom de l\'administrateur'));
      $this->controller->Form->addField('email', array('label' => 'Email de l\'administrateur'));
      $this->controller->Form->addField('password', array('label' => 'Mot de passe de l\'administrateur','type' => 'password'));
      $this->controller->Form->addField('passwordcheck', array('label' => 'Confirmer le mot de passe','type' => 'password'));
      echo $this->controller->Form->build('Enregistrer');

    ?>


    </div>
</div>