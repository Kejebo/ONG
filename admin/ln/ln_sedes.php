<?php
    require_once('db/db_sedes.php');
    class ln_sedes{

        var $db;
        
        function __construct()
        {
            $this->db= new db_sedes();
        }
        function controller(){
            if(isset($_GET['action'])){
                switch($_GET['action']){
                    case 'insert':
                        $this->db->insert_sede($_POST);
                        header('Location: sedes.php');
                    break;
                    case 'update':
                        $this->db->update_sede($_POST);
                        header('Location: sedes.php');
                    break;
                    case 'delete':
                        $this->db->delete_sede($_GET['id']);
                        header('Location: sedes.php');
                    break;
                    
                }
            }
        }
    }
?>