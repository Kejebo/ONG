<?php

    require_once('ui/ui_eventos.php');
    $ui= new ui_eventos();
    $ui->check_access("eventos.php");
    $ui->ln->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();

?>