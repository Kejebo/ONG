<?php

    require_once('ui/ui_asistencia.php');

    $ui= new ui_asistencia();
    $ui->check_access("asistencia.php");
    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();

?>