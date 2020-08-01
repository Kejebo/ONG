<?php
    require_once('ui/ui_galeria.php');
    $ui= new ui_galeria();
    $ui->check_access("galeria.php");

    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();
?>