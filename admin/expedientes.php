<?php
    require_once('ui/ui_expedientes.php');
    $ui= new ui_expedientes();
    $ui->check_access("expedientes.php");
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();
?>