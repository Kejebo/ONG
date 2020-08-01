<?php
    require_once('conexion.php');

        class db_patrocinio extends conexion{
            function cargar($destino)
            {
        
                $foto = $_FILES['logo'];
                $destino = $destino . rand(1, 10) . rand(1, 10) . rand(1, 10) . $foto['name'];
                move_uploaded_file($foto['tmp_name'], $destino);
        
                return $destino;
            }
        
            function insert_patrocinador($data){
                extract($data);
                $destino = 'assets/logos/patrocinador/';
                $destino = $this->cargar($destino);
                $this->execute(
                    "call insert_patrocinador('$institucion','$responsable','$direccion','$telefono','$correo','$cedula','$aportes','$destino','$visualizar')"
                );
            }
            function update_patrocinador($data){
                extract($data);
                extract($data);
                $destino = 'assets/logos/patrocinador/';
                $destino = $this->cargar($destino);
                $this->execute(" call update_patrocinador('$id','$institucion','$responsable','$direccion','$telefono','$correo','$cedula','$aportes','$destino','$visualizar')");
                }
            function get_patrocinadores(){
                return $this->get_data('select * from patrocinadores where estado=1');
            }
            function get_patrocinador($id){
                return $this->get_data("select * from patrocinadores where id_patrocinador='$id'");
            }
            function delete_patrocinador($id){
                $this->execute("update patrocinadores set estado=0 where id_patrocinador='$id'");
            }
        }

?>