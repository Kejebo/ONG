<?php

    require_once('ui/ui_junta.php');
    $ui= new ui_junta();
    $ui->check_access("junta.php");

    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();

?>