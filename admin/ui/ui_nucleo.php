<?php
require_once('gui.php');
require_once('ln/ln_joven.php');
class ui_nucleo extends gui
{

    var $ln;

    function __construct()
    {
        $this->ln = new ln_joven();
    }

    function controller()
    {
        $this->ln->controller();
    }
    function get_build()
    {
        $ui = $this->ln->db->get_joven($_GET['id'])[0];
?>
        <div class="row">

            <div class="col-md-12">

                <div class="card">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Personal</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" href="seguimientos.php?id=<?= $_GET['id'] ?>" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Seguimiento</span></a> </li>
                        <li class="nav-item"> <a class="nav-link  active show" href="nucleo_familiar.php?id=<?= $_GET['id'] ?>" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Nucleo Familiar</span></a> </li>

                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabcontent-border">
                        <div class="tab-pane p-20 active show" id="nucleo" role="tabpanel">
                            <div class="row p-3">
                                <div class="col-lg-4 col-sm-12 col-12">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            <h4>Datos del Familiar</h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="nucleo_familiar.php?action=insert_familiar" method="post">
                                                <input type="hidden" name="id_joven" value="<?= $_GET['id'] ?>">
                                                <div class="form-group">
                                                    <label>Nombre</label>
                                                    <input name="nombre" class="form-control" type="text" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Parentesco</label>
                                                    <select class="form-control" name="parentesco">
                                                        <?php foreach ($this->get_familiar() as $list) { ?>
                                                            <option value="<?= $list ?>"><?= $list ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jefe Familiar </label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="jefe" value="1">
                                                        <label class="form-check-label">Si</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" checked type="radio" name="jefe" value="0">
                                                        <label class="form-check-label">No</label>
                                                    </div>
                                                </div>
                                                <div id="jefe" style="display: none;">
                                                    <div class="form-group">
                                                        <label>Grado Academico</label>
                                                        <select class="form-control" name="estudios">
                                                            <?php foreach ($this->get_Estudios() as $estudio) { ?>
                                                                <option value="<?= $estudio ?>"><?= $estudio ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Ocupacion</label>
                                                        <select class="form-control" name="ocupacion">
                                                            <?php foreach ($this->get_ocupacion() as $ocupacion) { ?>
                                                                <option value="<?= $ocupacion ?>"><?= $ocupacion ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="container text-center p-2">
                                                    <button type="submit" class="btn btn-success btn-block">Guardar</button>
                                                    <a class="btn btn-info btn-block" href="patrocinios.php">Nuevo</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-sm-12 col-12">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            <h4>Lista de Familiares</h4>
                                        </div>
                                        <div class="card-body table-responsive">
                                            <table id="zero_config" class="table table-light">
                                                <thead>
                                                    <th>Nombre</th>
                                                    <th>Parentesco</th>
                                                    <th>Jefe</th>
                                                    <th>Editar</th>
                                                    <th>Eliminar</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($this->ln->db->get_familiares($_GET['id']) as $familiar) { ?>
                                                        <td><?= $familiar['nombre_familiar'] ?></td>
                                                        <td><?= $familiar['rol'] ?></td>
                                                        <td><?= $familiar['lider'] ?></td>
                                                        <td><a href="nucleo_familiar.php?action=update&id=<?= $familiar['id_familiar'] ?>" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
                                                        <td><a href="nucleo_familiar.php?action=delete_familiar&id=<?= $familiar['id_familiar'] ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>

                                                    <?php } ?>
                                                </tbody>
                                            </table>
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
        <script>
            window.addEventListener('load', () => {

                let radio = document.getElementsByName('jefe');
                $(radio).change(function(e) {
                    for (let index = 0; index < radio.length; index++) {
                        if (radio[index].checked == true) {
                            if (radio[index].value == 0) {
                                document.querySelector("#jefe").style.display = 'none';
                            } else {
                                document.querySelector("#jefe").style.display = 'block';
                            }
                        }
                    }
                });
            });
        </script>
<?php
    }
}
?>