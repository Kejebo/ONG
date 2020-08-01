<?php
require_once('db/db_reunion.php');
$db = new db_reunion();
$datos = $db->get_reunion($_GET['id_reunion']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/861Logo Dale Una Mano.png">

    <title><?='Acta #'.$datos['numero'].' '.$datos['dia']?></title>

</head>
<style>
    img {
        max-width: 100px;
        margin-left: 10px;
    }

    .encabezados_asignaciones {
        background-color: azure;
        font-style: italic;
    }

    .asignaciones {
        background-color: #131E72;
        color: white;
        font-weight: bold;

    }
  

    h1 {
        margin-bottom: 20px;
        text-align: center;
        color: orange;
    }

    table {
        width: 100%;
        vertical-align: middle;
        border-collapse: collapse;

    }

    .datos {
        width: 560px;
    }


    .reunion {
        width: 140px;
    }

    td {
        font-size: 16px;
        border: black 1px solid;
    }

    .encabezado {
        background-color: #131E72;
        color: white;
        height: 40px;
        font-weight: bold;

    }

    #content {
        display: flex;
        justify-content: center;
        width: 100%;
    }
</style>

<body>
    <img src="assets/861Logo Dale Una Mano.png">
    <br>
    <br>
    <h1>Bitacora de Reuniones</h1>
    <br>
    <div id="content">
        <table>
            <tbody>
                <tr class="encabezado">
                    <td class="reunion">Reunion #<?=$datos['numero']?></td>
                    <td style="width:240px; text-align: center;">Reunion de Junta Directiva D1MCR</td>
                    <td style="width:350px; text-align: center;">Fecha: <?= $datos['dia'] ?></td>
                </tr>
                <tr>
                    <td class="reunion"> Objectivos:</td>
                    <td colspan="2"> <label><?= $datos['objectivo'] ?></label></td>
                </tr>
                <tr>
                    <td class="reunion"> <label>Lugar</label></td>
                    <td colspan="2"> <label><?= $datos['lugar'] ?></label></td>
                </tr>

            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td class="reunion">Hora de Inicio</td>
                    <td style="width: 150px; text-align: center;"><?= $datos['inicio'] ?></td>
                    <td class="reunion">Hora de Finalizacion</td>
                    <td style="width: 293px; text-align: center;"><?= $datos['cierre'] ?></td>

                </tr>

            </tbody>
        </table>

        <table>
            <tbody>
                <tr>
                    <td class="asignaciones" style="width: 744px; text-align: center;">I. Agenda</td>
                </tr>

            </tbody>
        </table>
        <table>
            <tbody>
                <tr class="encabezados_asignaciones">
                    <td style="width: 372px; text-align: center;">Actividad</td>
                    <td style="width: 365px; text-align: center;">Responsable</td>
                </tr>
                <?php foreach ($db->get_agendas($_GET['id_reunion']) as $agenda) { ?>
                    <tr>
                        <td><?= $agenda['actividad'] ?></td>
                        <td><?= $agenda['encargado'] ?></td>
                    </tr>

                <?php } ?>



            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td class="asignaciones" style="width: 744px; text-align: center;">II. Asistencia</td>
                </tr>

            </tbody>
        </table>
        <table>
            <tbody>
                <tr class="encabezados_asignaciones">
                    <td style="width: 372px; text-align: center;">Nombre</td>
                    <td style="width: 200px; text-align: center;">Representando</td>
                    <td style="width: 158px; text-align: center;">Firma</td>

                </tr>
                <?php
                foreach ($db->get_asistencia($_GET['id_reunion']) as $asistencia) { ?>
                    <tr>
                        <td><?= $asistencia['encargado'] ?></td>
                        <td><?= $asistencia['representa'] ?></td>
                        <td></td>
                    </tr>

                <?php } ?>

            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td class="asignaciones" style="width: 744px; text-align: center;">III. Asuntos Discutidos</td>
                </tr>
                <tr>
                    <td>
                        <ul style="width: 80%;">
                            <?php
                            foreach ($db->get_asuntos($_GET['id_reunion']) as $asunto) { ?>

                                <li><?= $asunto['actividad'] ?></li>
                                <br>
                            <?php } ?>
                        </ul>
                    </td>
                </tr>

            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td class="asignaciones" style="width: 744px; text-align: center;">IV. Acuerdos</td>
                </tr>

            </tbody>
        </table>
        <table>
            <tbody>
                <tr class="encabezados_asignaciones">
                    <td style="width: 372px; text-align: center;">Acuerdos</td>
                    <td style="width: 365px; text-align: center;">Responsable</td>

                </tr>
                <?php
                foreach ($db->get_acuerdos($_GET['id_reunion']) as $acuerdos) { ?>
                    <tr>
                        <td><?= $acuerdos['actividad'] ?></td>
                        <td><?= $acuerdos['encargado'] ?></td>

                    </tr>

                <?php } ?>
                    <tr>
                        <td colspan="2"><strong><?=$datos['nombre'].' '.$datos['primer_apellido'].' '.$datos['segundo_apellido']?></strong> </td>
                    </tr>
            </tbody>
        </table>

    </div>
</body>

</html>