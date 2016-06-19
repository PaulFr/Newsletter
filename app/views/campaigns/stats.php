<div class="bloc" style="margin-top:0">
    <div class="title">
        Rapport d'envoi des emails
    </div>
    <div class="content">
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
</div>

<div class="bloc" style="margin-top:0">
    <div class="title">
        Rapport des liens cliqués
    </div>
    <div class="content">
        <table class="noalt">
            <thead>
            <tr>
                <th colspan="2"><em>Nombre de clic sur les liens</em></th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($links as $link): ?>
                    <tr>
                        <td><h4><?= $link->nbClick ?></h4></td>
                        <td><?= $link->link ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
