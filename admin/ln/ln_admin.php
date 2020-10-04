<?php
    require_once('db/db_admin.php');
    class ln_admin{

        var $db;
        
        function __construct()
        {
            $this->db= new db_admin();
        }
        function controller(){
            if(isset($_GET['action'])){
                switch($_GET['action']){
                    case 'admin':
                        $this->db->update_admin($_POST);
                        header('Location: admin.php');
                    break;
                    
                }
            }
        }
    }
?>