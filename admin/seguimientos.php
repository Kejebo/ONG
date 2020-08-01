<?php

    require_once('ui/ui_seguimientos.php');
    $ui= new ui_seguimientos();
    $ui->check_access("seguimientos.php");

    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();

?>