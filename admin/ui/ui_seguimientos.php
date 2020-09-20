<?php
require_once('gui.php');
require_once('ln/ln_seguimiento.php');
class ui_seguimientos extends gui
{
    var $ln;

    function __construct()
    {
        $this->ln = new ln_seguimiento();
    }
    function controller()
    {
        $this->ln->controller();
    }

    function get_build()
    {
        $ui = $this->ln->db->get_joven($_GET['id'])[0]; ?>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"> <a class="nav-link" href="expedientes.php?action=update_joven&id=<?= $_GET['id'] ?>" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Personal</span></a> </li>
            <li class="nav-item"> <a class="nav-link  active show" href="seguimientos.php?id=<?= $_GET['id'] ?>" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Seguimiento</span></a> </li>
            <li class="nav-item"> <a class="nav-link  active show" href="nucleo_familiar.php?id=<?= $_GET['id'] ?>" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Nucleo Familiar</span></a> </li>

        </ul>
        <!-- Tab panes -->
        <div class="tab-content tabcontent-border">
            <div class="tab-pane p-20" id="home" role="tabpanel">
            </div>
            <div class="tab-pane p-20 active show" id="seguimiento" role="tabpanel">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="clearfix">
                                    <div class="float-left">
                                        <h3> Historial de Seguimientos </h3>
                                    </div>
                                    <div class="float-right mr-2">
                                        <a href="pdfs.php?id=<?=$_GET['id']?>" class="btn btn-primary mr-4"><i class="far fa-plus-square"></i> Exportar</a>
                                        <span class="btn btn-primary mr-4" data-toggle="modal" data-target="#nuevo"><i class="far fa-plus-square"></i> INCRIBIR</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Joven: <?= $ui['nombre'] . ' ' . $ui['primer_apellido'] ?></h4>

                                <table id="zero_config" class="table table-light">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Ultima Edicion</th>
                                            <th>Archivo</th>
                                            <th>Asunto</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            <th>Exportar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->ln->db->get_seguimientos($_GET['id']) as $seguimientos) { ?>
                                            <tr>
                                                <td><?= $seguimientos['fecha'] ?></td>
                                                <td><?= $seguimientos['nombre'] . ' ' . $seguimientos['primer_apellido'] . ' ' . $seguimientos['segundo_apellido'] ?></td>
                                                <td><a href="<?= $seguimientos['documento'] ?>" download class="btn btn-dark"><i class="fas fa-download"></i></a></td>
                                                <td><?= $seguimientos['asunto'] ?></td>
                                                <td><a href="seguimiento.php?id_seguimiento=<?= $seguimientos['id_seguimiento'] ?>" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
                                                <td><a href="seguimiento.php?id=<?= $seguimientos['id_seguimiento'] ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                                                <td><a href="informes.php?id=<?= $seguimientos['id_seguimiento'] ?>" class="btn btn-dark"><i class="fas fa-file-pdf"></i></a></td>
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
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">Generar Seguimiento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="seguimientos.php?action=insert" enctype="multipart/form-data">
                                <input type="hidden" name="joven" value="<?= $_GET['id'] ?>">
                                <div class="form-group">
                                    <label for="my-input">Fecha</label>
                                    <input id="my-input" class="form-control" type="date" name="fecha">
                                </div>
                                <div class="form-group">
                                    <label>Asunto</label>
                                    <textarea id="my-textarea" class="form-control" name="asunto" rows="3"></textarea>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-block">Guardar</button>
                        </div>
                        </form>
                    </div>
                </div>
        <?php
    }
}

        ?>