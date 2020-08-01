<?php

    require_once('ui/ui_seguimiento.php');
    $ui= new ui_seguimiento();
    $ui->check_access("seguimiento.php");

    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();

?>