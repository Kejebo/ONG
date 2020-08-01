<?php

    require_once('ui/ui_inscripcion.php');
    $ui= new ui_inscripcion();
    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();

?>