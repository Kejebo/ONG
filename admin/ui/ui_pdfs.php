<?php

function get_seguimientos($db)
{
?>

    <div id="titulo">
        <h2>Lista de Seguimiento del Joven</h2>
    </div>
    <br>
    <br>

    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 15%">Fecha</th>
                <th style="text-align: center;    width: 30%">Joven</th>
                <th style="text-align: center;    width: 30%">Asunto</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($db as $seguimientos) { ?>
                <tr>
                    <td><?= $seguimientos['fecha'] ?></td>
                    <td><?= $seguimientos['nombre'] . ' ' . $seguimientos['primer_apellido'] . ' ' . $seguimientos['segundo_apellido'] ?></td>
                    <td><?= $seguimientos['asunto'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php
}

function get_seguimiento($db)
{

    $data = $db->get_seguimiento($_GET['id'])[0];
?>
    <div id="titulo">
        <h2>Seguimiento a <?= $data['nombre'] . ' ' . $data['primer_apellido'] . ' el día ' . $data['fecha'] ?> </h2>
    </div>
    <br>
    <br>

    <h3 style="text-align: center;">Recomendaciones</h2>

        <table class="joven" style="text-align: center;">

            <tbody>
                <tr>
                    <td style="width: 15%; "><strong>Fecha </strong></td>
                    <td style="width: 35%;"><strong>Autor</strong></td>
                    <td style="width: 50%;"><strong> Nota</strong></td>
                </tr>
                <?php foreach ($db->get_recomendacion($_GET['id']) as $recomendacion) { ?>
                    <tr>
                        <td> <?= $recomendacion['dia'] ?></td>
                        <td><?= $recomendacion['nombre'] . ' ' . $recomendacion['primer_apellido'] . ' ' . $recomendacion['segundo_apellido'] ?></td>
                        <td><?= $recomendacion['mensaje'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <h3 style="text-align:center;">Observaciones</h3>


        <table class="joven" style="text-align: center;">
            <tbody>
                <tr>
                    <td style="width: 15%;"><strong> Fecha </strong></td>
                    <td style="width: 35%;"><strong> Autor</strong></td>
                    <td style="width: 50%;"><strong>Nota</strong></td>
                </tr>
                <?php foreach ($db->get_observacion($_GET['id']) as $observacion) { ?>
                    <tr>
                        <td><?= $observacion['dia'] ?></td>
                        <td><?= $observacion['nombre'] . ' ' . $observacion['primer_apellido'] . ' ' . $observacion['segundo_apellido'] ?></td>
                        <td><?= $observacion['mensaje'] ?></td>
                    </tr>
                <?php }  ?>
            </tbody>
        </table>
        <h3 style="text-align: left;">Miembros que participaron:</h3>
        <ul>
            <?php foreach ($db->get_facilitadores_seguimiento($_GET['id']) as $facilitador) { ?>
                <li><?= $facilitador['nombre'] . ' ' . $facilitador['primer_apellido'] . ' ' . $facilitador['segundo_apellido'] ?></li>
            <?php }  ?>

        </ul>
    <?php
}

function get_joven($db)
{
    require_once('db/db_sedes.php');
    $sede = new db_sedes();
    $ui = $db->get_joven($_GET['id'])[0];
    $sede = $sede->get_sede($ui['sede'])[0];
    $nucleo = $db->get_familiares($_GET['id']);
    $horas = $db->get_horas($_GET['id']) == null ? 0 : $db->get_horas($_GET['id'])[0];
    ?>
        <div id="titulo">
            <h2>Datos Personales
                <hr>
            </h2>
        </div>
        <img style="max-width: 100px;" src="<?= $ui['foto'] ?>" alt="">
        <br>
        <br>
        <table class="joven" border="1" cellspacing="0">
            <tbody class="cuerpo">

                <tr>
                    <td class="titulos" style="width: 30%;">Nombre Completo</td>
                    <td class="datos" style="width: 30%;"><?= $ui['nombre'] . ' ' . $ui['primer_apellido'] . ' ' . $ui['segundo_apellido'] ?></td>
                    <td class="titulos" style="width: 20%;">Cedula</td>
                    <td class="datos" style="width: 20%;"><?= $ui['cedula'] ?></td>

                </tr>

                <tr>
                    <td class="titulos" colspan="1">Fecha de Nacimiento</td>
                    <td class="datos" colspan="1"><?= $ui['fecha_nacimiento'] ?></td>
                    <td class="titulos" colspan="1">Edad</td>
                    <td class="datos" colspan="1"><?= $ui['edad'] ?></td>
                </tr>


                <tr>
                    <td class="titulos" colspan="1">Correo</td>
                    <td class="datos" colspan="1"><?= $ui['correo'] ?></td>
                    <td class="titulos" colspan="1">Telefono</td>
                    <td class="datos" colspan="1"><?= $ui['telefono'] ?></td>
                </tr>

                <tr>
                    <td class="titulos" colspan="1">Genero</td>
                    <td class="datos" colspan="1"><?= $ui['genero'] ?></td>
                    <td class="titulos" colspan="1">Estado Civil</td>
                    <td class="datos" colspan="1"><?= $ui['estado_civil'] ?></td>
                </tr>

                <tr>
                    <td class="titulos" colspan="1">Cant Miembros</td>
                    <td class="datos" colspan="1"><?= $ui['cant_miembros'] ?></td>
                    <td class="titulos" colspan="1">Ayuda Social</td>
                    <td class="datos" colspan="1"><?= $ui['ayuda_social'] == 1 ? "Si" : "No" ?></td>
                </tr>
                <tr>
                    <td class="titulos" colspan="1">Generacion</td>
                    <td class="datos" colspan="1"><?= $ui['generacion'] ?></td>
                    <td class="titulos" colspan="1">Sede</td>
                    <td class="datos" colspan="1"><?= $sede['nombre_sede'] ?></td>
                </tr>
                <tr>
                    <td class="titulos" colspan="1">Domicilio</td>
                    <td class="datos" colspan="3"><?= $ui['direccion'] ?></td>
                </tr>
                <tr>
                    <td class="titulos" colspan="1">Horas de Voluntariado</td>
                    <td class="datos" colspan="3"><?= $horas == 0 ? 0 : $horas['horas'] ?></td>
                </tr>
            </tbody>
        </table>

        <h3>Contacto de Emergencia</h3>
        <table class="joven" border="1" cellspacing="0">
            <tbody class="cuerpo">
                <tr>
                    <td class="titulos" style="width: 15%;">Nombre</td>
                    <td class="datos" style="width: 20%;"><?= $ui['nombre_familiar'] ?></td>
                    <td class="titulos" style="width: 15%;">Telefono</td>
                    <td class="datos" style="width: 15%;"><?= $ui['telefono_familiar'] ?></td>
                    <td class="titulos" style="width: 25%;">Rasgo Familiar</td>
                    <td class="datos" style="width: 10%;"><?= $ui['tipo_conocido'] ?></td>

                </tr>

            </tbody>
        </table>
        <h3>Nucleo Familiar</h3>
        <table class="joven" border="1" cellspacing="0">
            <tbody class="cuerpo">
                <?php foreach ($nucleo as $familiar) { ?>
                    <tr>
                        <td class="titulos" style="width: 15%;">Nombre</td>
                        <td class="datos" style="width: 20%;"><?= $familiar['nombre_familiar'] ?></td>
                        <td class="titulos" style="width: 20%;">Rasgo Familiar</td>
                        <td class="datos" style="width: 15%;"><?= $familiar['rol'] ?></td>
                        <td class="titulos" style="width: 10%;">Jefe</td>
                        <td class="datos" style="width: 20%;"><?= $familiar['lider'] ?></td>
                    </tr> <?php } ?>
            </tbody>

            </tbody>
        </table>
    <?php
}

function get_usuario($db)
{
    require_once('db/db_sedes.php');
    $sede = new db_sedes();
    $ui = $db->get_usuario($_GET['id'])[0];
    $sede = $sede->get_sede($ui['sede'])[0];
    ?>
        <div id="titulo">
            <h2>Datos Personales
                <hr>
            </h2>
        </div>
        <img style="max-width: 100px;" src="<?= $ui['foto'] ?>" alt="">
        <br>
        <br>
        <table class="joven" border="1" cellspacing="0">
            <tbody class="cuerpo">

                <tr>
                    <td class="titulos" style="width: 30%;">Nombre Completo</td>
                    <td class="datos" style="width: 30%;"><?= $ui['nombre'] . ' ' . $ui['primer_apellido'] . ' ' . $ui['segundo_apellido'] ?></td>
                    <td class="titulos" style="width: 20%;">Cedula</td>
                    <td class="datos" style="width: 20%;"><?= $ui['cedula'] ?></td>

                </tr>

                <tr>
                    <td class="titulos" colspan="1">Fecha de Nacimiento</td>
                    <td class="datos" colspan="1"><?= $ui['fecha_nacimiento'] ?></td>
                    <td class="titulos" colspan="1">Estado</td>
                    <td class="datos" colspan="1"><?= $ui['estado'] ?></td>
                </tr>


                <tr>
                    <td class="titulos" colspan="1">Correo</td>
                    <td class="datos" colspan="1"><?= $ui['correo'] ?></td>
                    <td class="titulos" colspan="1">Telefono</td>
                    <td class="datos" colspan="1"><?= $ui['telefono'] ?></td>
                </tr>

                <tr>
                    <td class="titulos" colspan="1">Genero</td>
                    <td class="datos" colspan="1"><?= $ui['genero'] ?></td>
                    <td class="titulos" colspan="1">Estado Civil</td>
                    <td class="datos" colspan="1"><?= $ui['estado_civil'] ?></td>
                </tr>

                <tr>
                    <td class="titulos" colspan="1">Sede</td>
                    <td class="datos" colspan="1"><?= $sede['nombre_sede'] ?></td>

                    <td class="titulos" colspan="1">Domicilio</td>
                    <td class="datos" colspan="3"><?= $ui['direccion'] ?></td>
                </tr>
                <tr>
                    <td class="titulos" colspan="1">Experiencia</td>
                    <td class="datos" colspan="1"><?= $ui['experiencia'] ?></td>
                    <td class="titulos" colspan="1">Rol</td>
                    <td class="datos" colspan="1"><?= $ui['tipo'] ?></td>
                </tr>
            </tbody>
        </table>

    <?php
}
function get_asistencia_externa($db)
{
    ?>
        <div id="titulo">
            <h2>Lista de Voluntarios asistentes para el evento <?= $db[0]['nombre'] ?></h2>
        </div>
        <br>
        <br>
        <table style="width: 100%; text-align:center;" align="center">
            <thead>
                <tr style="background-color: black; color:white">
                    <th style="text-align: center;    width: 20%">CEDULA</th>
                    <th style="text-align: center;    width: 40%">NOMBRE</th>
                    <th style="text-align: center;    width: 30%">FIRMA</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($db as $asistente) { ?>
                    <tr>
                        <td><?= $asistente['cedula'] ?></td>
                        <td><?= $asistente['nombre_completo'] ?></td>
                        <td></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php
}

function get_jovenes_evento($db)
{
    ?>

        <div id="titulo">
            <h2>Lista de Asistencia de Jovenes en el evento <?= $db[0]['event'] ?></h2>
        </div>
        <br>
        <br>
        <table style="width: 100%; text-align:center;" align="center">
            <thead>
                <tr style="background-color: black;">
                    <th style="text-align: center;    width: 20%">CEDULA</th>
                    <th style="text-align: center;    width: 40%">NOMBRE</th>
                    <th style="text-align: center;    width: 30%">FIRMA</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($db as $jovenes) { ?>
                    <tr>
                        <td><?= $jovenes['cedula'] ?></td>
                        <td><?= $jovenes['joven'] . ' ' . $jovenes['primer_apellido'] . ' ' . $jovenes['segundo_apellido'] ?></td>
                        <td></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php
}
    ?>