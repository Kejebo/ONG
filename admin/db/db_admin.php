<?php
require_once('conexion.php');

class db_admin extends conexion
{

    function get_admin()
    {
        return $this->get_data('select * from admin');
    }
    function delete_miembro($id){
        $this->execute("delete from miembros_junta_directiva where id_miembro='$id'");
    }
    function get_miembro($id)
    {
        return $this->get_data("call get_miembro('$id')");
    }
    function get_puestos(){
        return $this->get_data('select * from puestos_directivos');
    }

}
