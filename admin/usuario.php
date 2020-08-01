<?php

    require_once('ui/ui_usuario.php');
    $ui= new ui_usuario();
    $ui->check_access("usuario.php");

    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();
?>