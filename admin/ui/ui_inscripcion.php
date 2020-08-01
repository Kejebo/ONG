<?php
require_once('gui.php');
require_once('ln/ln_evento.php');
class ui_inscripcion extends gui
{
    var $ln;
    function __construct()
    {
        $this->ln = new ln_evento();
    }
    function controller()
    {
        $this->ln->controller();
    }

    function get_build()
    {
        $ui = $this->ln->db->get_evento($_GET['id'])[0];
?>
        <nav aria-label="Page breadcrumb ">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item" aria-current="page"><a class="btn btn-info" href="eventos.php">Eventos</a></li>
                <li class="breadcrumb-item" aria-current="page"><a class="btn btn-info active" href="inscripciones.php?id=<?= $_GET['id'] ?>">Inscripciones</a></li>
                <li class="breadcrumb-item" aria-current="page"><a class="btn btn-info" href="galeria.php?id=<?= $_GET['id'] ?>">Galería</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-info" href="asistencia.php?id=<?= $_GET['id'] ?>">Asistencia</a></li>

            </ol>

        </nav>
        <div class="container">
            <h2 class="card-title"><?= $ui['nombre_evento'] ?></h2>
            <label class="card-text">Fecha: <?= $ui['dia'] ?></label>
            <hr>
            <label class="card-text pr-3">Hora de Inicio: <?= $ui['inicio'] ?> </label>
            <label class="card-text">Hora de Finalizacion: <?= $ui['cierre'] ?></label>

            <div class="row">
                <div class="col-sm-6">


                    <div class="card shadow">
                        <div class="card-header">
                            <div class="clearfix">
                                <div class="float-left">
                                    <h4>Jovenes Incritos</h4>
                                </div>
                                <div class="float-right">
                                    <span class="btn btn-primary mr-4" data-toggle="modal" data-target="#jovenes"><i class="fas fa-user-plus"></i> INCRIBIR</span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body eventos">

                            <table class="table table-light">
                                <tbody>
                                    <?php foreach ($this->ln->db->get_voluntarios($_GET['id']) as $jovenes) { ?>
                                        <tr>
                                            <td><?= $jovenes['cedula'] ?></td>
                                            <td><?= $jovenes['nombre'] . ' ' . $jovenes['primer_apellido'] . ' ' . $jovenes['segundo_apellido'] ?></td>
                                            <td><a href="inscripciones.php?action=delete_voluntario&id=<?= $_GET['id'] ?>&evento=<?= $_GET['id'] ?>&joven=<?= $jovenes['id_joven'] ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="clearfix">
                                <div class="float-left">
                                    <h4>Otros Asistentes</h4>
                                </div>
                                <div class="float-right">
                                    <span class="btn btn-primary mr-4" data-toggle="modal" data-target="#asistente"><i class="fas fa-user-plus"></i> INCRIBIR</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body eventos">

                            <table class="table table-light">
                                <tbody>
                                    <?php foreach ($this->ln->db->get_asistentes_enlistado($_GET['id']) as $asistente) { ?>
                                        <tr>
                                            <td><?= $asistente['cedula'] ?></td>
                                            <td><?= $asistente['nombre_completo'] ?></td>
                                            <td><a href="inscripciones.php?action=delete_asistente&id=<?= $_GET['id'] ?>&evento=<?= $_GET['id'] ?>&asistente=<?= $asistente['id_asistente'] ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Comentarios</h4>
                        </div>
                        <div class="card-body">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#ver" aria-expanded="true" aria-controls="collapseOne">
                                                Ver Comentarios
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="ver" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body eventos">

                                            <?php foreach ($this->ln->db->get_comentarios($_GET['id']) as $comentarios) { ?>

                                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                    <strong><?= $comentarios['descripcion'] ?></strong>
                                                    <a class="close" href="inscripciones.php?action=delete_comentario&id=<?= $_GET['id'] ?>&evento=<?= $_GET['id'] ?>&comentario=<?= $comentarios['id_comentario'] ?>" class="close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </a> </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <form action="inscripciones.php?action=comentario&id=<?= $_GET['id'] ?>" method="post">
                                <div class="form-group">
                                    <input type="hidden" name="evento_mensaje" value="<?= $_GET['id'] ?>">
                                    <textarea class="form-control" placeholder="Agregue un comentario" name="mensaje" rows="3"></textarea>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
                <div class="col-sm-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Detalles</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-3">Descripcion</label>
                                <label style="font-weight: unset" class="col-9"><?= $ui['descripcion'] ?></label>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-3">Responsable</label>
                                <label style="font-weight: unset" class="col-9"><?= $ui['mentor'] ?></label>
                            </div>

                        </div>
                    </div>

                    <div class="card shadow">
                        <div class="card-header">
                            <div class="clearfix">
                                <div class="float-left">
                                    <h4>Patrocinadores</h4>
                                </div>
                                <div class="float-right">
                                    <span class="btn btn-primary mr-4" data-toggle="modal" data-target="#patrocinadores"><i class="fas fa-user-plus"></i> AGREGAR</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body eventos">


                            <table class="table table-light">
                                <tbody>
                                    <?php foreach ($this->ln->db->get_evento_patrocinio($_GET['id']) as $patrocinador) { ?>
                                        <tr>
                                            <td><?= $patrocinador['institucion'] ?></td>
                                            <td><a href="inscripciones.php?action=delete_patrocinador&id=<?= $_GET['id'] ?>&evento=<?= $_GET['id'] ?>&patrocinador=<?= $patrocinador['id_patrocinador'] ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Asistencia</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-light text-center">
                                <thead>
                                    <th>Edad</th>
                                    <th>Mujeres</th>
                                    <th>Hombres</th>

                                </thead>
                                <tbody>
                                    <?php
                                    $lista = null;
                                    $hombres = 0;
                                    $mujeres = 0;
                                    for ($i = 0; $i < 3; $i++) {
                                    ?> <tr>
                                            <?php
                                            if ($i == 0) {
                                                $lista = $this->ln->db->get_asistencia($_GET['id'], '0', '15')[0];
                                            ?>
                                                <td>De 14 años</td>
                                                <td><?= $lista['mujeres'] ?></td>
                                                <td><?= $lista['hombres'] ?></td>
                                            <?php
                                            } else if ($i == 1) {
                                                $lista = $this->ln->db->get_asistencia($_GET['id'], '16', '25')[0];
                                            ?>
                                                <td>De 15 a 24 años</td>
                                                <td><?= $lista['mujeres'] ?></td>
                                                <td><?= $lista['hombres'] ?></td>
                                            <?php
                                            } else {
                                                $lista = $this->ln->db->get_asistencia($_GET['id'], '26', '100')[0];
                                            ?>
                                                <td>De 25 a mas años</td>
                                                <td><?= $lista['mujeres'] ?></td>
                                                <td><?= $lista['hombres'] ?></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    <?php
                                        $hombres += $lista['hombres'];
                                        $mujeres += $lista['mujeres'];
                                    }  ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th><?= $mujeres ?></th>
                                        <th><?= $hombres ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="jovenes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-orange text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Seleccionar Jovenes</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="inscripciones.php?action=voluntarios&id=<?= $_GET['id'] ?>" method="post">

                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                            <table id="zero_config" class="table table-light inscripciones">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Seleccionar</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($this->ln->db->get_jovenes() as $jovenes) { ?>
                                        <tr>
                                            <td><input type="checkbox" name="jovenes[]" value="<?= $jovenes['id_joven'] ?>" id=""></td>
                                            <td><?= $jovenes['cedula'] ?></td>
                                            <td><?= $jovenes['nombre'] . ' ' . $jovenes['primer_apellido'] . ' ' . $jovenes['segundo_apellido'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-block">Agregar</button>

                    </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="modal fade" id="patrocinadores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-orange text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Seleccionar Patrocinadores</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body table-responsive">
                        <form action="inscripciones.php?action=insert_patrocinios&id=<?= $_GET['id'] ?>" method="post">
                            <input type="hidden" name="evento" value="<?= $_GET['id'] ?>">
                            <table class="table table-light inscripciones">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Seleccionar</th>
                                        <th>Nombre</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($this->ln->db->get_patrocinadores() as $patrocinios) { ?>
                                        <tr>
                                            <td><input type="checkbox" name="patrocinios[]" value="<?= $patrocinios['id_patrocinador'] ?>"></td>
                                            <td><?= $patrocinios['institucion'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </form>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">Agregar</button>
    </div>
                </div>
            </div>
        </div>

        <div class="modal fade p-3" id="asistente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-orange text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Asistente</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="inscripciones.php?action=asistente&id=<?= $_GET['id'] ?>" method="post">
                            <div class="form-group">
                                <label for="my-select">Tipo de Asistente</label>
                                <select class="form-control" name="tipo">
                                    <option value="Visitante">Visitante</option>
                                    <option value="Representante">Representante</option>
                                    <option value="Apoyo">Apoyo</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Fecha Nacimiento</label>
                                <input class="form-control" type="date" name="fecha">
                            </div>
                            <div class="form-group">
                                <label>Nombre Completo</label>
                                <input class="form-control" type="text" name="nombre">
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>Cedula</label>
                                    <input class="form-control" type="text" name="cedula">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Telefono</label>
                                    <input class="form-control" type="text" name="telefono">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Genero</label>
                                <select name="genero" class="form-control">
                                    <?php foreach ($this->get_genero() as $genero) { ?>
                                        <option value="<?= $genero ?>"><?= $genero ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-block">Agregar</button>

                    </div>
                    </form>

                </div>
            </div>
        </div>

<?php
    }
}
?>