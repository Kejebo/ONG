<?php
require_once('db/db_usuario.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('assets/phpmailer/Exception.php');
require_once('assets/phpmailer/PHPMailer.php');
require_once('assets/phpmailer/SMTP.php');

class ln_security
{
    var $db;
    function __construct()
    {
        $this->db = new db_usuario();
    }

    function action_controller()
    {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {

                case 'login':
                    $this->login($_POST);
                    break;

                case 'changes':
                    if ($this->validar_cedula($_POST['cedula'])) {
                        $codigo=$this->get_codigo();
                        $this->db->update_codigo($codigo[0] . $codigo[1] . $codigo[2],$_POST['cedula']);
                        $this->enviar_correo($codigo);
                        header('Location:http://localhost/ONG/admin/index.php?pass=Contraseña enviada a tu correo');
                    } else {
                        header('Location:http://localhost/ONG/admin/recuperar_clave.php?msg=Cedula Invalidad');
                    }
                    break;

                case 'changes_password':
                    if($this->db->get_codigo_estado($_POST['cedula'],$_POST['seguridad'])){
                    $this->db->cambiar_clave($_POST['cedula'],$_POST['seguridad'],$_POST['nueva']);
                    header('Location:http://localhost/ONG/admin/index.php?pass=Contraseña Actualizada');
                }else{
                    header('Location:http://localhost/ONG/admin/changes_password.php?user='.$_POST['cedula'].'&msg=Datos Invalidos');

                }
                break;
                case 'logout':
                    $this->logout();
                    break;
            }
        }
    }

    function login($data)
    {

        $result = $this->db->get_login($data);
        $json = json_encode($result);
        if ($result) {

            setcookie('ONG', $json, time() + 60 * 60 * 24 * 365);
            header('Location:jovenes.php');
        } else {
            header('Location:index.php?msg= Datos Incorrectos');
        }
    }

    function logout()
    {

        unset($_COOKIE['ONG']);
        setcookie('ONG', null, time() - 100);
        header('Location:index.php');
    }

    function check_access($url)
    {

        if (isset($_COOKIE['ONG'])) {

            if ($url == 'index.php') {
                header('Location:jovenes.php');
            }
        } else {
            if ($url != 'index.php') {
                if($url=='changes.php'){
                }else{
                    header('Location:index.php?msg=Error');

                }
            }
        }
    }


    function generar_numero_aleatorio()
    {

        return rand(0, 100);
    }

    function get_codigo()
    {

        $data = array();

        for ($i = 0; $i < 4; $i++) {

            array_push($data, $this->generar_numero_aleatorio());
        }

        return $data;
    }

    function update_usuario($codigo, $id)
    {

        $this->ln_usuarios->update_usuario($codigo, $id);
    }



    function get_usuario_cambio($data, $codigo)
    {
        return $this->ln_usuarios->get_usuario_cambio($data, $codigo);
    }

    function validar_codigo($codigo, $id)
    {

        if ($this->ln_usuarios->validar_codigo($codigo, $id) != false) {
            echo json_encode(array("result" => "true", "id_usuario" => $id));
        } else {
            echo json_encode(array("result" => "false", "id_usuario" => $id));
        }
    }
    function validar_cedula($id)
    {

        if ($this->db->get_codigo($id) != null) {
            return true;
        } else {
            return false;
        }
    }



    function enviar_correo($codigo)
    {
        //    $datos = $this->ln_admin->get_admin();
        $respuesta = false;
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'kenjen041@gmail.com';                     // SMTP username
            $mail->Password   = '31081995';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            $mail->setFrom('kenjen041@gmail.com', 'Kendrick');
            $mail->addAddress('kenjen041@gmail.com');     // Add a recipient

            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'ONG Dale una mano Costa Rica[CODIGO DE SEGURIDAD]';
            $mail->Body    = 'Cambiar contraseña : <a href=http://localhost/ONG/admin/changes_password.php?user='.$_POST['cedula'].'>Dar click</a> ha solicitada una recuperacion de contraseña ' . 'copie el siguiente codigo de seguridad: ' . $codigo[0] . $codigo[1] . $codigo[2];

            $mail->send();
            $respuesta = true;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            $respuesta = false;
        }

        return $respuesta;
    }
}
