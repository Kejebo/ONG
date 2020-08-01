<?php
require_once('conexion.php');

class db_usuario extends conexion
{

    function cargar($destino,$dato)
    {

        $foto = $_FILES[$dato];
        $destino = $destino . rand(1, 10) . rand(1, 10) . rand(1, 10) . $foto['name'];
        move_uploaded_file($foto['tmp_name'], $destino);

        return $destino;
    }

    function insert_usuario($data)
    {
        extract($data);
        $destino = 'assets/perfiles/usuario/';
        $destino = $this->cargar($destino,'foto');
        $copia='assets/cedulas/usuario/';
        $copia=$this->cargar($copia,'copia');
        if($acceso=='habilitado'){
            $acceso=1;
        }else{
            $acceso=0;
        }
        $result =   $this->execute(
            "call insert_usuario('$nombre','$primer_apellido','$segundo_apellido',
                    '$genero','$fecha_nac','$telefono','$cedula','$correo','$civil','$direccion'
                    ,'$destino','$experiencia','$canton','$estado','$clave','$copia','$tipo','$acceso')"
        );
    }
    function update_usuario($data)
    {
        extract($data);
        $destino=null;
        $copia=null;
        if($acceso=='habilitado'){
            $acceso=1;
        }else{
            $acceso=0;
        }
        if($_FILES['foto']['name']!=null){
            $destino = 'assets/perfiles/usuario/';
            $destino = $this->cargar($destino,'foto');
                
        }else{
            $destino=$copia_foto;
        }
        if($_FILES['copia']['name']!=null){
            $copia='assets/cedulas/usuario/';
            $copia=$this->cargar($copia,'copia');
           
        }else{
            $copia=$copia_cedula;
        }

        $result =   $this->execute(
            "call update_usuario('$id_usuario','$nombre','$primer_apellido','$segundo_apellido',
                    '$genero','$fecha_nac','$telefono','$cedula','$correo','$civil','$direccion'
                    ,'$destino','$experiencia','$canton','$estado','$clave','$copia','$tipo','$acceso')"
        );
    }
    function get_login($data){
        extract($data);
        return $this->get_data("select *, nombre as nombre, id_usuario as id,tipo as puesto from usuarios where cedula='$usuario' and clave='$pass' and acceso=1")[0];
    }
    function get_usuarios()
    {
        return $this->get_data('select * from usuarios');
    }
    function get_usuario($id)
    {
        $result=$this->get_data("select * from usuarios where id_usuario='$id'");
            return $result;
    }
}
