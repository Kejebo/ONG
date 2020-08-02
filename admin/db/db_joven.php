<?php
require_once('conexion.php');

class db_joven extends conexion
{

    function cargar($destino,$archivo)
    {
        if (isset($_FILES[$archivo])) {
            $foto = $_FILES[$archivo];
            $destino = $destino . $foto['name'];
            move_uploaded_file($foto['tmp_name'], $destino);
        } else {
            $destino = '';
        }
        return $destino;
    }

    function insert_joven($data)
    {
        extract($data);
        $imagen = 'assets/perfiles/jovenes/';
        $imagen = $this->cargar($imagen,'foto');
        $compromiso = 'assets/cartas/jovenes/';
        $compromiso = $this->cargar($compromiso,'compromiso');
        $consentimiento = 'assets/consentimiento/jovenes/';
        $consentimiento = $this->cargar($consentimiento,'consentimiento');
        $copia_cedula = 'assets/cedulas/jovenes/';
        $copia_cedula = $this->cargar($copia_cedula,'copia_cedula');

        print_r($this->execute(
            "call insert_joven('$nombre','$primer_apellido','$segundo_apellido'
                    ,'$nombre_emergencia','$telefono_emergencia','$tipo',
                    '$genero','$fecha_nac','$telefono','$cedula','$correo','$civil','$canton'
                    ,'$provincia', '$distrito','$estado','$fecha_reg'
                    ,'$centro_form','$generacion','$direccion'
                    ,'$compromiso','$imagen','$miembros','$ayuda','$consentimiento','$copia_cedula')"));
    }
    function get_id()
    {
        $sql = "select * from jovenes
                order by id_joven desc
                limit 1";
        $result = $this->get_data($sql);
        return $result[0]['id_joven'];
    }

    function insert_familiar($data)
    {
        extract($data);
        if ($jefe == 0) {
            $this->execute("insert into nucleo_familiar(id_joven,rol,nombre_familiar) values('$id_joven','$parentesco','$nombre')");
        } else {
            $this->execute("insert into nucleo_familiar(id_joven,rol,nombre_familiar,jefe,estudios,ocupacion) values('$joven','$parentesco','$nombre','$jefe','$estudio','$ocupacion)");
        }
    }
    function get_familiares($id)
    {
        return $this->get_data("select *, if(n.jefe=1, 'Si','No') as lider from nucleo_familiar n where n.id_joven  ='$id'");
    }

    function insert_ocupacion($id,$tipo,$lugar)
    {
        $this->execute("call insert_ocupacion('$id','$lugar','$tipo')");
    }
    function get_jovenes()
    {
        return $this->get_data("select * from jovenes where estado Not IN('0')");
    }
    function get_joven($id)
    {
        return $this->get_data("call get_joven('$id')");
    }
    function get_ocupacion($id){
        return $this->get_data("select * from ocupacion_joven where id_joven='$id'");
    }
    function delete($id)
    {
        $this->execute("update jovenes j set j.estado='0' where id_joven='$id'");
    }
}
