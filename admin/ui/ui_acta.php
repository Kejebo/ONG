<?php
require_once('gui.php');
require_once('ln/ln_reunion.php');
class ui_acta extends gui
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
        $ui = $this->ln->db->get_reunion($_GET['id_reunion']);
?>
        <!-- Tab panes -->


        <nav aria-label="Page breadcrumb ">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item" aria-current="page"><a class="btn btn-info" href="reuniones.php">Regresar</a></li>

            </ol>

        </nav>
        <div class="container">
            <div class="clearfix">
                <div class="float-left">

                </div>
                <div class="float-right">
                    <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#my-modal"> <i class="far fa-edit"></i> Editar</button>
                    <a href="actas.php?id_reunion=<?= $_GET['id_reunion'] ?>" target="blank" class="btn btn-dark"><i class="fas fa-download"></i> Exportar</a>

                </div>
            </div>
            <h4 class="card-title">Acta de Reunion #<?= $ui['numero'] ?></h4>
            <hr>
            <h6 class="card-title">Motivo:<strong> <?= $ui['objectivo'] ?></strong></h6>
            <hr>
            <h6 class="card-title">Lugar: <strong><?= $ui['lugar'] ?></strong></h6>
            <hr>
            <label class="card-text  pr-3">Fecha: <strong><?= $ui['dia'] ?></strong> </label>
            <label class="card-text pr-3"> Hora de Inicio: <strong><?= $ui['inicio'] ?></strong> </label>
            <label class="card-text  pr-3"> Hora de Finalizacion: <strong><?= $ui['cierre'] ?></strong></label>


            <div class="row">
                <div class="col-sm-12 p-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <h3>Agenda</h3>
                        </div>
                        <div class="card-body">
                            <form action="" onsubmit="agenda(this)" method="post" class="p-3 row">

                                <div class="form-group col-sm-6">
                                    <label>Encargado</label>
                                    <input class="form-control" type="text" id="encargado_agenda">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Actividad</label>
                                    <input class="form-control" type="text" id="actividad_agenda">
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success">Agregar</button>
                            </form>
                            <table class="table table-light">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Actividad</th>
                                        <th>Encargado</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="agenda">
                                    <?php
                                    foreach ($this->ln->db->get_agendas($_GET['id_reunion']) as $agenda) { ?>
                                        <tr>
                                            <td><?= $agenda['actividad'] ?></td>
                                            <td><?= $agenda['encargado'] ?></td>
                                            <td><a href="acta.php?action=delete_agenda&id=<?= $agenda['id_agenda'] ?>&id_reunion=<?= $_GET['id_reunion'] ?>" class="btn btn-danger">-</a></td>

                                        </tr>

                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-sm-12 p-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <h3>Asistentes</h3>
                        </div>
                        <div class="card-body">
                            <form action="" onsubmit="asistencia(this)" method="post" class="p-3 row">
                                <input type="hidden" name="id" value="<?= $_GET['id_reunion'] ?>">
                                <div class="form-group col-sm-6">
                                    <label>Nombre</label>
                                    <input class="form-control" type="text" id="encargado_asistencia">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Representando</label>
                                    <input class="form-control" type="text" id="representa">
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success">Agregar</button>
                            </form>

                            <table class="table table-light">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Representando</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="asistencia">
                                    <?php
                                    foreach ($this->ln->db->get_asistencia($_GET['id_reunion']) as $asistencia) { ?>
                                        <tr>
                                            <td><?= $asistencia['encargado'] ?></td>
                                            <td><?= $asistencia['representa'] ?></td>
                                            <td><a href="acta.php?action=delete_asistencia&id=<?= $asistencia['id_asistencia'] ?>&id_reunion=<?= $_GET['id_reunion'] ?>" class="btn btn-danger">-</a></td>

                                        </tr>

                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-sm-12 p-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Acuerdos</h3>
                        </div>
                        <div class="card-body shadow">
                            <form action="" onsubmit="acuerdos(this)" method="post" class="p-3 row">
                                <div class="form-group col-sm-6">
                                    <label>Responsable</label>
                                    <input class="form-control" type="text" id="encargado_acuerdo" name="encargado">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Acuerdo</label>
                                    <input class="form-control" type="text" id="actividad_acuerdo" name="actividad">
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success">Agregar</button>
                            </form>

                            <table class="table table-light">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Acuerdo</th>
                                        <th>Responsable</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="acuerdo">
                                    <?php
                                    foreach ($this->ln->db->get_acuerdos($_GET['id_reunion']) as $acuerdos) { ?>
                                        <tr>
                                            <td><?= $acuerdos['actividad'] ?></td>
                                            <td><?= $acuerdos['encargado'] ?></td>
                                            <td><a href="acta.php?action=delete_acuerdo&id=<?= $acuerdos['id_acuerdo'] ?>&id_reunion=<?= $_GET['id_reunion'] ?>" class="btn btn-danger">-</a></td>

                                        </tr>

                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-sm-12 p-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <h3>Asuntos Discutidos</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" onsubmit="asuntos(this)" class="p-3 row">
                                <input type="hidden" id="id" value="<?= $_GET['id_reunion'] ?>">
                                <div class="form-group col-sm-12">
                                    <label>Asunto</label>
                                    <textarea name="asunto" id="asunto" class="form-control bg-light" rows="2"></textarea>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success">Agregar</button>
                            </form>
                            <table class="table table-light">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Asunto</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="asuntos">
                                    <?php
                                    foreach ($this->ln->db->get_asuntos($_GET['id_reunion']) as $asunto) { ?>
                                        <tr>
                                            <td><?= $asunto['actividad'] ?></td>
                                            <td><a href="acta.php?action=delete_asunto&id=<?= $asunto['id_asunto'] ?>&id_reunion=<?= $_GET['id_reunion'] ?>" class="btn btn-danger">-</a></td>

                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-center text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Editar Reunion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="acta.php?action=update&id_reunion=<?= $_GET['id_reunion'] ?>">
                            <div class="form-group">
                                <label>Fecha</label>
                                <input class="form-control" type="date" name="fecha" value="<?= $ui['fecha'] ?>">
                            </div>
                            <div class="form-group">
                                <label>#Reunion</label>
                                <input type="number" name="numero" class="form-control" value="<?= $ui['numero'] ?>">
                            </div>

                            <div class="form-group">
                                <label>Objectivo</label>
                                <input class="form-control" name="objectivo" value="<?= $ui['objectivo'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Lugar</label>
                                <input class="form-control" name="lugar" value="<?= $ui['lugar'] ?>">
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>Hora inicio</label>
                                    <input type="time" name="inicio" class="form-control" value="<?= $ui['hora_inicio'] ?>">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Hora Finalizacion</label>
                                    <input type="time" name="final" class="form-control" value="<?= $ui['hora_final'] ?>">
                                </div>

                            </div>
                            <button type="submit" class="btn btn-success btn-block">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>