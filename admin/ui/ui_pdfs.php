<?php

function get_seguimientos($db)
{
?>

    <div id="titulo">
        <h2>Lista de Seguimiento del Joven</h2>
    </div>
    <br>
    <br>
    <table  style="width: 100%; text-align:center;" align="center">
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

function get_asistencia_externa($db)
{
?>

    <div id="titulo">
        <h2>Lista de Visitantes en el evento <?=$db[0]['nombre']?></h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 20%">CEDULA</th>
                <th style="text-align: center;    width: 40%">Nombre</th>
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
        <h2>Lista de Asistencia de Jovenes en el evento <?=$db[0]['event']?></h2>
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