<?php
require_once('ui/ui_eventos.php');
$config = array(
	'titulo'	=> 'Eventos',
	'url'		=> 'eventos.php',
);
$ui = new ui_eventos($config);
$ui->get_header();
$ui->build();
$ui->get_footer();
?>
	