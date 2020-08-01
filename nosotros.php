<?php
require_once('ui/ui_nosotros.php');
$config = array(
	'titulo'	=> 'Nosotros',
	'url'		=> 'nosotros.php',
);
$ui = new ui_nosotros($config);
$ui->get_header();
$ui->build();
$ui->get_footer();
?>
	