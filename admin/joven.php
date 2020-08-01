<?php

    require_once('ui/ui_joven.php');
    $ui= new ui_joven();
    $ui->check_access("joven.php");

    $ui->controller();
    $ui->get_header();
    $ui->get_barra();
    $ui->get_build();
    $ui->get_scripts();

?>