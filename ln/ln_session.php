<?php
class ln_session{

var $ln_usuarios;

    function __construct(){

        // $this->ln_usuario = new ln_usuarios();
    }

    function action_controller(){
        if(isset($_GET['action'])){
            switch($_GET['action']){

                case 'login':
                $this->login($_POST);
                break;

                case 'logout':
                $this->logout();
                break;
            }
        }
    }

    function get_user($data){
        $result=array();
        $users=array(
            array('id' => '1-1111-1111', 'pass' => '123'),
            array('id' => '222222222',   'pass' => 'password'),
            array('id' => '3-1111-1111', 'pass' => '1234'),
            array('id' => '4-1111-1111', 'pass' => '12345')
        );

        foreach ($users as $item) {
            if($item['id'] == $data['cedula'] && $item['pass'] == $data['pass']){
                $result=$item;
                break;
            }
        }

        return $result;

    }

    function login($data){
        $result=$this->get_user($data);
        if ($result) {
            session_start();
            $_SESSION["id"]= $data['cedula'];
            $_SESSION["pass"]= $data['pass'];
            header('Location:index.php');
        } else {
            header('Location:session.php?msg=error');
        }
    }

    function logout(){
        session_start();
        session_unset();
        session_destroy();
        header('Location:index.php');
    }

}
?>