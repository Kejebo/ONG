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
        <h2>Lista de Seguimiento del Joven</h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <tbody>
            <tr>
                <td style="width: 25%;"><strong>Joven: </strong> <?= $data['nombre'] . ' ' . $data['primer_apellido'] ?></td>
                <td style="width: 25%;"><strong>Fecha: </strong> <?= $data['fecha'] ?></td>
                <td style="width: 50%;"><strong>Asunto: </strong> <?= $data['asunto'] ?></td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width: 100%; text-align:center;">Recomendaciones</td>
            </tr>
        </tbody>
    </table>
    
    <table>

        <thead>
            <tr>
                <th style="width: 25%; "><strong>Fecha </strong></th>
                <th style="width: 25%;"><strong>Autor</strong></th>
                <th style="width: 50%;"><strong>Nota</strong></th>
            </tr>
        </thead>

        <tbody>
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
    <table>
        <thead>
            <tr>
                <th style="width: 15%;"><strong> Fecha </strong></th>
                <th style="width: 35%;"><strong> Autor</strong></th>
                <th style="width: 50%;"><strong >Nota</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_observacion($_GET['id']) as $observacion) { ?>
              <tr>
                <td><?= $observacion['dia'] ?></td>
                <td><?= $observacion['nombre'] . ' ' . $observacion['primer_apellido'] . ' ' . $observacion['segundo_apellido'] ?></td>
                <td><?= $observacion['mensaje'] ?></td>
                </tr>
                <?php }  ?>
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