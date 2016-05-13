<!DOCTYPE html>
<html>
<head>
    <title><?php echo $this->titleForLayout; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <!-- Main stylesheed  (EDIT THIS ONE) -->
    <link rel="stylesheet" href="<?php echo Router::wwwroot('css/style.css'); ?>" />

    <link rel="stylesheet" href="<?php echo Router::wwwroot('js/jwysiwyg/jquery.wysiwyg.old-school.css'); ?>" />

    <!-- jQuery AND jQueryUI -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>

    <!-- jQuery Cookie - https://github.com/carhartl/jquery-cookie -->
    <script type="text/javascript" src="<?php echo Router::wwwroot('js/cookie/jquery.cookie.js'); ?>"></script>

    <!-- jWysiwyg - https://github.com/akzhan/jwysiwyg/ -->
    <link rel="stylesheet" href="<?php echo Router::wwwroot('js/jwysiwyg/jquery.wysiwyg.old-school.css'); ?>" />
    <script type="text/javascript" src="<?php echo Router::wwwroot('js/jwysiwyg/jquery.wysiwyg.js'); ?>"></script>


    <!-- Tooltipsy - http://tooltipsy.com/ -->
    <script type="text/javascript" src="<?php echo Router::wwwroot('js/tooltipsy.min.js'); ?>"></script>

    <!-- iPhone checkboxes - http://awardwinningfjords.com/2009/06/16/iphone-style-checkboxes.html -->
    <script type="text/javascript" src="<?php echo Router::wwwroot('js/iphone-style-checkboxes.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo Router::wwwroot('js/excanvas.js'); ?>"></script>

    <!-- Load zoombox (lightbox effect) - http://www.grafikart.fr/zoombox -->
    <script type="text/javascript" src="<?php echo Router::wwwroot('js/zoombox/zoombox.js'); ?>"></script>

    <!-- Charts - http://www.filamentgroup.com/lab/update_to_jquery_visualize_accessible_charts_with_html5_from_designing_with/ -->
    <script type="text/javascript" src="<?php echo Router::wwwroot('js/visualize.jQuery.js'); ?>"></script>

    <!-- Uniform - http://uniformjs.com/ -->
    <script type="text/javascript" src="<?php echo Router::wwwroot('js/jquery.uniform.js'); ?>"></script>


    <!-- Main Javascript that do the magic part (EDIT THIS ONE) -->
    <script type="text/javascript" src="<?php echo Router::wwwroot('js/main.js'); ?>"></script>
</head>
<body class="wood dark">

<div id="head">
    <div class="left">
        <a href="#" class="button profile"><img src="<?php echo Router::wwwroot('img/icons/top/huser.png'); ?>" alt="" /></a>
        Bonjour,
        <a href="#"><?= $this->controller->Session->get('User')->firstname.' '.$this->controller->Session->get('User')->lastname; ?></a>
        |
        <a href="<?php echo Router::url('users/logout/'.$this->controller->Session->get('Token')); ?>">Se déconnecter</a>
    </div>
</div>


<!--
        SIDEBAR
                 -->
<div id="sidebar" class="black">
            <ul>
                <li>
                    <a href="<?php echo Router::url(); ?>">
                <img src="<?php echo Router::wwwroot('img/icons/menu/home.png'); ?>" alt="" />
                Tableau de bord
            </a>
                </li>

                <li class="<?= $this->controller->request->controller == 'campaigns' ? 'current' : '' ?>"><a href="#"><img src="<?php echo Router::wwwroot('img/icons/menu/mail.png'); ?>" alt="" /> Campagne</a>
                    <ul>
                        <li><a href="<?php echo Router::url('campaigns'); ?>">Mes campagnes</a></li>
                        <li><a href="<?php echo Router::url('campaigns/create'); ?>">Nouvelle campagne</a></li>
                    </ul>
                </li>
                <li class="<?= $this->controller->request->controller == 'subscribers' ? 'current' : '' ?>"><a href="#"><img src="<?php echo Router::wwwroot('img/icons/menu/users.png'); ?>" alt="" /> Abonnés</a>
                    <ul>
                        <li><a href="<?php echo Router::url('subscribers'); ?>">Les abonnés</a></li>
                        <li><a href="<?php echo Router::url('subscribers/create'); ?>">Ajouter un abonné</a></li>
                    </ul>
                </li>
                <li class="<?= $this->controller->request->controller == 'subscribersLists' ? 'current' : '' ?>"><a href="#"><img src="<?php echo Router::wwwroot('img/icons/menu/list.png'); ?>" alt="" /> Liste de diffusion</a>
                    <ul>
                        <li><a href="<?php echo Router::url('subscribersLists'); ?>">Les listes d'abonnés</a></li>
                        <li><a href="<?php echo Router::url('subscribersLists/create'); ?>">Créer une liste de diffusion</a></li>
                    </ul>
                </li>

                <li class="<?= $this->controller->request->controller == 'users' ? 'current' : '' ?>"><a href="#"><img src="<?php echo Router::wwwroot('img/icons/menu/settings.png'); ?>" alt="" /> Administration</a>
                    <ul>
                        <li><a href="<?php echo Router::url('users/settings'); ?>">Paramètre du compte</a></li>
                        <li><a href="<?php echo Router::url('users/manage'); ?>">Gérer les utilisateurs</a></li>
                    </ul>
                </li>
            </ul>
            <a href="#collapse" id="menucollapse">&#9664; Réduire la sidebar</a>

        </div>




<!--
      CONTENT
                -->
<div id="content" class="black">
    <?php echo $this->controller->Session->flash();
          echo $this->contentForLayout; ?>
</div>

</body>
</html>