<?php
require_once('ui/ui_programas.php');
$config = array(
	'titulo'	=> 'Programas',
	'url'		=> 'programas.php',
);

$ui = new GUI($config);

$ui->get_header();
$ui->get_footer();
?>
	