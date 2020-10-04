<?php
include('ui/ui_pdfs.php');
require_once('db/db_seguimientos.php');
require_once('db/db_evento.php');
require_once('db/db_admin.php');
require_once('db/db_joven.php');
$admin = new db_admin();
$admin = $admin->get_admin()[0];
$joven= new db_joven();

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
        border: black 1px solid;

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
    #encabezado tbody td{
        padding: 5px;
    border-top: 0px;
    border-right: 0px;
    border-bottom: 1px solid black;
    border-left: 0px;    }
    .joven tbody td{
        padding: 5px;
    border-top: 0px;
    border-right: 0px;
    border-bottom: 1px solid black;
    border-left: 0px;  
    }
    .datos{
        margin-left: 20px;
    }
    .titulos{
        font-weight: bold;
    }
</style>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <table id="encabezado"  border="1" cellspacing="0">
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
    }
    ?>
</page>
<?php

require_once( __DIR__ . '../vendor/autoload.php');

$mpdf = new \Mpdf\Mpdf();
$html = ob_get_clean();

$mpdf->WriteHTML($html);
$mpdf->Output();

/*require_once(__DIR__ . "./vendor/autoload.php");

use Spipu\Html2Pdf\Html2Pdf;

$html = ob_get_clean();
$pdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8');
$pdf->setTestTdInOnePage (false);
$pdf->writeHTML($html);

$pdf->output();
*/
?>