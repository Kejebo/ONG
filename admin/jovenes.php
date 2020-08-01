<?php
    require_once('ui/ui_jovenes.php');
    $ui= new ui_jovenes();
    $ui->check_access("jovenens.php");

    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();
?>