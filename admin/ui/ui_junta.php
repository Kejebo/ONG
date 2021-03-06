<?php
require_once('gui.php');
require_once('ln/ln_usuario.php');
class ui_junta extends gui
{
    var $ln;
    function __construct()
    {
        $this->ln = new ln_usuario();
    }
    function controller()
    {
        $this->ln->controller();
    }

    function get_build()
    {
        $patrocinador=null;
        $accion='insert_member';
?>
        <nav aria-label="Page breadcrumb ">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-info" href="reuniones.php"><i class="far fa-handshake"></i>  Reuniones</a></li>
            </ol>
        </nav>
            <div class="row p-3">
                <div class="col-sm-12 col-sm-12 col-md-4 col-lg-4">

                    <div class="card">
                        <div class="card-header">
                            <h4>Datos del Miembro</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <form action="junta.php?action=<?=$accion?>" method="post">
                            <input type="hidden" name="id" value="<?=$patrocinador['id_junta']?>">   
                            <div class="form-group">
                                    <label>Miembro</label>
                                    <select class="form-control" name="id_facilitador">
                                            <?php   
                                                foreach($this->ln->db->get_usuarios() as $facilitador){?>
                                                    <option value="<?=$facilitador['id_usuario']?>"><?= $facilitador['nombre'] . ' ' . $facilitador['primer_apellido'] . ' ' . $facilitador['segundo_apellido'] ?></option>
                                                <?php }
                                            ?>
                                        </select>                                </div>
                                <div class="form-group">
                                    <label>Puesto</label>
                                        <select class="form-control" name="puesto">
                                            <?php   
                                                foreach($this->ln->junta->get_puestos() as $junta){?>
                                                    <option value="<?=$junta['id_puesto']?>"><?=$junta['nombre']?></option>
                                                <?php }
                                            ?>
                                        </select>
                                </div>
                                <hr>
                                <div class="container text-center p-2">
                                    <button type="submit" class="btn btn-success btn-block">Guardar</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Miembro de la Junta Directiva</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="zero_config" class="table table-light">
                                <thead>
                                    <th>Miembro</th>
                                    <th>Puesto</th>
                                    <th>Telefono</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach($this->ln->junta->get_junta() as $miembros){?>

                                        <tr>
                                        <td><?= $miembros['nombre_f'] . ' ' . $miembros['primer_apellido'] . ' ' . $miembros['segundo_apellido'] ?></td>
                                        <td><?=$miembros['puesto']?></td>
                                        <td><?=$miembros['telefono']?></td>
                                        <td><a class="btn btn-warning"><i class="far fa-edit text-white"></i></a></td>
                                        <td><a class="btn btn-danger"><i class="far fa-trash-alt text-white"></i></a></td>
                                        </tr>
                                        <?php }
                                    ?>

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