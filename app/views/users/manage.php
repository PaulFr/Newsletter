<h1><img src="<?php echo Router::wwwroot('img/icons/cog.png'); ?>" alt=""> Administration</h1>

<div class="bloc">
    <div class="title">Gérer les administrateurs</div>
    <div class="content">

        <div class="left">
            <form action="#" id="search" class="search placeholder">
                <label>Rechercher un administrateur</label>
                <input type="text" value="" name="q" class="text"/>
                <input type="submit" value="rechercher" class="submit"/>
            </form>
        </div>
        <div class="left">
            <a href="<?php echo Router::url('users/create'); ?>" alt="" title="Ajouter un nouvel administrateur"><img src="<?php echo Router::wwwroot('img/icons/glyph-add.png'); ?>" style="padding:5px;"></a>
        </div>
        <div class="clear"></div>
        <br/>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Créé le</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($req as $k => $v): ?>
                <tr id="user-<?= $v->id ?>">
                    <td><?= $v->lastname ?></td>
                    <td><?= $v->firstname ?></td>
                    <td><?= $v->email ?></td>
                    <td><?= $v->created ?></td>
                    <td class="actions">
                    <?php if($v->id == $userLogged): ?>
                    <a href="<?php echo Router::url('users/delete/'.$v->id); ?>" onclick="return confirm('Toute suppression est définitive, êtes-vous sur ?');" class="delete-campagne" title="Supprimer mon compte"><img src="<?php echo Router::wwwroot('img/icons/actions/delete.png'); ?>" alt="" /></a></td>
                    <?php endif ?>
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