<?php

    require_once('ui/ui_evento.php');

    $ui= new ui_evento();
    $ui->check_access("evento.php");
    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();

?>