<?php
require_once('db/db_reunion.php');
require_once('db/db_evento.php');
require_once('ln/ln_security.php');
require_once('db/db_reunion.php');
require_once('db/db_seguimientos.php');
$db = new db_reunion();
$evento = new db_evento();
$security= new ln_security();
$reunion= new db_reunion();
$seguimiento= new db_seguimiento();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'update':
            $this->db->insert_reunion($_POST);
            break;
        case 'agenda':
            $db->insert_agenda($_POST);
            echo json_encode($db->get_agendas($_POST['id']));
            break;

        case 'asistencia':
            $db->insert_asistente($_POST);
            echo json_encode($db->get_asistencia($_POST['id']));
            break;
        case 'acuerdos':
            $db->insert_acuerdos($_POST);
            echo json_encode($db->get_acuerdos($_POST['id']));
            break;

        case 'asunto':
            $db->insert_asuntos($_POST);
            echo json_encode($db->get_asuntos($_POST['id']));
            break;

        case 'delete_agenda':
            $this->db->delete_agenda($_GET['id']);
            header("Location:acta.php?id_reunion=" . $_GET['id_reunion']);
            break;


        case 'delete_asistencia':
            $db->delete_asistencia($_GET['id']);
            header("Location:acta.php?id_reunion=" . $_GET['id_reunion']);
            break;
        case 'delete_acuerdo':
            $db->delete_acuerdo($_GET['id']);
            header("Location:acta.php?id_reunion=" . $_GET['id_reunion']);
            break;

        case 'delete_asunto':
            $db->delete_asunto($_POST['id']);
            echo json_encode($db->get_asuntos($_POST['id']));
            break;
        case 'objectivos':
            $evento->insert_objectivo($_POST);
            echo json_encode($evento->get_objectivos());
        break;

        case 'categorias':
            $evento->insert_categoria($_POST);
            echo json_encode($evento->get_categorias());
        break;

        case 'changes':
            $security->validar_cedula($_POST['cedula']);
        break;

        case 'evento_diario':
            echo json_encode($evento->get_eventos_diario($_POST['fecha']));
        break;

        case 'evento_periodo':
            echo json_encode($evento->get_eventos_periodos($_POST['inicio'],$_POST['final']));
        break;

        case 'evento_mensual':
            echo json_encode($evento->get_eventos_mensual($_POST['fecha']));
        break;
        case 'evento_anual':
            echo json_encode($evento->get_eventos_anual($_POST['fecha']));
        break;
        case 'reunion_diario':
            echo json_encode($reunion->get_reunion_diario($_POST['fecha']));
        break;
        case 'reunion_mensual':
            echo json_encode($reunion->get_reunion_mensual($_POST['fecha']));
        break;
        case 'reunion_anual':
            echo json_encode($reunion->get_reunion_anual($_POST['fecha']));
        break;

        case 'reunion_periodo':
            echo json_encode($reunion->get_reunion_periodo($_POST['inicio'],$_POST['final']));
        break;
        case 'seguimiento_diario':
            echo json_encode($seguimiento->get_seguimiento_diario($_POST['fecha']));
        break;
        case 'seguimiento_mensual':
            echo json_encode($seguimiento->get_seguimiento_mensual($_POST['fecha']));
        break;
        case 'seguimiento_anual':
            echo json_encode($seguimiento->get_seguimiento_anual($_POST['fecha']));
        break;

        case 'seguimiento_periodo':
            echo json_encode($seguimiento->get_seguimiento_periodo($_POST['inicio'],$_POST['final']));
        break;

    }
}
