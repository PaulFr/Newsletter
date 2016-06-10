<h1><img src="<?php echo Router::wwwroot('img/icons/mail-add.png'); ?>" alt=""> Abonnés</h1>

<div class="bloc">
    <div class="title">Gérer les abonnés à la newsletter</div>
    <div class="content">

        <div class="left">
            <form action="#" id="search" class="search placeholder">
                <label>Rechercher un abonné</label>
                <input type="text" value="" name="q" class="text"/>
                <input type="submit" value="rechercher" class="submit"/>
            </form>
        </div>
        <div class="clear"></div>
        <br/>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($req as $k => $v): ?>
                <tr id="campagne-<?= $v->id ?>">
                    <td><?= $v->lastname ?></td>
                    <td><?= $v->firstname ?></td>
                    <td><?= $v->email ?></td>
                    <td><?= $v->created ?></td>
                    <td class="actions"><a href="<?php echo Router::url('subscribers/create/'.$v->id); ?>" class="edit-campagne" title="Editer l'abonné"><img src="<?php echo Router::wwwroot('img/icons/actions/edit.png'); ?>" alt="" /></a>
                    <a href="<?php echo Router::url('subscribers/delete/'.$v->id); ?>" onclick="return confirm('Toute suppression est définitive, êtes-vous sur ?');" class="delete-campagne" title="Supprimer l'abonné"><img src="<?php echo Router::wwwroot('img/icons/actions/delete.png'); ?>" alt="" /></a></td>
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