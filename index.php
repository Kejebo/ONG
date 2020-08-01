<?php
require_once('ui/ui_inicio.php');
$config = array(
	'titulo'	=> 'Inicio',
	'url'		=> 'index.php',
);

$ui = new ui_inicio($config);
$ui->action_controller();

$ui->get_header();
$ui->build();
$ui->get_footer();
?>
	