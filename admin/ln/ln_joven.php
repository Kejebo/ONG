<?php
require_once('db/db_joven.php');
class ln_joven
{

    var $db;

    function __construct()
    {
        $this->db = new db_joven();
    }
    function controller()
    {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'insert':

                    $this->db->insert_joven($_POST);
                    foreach ($_POST['ocupacion'] as $list) {
                        if ($list == 'Estudia') {
                            $this->db->insert_ocupacion($this->db->get_id(), $list, $_POST['estudia']);
                        } else if ($list == 'Trabaja') {
                            $this->db->insert_ocupacion($this->db->get_id(), $list, $_POST['trabaja']);
                        } else {
                            $this->db->insert_ocupacion($this->db->get_id(), $list, '');
                        }
                    }
                    header('Location:joven.php');

                    break;
                case 'insert_familiar':
                    $this->db->insert_familiar($_POST);
                    header('Location:nucleo_familiar.php?id=' . $_POST['id_joven']);
                    break;
                case 'update_familiar':
                    $this->db->update_familiar($_POST);
                    header('Location:nucleo_familiar.php?id=' . $_POST['id_joven']);
                    break;
                case 'delete_familiar':
                    $this->db->delete_familiar($_GET['id_familiar']);
                    header('Location:nucleo_familiar.php?id=' . $_GET['id_joven']);
                    break;
                case 'delete':
                    $this->db->delete($_GET['id']);
                    break;
                case 'update':
                    $this->db->update_joven($_POST);
                    print_r($this->db->delete_ocupacion($_POST['id']));
                    foreach ($_POST['ocupacion'] as $list) {
                        if ($list == 'Estudia') {
                            $this->db->insert_ocupacion($_POST['id'], $list, $_POST['estudia']);
                        } else if ($list == 'Trabaja') {
                            $this->db->insert_ocupacion($_POST['id'], $list, $_POST['trabaja']);
                        } else {
                            $this->db->insert_ocupacion($_POST['id'], $list, '');
                        }
                    }

                    //                    header('Location:expedientes.php?action=update_joven&id=' . $_POST['id']);

                    break;
            }
        }
    }
}
