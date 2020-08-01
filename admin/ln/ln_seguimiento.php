<?php
require_once('db/db_seguimientos.php');
class ln_seguimiento
{

    var $db;

    function __construct()
    {
        $this->db = new db_seguimiento();
    }
    function controller()
    {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'insert':
                    print($this->db->insert_seguimiento($_POST));
                    header("Location: seguimiento.php?id_seguimiento=" . $this->db->get_id());
                    break;
                case 'update':
                    $this->db->update_seguimiento($_POST);
                    break;
                case 'delete':
                    break;
                case 'insert_facilitadores':
                    $this->db->insert_facilitadores($_POST);
                    header("Location: seguimiento.php?id_seguimiento=" . $_GET['id_seguimiento']);

                    break;
                case 'update_documento':
                    $this->db->insert_documento($_POST, $_GET['id_seguimiento']);
                    header("Location: seguimiento.php?id_seguimiento=" . $_GET['id_seguimiento']);

                    break;
                case 'insert_observacion':
                    $this->db->insert_observacion($_POST);
                    header("Location: seguimiento.php?id_seguimiento=" . $_GET['id_seguimiento']);
                    break;
                case 'insert_recomendacion':
                    $this->db->insert_recomendacion($_POST);
                    $this->db->update_last_changes($_GET['id_seguimiento'], json_decode($_COOKIE['ONG'], true)['id']);
                    header("Location: seguimiento.php?id_seguimiento=" . $_GET['id_seguimiento']);
                    break;

                case 'delete_observacion':
                    $this->db->delete_observacion($_GET['id']);
                    header("Location: seguimiento.php?id_seguimiento=" . $_GET['id_seguimiento']);
                    break;

                case 'delete_facilitador':
                    $this->db->delete_facilitador($_GET['id']);
                    header("Location: seguimiento.php?id_seguimiento=" . $_GET['id_seguimiento']);
                    break;
                case 'delete_recomendacion':
                    $this->db->delete_recomendacion($_GET['id']);
                    header("Location: seguimiento.php?id_seguimiento=" . $_GET['id_seguimiento']);
                    break;


                case 'update':
                    $this->db->update_seguimiento($_POST);
                    header("Location: seguimiento.php?id_seguimiento=" . $_GET['id_seguimiento']);
                    break;
            }
        }
    }
}
