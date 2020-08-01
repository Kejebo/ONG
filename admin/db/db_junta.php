<?php
require_once('conexion.php');

class db_junta extends conexion
{

    function insert_miembro($data)
    {
        extract($data);
      return  $this->execute(
            "call insert_miembro('$id_facilitador','$puesto')"
        );
    }

    function update_patrocinador($data)
    {
        extract($data);
        print_r($this->execute("call update_miembrio('$id','$id_facilitador','$puesto')"));
    }
    function get_junta()
    {
        return $this->get_data('call get_junta_directiva()');
    }
    function get_puestos(){
        return $this->get_data('select * from puestos_directivos');
    }

}
