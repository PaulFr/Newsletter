<?php
$endedAt = microtime(true);
define('GENERATION_TIME', round($endedAt-$startedAt, 7));			#Define the page generation time.

ob_end_flush();

echo 'Execution : '.GENERATION_TIME;