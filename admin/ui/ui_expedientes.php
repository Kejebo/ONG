<?php
require_once('gui.php');
require_once('ln/ln_joven.php');
require_once('ln/ln_sedes.php');
class ui_expedientes extends gui
{

    var $ln;
    var $sedes;
    function __construct()
    {
        $this->ln = new ln_joven();
        $this->sedes = new ln_sedes();
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
                        <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Personal</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" href="seguimientos.php?id=<?= $_GET['id'] ?>" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Seguimiento</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" href="nucleo_familiar.php?id=<?= $_GET['id'] ?>" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Nucleo Familiar</span></a> </li>

                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabcontent-border">
                        <div class="tab-pane p-20 active show" id="home" role="tabpanel">
                            <form action="expedientes.php?action=update" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-4 p-3">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <h4>Datos Personales</h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-5">
                                                        <label class="control-label col-form-label">Status</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
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
                                                    <div class="col-sm-12 col-md-5">
                                                        <label class="control-label col-form-label">Nombre</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" name="nombre" value="<?= $ui['nombre'] ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-5">
                                                        <input type="hidden" name="id" value="<?= $ui['id_joven'] ?>">
                                                        <label class="control-label col-form-label">Primer Apellido</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" name="primer_apellido" value="<?= $ui['primer_apellido'] ?>" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-5">
                                                        <label class="control-label col-form-label">Segundo Apellido</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" name="segundo_apellido" value="<?= $ui['segundo_apellido'] ?>" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-5"><label>Cedula</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" name="cedula" value="<?= $ui['cedula'] ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-5">
                                                        <label class="control-label col-form-label">Fecha de nac.</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="date" name="fecha_nac" value="<?= $ui['fecha_nacimiento'] ?>" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-5">
                                                        <label class="control-label col-form-label">Edad</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" name="edad" value="<?= $ui['edad'] ?>" class="form-control">

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-5">
                                                        <label class="control-label col-form-label">Correo</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" name="correo" value="<?= $ui['correo'] ?>" class="form-control">

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-5">
                                                        <label class="control-label col-form-label">Genero</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
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
                                                    <div class="col-sm-12 col-md-5">
                                                        <label class="control-label col-form-label">Estado Civil</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <select name="civil" class="form-control">
                                                            <?php foreach ($this->get_civil() as $status) { ?>
                                                                <?php if ($status == $ui['estado_civil']) { ?>
                                                                    <option selected value="<?= $status ?>"><?= $status ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $status ?>"><?= $status ?></option>
                                                            <?php }
                                                            } ?> </select>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-5">
                                                        <label>Cant. Miembros</label>
                                                    </div>

                                                    <div class="col-sm-12 col-md-7">
                                                        <input class="form-control" type="number" name="miembros" value="<?= $ui['cant_miembros'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <label>Rec. Ayuda Social</label>
                                                    </div>
                                                    <?php for ($i = 1; $i > -1; $i--) { ?>
                                                        <div class="form-check form-check-inline col-md-1 col-sm-6">
                                                            <?php if ($ui['ayuda_social'] == 1) { ?>
                                                                <input class="form-check-input" checked type="radio" name="ayuda" value="<?= $i ?>">
                                                            <?php } else { ?>
                                                                <input class="form-check-input" checked type="radio" name="ayuda" value="<?= $i ?>">
                                                            <?php } ?>
                                                            <label class="form-check-label"><?= $i > 0 ? 'Si' : 'No' ?></label>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <br>

                                            </div>
                                        </div>

                                        <div class="card shadow">
                                            <div class="card-body">
                                                <h5>Domicilio</h5>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-5">
                                                        <label class="control-label col-form-label">Provincia</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" class="form-control" name="provincia" value="<?= $ui['provincia'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-5">
                                                        <label class="control-label col-form-label">Canton</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" class="form-control" name="canton" value="<?= $ui['canton'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-5">
                                                        <label class="control-label col-form-label">Distrito</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" class="form-control" name="distrito" value="<?= $ui['distrito'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-4 col-12">
                                                        <label class="control-label col-form-label">Direccion</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-8 col-12">
                                                        <textarea value="<?= $ui['direccion'] ?>" name="direccion" class="form-control" cols="30" rows="2"><?= $ui['direccion'] ?>
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
                                                <input type="hidden" id='datos' value='<?= json_encode($this->ln->db->get_ocupacion($_GET['id'])) ?>'>
                                                <div class="row">
                                                    <div class="form-check col-12 col-md-3">
                                                        <input class="form-check-input ocupacion" type="checkbox" name="ocupacion[]" value="Estudia">
                                                        <label class="form-check-label">Estudia</label>
                                                    </div>
                                                    <div class="form-group col-12 col-md-9">
                                                        <input type="text" id="estudia" name="estudia" style="width: 100%;" placeholder="Donde">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-check col-12 col-md-3">
                                                        <input class="form-check-input ocupacion" type="checkbox" name="ocupacion[]" value="Trabaja">
                                                        <label class="form-check-label">Trabaja</label>
                                                    </div>
                                                    <div class="form-group col-12 col-md-9">
                                                        <input type="text" id="trabaja" name="trabaja" style="width: 100%;" placeholder="Donde...">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-check col-12">
                                                        <input class="form-check-input ocupacion" type="checkbox" name="ocupacion[]" value="No estudia">
                                                        <label class="form-check-label">No Estudia</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-check col-12">
                                                        <input class="form-check-input ocupacion" type="checkbox" name="ocupacion[]" value="No Trabaja">
                                                        <label class="form-check-label">No trabaja</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card shadow">
                                            <div class="card-body">
                                                <h5>Detalle de Registro</h5>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-4 col-12">
                                                        <label class="control-label col-form-label">Fecha de registro.</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-8 col-12">
                                                        <input type="date" name="fecha_reg" class="form-control" value="<?= $ui['fecha_registro'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-4 col-12">
                                                        <label class="control-label col-form-label">Generacion</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-8 col-12">
                                                        <input type="text" name="generacion" class="form-control" value="<?= $ui['generacion'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-4 col-12">
                                                        <label class="control-label col-form-label">Centro de Formacion</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-8 col-12">
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
                                            </div>
                                        </div>


                                        <div class="card shadow">
                                            <div class="card-body">
                                                <h4>Contacto</h4>

                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-4">
                                                        <label class="control-label col-form-label">Telefono</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-8">
                                                        <input type="text" class="form-control" name="telefono" value="<?= $ui['telefono'] ?>">
                                                    </div>
                                                </div>
                                                <h4>Contacto de Emergencia</h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-4">
                                                        <label class="control-label col-form-label">Nombre</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-8">
                                                        <input type="text" class="form-control" name="nombre_emergencia" value="<?= $ui['nombre_familiar'] ?>">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-4">
                                                        <label class="control-label col-form-label">Rasgo </label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <select class="form-control" type="text" name="tipo">
                                                            <?php foreach ($this->get_familiar() as $familiar) { ?>
                                                                <?php if ($familiar == $ui['tipo_conocido']) { ?>
                                                                    <option selected value="<?= $familiar ?>"><?= $familiar ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $familiar ?>"><?= $familiar ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-4">
                                                        <label class="control-label col-form-label">Telefono</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-8">
                                                        <input type="text" class="form-control" name="telefono_emergencia" value="<?= $ui['telefono_familiar'] ?>">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-sm-4 p-3">

                                        <div class="card shadow">
                                            <div class="card-body">
                                                <h4>Documentos</h4>
                                                <img src="<?= $ui['foto'] ?>" class="img-thumbnail">

                                                <label class="control-label col-form-label">Foto de Perfil</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="foto"  >
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                                <input type="hidden" name="perfil" value="<?=$ui['foto']?>">

                                                <br>
                                                <br>
                                                <label class="control-label col-form-label">Consentimiento Informado</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="consentimiento">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                                <input type="hidden" name="consenti" value="<?=$ui['consentimiento']?>">

                                                <br>
                                                <br>
                                                <label class="control-label col-form-label">Copia de Cedula</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="copia_cedula">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                                <input type="hidden" name="cedula_dos" value="<?=$ui['copia_cedula']?>">

                                                <br>
                                                <br>
                                                <label class="control-label col-form-label">Carta compromiso</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="carta"  aria-describedby="inputGroupFileAddon01">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                            <input type="hidden" name="compro" value="<?=$ui['compromiso']?>">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="container text-center p-2">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                        <a href="jovenes.php" class="btn btn-danger">Cancelar</a>

                                    </div>
                                </div>



                            </form>

                        </div>

                        <div class="tab-pane p-20" id="profile" role="tabpanel">
                            <div class="p-20">
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="messages" role="tabpanel">
                            <div class="p-20">
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="seguimiento" role="tabpanel">
                            <div class="p-20">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        <script>
            window.addEventListener('load', () => {
                datos = document.querySelector("#datos").value;
                data = JSON.parse(datos);
                check = document.querySelectorAll(".ocupacion");
                for (let index = 0; index < data.length; index++) {
                    if (data[index].tipo == "Estudia") {
                        check[0].setAttribute('checked', 'true');
                        document.querySelector("#estudia").value = data[index].lugar;
                    }
                    if (data[index].tipo == "Trabaja") {
                        check[1].setAttribute('checked', 'true');
                        document.querySelector("#trabaja").value = data[index].lugar;
                    }
                    if (data[index].tipo == "No Estudia") {
                        check[2].setAttribute('checked', 'true');
                    }
                    if (data[index].tipo == "No Trabaja") {
                        check[3].setAttribute('checked', 'true');
                    }
                }
            });
        </script>
<?php
    }
}
?>