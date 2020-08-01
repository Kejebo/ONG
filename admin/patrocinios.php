<?php
    
    require_once('ui/ui_patrocinador.php');
    $ui= new ui_patrocinador();
    $ui->check_access("patrocinio.php");

    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();

?>