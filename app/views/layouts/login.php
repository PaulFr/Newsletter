<!DOCTYPE html>
<html>
<head>
    <title><?php echo $this->titleForLayout; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="<?php echo Router::wwwroot('css/style.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo Router::wwwroot('js/jwysiwyg/jquery.wysiwyg.old-school.css'); ?>"/>
    <!-- jQuery AND jQueryUI -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo Router::wwwroot('js/min.js'); ?>"></script>
</head>
<body class="wood dark">
<div id="content" class="login">
    <?php
    echo $this->controller->Session->flash();
    echo $this->contentForLayout; ?>
</div>
</body>
</html>