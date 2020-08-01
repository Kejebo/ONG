<?php
    require_once('conexion.php');

        class db_sedes extends conexion{
            function insert_sede($data){
                extract($data);
                print($this->execute(
                    "insert into sedes(nombre_sede) values('$nombre')"
                ));
            }
            function update_sede($data){
                extract($data);
                $this->execute("update sedes s set s.nombre_sede='$nombre' where s.id_sede='$id'");
            }
            function    get_sedes(){
                return $this->get_data('select * from sedes where estado=1');
            }
            function get_sede($id){
                return $this->get_data("select * from sedes where id_sede='$id'");
            }
            function delete_sede($id){
                $this->execute("update sedes set estado=0 where id_sede='$id'");
            }
        }

?>