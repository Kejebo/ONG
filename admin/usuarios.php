<?php

    require_once('ui/ui_usuarios.php');
    $ui= new ui_usuarios();
    $ui->check_access("usuarios.php");

    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();
?>