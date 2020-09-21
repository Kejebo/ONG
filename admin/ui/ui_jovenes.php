<?php
require_once('gui.php');
require_once('ln/ln_joven.php');
class ui_jovenes extends gui
{
    var $ln;

    function __construct()
    {
        $this->ln=new ln_joven();
    }
    function estados($data){
        if($data==1){

        }
    }
    function get_build()
    {
?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="clearfix">
                            <div class="float-left">
                               <h3> Lista de Jovenes </h3>
                            </div>
                            <div class="float-right mr-2">
                                <a href="joven.php" class="btn btn-dark">+Nuevo</a>
                                <a href="excel.php?action=jovenes" class="btn btn-success"><i class="fas fa-file-excel"></i> Generar</a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table  id="zero_config" class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cedula</th>
                                    <th>Genero</th>
                                    <th>Estado Civil</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                    <th>Exportar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($this->ln->db->get_jovenes() as $lista){ ?>
                                <tr>
                                <td><?=$lista['nombre'].' '.$lista['primer_apellido'].' '.$lista['segundo_apellido']?></td>
                                <td><?=$lista['cedula']?></td>
                                <td><?=$lista['genero']?></td>
                                <td><?=$lista['estado_civil']?></td>
                                <td><?=$lista['fecha_nacimiento']?></td>
                                <td><?=$lista['status']?></td>
                                <td><a href="expedientes.php?action=update_joven&id=<?=$lista['id_joven']?>" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
                                <td><a href="jovenes.php?action=delete&id=<?=$lista['id_joven']?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                                <td><a href="pdf.php?action=exportar=<?=$lista['id_joven']?>" class="btn btn-dark"><i class="fas fa-file-pdf"></i></a></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

<?php
    }
}

?>