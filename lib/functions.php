<?php

function debug($var, $dumped=false){

	if(Config::get('DEBUG_MODE')>0){
		$debug = debug_backtrace(); 
		echo '<p>&nbsp;</p><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>'.$debug[0]['file'].' </strong> line '.$debug[0]['line'].'</a></p>'; 
		echo '<ol style="display:none;">'; 
		foreach($debug as $k=>$v){ if($k>0 && isset($v['line'])){
			echo '<li><strong>'.$v['file'].' </strong> line '.$v['line'].'</li>'; 
		}}
		echo '</ol>'; 
		echo !$dumped ? '<pre>'.print_r($var, true).'</pre>' : var_dump($var);
	}
	
}

function previewContent($chaine, $longueur = 120) 
{
 
	if (empty ($chaine)) 
	{ 
		return ""; 
	}
	elseif (strlen ($chaine) < $longueur) 
	{ 
		return $chaine; 
	}
	elseif (preg_match ("/(.{1,$longueur})\s./ms", $chaine, $match)) 
	{ 
		return $match [1] . "..."; 
	}
	else 
	{ 
		return substr ($chaine, 0, $longueur) . "..."; 
	}
}
