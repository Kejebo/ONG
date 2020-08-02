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
                    $aux_uno=0;
                    $aux_dos=0;
                    $this->db->insert_joven($_POST);
                    foreach($_POST['ocupacion'] as $list){
                        if($list=='Estudia'){
                        $this->db->insert_ocupacion($this->db->get_id(),$list,$_POST['estudia']);
                        }else if($list=='Trabaja'){
                            $this->db->insert_ocupacion($this->db->get_id(),$list,$_POST['trabaja']);
                        }else{
                            $this->db->insert_ocupacion($this->db->get_id(),$list,'');

                        }
                    }
                    header('Location:joven.php');
                
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
