<?php
include('ui/ui_pdfs.php');
require_once('db/db_seguimientos.php');
require_once('db/db_evento.php');
$db = new db_seguimiento();
$evento = new db_evento();

?>
<style>
    img {
        max-width: 100px;
        margin-left: 10px;
    }

    label {
        text-transform: uppercase;
        font-size: 12px;
    }

    table{
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
        color: white;
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
</style>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <img src="assets/861Logo Dale Una Mano.png">
    <br>
    <br>

    <?php
    switch($_GET['action']){
        case 'lista-jovenes-evento':
            get_jovenes_evento($evento->get_voluntarios($_GET['id']));
        break;

        case 'lista-asistente-evento':
            get_asistencia_externa($evento->get_asistencia_externa($_GET['id']));
        break;

        case 'seguimientos':
            get_seguimientos($db->get_seguimientos($_GET['id']));
        break;
    }
    ?>


</page>
<?php
require_once(__DIR__ . "./vendor/autoload.php");

use Spipu\Html2Pdf\Html2Pdf;

$html = ob_get_clean();
$pdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8');
$pdf->writeHTML($html);

$pdf->output();
?>