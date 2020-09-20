<?php
require_once('conexion.php');

class db_reunion extends conexion
{

    function insert_reunion($data)
    {
        extract($data);
        $id=json_decode($_COOKIE['ONG'], true)['id'];
        return  $this->execute(
            "call insert_reunion('$numero','$fecha','$objectivo','$lugar','$inicio','$final','$id')"
        );
    }

    function update_reunion($data,$id)
    {
        extract($data);
        $id_usuario=json_decode($_COOKIE['ONG'], true)['id'];

        $this->execute(
            "call update_reunion('$id','$numero','$fecha','$lugar','$objectivo','$inicio','$final')"
        );
    }

    function insert_agenda($data)
    {
        extract($data);
        $this->execute("insert into agendas(id_reunion,actividad,encargado) values('$id','$actividad','$encargado')");
    }
    function insert_asistente($data)
    {
        extract($data);
        $this->execute("insert into asistencia_reunion(id_reunion,representa,encargado) values('$id','$representa','$encargado')");
    }
    function insert_acuerdos($data)
    {
        extract($data);
        $this->execute("insert into acuerdos_reunion(id_reunion,actividad,encargado) values('$id','$actividad','$encargado')");
    }
    function insert_asuntos($data)
    {
        extract($data);
        $this->execute("insert into asuntos_reunion(id_reunion,actividad) values('$id','$asunto')");
    }
    function get_reuniones()
    {
        return $this->get_data('select * from reuniones r inner join usuarios u on u.id_usuario=r.id_usuario');
    }
    function get_puestos()
    {
        return $this->get_data('select * from puestos_directivos');
    }

    function get_reunion($id)
    {
        return $this->get_data("call get_reunion('$id');")[0];
    }

    function get_agendas($id)
    {
        return $this->get_data("select * from agendas where id_reunion='$id'");
    }
    function get_asistencia($id)
    {
        return $this->get_data("select * from asistencia_reunion where id_reunion='$id'");
    }
    function get_acuerdos($id)
    {
        return $this->get_data("select * from acuerdos_reunion where id_reunion='$id'");
    }
    function get_asuntos($id)
    {
        return $this->get_data("select * from asuntos_reunion where id_reunion='$id'");
    }
    function delete_agenda($id)
    {
        $this->execute("delete from agendas where id_agenda='$id'");
    }
    function delete_asistencia($id)
    {
        $this->execute("delete from asistencia_reunion where id_asistencia='$id'");
    }
    function delete_acuerdo($id)
    {
        $this->execute("delete from acuerdos_reunion where id_acuerdo='$id'");
    }
    function delete_asunto($id)
    {
        $this->execute("delete from asuntos_reunion where id_asunto='$id'");
    }
    function get_id(){
        $sql = "select max(id_reunion) as id from reuniones";
        $result = $this->get_data($sql);
        return $result[0]['id'];
    }
}
