<?php
require_once('gui.php');
require_once('ln/ln_usuario.php');
require_once('ln/ln_sedes.php');

class ui_usuario extends gui
{
    var $sedes;
    var $ln;
    function __construct()
    {
        $this->ln = new ln_usuario();
        $this->sedes= new ln_sedes();
    }
    function controller()
    {
        $this->ln->controller();
    }

    function get_build()
    {
        $usuario = json_decode($_COOKIE['ONG'], true)['puesto'];
        $ui = null;
        $action = "insert";
        if (isset($_GET['id'])) {
            $action = "update";
            $ui = $this->ln->db->get_usuario($_GET['id'])[0];
        }
        if ($usuario == 'Facilitador' || $usuario == 'Joven' || $usuario == 'Comite') {
            $action = 'update_single';
        }

?>
        <form class="formularios" action="usuario.php?action=<?= $action ?>" method="post" enctype="multipart/form-data">
            <nav aria-label="Page breadcrumb ">
                <ol class="breadcrumb bg-dark">
                    <?php
                    if ($usuario == 'Facilitador' || $usuario == 'Joven' || $usuario == 'Comite') {
                    ?>
                        <li class="breadcrumb-item text-white" aria-current="page">
                            <h2>Datos Personales</h2>
                        </li>

                    <?php    } else { ?>
                        <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-info" href="usuarios.php">Usuarios</a></li>

                    <?php }

                    ?>
                </ol>
            </nav>
            <div class="row p-3">
                <div class="col-sm-4 p-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4>Datos Personales</h4>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Status</label>
                                </div>
                                <input type="hidden" name="id_usuario" value="<?= $ui['id_usuario'] ?>">
                                <div class="col-sm-7">
                                    <select class="form-control" type="text" name="estado">
                                        <?php foreach ($this->get_status() as $status) { ?>
                                            <?php if ($status == $ui['estado']) { ?>
                                                <option selected value="<?= $status ?>"><?= $status ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $status ?>"><?= $status ?></option>
                                        <?php }
                                        } ?>
                                    </select>


                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Tipo</label>
                                </div>
                                <div class="col-sm-7">
                                    <select class="form-control" type="text" name="tipo">
                                        <?php foreach ($this->get_Tipo() as $tipo) { ?>
                                            <?php if ($tipo == $ui['tipo']) { ?>
                                                <option selected value="<?= $tipo ?>"><?= $tipo ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $tipo ?>"><?= $tipo ?></option>
                                        <?php }
                                        } ?>
                                    </select>


                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Nombre</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" name="nombre" class="form-control" value="<?= $ui != null ? $ui['nombre'] : '' ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Primer Apellido</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" name="primer_apellido" required class="form-control" value="<?= $ui != null ? $ui['primer_apellido'] : '' ?>">

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Segundo Apellido</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" name="segundo_apellido" required class="form-control" value="<?= $ui != null ? $ui['segundo_apellido'] : ''  ?>">

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Cedula</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" name="cedula" required class="form-control" value="<?= $ui != null ? $ui['cedula'] : ''  ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Fecha de nac.</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="date" name="fecha_nac" required class="form-control" value="<?= $ui != null ? $ui['fecha_nacimiento'] : ''  ?>">

                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Genero</label>
                                </div>
                                <div class="col-sm-7">
                                    <select name="genero" class="form-control">
                                        <?php foreach ($this->get_genero() as $genero) { ?>
                                            <?php if ($genero == $ui['genero']) { ?>
                                                <option selected value="<?= $genero ?>"><?= $genero ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $genero ?>"><?= $genero ?></option>
                                        <?php }
                                        } ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Estado Civil</label>
                                </div>
                                <div class="col-sm-7">
                                    <select name="civil" class="form-control">
                                        <?php foreach ($this->get_civil() as $civil) { ?>
                                            <?php if ($civil == $ui['estado_civil']) { ?>
                                                <option selected value="<?= $civil ?>"><?= $civil ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $civil ?>"><?= $civil ?></option>
                                        <?php    }
                                        } ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-12">
                                    <label class="control-label col-form-label">Experiencia</label>
                                </div>
                                <div class="col-sm-8 col-12">
                                    <textarea placeholder="Ingrese su experiencia" name="experiencia" class="form-control" cols="30" rows="2"><?= $ui != null ? $ui['experiencia'] : '' ?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4 p-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4>Datos de Usuario</h4>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Correo</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="email" name="correo" required class="form-control" value="<?= $ui != null ? $ui['correo'] : '' ?>">

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Contraseña</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" name="clave" required class="form-control" value="<?= $ui != null ? $ui['clave'] : '' ?>">

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5 ">
                                    <label class="control-label col-form-label">Centro de Formacion</label>
                                </div>
                                <div class="col-sm-7">
                                    <select id="my-select" class="form-control" name="centro_form">
                                        <?php foreach ($this->sedes->db->get_sedes() as $sedes) {
                                            if ($ui['sede'] == $sedes['id_sede']) {
                                        ?>
                                                <option selected value="<?= $sedes['id_sede'] ?>"><?= $sedes['nombre_sede'] ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $sedes['id_sede'] ?>"><?= $sedes['nombre_sede'] ?></option>

                                        <?php }
                                        } ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Acceso</label>
                                </div>
                                <div class="col-sm-7">
                                    <select class="form-control" type="text" name="acceso">
                                        <?php foreach ($this->get_acceso() as $acceso) { ?>
                                            <?php if ($acceso == $ui['acceso']) { ?>
                                                <option selected value="<?= $acceso ?>"><?= $acceso ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $acceso ?>"><?= $acceso ?></option>
                                        <?php }
                                        } ?>
                                    </select>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow">
                        <div class="card-body">
                            <h5>Domicilio</h5>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label class="control-label col-form-label">Canton</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="canton" required class="form-control" value="<?= $ui != null ? $ui['canton'] : '' ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label class="control-label col-form-label">Direccion</label>
                                </div>
                                <div class="col-sm-8">
                                    <textarea placeholder="Ingrese la direccion" name="direccion" class="form-control" cols="30" rows="2"><?= $ui != null ? $ui['canton'] : ''  ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="card shadow">
                        <div class="card-body">
                            <h4>Contacto</h4>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label class="control-label col-form-label">Telefono</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="telefono" value="<?= $ui != null ? $ui['telefono'] : ''  ?>" required>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-4 p-3  align-content-center">
                    <div class="card shadow">

                        <img class="card-img-top" src="<?= $ui['foto'] ?>" height="200px">
                        <div class="card-body">
                            <h4>Documentos</h4>

                            <span>Foto de Perfil</span>
                            <div class="input-group">
                                <input type="file" class="form-control" name="foto">
                                <a href="<?= $ui['foto'] ?>" download class="btn btn-secondary"><i class="fas fa-download"></i></a>
                                <input type="hidden" name="copia_foto" value="<?= $ui != null ? $ui['foto'] : '' ?>">
                            </div>


                            <br>
                            <br>
                            <label>Copia Cedula</label>
                            <div class="input-group">
                                <input type="file" class="form-control" name="copia">
                                <a href="<?= $ui['copia_cedula'] ?>" download class="btn btn-secondary"><i class="fas fa-download"></i></a>
                                <a href="<?= $ui['copia_cedula'] ?>" target="blank" class="btn btn-info"><i class="fas fa-eye"></i></a>
                            </div>
                            <input type="hidden" name="copia_cedula" value="<?= $ui != null ? $ui['copia_cedula'] : '' ?>">
                        </div>
                    </div>
                </div>
                <div class="container text-center p-2">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="usuario.php" class="btn btn-info">Nuevo</a>

                </div>
            </div>



        </form>

<?php
    }
}
?>