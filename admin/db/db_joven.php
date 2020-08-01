<?php
require_once('conexion.php');

class db_joven extends conexion
{

    function cargar_foto($destino)
    {
        if (isset($_FILES['foto'])) {
            $foto = $_FILES['foto'];
            $destino = $destino . $foto['name'];
            move_uploaded_file($foto['tmp_name'], $destino);
        } else {
            $destino = '';
        }
        return $destino;
    }
    function cargar_carta($destino)
    {
        if (isset($_FILES['carta'])) {
            $carta = $_FILES['carta'];
            $destino = $destino . $carta['name'];
            move_uploaded_file($carta['tmp_name'], $destino);
        } else {
            $destino = '';
        }
        return $destino;
    }
    function insert_joven($data)
    {
        extract($data);
        $imagen = 'assets/perfiles/jovenes/';
        $imagen = $this->cargar_foto($imagen);
        $compromiso = 'assets/cartas/jovenes/';
        $compromiso = $this->cargar_carta($compromiso);

        print_r($this->execute(
            "call insert_joven('$nombre','$primer_apellido','$segundo_apellido'
                    ,'$nombre_emergencia','$telefono_emergencia','$tipo',
                    '$genero','$fecha_nac','$telefono','$cedula','$correo','$civil','$canton'
                    ,'$provincia', '$distrito','$estado','$fecha_reg'
                    ,'$centro_form','$generacion','$direccion'
                    ,'$compromiso','$imagen','$miembro','$ayuda','$consentimiento','$copia_cedula')"
        ));
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

    function insert_ocupacion($data)
    {
        extract($data);
        $this->execute("call insert_ocupacion('$id','$lugar','$tipo')");
    }
    function get_jovenes()
    {
        return $this->get_data('select * from jovenes');
    }
    function get_joven($id)
    {
        return $this->get_data("call get_joven('$id')");
    }
    function delete($id)
    {
        $this->execute("delete from jovenes where id_joven='$id'");
    }
}
