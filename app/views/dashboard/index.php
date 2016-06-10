<h1><img src="img/icons/dashboard.png" alt="" /> Dashboard </h1>

<div class="bloc left">
    <div class="title">
        Raccourcis
    </div>
    <div class="content dashboard">
        <div class="center">
            <a href="<?php echo Router::url('subscribers/create'); ?>" class="shortcut">
                <img src="img/icons/users.png" alt="" width="32" height="32" />
                Ajouter des abonnés
            </a>
            <a href="<?php echo Router::url('subscribersLists/create'); ?>" class="shortcut">
                <img src="img/icons/contacts.png" alt="" width="32" height="32" />
                Ajouter une liste de diffusion
            </a>
            <a href="<?php echo Router::url('campaigns/create'); ?>" class="shortcut">
                <img src="img/icons/mail.png" alt="" width="32" height="32"/>
                Ajouter une campagne
            </a>
            <a href="<?php echo Router::url('users/settings'); ?>" class="shortcut last">
                <img src="img/icons/cog.png" alt="" width="32" height="32" />
                Gérer mes paramètres
            </a>
            <div class="cb"></div>
        </div>
    </div>
</div>



<div class="bloc right">
    <div class="title">
        Rapport en temps réel
    </div>
    <div class="content">
        <div class="left">
            <table class="noalt">
                <thead>
                <tr>
                    <th colspan="2"><em>Contenu</em></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><h4><?= $nbSubs ?></h4></td>
                    <td>Abonnés</td>
                </tr>
                <tr>
                    <td><h4><?= $nbLists ?></h4></td>
                    <td>Listes de diffusion</td>
                </tr>
                <tr>
                    <td><h4><?= $nbCampaigns ?></h4></td>
                    <td>Campagnes</td>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="right">
            <table class="noalt">
                <thead>
                <tr>
                    <th colspan="2"><em>Rapport des mails</em></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><h4><?= $nbSent + $nbSending + $nbFailed ?></h4></td>
                    <td>Mails envoyés au total</td>
                </tr>
                <tr>
                    <td><h4><?= $nbSent ?></h4></td>
                    <td class="good">Mails reçus</td>
                </tr>
                <tr>
                    <td><h4><?= $nbSending ?></h4></td>
                    <td class="neutral">Mails en cours d'envoi</td>
                </tr>
                <tr>
                    <td><h4><?= $nbFailed ?></h4></td>
                    <td class="bad">Mails non reçus</td>
                </tr>
                <tr>
                    <td><h4><?= $nbClicked ?></h4></td>
                    <td class="info">Liens cliqués</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="cb"></div>
    </div>
</div>

<div class="cb"></div>

