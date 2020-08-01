<?php
require_once('gui.php');
require_once('ln/ln_patrocinador.php');
class ui_patrocinador extends gui
{
    var $ln;
    function __construct()
    {
        $this->ln = new ln_patrocinador();
    }
    function controller()
    {
        $this->ln->controller();
    }

    function get_build()
    {
        $patrocinador = null;
        $accion = 'insert';
        if (isset($_GET['action'])) {
            $patrocinador = $this->ln->db->get_patrocinador($_GET['id'])[0];
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
                        <form action="patrocinios.php?action=<?= $accion ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $patrocinador != null ? $patrocinador['id_patrocinador'] : '' ?>">
                            <div class="form-group">
                                <label for="my-input">Logo</label>
                                <input id="my-input" class="form-control-file" type="file" name="logo">
                            </div>
                            <div class="form-group">
                                <label for="">Ver en pagina web</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input id="my-input" class="form-check-input" type="radio" name="visualizar" value="1">
                                    <label for="my-input" class="form-check-label">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="my-input" class="form-check-input" type="radio" name="visualizar" value="0">
                                    <label for="my-input" class="form-check-label">No</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Empresa</label>
                                <input name="institucion" class="form-control" type="text" value="<?= $patrocinador != null ? $patrocinador['institucion'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Responsable</label>
                                <input name="responsable" class="form-control" type="text" value="<?= $patrocinador != null ? $patrocinador['responsable'] : '' ?>">
                            </div>

                            <div class="form-group">
                                <label>Cedula Juridica(Fisica)</label>
                                <input name="cedula" class="form-control" type="text" value="<?= $patrocinador != null ? $patrocinador['cedula_juridica'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Telefono</label>
                                <input class="form-control" type="text" name="telefono" value="<?= $patrocinador != null ? $patrocinador['telefono'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Correo</label>
                                <input class="form-control" type="email" name="correo" value="<?= $patrocinador != null ? $patrocinador['correo'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Direccion</label>
                                <textarea name="direccion" class="form-control" cols="30" rows="2"><?= $patrocinador != null ? $patrocinador['direccion'] : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Aportes</label>
                                <textarea name="aportes" class="form-control" cols="30" rows="3"><?= $patrocinador != null ? $patrocinador['aportes'] : '' ?></textarea>
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
                        <h4>Lista de Patrocinadores</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="zero_config" class="table table-light" >
                            <thead>
                                <th>Logo</th>
                                <th>Institucion</th>
                                <th>Responsable</th>
                                <th>Telefono</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody>
                                <?php foreach ($this->ln->db->get_patrocinadores() as $list) { ?>
                                    <tr>
                                        <td><img src="<?=$list['logo']?>" alt="" style="max-width: 50px;"></td>
                                        <td><?= $list['institucion'] ?></td>
                                        <td><?= $list['responsable'] ?></td>
                                        <td><?= $list['telefono'] ?></td>
                                        <td><a href="patrocinios.php?action=update_patrocinio&id=<?= $list['id_patrocinador'] ?>" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
                                        <td><a href="patrocinios.php?action=delete&id=<?= $list['id_patrocinador'] ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
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