<?php
require_once('conexion.php');

class db_junta extends conexion
{

    function insert_miembro($data)
    {
        extract($data);
      return  $this->execute(
            "call insert_miembro('$usuario','$puesto','$descripcion')"
        );
    }

    function update_miembro($data)
    {
        extract($data);
       $this->execute("call update_miembro('$id','$usuario','$puesto','$descripcion')");
    }
    function get_junta()
    {
        return $this->get_data('call get_junta_directiva()');
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
