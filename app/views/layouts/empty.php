<html>
<header>
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

	<title><?= $this->titleForLayout; ?></title>
</header>
<body style="background-color:white;">
	<div id="content" style="margin:0;width:100%">
		<?= $this->contentForLayout; ?>
	</div>
</body>
</html>