<?php
require_once('conexion.php');

class db_admin extends conexion
{

    function cargar($destino)
    {

        $foto = $_FILES['logo'];
        $destino = $destino . rand(1, 10) . rand(1, 10) . rand(1, 10) . $foto['name'];
        move_uploaded_file($foto['tmp_name'], $destino);

        return $destino;
    }

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
    function update_admin($data){
        extract($data);
        $destino = $documento;

        if ($_FILES['logo']['name'] != null) {
            $destino = 'assets/logos/ong/';
            $destino = $this->cargar($destino);
            unlink($documento);
        }
     
       print($this->execute("call update_admin('$nombre','$clave','$correo','$direccion','$lema','$destino','$telefono','$id')"));
    }
}
