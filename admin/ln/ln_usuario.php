<?php
    require_once('db/db_usuario.php');
    require_once('db/db_junta.php');
    class ln_usuario{

        var $db;
        var $junta;
        
        function __construct()
        {
            $this->db= new db_usuario();
            $this->junta= new db_junta();
        }
        function controller(){
            if(isset($_GET['action'])){
                switch($_GET['action']){
                    case 'insert':
                        $this->db->insert_usuario($_POST);
                        header('Location: usuarios.php');
                    break;
                    case 'insert_member':
                        $this->junta->insert_miembro($_POST);
                        header('Location: junta.php');
                    break;
                    case 'update_member':
                        $this->junta->update_miembro($_POST);
                        header('Location: junta.php');
                    break;
                    case 'delete_member':
                        $this->junta->delete_miembro($_GET['id']);
                        header('Location: junta.php');
                    break;
                    case 'update':
                        $this->db->update_usuario($_POST);
                        header('Location: usuarios.php');
                    break;
                    case 'update_single':
                        $this->db->update_usuario($_POST);
                        header('Location: usuario.php?action=update_usuario&id='.$_POST['id_usuario']);
                    break;
                }
            }
        }
    }
?>