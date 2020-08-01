<?php
require_once('ui/ui_preguntas.php');
$config = array(
	'titulo'	=> 'Preguntas',
	'url'		=> 'preguntas.php',
);

$ui = new GUI($config);

$ui->get_header();
$ui->get_footer();
?>
	