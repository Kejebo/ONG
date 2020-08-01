<?php
require_once('gui.php');
require_once('ln/ln_reunion.php');
class ui_reunion extends gui
{
    var $ln;

    function __construct()
    {
        $this->ln = new ln_reunion();
    }
    function controller()
    {
        $this->ln->controller();
    }

    function get_build()
    {
        $ui = ""; //$this->ln->db->get_joven($_GET['id'])[0]; 
?>
        <!-- Tab panes -->
        <div class="">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="clearfix">
                                <div class="float-left">
                                    <h3> Modulo de Reuniones </h3>
                                </div>
                                <div class="float-right mr-2">
                                    <span class="btn btn-primary mr-4" data-toggle="modal" data-target="#nuevo">Nueva reunion</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">

                            <table id="zero_config" class="table table-light">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>#Reunion</th>
                                        <th>Elaborado</th>
                                        <th>Asunto</th>
                                        <th>Acta</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($this->ln->db->get_reuniones() as $reunion) { ?>
                                        <tr>
                                            <td><?= $reunion['fecha'] ?></td>
                                            <td><?= $reunion['numero'] ?></td>
                                            <td><?= $reunion['nombre'].' '.$reunion['primer_apellido'].' '.$reunion['segundo_apellido'] ?></td>
                                            <td><?= $reunion['objectivo'] ?></td>
                                            <td><a target="_blank" href="actas.php?id_reunion=<?= $reunion['id_reunion'] ?>" class="btn btn-dark"><i class="fas fa-file-pdf"></i></a></td>
                                            <td><a href="acta.php?id_reunion=<?= $reunion['id_reunion'] ?>" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
                                            <td><a href="reunion.php?action=delete&id=<?= $reunion['id_reunion'] ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>

                                        </tr>

                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-center text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Crear Reunion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form method="post" action="reuniones.php?action=insert" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="my-input">Fecha</label>
                                        <input id="my-input" class="form-control" type="date" name="fecha">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>#Reunion</label>
                                        <input type="number" name="numero" class="form-control">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Objectivo</label>
                                    <input class="form-control" name="objectivo">
                                </div>
                                <div class="form-group">
                                    <label>Lugar</label>
                                    <input class="form-control" name="lugar">
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>Hora inicio</label>
                                        <input type="time" name="inicio" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Hora Finalizacion</label>
                                        <input type="time" name="final" class="form-control">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">Guardar</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>