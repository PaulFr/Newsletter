<h1><img src="<?php echo Router::wwwroot('img/icons/mail-add.png'); ?>" alt=""> Campagnes</h1>

            <div class="bloc">
                <div class="title">Gérer mes campagnes</div>
                <div class="content">

                    <div class="left">
                        <form action="#" id="search" class="search placeholder">
                            <label>Rechercher une campagne</label>
                            <input type="text" value="" name="q" class="text"/>
                            <input type="submit" value="rechercher" class="submit"/>
                        </form>
                    </div>
                    <div class="clear"></div>
                    <br/>

                    <table>
                        <thead>
                            <tr>
                                <th>Nom de la campagne</th>
                                <th>Auteur</th>
                                <th>Catégories</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  foreach($req as $k => $v): ?>
                            <tr id="campagne-<?= $v->id ?>">
                                <td><a href="<?= Router::url('campaigns/view/'.$v->id); ?>" class="zoombox w650 h750"><?= $v->title ?></a></td>
                                <td><?= $v->firstname.' '.$v->lastname ?></td>
                                <td><a href="<?php echo Router::url('campaigns/index/'.$v->category); ?>"><?= $v->category ?></a></td>
                                <td><?= $v->created ?></td>
                                <td class="actions" style="width:130px">
                                    <a href="<?php echo Router::url('campaigns/stats/').$v->id; ?>" class="zoombox w500 h400" title="Voir les statistiques de la campagne"><img src="/Newsletter/img/icons/chart-bar.png" alt="Envoyer" style="margin-bottom:-4px;width:27px"></a>
                                    <a href="<?php echo Router::url('campaigns/send/').$v->id; ?>" class="zoombox w500 h400" title="Envoyer la campagne"><img src="/Newsletter/img/icons/mail-forward.png" alt="Envoyer" style="margin-bottom:-4px;width:27px"></a>
                                    <a href="<?php echo Router::url('campaigns/create/'.$v->id); ?>" class="edit-campagne" title="Modifier la campagne"><img src="<?php echo Router::wwwroot('img/icons/actions/edit.png'); ?>" alt="" /></a>
                                    <a href="<?php echo Router::url('campaigns/delete/'.$v->id); ?>" onclick="return confirm('Toute suppression est définitive, êtes-vous sur ?');" class="delete-campagne" title="Supprimer la campagne"><img src="<?php echo Router::wwwroot('img/icons/actions/delete.png'); ?>" alt="" /></a></td>
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
                                <a href="<?php echo Router::url('campaigns/index/'.$currentCategory.'/'.($i+1)); ?>"><?php echo $i+1; ?></a>
                            <?php endif ?>
                        <?php endfor; ?>
                            </div>
                </div>
            </div>