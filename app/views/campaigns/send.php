<form action="" method="POST" id="SubscriberList">
	<div class="bloc" style="margin:0">
		<div class="title">Selectionner les listes de diffusions</div>
	    <div class="content" style="max-height: 250;overflow-y: scroll;overflow-x: hidden;">
			<table class="ui compact celled definition table">
			  <thead class="full-width">
			    <tr>
			      <th><input type="checkbox" class="checkall"></th>
			      <th>Nom</th>
			      <th>Nombre d'abonnés</th>
			    </tr>
			  </thead>
			  <tbody>
			    <?php foreach ($subscriberList as $list): ?>
			    <tr>
			      <td class="collapsing">
			        <div class="ui checkbox">
			          <input type="checkbox" name="SubscriberList[list][<?= $list->id; ?>]" tabindex="0" value="1" class="hidden">
			        </div>
			      </td>
			      <td><?= $list->name; ?></td>
			      <td><?= $list->nbAbonnes; ?></td>
			    </tr>
			    <?php endforeach ?>
			  </tbody>
			</table>

		</div>
	</div>

	<div class="clear"></div><br />
	<div class="submit" style="margin:20px auto; text-align:center"><input type="submit" value="Envoyer" name="SubscriberList[sended]"></div>
</form>
