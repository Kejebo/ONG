<?php
    
    require_once('ui/ui_sedes.php');
    $ui= new ui_sede();
    $ui->check_access("sedes.php");

    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();

?>