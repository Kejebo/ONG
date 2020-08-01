<?php
    
    require_once('ui/ui_nucleo.php');
    $ui= new ui_nucleo();
    $ui->check_access("nucleo.php");

    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();

?>