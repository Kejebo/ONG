<?php
require_once('db/db_evento.php');
class ln_evento
{

    var $db;

    function __construct()
    {
        $this->db = new db_evento();
    }
    function controller()
    {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'insert':
                    $this->db->insert_evento($_POST);
                    header("Location: inscripciones.php?id=" . $this->db->get_id());
                    break;
                case 'update':
                    $this->db->update_evento($_POST);
                    header("Location: evento.php?id=" . $_POST['id']);
                    break;
                case 'delete':
                    $this->db->delete_evento($_GET['id']);
                    header("Location: eventos.php");
                    break;
                case 'insert_patrocinios':
                    $this->db->insert_patrocinadores($_POST);
                    header("Location: inscripciones.php?id=" . $_GET['id']);

                    break;
                case 'insert_galeria':
                    $this->db->insert_galeria($_POST);
                    header("Location: galeria.php?id=" . $_GET['id']);

                    break;
                case 'comentario':
                    $this->db->insert_comentario($_POST);

                    header("Location: inscripciones.php?id=" . $_GET['id']);
                    break;
                case 'voluntarios':
                    $this->db->insert_voluntarios($_POST);
                    header("Location: inscripciones.php?id=" . $_GET['id']);
                    break;
                case 'add_voluntarios':
                    $this->db->insert_joven_asistencia($_POST);
                    header("Location: asistencia.php?id=" . $_GET['id']);
                    break;
                case 'delete_voluntario':
                    $this->db->delete_voluntario($_GET);
                    header("Location: inscripciones.php?id=" . $_GET['id']);
                    break;
                case 'delete_patrocinador':
                    $this->db->delete_patrocinador($_GET);
                    header("Location: inscripciones.php?id=" . $_GET['id']);
                    break;
                case 'delete_galeria':
                    $this->db->delete_galeria($_GET);
                    header("Location: galeria.php?id=" . $_GET['id']);
                    break;
                case 'delete_comentario':
                    $this->db->delete_comentario($_GET);
                    header("Location: inscripciones.php?id=" . $_GET['id']);
                    break;
                case 'asistente':
                    $this->db->insert_asistente($_GET['id'], $_POST);
                    header("Location: inscripciones.php?id=" . $_GET['id']);
                    break;
                case 'delete_asistente':
                    $this->db->delete_asistente($_GET);
                    header("Location: asistencias.php?id=" . $_GET['id']);
                    break;
                case 'dar_baja':
                    $this->db->dar_baja($_GET);
                    header("Location: asistencia.php?id=" . $_GET['id']);
                    break;
            }
        }
    }
    function reports_dia(){
        $result=null;
        $tipo=$_GET['tipo'];

        switch($_GET['busqueda']){
            case 'evento':
                if($tipo=='dia'){
                    $result=$this->db->get_eventos_diario($_GET['fecha_uno']);
                }        
        }
        return $result;
    }
}
