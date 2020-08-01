<?php
    require_once('db/db_patrocinador.php');
    class ln_patrocinador{

        var $db;
        
        function __construct()
        {
            $this->db= new db_patrocinio();
        }
        function controller(){
            if(isset($_GET['action'])){
                switch($_GET['action']){
                    case 'insert':
                        $this->db->insert_patrocinador($_POST);
                        header('Location: patrocinios.php');
                    break;
                    case 'update':
                        $this->db->update_patrocinador($_POST);
                        header('Location: patrocinios.php');
                    break;
                    case 'delete':
                        $this->db->delete_patrocinador($_GET['id']);
                        header('Location: patrocinios.php');
                    break;
                    
                }
            }
        }
    }
?>