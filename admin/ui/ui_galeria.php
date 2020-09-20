<?php
require_once('gui.php');
require_once('ln/ln_evento.php');
class ui_galeria extends gui
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
                <li class="breadcrumb-item" aria-current="page"><a class="btn btn-info" href="inscripciones.php?id=<?= $_GET['id'] ?>">Inscripciones</a></li>
                <li class="breadcrumb-item" aria-current="page"><a class="btn btn-info active" href="galeria.php?id=<?= $_GET['id'] ?>">Galería</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-info" href="asistencia.php?id=<?= $_GET['id'] ?>">Asistencia</a></li>

            </ol>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-4">

                    <div class="card">
                        <div class="card-header">
                            <h4>Galeria de imagenes</h4>
                        </div>
                        <div class="card-body">
                            <form action="galeria.php?action=insert_galeria&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input class="form-control" type="file" name="foto">
                                </div>
                                <hr>
                                <div class="container text-center p-2">
                                    <button type="submit" class="btn btn-success btn-block">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class=" col-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Galeria de Imagenes</h4>
                        </div>
                        <div class="card-body galeria p-3">
                            <div class="row">
                                <?php foreach ($this->ln->db->get_galeria($_GET['id']) as $fotos) { ?>
                                    <div class="col-sm-12 col-md-12 col-lg-4  pb-5">
                                        <div class="card">
                                            <img class="card-img-top" src="<?= $fotos['foto'] ?>" style="width: 100%; height: 200px">
                                            <div style="position: relative">
                                                <a href="galeria.php?action=delete_galeria&id=<?=$_GET['id']?>&foto=<?= $fotos['id_galeria'] ?>&direccion=<?=$fotos['foto']?>" class="btn btn-danger text-white" style="position: absolute; bottom: 5px; right: 5px;"><span class="fa fa-trash"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
<?php
    }
}
?>