<?php
require_once('gui.php');
require_once('ln/ln_usuario.php');
class ui_usuarios extends gui
{
    var $ln;

    function __construct()
    {
        $this->ln = new ln_usuario();
    }
    function get_build()
    {
?>
        <div class="row p-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="clearfix">
                            <div class="float-left">
                                <h3> Lista de Usuarios </h3>
                            </div>
                            <div class="float-right mr-2">
                                <a href="usuario.php" class="btn btn-info"><i class="fas fa-user-plus"></i> Nuevo</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="zero_config" class="table table-light align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cedula</th>
                                    <th>Genero</th>
                                    <th>Rol</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                    <th>Exportar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($this->ln->db->get_usuarios() as $lista) { ?>
                                    <tr>
                                        <td><?= $lista['nombre'] . ' ' . $lista['primer_apellido'] . ' ' . $lista['segundo_apellido'] ?></td>
                                        <td><?= $lista['cedula'] ?></td>
                                        <td><?= $lista['genero'] ?></td>
                                        <td><?= $lista['tipo'] ?></td>
                                        <td><?= $lista['fecha_nacimiento'] ?></td>
                                        <td><?= $lista['status'] ?></td>
                                        <td><a href="usuario.php?action=update_usuario&id=<?= $lista['id_usuario'] ?>" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
                                        <td><a href="index.php?action=delete&id=<?= $lista['id_usuario'] ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                                        <td><a href="expedientes.php?action=exportar=<?= $lista['id_usuario'] ?>" class="btn btn-info">
                                                <>
                                            </a></td>
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