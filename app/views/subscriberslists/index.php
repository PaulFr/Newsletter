<h1><img src="<?php echo Router::wwwroot('img/icons/mail-add.png'); ?>" alt=""> Abonnés</h1>

<div class="bloc">
    <div class="title">Gérer les listes d'abonnés</div>
    <div class="content">

        <div class="left">
            <form action="#" id="search" class="search placeholder">
                <label>Rechercher une liste</label>
                <input type="text" value="" name="q" class="text"/>
                <input type="submit" value="rechercher" class="submit"/>
            </form>
        </div>
        <div class="clear"></div>
        <br/>

        <table>
            <thead>
                <tr>
                    <th>Nom de la liste</th>
                    <th>Nombre d'abonnés</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($req as $k => $v): ?>
                <tr id="list-<?= $v->list_id ?>">
                    <td><a href="<?= Router::url('subscribersLists/view/'.$v->list_id); ?>"><?= $v->name ?></a></td>
                    <td><?= $v->count ?></td>
                    <td><?= $v->description ?></td>
                    <td class="actions"><a href="<?php echo Router::url('subscribersLists/create/'.$v->list_id); ?>" class="edit-campagne" title="Modifier la liste"><img src="<?php echo Router::wwwroot('img/icons/actions/edit.png'); ?>" alt="" /></a>
                    <a href="<?php echo Router::url('subscribersLists/deleteList/'.$v->list_id); ?>" onclick="return confirm('Toute suppression est définitive, êtes-vous sur ?');" class="delete-campagne" title="Supprimer la liste"><img src="<?php echo Router::wwwroot('img/icons/actions/delete.png'); ?>" alt="" /></a></td>
                </tr>
            <?php  endforeach; ?>
                
            </tbody>
        </table>
        <br/>

        <div class="pagination">
            <?php for($i=0; $i < $nbPages; $i++): ?>
                <?php if ($currentPage == $i+1): ?>
                    <a href="" class="current"><?php echo $i+1; ?></a>
                <?php else: ?>
                    <a href="<?php echo Router::url('subscribers/index/'.($i+1)); ?>"><?php echo $i+1; ?></a>
                <?php endif ?>
            <?php endfor; ?>
                </div>
    </div>
</div>