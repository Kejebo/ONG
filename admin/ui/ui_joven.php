<?php
require_once('gui.php');
require_once('ln/ln_joven.php');
require_once('db/db_sedes.php');
class ui_joven extends gui
{
    var $ln;
    var $sede;
    function __construct()
    {
        $this->ln = new ln_joven();
        $this->sede = new db_sedes();
    }
    function controller()
    {
        $this->ln->controller();
    }

    function get_build()
    {

?>

        <form class="formularios" action="joven.php?action=insert" method="post" enctype="multipart/form-data">
            <nav aria-label="Page breadcrumb ">
                <ol class="breadcrumb bg-dark">
                    <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-info" href="index.php">Expedientes</a></li>
                </ol>
            </nav>

            <div class="row p-3">
                <div class="col-sm-4 p-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Datos Personales</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Status</label>
                                </div>
                                <div class="col-sm-7">
                                    <select class="form-control" type="text" name="estado">
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                        <option value="prospecto">Prospecto</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Nombre</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" name="nombre" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Primer Apellido</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" name="primer_apellido" required class="form-control">

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Segundo Apellido</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" name="segundo_apellido" required class="form-control">

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5"> <label>Cedula</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" name="cedula" required class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Correo</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="email" name="correo" required class="form-control">

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Fecha de nac.</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="date" name="fecha_nac" required class="form-control">

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Genero</label>
                                </div>
                                <div class="col-sm-7">
                                    <select name="genero" class="form-control">
                                        <option value="Mujer">Mujer</option>
                                        <option value="Hombre">Hombre</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Estado Civil</label>
                                </div>
                                <div class="col-sm-7">
                                    <select name="civil" class="form-control">
                                        <option value="Casado(a)">Casado(a)</option>
                                        <option value="Soltero(a)">Soltero(a)</option>
                                        <option value="Union Libre">Union Libre</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label>Cant. Miembros</label>
                                </div>
                                <div class="col-sm-7">
                                    <input class="form-control" type="number" name="miembros" min='0' value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label>Rec. Ayuda Social</label>
                                </div>
                                <div class="form-check form-check-inline col-sm-1">
                                    <input id="my-input" class="form-check-input" type="radio" name="ayuda" value="1">
                                    <label for="my-input" class="form-check-label">Si</label>
                                </div>
                                <div class="form-check form-check-inline col-sm-1">
                                    <input id="my-input" class="form-check-input" type="radio" name="ayuda" value="0">
                                    <label for="my-input" class="form-check-label">No</label>
                                </div>
                            </div>

                            <br>

                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Domicilio</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Provincia</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="provincia" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Canton</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="canton" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label class="control-label col-form-label">Distrito</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="distrito" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-12">
                                    <label class="control-label col-form-label">Direccion</label>
                                </div>
                                <div class="col-sm-8 col-12">
                                    <textarea placeholder="Ingrese la direccion" name="direccion" class="form-control" cols="30" rows="2">

                                </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 p-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Ocupacion</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-check col-12 col-md-3">
                                    <input id="my-input" class="form-check-input" type="checkbox" name="ocupacion[]" value="Estudia">
                                    <label for="my-input" class="form-check-label">Estudia</label>
                                </div>
                                <div class="form-group col-12 col-md-9">
                                    <input id="my-input" type="text" name="estudia" style="width: 100%;" placeholder="Donde">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-check col-12 col-md-3">
                                    <input class="form-check-input" type="checkbox" name="ocupacion[]" value="Trabaja">
                                    <label class="form-check-label">Trabaja</label>
                                </div>
                                <div class="form-group col-12 col-md-9">
                                    <input  type="text" name="trabaja" style="width: 100%;" placeholder="Donde...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-check col-12">
                                    <input class="form-check-input" type="checkbox" name="ocupacion[]" value="No estudia">
                                    <label class="form-check-label">No Estudia</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-check col-12">
                                    <input id="my-input" class="form-check-input" type="checkbox" name="ocupacion[]" value="No Trabaja">
                                    <label for="my-input" class="form-check-label">No trabaja</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Detalle de Registro</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-4 col-12">
                                    <label class="control-label col-form-label">Fecha de registro.</label>
                                </div>
                                <div class="col-sm-8 col-12">
                                    <input type="date" name="fecha_reg" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-12">
                                    <label class="control-label col-form-label">Generacion</label>
                                </div>
                                <div class="col-sm-8 col-12">
                                    <input type="text" name="generacion" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-12">
                                    <label class="control-label col-form-label">Centro de Formacion</label>
                                </div>
                                <div class="col-sm-8 col-12">
                                    <select id="my-select" class="form-control" name="centro_form">
                                        <?php foreach ($this->sede->get_sedes() as $sedes) { ?>
                                            <option value="<?= $sedes['id_sede'] ?>"><?= $sedes['nombre_sede'] ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Contacto</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label class="control-label col-form-label">Telefono</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="telefono" required>
                                </div>
                            </div>

                            <h4>Emergencia
                                <hr>
                            </h4>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label class="control-label col-form-label">Nombre</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nombre_emergencia" required>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label class="control-label col-form-label">Rasgo </label>
                                </div>
                                <div class="col-sm-8">
                                    <select class="form-control" type="text" name="tipo">
                                        <?php foreach ($this->get_familiar() as $familiar) { ?>
                                            <option value="<?= $familiar ?>"><?= $familiar ?></option>
                                        <?php
                                        } ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label class="control-label col-form-label">Telefono</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="telefono_emergencia" required>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-4 p-3">

                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Documentos</h4>
                        </div>
                        <div class="card-body">
                            <label class="control-label col-form-label">Foto de Perfil</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name='foto' aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="foto">Choose file</label>
                            </div>
                            <br>
                            <br>
                            <label class="control-label col-form-label">Consentimiento Informado</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="consentimiento" id="consentimiento" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="consentimiento">Selecciones la carta</label>
                            </div>
                            <br>
                            <br>
                            <label class="control-label col-form-label">Copia de Cedula</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="copia_cedula" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="copia_cedula">Seleccione la cedula</label>
                            </div>
                            <br>
                            <br>
                            <label class="control-label col-form-label">Carta compromiso</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="compromiso" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="carta">Selecciones el archivo</label>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="container text-center p-2">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="jovenes.php" class="btn btn-danger">Cancelar</a>

                </div>
            </div>



        </form>

<?php
    }
}
?>