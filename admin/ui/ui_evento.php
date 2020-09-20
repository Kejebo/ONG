<?php
require_once('gui.php');
require_once('ln/ln_evento.php');
class ui_evento extends gui
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
        $action = 'insert';
        $evento = null;
        if (isset($_GET['id'])) {
            $action = 'update';
            $evento = $this->ln->db->get_evento($_GET['id'])[0];
        }
?>
        <form class="form_eventos" action="evento.php?action=<?= $action ?>" method="post" enctype="multipart/form-data">
            <nav aria-label="Page breadcrumb ">
                <ol class="breadcrumb bg-dark">
                    <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-info" href="eventos.php">Eventos</a></li>
                    <?php if (isset($_GET['id'])) { ?>
                        <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-info" href="inscripciones.php?id=<?= $_GET['id'] ?>">Incripciones</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-info" href="galeria.php?id=<?= $_GET['id'] ?>">Galeria</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-info" href="asistencia.php?id=<?= $_GET['id'] ?>">Asistencia</a></li>

                    <?php } ?>
                </ol>
            </nav>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Datos del Evento</h4>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="id" value="<?= $evento['id_evento'] ?>">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input name="nombre" class="form-control" type="text" value="<?= $evento != null ? $evento['nombre_evento'] : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input name="fecha" class="form-control" type="date" value="<?= $evento['fecha'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Supervisor</label>
                                    <select name="facilitador" class="form-control">
                                        <?php foreach ($this->ln->db->get_usuarios() as $mentores) {
                                            if ($mentores['id_usuario'] == $evento['id_joven']) {
                                        ?>
                                                <option selected value="<?= $mentores['id_usuario'] ?>"><?= $mentores['nombre'] . ' ' .
                                                                                                            $mentores['primer_apellido'] . ' ' . $mentores['segundo_apellido']
                                                                                                            . ' / ' . $mentores['tipo'] ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?= $mentores['id_usuario'] ?>"><?= $mentores['nombre'] . ' ' .
                                                                                                    $mentores['primer_apellido'] . ' ' . $mentores['segundo_apellido'] . ' / ' . $mentores['tipo'] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Responsable</label>
                                    <select name="joven" class="form-control">
                                        <?php foreach ($this->ln->db->get_jovenes() as $jovenes) {
                                            if ($jovenes['id_joven'] == $evento['id_joven']) {
                                        ?>
                                                <option selected value="<?= $jovenes['id_joven'] ?>"><?= $jovenes['nombre'] . ' ' .
                                                                                                            $jovenes['primer_apellido'] . ' ' . $jovenes['segundo_apellido'] ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?= $jovenes['id_joven'] ?>"><?= $jovenes['nombre'] . ' ' .
                                                                                                $jovenes['primer_apellido'] . ' ' . $jovenes['segundo_apellido'] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <div class="input-group">
                                        <select name="categoria" id="categoria" class="form-control">
                                            <?php foreach ($this->ln->db->get_categorias() as $categorias) {
                                                if ($categorias['id_categoria'] == $evento['id_categoria']) {
                                            ?>
                                                    <option selected value="<?= $categorias['id_categoria'] ?>"><?= $categorias['nombre_categoria'] ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?= $categorias['id_categoria'] ?>"><?= $categorias['nombre_categoria'] ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <div class="input-group-prepend">
                                            <span class="btn btn-orange" type="button" data-toggle="modal" data-target="#categorias">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Objectivo</label>
                                    <div class="input-group">
                                        <select name="objectivo" id="objectivo" class="form-control">
                                            <?php foreach ($this->ln->db->get_objectivos() as $objectivos) {
                                                if ($objectivos['id_objectivo'] == $evento['id_objectivo']) {
                                            ?>
                                                    <option selected value="<?= $objectivos['id_objectivo'] ?>"><?= $objectivos['nombre_objectivo'] ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?= $objectivos['id_objectivo'] ?>"><?= $objectivos['nombre_objectivo'] ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <div class="input-group-prepend">
                                            <span class="btn btn-orange"data-toggle="modal" data-target="#objectivos">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>Hora de Inicio</label>
                                        <input name="hora_inicio" class="form-control" type="time" value="<?= $evento['hora_inicio'] ?>">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Hora de Cierre</label>
                                        <input name="hora_cierre" class="form-control" type="time" value="<?= $evento['hora_cierre'] ?>">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <textarea name="descripcion" class="form-control" id="" cols="30" rows="5"><?= $evento != null ? $evento['actividad'] : '' ?></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Sitio del Evento</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nombre del lugar</label>
                                    <input name="lugar" class="form-control" type="text" value="<?= $evento != null ? $evento['lugar'] : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Direccion del lugar</label>
                                    <textarea name="direccion_lugar" class="form-control" id="" cols="30" rows="3"><?= $evento != null ? $evento['direccion_lugar'] : '' ?></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Archivo de Guía</h4>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Archivo</label>
                                    <div class="input-group">
                                        <input name="guia" class="form-control" type="file" value="<?= $evento['archivo_guia'] ?>">
                                        <input type="hidden" name="documento" value="<?= $evento['archivo_guia'] ?>">
                                        <a href="<?= $evento['archivo_guia'] ?>" download class="btn btn-dark"><i class="fas fa-download"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="container text-center p-2">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="jovenes.php" class="btn btn-danger">Cancelar</a>

                </div>


            </div>
        </form>
        <div id="categorias" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-orange text-white">
                        <h5 class="modal-title" id="my-modal-title">Agregar Categoria</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input id="nombre_categoria" class="form-control" type="text" placeholder="Ingrese el nombre de la categoria">
                        </div>
                </div>
                    <div class="modal-footer">
                    <button class="btn btn-success btn-block" onclick="categoria()" >Agregar</button>
                </div>
                </div>
            </div>
        </div>

        <div id="objectivos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-orange text-white">
                        <h5 class="modal-title" id="my-modal-title">Agregar Objectivo</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input id="nombre_objectivo" class="form-control" type="text" placeholder="Ingrese el nombre del objetivo">
                        </div>
                </div>
                    <div class="modal-footer">
                    <button class="btn btn-success btn-block" onclick="objectivo()" >Agregar</button>
                </div>
                </div>
            </div>
        </div>

<?php
    }
}
?>