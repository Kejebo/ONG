<?php
require_once('conexion.php');

class db_evento extends conexion
{

    function cargar($destino)
    {

        $foto = $_FILES['guia'];
        $destino = $destino . rand(1, 10) . rand(1, 10) . rand(1, 10) . $foto['name'];
        move_uploaded_file($foto['tmp_name'], $destino);

        return $destino;
    }

    function insert_evento($data)
    {
        extract($data);
        $destino = 'assets/cartas/eventos/';
        $destino = $this->cargar($destino);
        $result =   $this->execute(
            "call insert_evento('$facilitador','$joven','$nombre','$descripcion','$fecha','$hora_inicio','$hora_cierre',
                    '$lugar','$direccion_lugar','$destino','$categoria','$objectivo')"
        );
    }
    function insert_objectivo($data)
    {
        extract($data);
        $this->execute("insert into objectivo_evento(nombre_objectivo) values('$nombre')");
    }
    function get_objectivos()
    {
        return $this->get_data("select * from objectivo_evento where estado=1 order by nombre_objectivo asc");
    }
    function insert_categoria($data)
    {
        extract($data);
        $this->execute("insert into categoria_eventos(nombre_categoria) values('$nombre')");
    }
    function get_categorias()
    {
        return $this->get_data("select * from categoria_eventos where estado=1 order by nombre_categoria asc");
    }

    function get_eventos()
    {
        return $this->get_data("call get_eventos()");
    }
    function get_usuarios()
    {
        return $this->get_data('select * from usuarios');
    }
    function get_jovenes()
    {
        return $this->get_data('select * from jovenes');
    }

    function get_evento($id)
    {
        return $this->get_data("call get_evento('$id')");
    }

    function get_eventos_diario($fecha)
    {
        return $this->get_data("call get_eventos_diario('$fecha')");
    }

    function get_eventos_anual($fecha)
    {
        return $this->get_data("call get_eventos_anual('$fecha')");
    }

    function get_eventos_mensual($fecha)
    {
        return $this->get_data("call get_evento_mensual('$fecha')");
    }
    function insert_voluntarios($data)
    {
        extract($data);
        foreach ($jovenes as $lista) {
            $this->execute("call insert_voluntario('$id','$lista')");
        }
    }
    function get_voluntarios($id)
    {
        return $this->get_data("call get_voluntarios('$id');");
    }

    function delete_voluntario($data)
    {
        extract($data);
        $this->execute("delete from evento_jovenes where id='$evento'");
    }
    function get_patrocinadores()
    {
        return $this->get_data('select * from patrocinadores');
    }
    function insert_patrocinadores($data)
    {
        extract($data);
        foreach ($patrocinios as $lista) {
            $this->execute("call insert_patrocinio_evento('$evento','$lista');");
        }
    }
    function get_evento_patrocinio($id)
    {
        return $this->get_data("call get_evento_patrocinio('$id');");
    }
    function insert_comentario($data)
    {
        extract($data);
        print_r($this->execute("call insert_comentario('$evento_mensaje','$mensaje')"));
    }
    function get_comentarios($id)
    {
        return $this->get_data("select * from comentarios where id_evento='$id';");
    }
    function delete_comentario($data)
    {
        extract($data);
        $this->execute("delete from comentarios where id_evento='$evento' and id_comentario='$comentario'");
    }

    function insert_asistente($id, $data)
    {
        extract($data);
        $this->execute("call insert_asistente('$id','$nombre','$genero','$fecha','$telefono','$cedula','$tipo','$miembros');");
    }
    function get_asistentes_enlistado($id)
    {
        return $this->get_data("select * from asistentes where id_evento='$id'");
    }
    function get_asistentes_externo($id)
    {
        return $this->get_data("select * from asistentes where id_evento='$id' and asistio=1");
    }
    function delete_asistente($data)
    {
        extract($data);
        $this->execute("delete from asistentes where id_evento='$evento' and id_asistente='$asistente'");
    }
    function delete_patrocinador($data)
    {
        extract($data);
        $this->execute("delete from evento_patrocinio where id_evento='$evento' and id_patrocinador='$patrocinador'");
    }


    function insert_galeria($data)
    {
        extract($data);
        $imagen = 'assets/galeria/';
        $imagen = $this->cargar_foto($imagen);
        $this->execute("insert into galeria_evento(id_evento,foto) values('$id','$imagen');");
    }

    function get_galeria($id)
    {
        return $this->get_data("select * from galeria_evento where id_evento='$id';");
    }
    function update_evento($data)
    {
        extract($data);
        $destino = $documento;

        if ($_FILES['guia']['name'] != null) {
            $destino = 'assets/cartas/eventos/';
            $destino = $this->cargar($destino);
            unlink($documento);
        }
        $this->execute("call update_evento('$id','$facilitador','$joven','$nombre','$descripcion','$fecha','$hora_inicio','$hora_cierre',
                '$lugar','$direccion_lugar','$destino','$categoria','$objectivo')");
    }
    function insert_joven_asistencia($data)
    {
        extract($data);
        if (isset($jovenes)) {
            foreach ($jovenes as $lista) {
                $this->execute("call update_evento_joven('$lista')");
            }
        }
        if (isset($asistente)) {
            foreach ($asistente as $lista) {
                $this->execute("update asistentes set asistio=1 where id_asistente='$lista'");
            }
        }
    }

    function dar_baja($data)
    {
        extract($data);
        if (isset($joven)) {
            $this->execute("update evento_jovenes set asistio=0 where id_joven='$joven' and id_evento='$id'");
        }
        if (isset($asistente)) {
                $this->execute("update asistentes set asistio=0 where id_asistente='$asistente'");
        }
    }

    function insert_asistencia_evento($data)
    {
        extract($data);
    }
    function get_asistencia_jovenes($id)
    {
        return $this->get_data("call get_asistencia_jovenes('$id')");
    }

    function get_asistencia_externa($id)
    {
        return $this->get_data("call get_asistencias_externa('$id')");
    }
    function get_id()
    {
        $sql = "select * from eventos
        order by id_evento desc
        limit 1";
        $result = $this->get_data($sql);
        return $result[0]['id_evento'];
    }
    function delete_galeria($data)
    {
        extract($data);
        $this->execute("delete from galeria_eventos where id_galeria='$foto'");
        unlink($direccion);
    }
    function cargar_foto($destino)
    {

        $foto = $_FILES['foto'];
        $destino = $destino . rand(1, 10) . rand(1, 10) . rand(1, 10) . $foto['name'];
        move_uploaded_file($foto['tmp_name'], $destino);

        return $destino;
    }
    function get_asistencia($id, $minimo, $maximo)
    {
        return $this->get_data("call get_asistencia_evento('$id','$minimo','$maximo')");
    }
    function delete_patrocinios_evento($id)
    {
        $this->execute("delete from evento_patrocinio where id_evento='$id';");
    }
    function delete_voluntarios_evento($id)
    {
        $this->execute("delete from asistentes where id_evento='$id';");
    }
    function delete_galeria_evento($id)
    {
        $this->execute("delete from galeria_eventos where id_evento='$id';");
    }
    function delete_jovenes_evento($id)
    {
        $this->execute("delete from evento_jovenes where id_evento='$id';");
    }
    function delete_evento($id)
    {
        $this->delete_galeria_evento($id);
        $this->delete_jovenes_evento($id);
        $this->delete_voluntarios_evento($id);
        $this->delete_patrocinios_evento($id);
        $this->execute("delete from eventos where id_evento='$id'");
    }
}
