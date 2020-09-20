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
        $action = 'insert_familiar';
        $ui = null;
        $visibility='none';
        if (isset($_GET['id_familiar'])) {
            $action = 'update_familiar';
            $ui = $this->ln->db->get_familiar($_GET['id_familiar'])[0];
        }
?>
        <div class="row">

            <div class="col-md-12">

                <div class="card">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link" href="expedientes.php?action=update_joven&id=<?= $_GET['id'] ?>" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Personal</span></a> </li>
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
                                            <form action="nucleo_familiar.php?action=<?= $action ?>" method="post">
                                                <input type="hidden" name="id_joven" value="<?= $_GET['id'] ?>">
                                                <input type="hidden" name="id_familiar" value="<?= $_GET['id_familiar'] ?>">
                                                <div class="form-group">
                                                    <label>Nombre</label>
                                                    <input name="nombre" class="form-control" type="text" value="<?= $ui != null ? $ui['nombre_familiar'] : '' ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Parentesco</label>
                                                    <select class="form-control" name="parentesco">
                                                        <?php foreach ($this->get_familiar() as $list) {
                                                            if ($ui['rol'] == $list) {
                                                        ?>
                                                                <option selected value="<?= $list ?>"><?= $list ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?= $list ?>"><?= $list ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jefe Familiar </label>
                                                    <?php for ($i = 1; $i > -1; $i--) {  ?>
                                                        <div class="form-check form-check-inline col-md-1 col-sm-6">
                                                            <?php
                                                            if ($ui != null) {
                                                                if ($ui['jefe'] == $i) {
                                                                    $visibility='block'; ?>
                                                                    <input class="form-check-input" checked type="radio" name="jefe" value="<?= $i ?>">
                                                                <?php } else { ?>
                                                                    <input class="form-check-input"  type="radio" name="jefe" value="<?= $i ?>">
                                                                <?php } ?>
                                                                <label class="form-check-label"><?= $i > 0 ? 'Si' : 'No' ?></label>
                                                        </div>
                                                    <?php } else { ?>
                                                        <input class="form-check-input" checked type="radio" name="jefe" value="<?= $i ?>">
                                                        <label class="form-check-label"><?= $i > 0 ? 'Si' : 'No' ?></label>
                                                </div>
                                        <?php }
                                                        } ?>
                                        </div>

                                        <div id="jefe" style="display: <?=$visibility?>;">
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
                                            <a class="btn btn-info btn-block" href="nucleo_familiar.php?id=<?=$_GET['id']?>">Nuevo</a>
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
                                                   <tr>
                                                    <td><?= $familiar['nombre_familiar'] ?></td>
                                                    <td><?= $familiar['rol'] ?></td>
                                                    <td><?= $familiar['lider'] ?></td>
                                                    <td><a href="nucleo_familiar.php?action=update_familiares&id_familiar=<?= $familiar['id_familiar'] ?>&id=<?= $_GET['id'] ?>" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
                                                    <td><a href="nucleo_familiar.php?action=delete_familiar&&id_familiar=<?= $familiar['id_familiar'] ?>&id_joven=<?= $_GET['id']?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                                                    </tr> <?php } ?>
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