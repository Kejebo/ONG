<?php
require_once('conexion.php');

class db_joven extends conexion
{

    function cargar($destino, $archivo)
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
        $imagen = $this->cargar($imagen, 'foto');
        $compromiso = 'assets/cartas/jovenes/';
        $compromiso = $this->cargar($compromiso, 'compromiso');
        $consentimiento = 'assets/consentimiento/jovenes/';
        $consentimiento = $this->cargar($consentimiento, 'consentimiento');
        $copia_cedula = 'assets/cedulas/jovenes/';
        $copia_cedula = $this->cargar($copia_cedula, 'copia_cedula');

        print_r($this->execute(
            "call insert_joven('$nombre','$primer_apellido','$segundo_apellido'
                    ,'$nombre_emergencia','$telefono_emergencia','$tipo',
                    '$genero','$fecha_nac','$telefono','$cedula','$correo','$civil','$canton'
                    ,'$provincia', '$distrito','$estado','$fecha_reg'
                    ,'$centro_form','$generacion','$direccion'
                    ,'$compromiso','$imagen','$miembros','$ayuda','$consentimiento','$copia_cedula')"
        ));
    }

    function update_joven($data)
    {
        extract($data);
        
        $imagen = 'assets/perfiles/jovenes/';
        $imagen = $_FILES['foto']['name'] == null ? $perfil:$this->cargar($imagen, 'foto');
        $compromiso = 'assets/cartas/jovenes/';
        $compromiso = $_FILES['carta']['name'] == null ? $compro :$this->cargar($compromiso, 'carta');
        $consentimiento = 'assets/consentimiento/jovenes/';
        $consentimiento = $_FILES['consentimiento'] == null ? $consenti :$this->cargar($consentimiento, 'consentimiento');
        $copia_cedula = 'assets/cedulas/jovenes/';
        $copia_cedula = $_FILES['copia_cedula']['name'] == null ? $cedula_dos : $this->cargar($copia_cedula, 'copia_cedula');
        $this->execute(
            "call update_joven('$id','$nombre','$primer_apellido','$segundo_apellido'
                    ,'$nombre_emergencia','$telefono_emergencia','$tipo',
                    '$genero','$fecha_nac','$telefono','$cedula','$correo','$civil','$canton'
                    ,'$provincia', '$distrito','$estado','$fecha_reg'
                    ,'$centro_form','$generacion','$direccion'
                    ,'$compromiso','$imagen','$miembros','$ayuda','$consentimiento','$copia_cedula')"
        );
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

    function update_familiar($data)
    {
        extract($data);
        if ($jefe == 0) {
            $this->execute("update nucleo_familiar set rol='$parentesco',nombre_familiar='$nombre' where id_familiar='$id_familiar'");
        } else {
            $this->execute("update nucleo_familiar set rol='$parentesco',nombre_familiar='$nombre',jefe='$jefe',estudios='$estudio',ocupacion='$ocupacion' where id_familiar='$id_familiar'");
        }
    }
    function get_familiares($id)
    {
        return $this->get_data("select *, if(n.jefe=1, 'Si','No') as lider from nucleo_familiar n where n.id_joven  ='$id'");
    }
    function get_familiar($id)
    {
        return $this->get_data("select *, if(n.jefe=1, 'Si','No') as lider from nucleo_familiar n where n.id_familiar  ='$id'");
    }
    function delete_familiar($id){
        $this->execute("delete from nucleo_familiar where id_familiar='$id'");
    }

    function insert_ocupacion($id, $tipo, $lugar)
    {
        $this->execute("call insert_ocupacion('$id','$lugar','$tipo')");
    }
    function get_jovenes()
    {
        return $this->get_data("select *,j.estado as status, (SELECT TIMESTAMPDIFF(YEAR,fecha_nacimiento,CURDATE())) as edad from jovenes j inner join sedes s on s.id_sede=j.sede where j.estado Not IN('0')");
    }
    function get_joven($id)
    {
        return $this->get_data("call get_joven('$id')");
    }
    function get_ocupacion($id)
    {
        return $this->get_data("select * from ocupacion_joven where id_joven='$id'");
    }

    function delete_ocupacion($id)
    {
        return $this->execute("delete from ocupacion_joven where id_joven='$id'");
    }
    function delete($id)
    {
        $this->execute("update jovenes j set j.estado='0' where id_joven='$id'");
    }
}
