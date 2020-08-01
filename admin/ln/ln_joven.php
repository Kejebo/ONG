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
                    break;
                case 'insert_familiar':
                    $this->db->insert_familiar($_POST);
                    header('Location:nucleo_familiar.php?id='.$_POST['id_joven']);
                    break;
                case 'delete':
                    $this->db->delete($_GET['id']);
                    break;
            }
        }
    }
}
