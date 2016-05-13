<h1><img src="<?php echo Router::wwwroot('img/icons/users.png'); ?>" alt=""> Abonnés</h1>

            <div class="bloc left ">
                <div class="title">Ajouter un nouvel abonné à la newsletter</div>
                <div class="content">
                    <?php $this->controller->loadPlugin('Form');
                $this->controller->Form->create('Subscriber',null, 'POST', 'create');
                $this->controller->Form->separator('<br />');
                $this->controller->Form->addField('lastname', array('label' => 'Nom'));
                $this->controller->Form->addField('firstname', array('label' => 'Prénom'));
                if($id > 0) $this->controller->Form->addField('id', array('type'=>'hidden'));
                $this->controller->Form->addField('email', array('label' => 'Email'));
                echo $this->controller->Form->build('Ajouter l\'abonné');

                ?>
                </div>
            </div>
            <div class="bloc right ">
                <div class="title">Importer des abonnés à la newsletter</div>
                <div class="content">
                    <form action="<?= Router::url('subscribers/csv') ?>" id="form-import" method="POST" enctype="multipart/form-data">
                        <div class="input required">
                            <label for="importList">Importer un fichier d'abonnés <span class="info">ficher .csv (voir un <a href="<?php echo Router::wwwroot('img/import-exemple.jpg'); ?>." class="zoombox w450 h600" alt="exemple import csv" title="Aperçu d'un exemple de fichier d'import"> exemple ici</a>)</span></label>
                            <input type="file" accept=".csv" style="width:100%" name="importList">
                        </div>
                        
                        <div class="clear"></div><br/>
                        <div class="submit">
                            <input type="submit" value="Importer les abonnés">
                        </div>  
                    </form>
                </div>
            </div>
            