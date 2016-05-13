<h1><img src="<?php echo Router::wwwroot('img/icons/mail-add.png'); ?>" alt=""> Campagnes</h1>

            <div class="bloc">
                <div class="title"><?= $id > 0 ? 'Modifier' : 'Créer' ?> votre campagne de newsletter</div>
                <div class="content">
                    <!--<form action="#" id="form" method="GET">
                        <div class="input medium required">
                            <label for="nom-campagne">Nom de la campagne</label>
                            
                            <input type="text" name="nom-campagne">
                        </div>
                        <div class="input medium required">
                            <label for="objet">Objet du mail</label>
                            <input type="text" name="objet">
                        </div>
                        <div class="input required">
                            <label for="nom">Votre nom</label>
                            <input type="text" name="nom">
                        </div>
                        <div class="input medium required">
                            <label for="email">Votre email</label>
                            <input type="text" name="email">
                        </div>
                        <div class="input medium required">
                            <label for="select">Catégorie de la campagne</label>
                            <select name="select" id="select">
                                <option disabled selected>Selectionner une catégorie</option>
                                <option value="1">Message urgent</option>
                                <option value="2">Publicité</option>
                                <option value="3">autre...</option>
                            </select>
                        </div>
                        <div class="clear"></div><br/>
                        <div class="input textarea">
                            <label for="textarea2">Rédiger votre campagne</label>
                            <textarea name="text" id="textarea2" rows="7" class="wysiwyg" cols="4">
                                Ici <em>vous pouvez</em> avoir du <strong>contenu HTML</strong>
                            </textarea>
                        </div>
                        <div class="submit">
                            <input type="submit" value="Enregistrer la campagne">
                        </div>  
                    </form>-->
                     <?php $this->controller->loadPlugin('Form');
                $this->controller->Form->create('Newsletter',null, 'POST', 'create');
                $this->controller->Form->separator('<br />');
                $this->controller->Form->addField('title', array('label' => 'Nom de la campagne'));
                $this->controller->Form->addField('category', array('label' => 'Catégorie de la campagne'));
                if($id > 0) $this->controller->Form->addField('id', array('type'=>'hidden'));
                $this->controller->Form->addField('content', array('label' => 'Rédigez votre message', 'type' => 'textarea', 'class'=>'wysiwyg', 'value'=>'Votre contenu'));
                echo $this->controller->Form->build('Enregistrer la campagne');

?>
                </div>
            </div>

