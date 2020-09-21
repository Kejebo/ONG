<?php

    require_once('ui/ui_admin.php');

    $ui= new ui_admin();
    $ui->check_access("admin.php");
    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();

?>