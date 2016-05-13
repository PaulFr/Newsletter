<h1><img src="<?php echo Router::wwwroot('img/icons/mail-add.png'); ?>" alt=""> Campagnes</h1>

<div class="bloc">
    <div class="title"><?= $id > 0 ? 'Modifier' : 'Créer' ?> votre campagne de newsletter</div>
    <div class="content">
		<?php 
		$this->controller->loadPlugin('Form');
        $this->controller->Form->create('SubscriberList',null, 'POST', 'create');
        $this->controller->Form->separator('<br />');
        $this->controller->Form->addField('name', array('label' => 'Nom de la liste'));
        $this->controller->Form->addField('description', array('label' => 'Description'));
        if($id > 0) $this->controller->Form->addField('list_id', array('type'=>'hidden'));
        echo $this->controller->Form->build('Envoyer');

        ?>




    </div>
</div>