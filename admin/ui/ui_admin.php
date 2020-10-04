<?php
require_once('gui.php');
require_once('ln/ln_admin.php');
class ui_admin extends gui
{
    var $ln;
    function __construct()
    {
        $this->ln = new ln_admin();
    }
    function controller()
    {
        $this->ln->controller();
    }

    function get_build()
    {
        $sede = $this->ln->db->get_admin()[0];

?>
        <form class="form_eventos" action="admin.php?action=admin" method="post" enctype="multipart/form-data">

            <nav aria-label="Page breadcrumb ">
                <ol class="breadcrumb bg-dark">
                    <li class="breadcrumb-item text-white" aria-current="page">
                        <h4>Modulo de Administrativo</h4>
                    </li>
                </ol>
            </nav>
            <div class="container p-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Datos de la ONG</h4>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-lg-6 col-sm-12 col-12">

                                <input type="hidden" name="id" value="<?= $sede != null ? $sede['id_admin'] : '' ?>">
                                <div class="form-group">
                                    <img class="img-thumbnail" src="<?= $sede != null ? $sede['logo'] : '' ?>" alt="">
                                    <label>Logo</label>
                                    <input class="form-control-file" type="file" name="logo">
                                </div>
                                <input type="hidden" name="documento" value="<?= $sede != null ? $sede['logo'] : '' ?>">

                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input name="nombre" class="form-control" type="text" value="<?= $sede['nombre'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input name="telefono" class="form-control" type="text" value="<?= $sede['telefono'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Correo</label>
                                    <input name="correo" class="form-control" type="text" value="<?= $sede['correo'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input name="clave" class="form-control" type="password" value="<?= $sede['clave'] ?>">
                                </div>

                                <div class="form-group">
                                    <label>Direccion</label>
                                    <textarea id="my-textarea" class="form-control" name="direccion" rows="3"><?= $sede['direccion'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Lema</label>
                                    <textarea id="my-textarea" class="form-control" name="lema" rows="3"><?= $sede['lema'] ?></textarea>
                                </div>
                                <div>
                                <button type="submit" class="btn btn-success btn-block">Actualizar</button>
                            </div>
 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<?php
    }
}
?>