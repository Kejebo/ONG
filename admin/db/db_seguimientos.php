<?php
require_once('conexion.php');

class db_seguimiento extends conexion
{

    function cargar($destino)
    {

        $foto = $_FILES['guia'];
        $destino = $destino . rand(1, 10) . rand(1, 10) . rand(1, 10) . $foto['name'];
        move_uploaded_file($foto['tmp_name'], $destino);

        return $destino;
    }
    function cargar_update($destino)
    {

        $foto = $_FILES['guia_modificada'];
        $destino = $destino . rand(1, 10) . rand(1, 10) . rand(1, 10) . $foto['name'];
        move_uploaded_file($foto['tmp_name'], $destino);

        return $destino;
    }
    function insert_seguimiento($data)
    {
        extract($data);
        $usuario=json_decode($_COOKIE['ONG'], true)['id'];
       print_r($this->execute(
            "insert into seguimientos(id_joven,id_usuario,fecha,asunto) values('$joven','$usuario','$fecha','$asunto')"
        ));
    }

    function insert_documento($data,$id_seguimiento)
    {
        extract($data);
       $destino = 'assets/documentos/seguimientos/';
       $destino = $this->cargar($destino);
        $result =   $this->execute(
            "call update_seguimiento_documento('$id_seguimiento','$destino')"
        );
    }

    function get_usuarios()
    {
        return $this->get_data('select * from usuarios');
    }
    function get_joven($id)
    {
        return $this->get_data("select * from jovenes where id_joven='$id'");
    }
    function get_seguimientos(){
        return $this->get_data("call get_seguimientos()");

    }
    function get_seguimiento($id){
        return $this->get_data("call get_seguimiento('$id')");

    }
    function get_evento($id)
    {
        return $this->get_data("call get_evento('$id')");
    }
    function insert_facilitadores($data)
    {
        extract($data);
        foreach ($facilitadores as $lista) {
            print_r($this->execute("call insert_facilitador_seguimiento('$lista','$id')"));
        }
    }
    function get_facilitadores_seguimiento($id)
    {
        return $this->get_data("call get_facilitadores_seguimiento('$id')");
    }

    
    function insert_observacion($data)
    {
        extract($data);
        print_r($this->execute("call insert_observacion_seguimiento('$facilitador','$id','$mensaje')"));
    }
    function insert_recomendacion($data)
    {
        extract($data);
        print_r($this->execute("call insert_recomendacion_seguimiento('$facilitador','$id','$mensaje')"));
    }
    function get_recomendacion($id)
    {
        return $this->get_data("call get_recomendaciones('$id')");
    }
    function delete_recomendacion($data)
    {
        $this->execute("delete from recomendacion_seguimiento where id_recomendacion='$data'");
    }

    function get_observacion($id)
    {
        return $this->get_data("call get_observaciones('$id')");
    }
    function delete_observacion($data)
    {
        $this->execute("delete from observaciones_seguimiento where id_observacion='$data'");
    }

  
    function update_seguimiento($data)
    {
        extract($data);
        $destino = $documento;
        if ($_FILES['guia_modificada'] != null) {
            $destino = 'assets/documentos/seguimientos/';
            $destino = $this->cargar_update($destino);
        }
        $usuario=json_decode($_COOKIE['ONG'], true)['id'];

        $this->execute("call update_seguimiento('$id_seguimiento','$destino','$asunto','$fecha','$usuario')");
    }

    function update_last_changes($id,$facilitador){

        $this->execute("update seguimientos set id_facilitador='$facilitador' where id_seguimiento='$id';");
    }
    function get_id(){
        $sql = "select * from seguimientos
        order by id_seguimiento desc
        limit 1";
        $result = $this->get_data($sql);
        return $result[0]['id_seguimiento'];
    }
  
    function delete_facilitador($data){
        extract($data);
        $this->execute("delete from usuarios_seguimiento where id_usuario='$id' and id_seguimiento='$seguimiento';");
    }
    function delete_galeria_evento($id){
        $this->execute("delete from galeria_eventos where id_evento='$id';");
    }
    function delete_jovenes_evento($id){
        $this->execute("delete from evento_jovenes where id_evento='$id';");
    }
 
}
