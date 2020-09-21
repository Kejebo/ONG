<?php
require_once('gui.php');
require_once('ln/ln_evento.php');
class ui_asistencia extends gui
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

?>
        <nav aria-label="Page breadcrumb ">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item" aria-current="page"><a class="btn btn-info" href="eventos.php">Eventos</a></li>
                <?php if (isset($_GET['id'])) { ?>
                    <li class="breadcrumb-item" aria-current="page"><a class="btn btn-info" href="inscripciones.php?id=<?= $_GET['id'] ?>">Incripciones</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a class="btn btn-info" href="galeria.php?id=<?= $_GET['id'] ?>">Galeria</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-info active" href="asistencia.php?id=<?= $_GET['id'] ?>">Asistencia</a></li>

                <?php } ?>
            </ol>
        </nav>
        <div class="p-3">
            <div class="row">
                <div class="col-sm-6 shadow">
                    <div class="card">
                        <div class="card-header">
                            <div class="clearfix">
                                <div class="float-left">
                                    <h4>Lista de Jovenes</h4>

                                </div>
                                <div class="float-right">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#jovenes">AGREGAR</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form_eventos" action="evento.php?action=update_voluntarios" method="post">
                                <table class="table table-light text-center zero_config">
                                    <thead class="bg-orange text-white text-uppercase">

                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Dar baja</th>

                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->ln->db->get_asistencia_jovenes($_GET['id']) as $jovenes) { ?>
                                            <tr>
                                                <td><?= $jovenes['cedula'] ?></td>
                                                <td><?= $jovenes['nombre'] . ' ' . $jovenes['primer_apellido'] . ' ' . $jovenes['segundo_apellido'] ?></td>
                                                <td><a href="inscripciones.php?action=delete_voluntario_asistencia&id=<?= $_GET['id'] ?>&evento=<?= $_GET['id'] ?>&joven=<?= $jovenes['id_joven'] ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 shadow">
                    <div class="card">
                        <div class="card-header">
                            <div class="clearfix">
                                <div class="float-left">
                                    <h4>Lista de Asistentes</h4>

                                </div>
                                <div class="float-right">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#asistente">AGREGAR</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form_eventos" action="evento.php?action=update_voluntarios" method="post">
                                <table class="table table-light text-center zero_config">
                                    <thead class="bg-orange text-white text-uppercase">

                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Dar baja</th>

                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->ln->db->get_asistencia_externa($_GET['id']) as $asistente) { ?>
                                            <tr>
                                                <td><?= $asistente['cedula'] ?></td>
                                                <td><?= $asistente['nombre_completo'] ?></td>
                                                <td><a href="inscripciones.php?action=delete_externo_asistencia" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>

                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                        <form action="inscripciones.php?action=add_voluntarios&id=<?= $_GET['id'] ?>" method="post">

                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                            <table class="table table-light zero_config">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Seleccionar</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($this->ln->db->get_voluntarios($_GET['id']) as $jovenes) { 
                                        if($jovenes['asistio']==0){
                                        ?>
                                     
                                        <tr>
                                            <td><input type="checkbox" name="jovenes[]" value="<?= $jovenes['id_joven'] ?>"></td>
                                            <td><?= $jovenes['cedula'] ?></td>
                                            <td><?= $jovenes['nombre'] . ' ' . $jovenes['primer_apellido'] . ' ' . $jovenes['segundo_apellido'] ?></td>
                                        </tr>
                                    <?php } }?>

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

        <div class="modal fade" id="asistente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-orange text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Seleccionar Jovenes</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="inscripciones.php?action=add_voluntarios&id=<?= $_GET['id'] ?>" method="post">

                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                            <table class="table table-light zero_config">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Seleccionar</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Tipo</th>

                                    </tr>
                                </thead>
                                <tbody>
                          

                                    <?php foreach ($this->ln->db->get_asistentes_enlistado($_GET['id']) as $asistente) { ?>
                                        <?php if($asistente['asistio']==0){?>
                                        <tr>
                                            <td><input type="checkbox" name="asistente[]" value="<?= $asistente['id_asistente'] ?>"></td>

                                            <td><?= $asistente['cedula'] ?></td>
                                            <td><?= $asistente['nombre_completo'] ?></td>
                                            <td><?= $asistente['tipo'] ?></td>

                                        </tr>
                                    <?php } }?>
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

<?php
    }
}
?>