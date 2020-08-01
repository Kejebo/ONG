<?php
require_once('gui.php');
require_once('ln/ln_sedes.php');
class ui_sede extends gui
{
    var $ln;
    function __construct()
    {
        $this->ln = new ln_sedes();
    }
    function controller()
    {
        $this->ln->controller();
    }

    function get_build()
    {
        $sede = null;
        $accion = 'insert';
        if (isset($_GET['action'])) {
            $sede = $this->ln->db->get_sede($_GET['id'])[0];
            $accion = 'update';
        }
?>
        <nav aria-label="Page breadcrumb ">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item text-white" aria-current="page">
                    <h4>Modulo de Patrocinadores</h4>
                </li>
            </ol>
        </nav>
        <div class="row p-3">
            <div class="col-lg-4 col-sm-12 col-12">

                <div class="card">
                    <div class="card-header">
                        <h4>Datos del Patrocinador</h4>
                    </div>
                    <div class="card-body">
                        <form action="sedes.php?action=<?= $accion ?>" method="post">
                            <input type="hidden" name="id" value="<?= $sede != null ? $sede['id_sede'] : '' ?>">
                            <div class="form-group">
                                <label>Nombre Sitio</label>
                                <input name="nombre" class="form-control" type="text" value="<?= $sede != null ? $sede['nombre_sede'] : '' ?>">
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
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Sedes</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="zero_config" class="table table-light" >
                            <thead>
                                <th>Nombre</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody>
                                <?php foreach ($this->ln->db->get_sedes() as $list) { ?>
                                    <tr>
                                        <td><?= $list['nombre_sede'] ?></td>
                                        <td><a href="sedes.php?action=update_sede&id=<?= $list['id_sede'] ?>" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
                                        <td><a href="sedes.php?action=delete&id=<?= $list['id_sede'] ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                                    </tr>
                                <?php } ?>
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