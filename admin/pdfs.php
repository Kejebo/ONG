<?php

ob_start();

include('ui/ui_pdfs.php');
require_once('db/db_seguimientos.php');
require_once('db/db_evento.php');
require_once('db/db_admin.php');
require_once('db/db_joven.php');
require_once('db/db_usuario.php');
$admin = new db_admin();
$admin = $admin->get_admin()[0];
$joven = new db_joven();
$usuario = new db_usuario();
$db = new db_seguimiento();
$evento = new db_evento();

?>
<style>
    #logo {
        width: 25%;
    }

    #info {
        margin-left: 26%;
        width: 50%;
        text-align: center;
    }

    img {
        max-width: 100px;
    }

    label {
        font-size: 12px;
    }

    table {
        border-collapse: collapse;
        width: 100%;

    }

    th {
        height: 40px;
        font-size: 14px;
        color: white;
        text-transform: uppercase;
        border: black 1px solid;
    }

    thead th {
        height: 40px;
        font-size: 14px;
        color: black;
        text-transform: uppercase;
    }

    tbody td {
        height: 30px;
        font-size: 14px;
        padding: 20px;
        font-family: Arial, Helvetica, sans-serif;
    }

    #titulo h2 {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }

    #datos {
        width: 35%;
        margin-left: 65%;
        text-align: left;
        font-size: 14px;
    }

    #datos label {
        padding: 10px;
    }

    #datos hr {
        height: 4px;
        background-color: lightgray;
        border: none;
    }

    #encabezado tbody td {
        padding: 5px;
        border-top: 0px;
        border-right: 0px;
        border-bottom: 1px solid black;
        border-left: 0px;
    }

    .joven tbody td {
        padding: 5px;
        border-top: 0px;
        border-right: 0px;
        border-bottom: 1px solid black;
        border-left: 0px;
    }

    .datos {
        margin-left: 20px;
    }

    .titulos {
        font-weight: bold;
    }
</style>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <div style="text-align: right;"><small style="font-style: italic;"><?= date("Y/m/d") ?></small></div>
    <table id="encabezado" border="1" cellspacing="0">
        <tbody>
            <tr>
                <td style="width: 25%;"> <img src="assets/861Logo Dale Una Mano.png">
                </td>
                <td style="text-align: center; width:50%">
                    <label style="font-size: 12px; font-weight: bold;"><?= $admin['nombre'] ?></label>
                    <br>
                    <label style="font-style: italic;"><?= $admin['lema'] ?></label>
                    <br>
                    <strong><label><?= $admin['correo'] ?></label></strong>
                    <br>
                    <strong><label><?= $admin['telefono'] ?></label></strong>
                    <br>
                    <label for=""><?= $admin['direccion'] ?></label>
                </td>
                <td style="width: 25%;"></td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>

    <?php
    switch ($_GET['action']) {
        case 'lista-jovenes-evento':
            get_jovenes_evento($evento->get_voluntarios($_GET['id']));
            break;

        case 'lista-asistente-evento':
            get_asistencia_externa($evento->get_asistencia_externa($_GET['id']));
            break;

        case 'seguimientos':
            get_seguimientos($db->get_seguimientos($_GET['id']));
            break;
        case 'seguimiento':
            get_seguimiento($db);
            break;

        case 'joven':
            get_joven($joven);
            break;
        case 'usuario':
            get_usuario($usuario);
            break;
    }
    ?>
</page>
<?php
require_once(__DIR__ . '../vendor/autoload.php');

$mpdf = new \Mpdf\Mpdf();
$html = ob_get_clean();

$mpdf->WriteHTML($html);

$mpdf->Output();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ob_end_clean();

?>