<?php
require_once('db/db_reunion.php');
require_once('db/db_evento.php');

$db = new db_reunion();
$evento = new db_evento();

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
    }
}
