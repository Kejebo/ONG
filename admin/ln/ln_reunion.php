<?php
require_once('db/db_reunion.php');
class ln_reunion
{

    var $db;

    function __construct()
    {
        $this->db = new db_reunion();
    }
    function controller()
    {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'insert':
                    $this->db->insert_reunion($_POST);
                    header("Location:acta.php?id_reunion=" . $this->db->get_id());

                    break;
                case 'update':
                    $this->db->update_reunion($_POST, $_GET['id_reunion']);
                    header("Location:acta.php?id_reunion=" . $_GET['id_reunion']);
                    break;

                case 'delete_agenda':
                    $this->db->delete_agenda($_GET['id']);
                    header("Location:acta.php?id_reunion=" . $_GET['id_reunion']);
                    break;

                case 'delete_asistencia':
                    $this->db->delete_asistencia($_GET['id']);
                    header("Location:acta.php?id_reunion=" . $_GET['id_reunion']);
                    break;

                case 'delete_acuerdo':
                    $this->db->delete_acuerdo($_GET['id']);
                    header("Location:acta.php?id_reunion=" . $_GET['id_reunion']);
                    break;
                    
                case 'delete_asunto':
                    $this->db->delete_asunto($_GET['id']);
                    header("Location:acta.php?id_reunion=" . $_GET['id_reunion']);
                    break;
            }
        }
    }
}
