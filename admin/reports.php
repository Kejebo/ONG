<?php

    require_once('ui/ui_reports.php');

    $ui= new ui_reports();
    $ui->check_access("reports.php");
    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();

?>