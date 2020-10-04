<?php
require_once('gui.php');
require_once('ln/ln_seguimiento.php');
class ui_seguimiento extends gui
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
        $ui = $this->ln->db->get_seguimiento($_GET['id_seguimiento'])[0]; ?>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Personal</span></a> </li>
            <li class="nav-item"> <a class="nav-link active show" href="seguimientos.php?id=<?= $ui['id_joven'] ?>" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Seguimiento</span></a> </li>
            <li class="nav-item"> <a class="nav-link" href="nucleo_familiar.php?id=<?= $_GET['id'] ?>" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Nucleo Familiar</span></a> </li>

        </ul>
        <!-- Tab panes -->
        <div class="tab-content tabcontent-border">
            <div class="tab-pane p-20 active show" id="home" role="tabpanel">
            </div>


            <div class="tab-pane p-20 active show" id="seguimiento" role="tabpanel">

                <div class="p-20" >

                    <div class="row">

                        <div class="col-md-12">

                            <div class="card" style="background-color: #eeeeee;">
                                <div class="card-header bg-white">
                                    <div class="clearfix">
                                        <div class="float-left">
                                        <a class="btn btn-secondary" href="seguimientos.php?id=<?= $ui['id_joven'] ?>">Historial</a>
                                        </div>
                                        <div class="float-right">
                                            <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#my-modal">Editar</button>
                                            <a class="btn btn-secondary" target="blank" href="pdfs.php?action=seguimiento&id=<?= $_GET['id_seguimiento'] ?>">Exportar</a>

                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <br>

                                    <h2 class="card-title"><?= $ui['nombre'] . ' ' . $ui['primer_apellido'] ?></h2>
                                    <hr>
                                    <h5>Asunto: <?= $ui['asunto'] ?></h5>
                                    <hr>
                                    <h5>Fecha: <?= $ui['dia'] ?></h5>
                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card shadow">
                                                <div class="card-header">
                                                    <div class="clearfix">
                                                        <div class="float-left">
                                                            <h4>Facilitadores</h4>
                                                        </div>
                                                        <div class="float-right">
                                                            <span class="btn btn-primary mr-4" data-toggle="modal" data-target="#facilitadores">Incribir</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body eventos">


                                                    <table class="table table-light">
                                                        <tbody>
                                                            <?php foreach ($this->ln->db->get_facilitadores_seguimiento($_GET['id_seguimiento']) as $facilitador) { ?>
                                                                <tr>
                                                                    <td><?= $facilitador['nombre'] . ' ' . $facilitador['primer_apellido'] . ' ' . $facilitador['segundo_apellido'] ?></td>
                                                                    <td><a href="seguimiento.php?action=delete_facilitador&id=<?= $facilitador['id_usuario'] ?>&id_seguimiento=<?= $_GET['id_seguimiento'] ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="card shadow">
                                                <div class="card-header">
                                                    <h4>Observaciones</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div id="accordion">
                                                        <div class="card">
                                                            <div class="card-header" id="headingOne">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#ver_observacion" aria-expanded="true" aria-controls="collapseOne">
                                                                        Ver Observaciones
                                                                    </button>
                                                                </h5>
                                                            </div>

                                                            <div id="ver_observacion" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                                <div class="card-body eventos">
                                                                    <?php foreach ($this->ln->db->get_observacion($_GET['id_seguimiento']) as $observacion) { ?>
                                                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                                            <strong><?= $observacion['mensaje'] ?></strong>
                                                                            <br>
                                                                            <small>Publicado: <?= $observacion['nombre'] . ' ' . $observacion['primer_apellido'] . ' ' . $observacion['segundo_apellido'] ?></small>
                                                                            <br>
                                                                            <small>Fecha: <?= $observacion['dia'] ?></small>
                                                                            <a class="close" href="seguimiento.php?action=delete_observacion&id_seguimiento=<?= $_GET['id_seguimiento'] ?>&id=<?= $observacion['id_observacion'] ?>" class="close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </a> </div>
                                                                    <?php } ?>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <form action="seguimiento.php?action=insert_observacion&id_seguimiento=<?= $_GET['id_seguimiento'] ?>" method="post">
                                                        <div class="form-group">
                                                            <input type="hidden" name="id" value="<?= $_GET['id_seguimiento'] ?>">
                                                            <input type="hidden" name="facilitador" value="<?= json_decode($_COOKIE['ONG'], true)['id'] ?>">
                                                            <textarea class="form-control" placeholder="Agregue un Observacion" name="mensaje" rows="3"></textarea>
                                                            <br>
                                                            <button type="submit" class="btn btn-success">Agregar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-sm-6">

                                            <div class="card shadow">
                                                <div class="card-header">
                                                    <div class="clearfix">
                                                        <div class="float-left">
                                                            <h4>Datos</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">

                                                    <form method="post" action="seguimiento.php?action=update_documento&id_seguimiento=<?= $_GET['id_seguimiento'] ?>" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label>Documento</label>
                                                            <input class="form-control" type="file" name="guia">
                                                            <br>
                                                            <button type="submit" class="btn btn-success">Agregar</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                            <div class="card shadow">
                                                <div class="card-header">
                                                    <h4>Recomendaciones</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div id="accordion">
                                                        <div class="card">
                                                            <div class="card-header" id="headingOne">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#ver_recomendacion" aria-expanded="true" aria-controls="collapseOne">
                                                                        Ver Recomendaciones
                                                                    </button>
                                                                </h5>
                                                            </div>

                                                            <div id="ver_recomendacion" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                                <div class="card-body eventos">

                                                                    <?php foreach ($this->ln->db->get_recomendacion($_GET['id_seguimiento']) as $recomendacion) { ?>
                                                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                                            <strong><?= $recomendacion['mensaje'] ?></strong>
                                                                            <br>
                                                                            <small>Publicado: <?= $recomendacion['nombre'] . ' ' . $recomendacion['primer_apellido'] . ' ' . $recomendacion['segundo_apellido'] ?></small>
                                                                            <br>
                                                                            <small>Fecha: <?= $recomendacion['dia'] ?></small>
                                                                            <a class="close" href="seguimiento.php?action=delete_recomendacion&id_seguimiento=<?= $_GET['id_seguimiento'] ?>&id=<?= $recomendacion['id_recomendacion'] ?>" class="close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </a> </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <form action="seguimiento.php?action=insert_recomendacion&id_seguimiento=<?= $_GET['id_seguimiento'] ?>" method="post">
                                                        <div class="form-group">
                                                            <input type="hidden" name="id" value="<?= $_GET['id_seguimiento'] ?>">
                                                            <input type="hidden" name="facilitador" value="<?= json_decode($_COOKIE['ONG'], true)['id'] ?>">
                                                            <textarea class="form-control" placeholder="Agregue un Recomendacion" name="mensaje" rows="3"></textarea>
                                                            <br>
                                                            <button type="submit" class="btn btn-success">Agregar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="facilitadores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-orange text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Seleccion de Facilitadores</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="seguimiento.php?action=insert_facilitadores&id_seguimiento=<?= $_GET['id_seguimiento'] ?>" method="post">

                        <div class="modal-body">

                            <div class="clearfix p-1">
                                <div class="float-left">

                                </div>
                                <div class="float-right">


                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?= $_GET['id_seguimiento'] ?>">
                            <table class="table table-light inscripciones">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Seleccionar</th>
                                        <th>Nombre</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($this->ln->db->get_usuarios() as $faciltador) { ?>
                                        <tr>
                                            <td><input type="checkbox" name="facilitadores[]" value="<?= $faciltador['id_usuario'] ?>"></td>
                                            <td><?= $faciltador['nombre'] . ' ' . $faciltador['primer_apellido'] . ' ' . $faciltador['segundo_apellido'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Editar datos</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-content">
                        <div class="modal-body">

                            <form method="post" action="seguimiento.php?action=update&id_seguimiento=<?= $_GET['id_seguimiento'] ?>" enctype="multipart/form-data">
                                <input type="hidden" name="id_seguimiento" value="<?= $_GET['id_seguimiento'] ?>">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input class="form-control" type="date" name="fecha" value="<?= $ui['fecha'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Asunto</label>
                                    <input class="form-control" type="text" name="asunto" value="<?= $ui['asunto'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Documento</label>
                                    <input class="form-control" type="file" name="guia_modificada">
                                    <br>
                                </div>
                                <input type="hidden" name="documento" value="<?= $ui['documento'] ?>">

                                <hr>
                                <button type="submit" class="btn btn-success">Actualizar</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
    <?php
    }
}
    ?>