<?php
require_once('conexion.php');

class db_usuario extends conexion
{

    function cargar($destino, $dato)
    {

        $foto = $_FILES[$dato];
        $destino = $destino . rand(1, 10) . rand(1, 10) . rand(1, 10) . $foto['name'];
        move_uploaded_file($foto['tmp_name'], $destino);

        return $destino;
    }

    function get_email($cedula){
        return $this->get_data("select correo as email from usuarios where cedula='$cedula'")[0];
    }
    function insert_usuario($data)
    {
        extract($data);
        $destino = 'assets/perfiles/usuario/';
        $destino = $this->cargar($destino, 'foto');
        $copia = 'assets/cedulas/usuario/';
        $copia = $this->cargar($copia, 'copia');
        if ($acceso == 'habilitado') {
            $acceso = 1;
        } else {
            $acceso = 0;
        }
        $result =   $this->execute(
            "call insert_usuario('$nombre','$primer_apellido','$segundo_apellido',
                    '$genero','$fecha_nac','$telefono','$cedula','$correo','$civil','$direccion'
                    ,'$destino','$experiencia','$canton','$estado','$clave','$copia','$tipo','$acceso','$centro_form')"
        );
    }

    function get_codigo($cedula){
        $data=$this->get_data("select u.clave as c from usuarios u where u.cedula='$cedula'");
        return $data;
    }

    function get_codigo_estado($cedula,$codigo){
        $data=$this->get_data("select * from usuarios u where u.cedula='$cedula' and u.codigo_cambio=$codigo");
        return $data;
    }
    function update_codigo($codigo,$cedula){
        $this->execute("call update_estado_clave('$codigo','$cedula')");
    }
    function cambiar_clave($cedula,$seguridad,$nueva){
        $this->execute("update usuarios u set u.clave='$nueva' where u.codigo_cambio =$seguridad and u.cedula='$cedula';");
    }
    function update_usuario($data)
    {
        extract($data);
        $destino = null;
        $copia = null;
        if ($acceso == 'habilitado') {
            $acceso = 1;
        } else {
            $acceso = 0;
        }
        if ($_FILES['foto']['name'] != null) {
            $destino = 'assets/perfiles/usuario/';
            $destino = $this->cargar($destino, 'foto');
        } else {
            $destino = $copia_foto;
        }
        if ($_FILES['copia']['name'] != null) {
            $copia = 'assets/cedulas/usuario/';
            $copia = $this->cargar($copia, 'copia');
        } else {
            $copia = $copia_cedula;
        }

        $result =   $this->execute(
            "call update_usuario('$id_usuario','$nombre','$primer_apellido','$segundo_apellido',
                    '$genero','$fecha_nac','$telefono','$cedula','$correo','$civil','$direccion'
                    ,'$destino','$experiencia','$canton','$estado','$clave','$copia','$tipo','$acceso','$centro_form')"
        );
    }
    function get_login($data)
    {
        extract($data);
        return $this->get_data("select *, nombre as nombre, id_usuario as id,tipo as puesto from usuarios where cedula='$usuario' and clave='$pass' and acceso=1")[0];
    }
    function get_usuarios()
    {
        return $this->get_data('select *,u.estado as status,(SELECT TIMESTAMPDIFF(YEAR,fecha_nacimiento,CURDATE())) as edad from usuarios u inner join sedes s on s.id_sede=u.sede');
    }
    function get_usuario($id)
    {
        $result = $this->get_data("select * from usuarios where id_usuario='$id'");
        return $result;
    }
}
