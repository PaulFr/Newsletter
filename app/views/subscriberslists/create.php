<h1><img src="<?php echo Router::wwwroot('img/icons/document-2-add.png'); ?>" alt=""> Liste de diffusion</h1>

<div class="bloc">
    <div class="title"><?= $id > 0 ? 'Modifier' : 'Créer' ?> votre liste de diffusion</div>
    <div class="content">
		
        <form action="" method="POST" id="SubscriberListForm">
        <div class="input medium required"><label for="SubscriberList-name">Nom de la liste : </label> <input name="SubscriberList[name]" id="SubscriberList-name"  type="text" value="<?php echo isset($subscriberList[0]->name) ? $subscriberList[0]->name : ''; ?>" /></div><br />
<div class="input medium required"><label for="SubscriberList-description">Description : </label> <input name="SubscriberList[description]" id="SubscriberList-description"  type="text" value="<?php echo isset($subscriberList[0]->description) ? $subscriberList[0]->description : ''; ?>" /></div><br />
<div class="input textarea right"><label for="SubscriberList-externes">Ajouter d'autres destinataires<span class="info">Séparer les emails par des retours à la ligne</span> : </label> <textarea name="SubscriberList[externes]"  cols="2" rows="5" class="input" id="SubscriberList-externes"></textarea></div><br />
<div class="input medium required"> <input name="SubscriberList[list_id]" id="SubscriberList-list_id"  type="hidden" value="<?php echo isset($subscriberList[0]->list_id) ? $subscriberList[0]->list_id : '0'; ?>" /></div>
       

        <div class="left">
            <label for="nom">Selectionner les abonnés</label>
            <table class="ui compact celled definition table">
              <thead class="full-width">
                <tr>
                  <th><input type="checkbox" class="checkall"></th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>E-mail</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($subscribers as $sub): ?>
                <tr>
                  <td class="collapsing">
                    <div class="ui checkbox">
                      <input type="checkbox" name="SubscriberList[subscribers][<?php echo $sub->client_id; ?>]" tabindex="0" value="1" class="hidden" <?php echo $sub->in_list == 1 ? 'checked' : ''; ?>>
                    </div>
                  </td>
                  <td><?= $sub->lastname; ?></td>
                  <td><?= $sub->firstname; ?></td>
                  <td><?= $sub->email; ?></td>
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>

        </div>

        <div class="clear"></div><br />
        <div class="submit"><input type="submit" value="Envoyer" name="SubscriberList[sended]"></div>
        </form>

        


    </div>
</div>