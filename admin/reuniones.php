<?php

    require_once('ui/ui_reuniones.php');
    $ui= new ui_reunion();
    $ui->check_access("reunion.php");

    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();

?>