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

    <table>
        <tbody>
            <tr>
                <td style="width: 100%; text-align: center;">Recomendaciones</td>
            </tr>
        </tbody>
    </table>

    <table style="text-align: center;">

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
    <table>
        <tbody>
            <tr>
                <td style="width: 100%; text-align:center;">Observaciones</td>
            </tr>
        </tbody>
    </table>


    <table style="text-align: center;">
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
    <h2>Miembros que participaron</h2>
    <ul>
        <?php foreach ($db->get_facilitadores_seguimiento($_GET['id']) as $facilitador) { ?>
            <li><?= $facilitador['nombre'] . ' ' . $facilitador['primer_apellido'] . ' ' . $facilitador['segundo_apellido'] ?></li>
        <?php }  ?>

    </ul>
<?php
}

function get_joven($db)
{
    $ui = $db->get_joven($_GET['id'])[0];

?>
    <div id="titulo">
        <h2>Datos Personales</h2>
    </div>
    <br>
    <br>
    <table class="joven" border="1" cellspacing="0">
        <tbody>

            <tr>
                <td class="titulos" style="width: 30%;">Nombre Completo</td>
                <td class="datos" style="width: 70%;"><?= $ui['nombre'] . ' ' . $ui['primer_apellido'] . ' ' . $ui['segundo_apellido'] ?></td>
            </tr>

            <tr>
                <td class="titulos" style="width: 30%;">Cedula</td>
                <td class="datos" style="width: 70%;"><?= $ui['cedula'] ?></td>
            </tr>

            <tr>
                <td class="titulos" style="width: 30%;">Fecha de Nacimiento</td>
                <td class="datos" style="width: 70%;"><?= $ui['fecha_nacimiento'] ?></td>
            </tr>

            <tr>
                <td class="titulos" style="width: 30%;">Edad</td>
                <td class="datos" style="width: 70%;"><?= $ui['edad'] ?></td>
            </tr>

            <tr>
                <td class="titulos" style="width: 30%;">Correo</td>
                <td class="datos" style="width: 70%;"><?= $ui['correo'] ?></td>
            </tr>

            <tr>
                <td class="titulos" style="width: 30%;">Telefono</td>
                <td class="datos" style="width: 70%;"><?= $ui['telefono'] ?></td>
            </tr>

            <tr>
                <td class="titulos" style="width: 30%;">Genero</td>
                <td class="datos" style="width: 70%;"><?= $ui['genero'] ?></td>
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
            <tr style="background-color: black;">
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