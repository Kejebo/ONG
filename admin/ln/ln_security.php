<?php
require_once('db/db_usuario.php');

class ln_security{
    var $db;
    function __construct()
    {
        $this->db= new db_usuario();
    }

    function action_controller(){
        if(isset($_GET['action'])){
            switch($_GET['action']){
               
                case 'login':
                $this->login($_POST);
                print_r($_POST);
                break;

                case 'logout':
                $this->logout();
                break;
            }
        }
    }

    function login($data){

        $result= $this->db->get_login($data);
        $json =json_encode($result);
        if($result){
        
            setcookie('ONG',$json, time() +60*60*24*365);
            header('Location:jovenes.php');
        
        }else{
            header('Location:index.php?msg= Datos Incorrectos');

        }
    }

    function logout(){

        unset($_COOKIE['ONG']);
        setcookie('ONG', null, time()-100);
        header('Location:index.php');
    }

    function check_access($url){
        
        if(isset($_COOKIE['ONG'])){
            
            if($url=='index.php'){
                header('Location:jovenes.php');
            }
            
        }else{
            if($url!='index.php'){
                header('Location:index.php?msg=Error');
            }
        }
        }
    }


?>