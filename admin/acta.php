<?php

    require_once('ui/ui_acta.php');
    $ui= new ui_acta();
    $ui->controller();

    $ui->check_access("actas.php");

    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();
?>