<?php




Router::connect('', 'users/login');
Router::connect('open-:nid-:sid.png', 'tracks/open/nid:([0-9]+)/sid:([0-9]+)');

?>