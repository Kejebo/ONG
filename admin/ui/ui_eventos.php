<?php
require_once('gui.php');
require_once('ln/ln_evento.php');
class ui_eventos extends gui
{
    var $ln;

    function __construct()
    {
        $this->ln = new ln_evento();
    }
    function get_build()
    {
?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="clearfix">
                            <div class="float-left">
                                <h3> Lista de Eventos </h3>
                            </div>
                            <div class="float-right mr-2">
                                <a href="evento.php" class="btn btn-info"><i class="far fa-calendar-alt"></i> Nuevo Evento</a>
                                <a href="excel.php?action=eventos" class="btn btn-success"><i class="fas fa-file-excel"></i> Exportar Historial</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="zero_config" class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Nombre</th>
                                    <th>Lugar</th>
                                    <th>Responsable</th>
                                    <th>Asistentes</th>
                                    <th>Inscribir</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                    <th>Exportar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($this->ln->db->get_eventos() as $evento){ ?>
                                    <tr>
                                        <td><?=$evento['fecha']?></td>
                                        <td><?=$evento['inicio'].' - '.$evento['cierre']?></td>
                                        <td><?=$evento['nombre_evento']?></td>
                                        <td><?=$evento['lugar']?></td>
                                        <td><?=$evento['mentor']?></td>
                                        <td><?=$evento['inscriptos']?></td>
                                        <td><a href="inscripciones.php?id=<?=$evento['id_evento']?>" class="btn btn-success"><i class="fas fa-user-plus"></i></a></td>
                                        <td><a href="evento.php?action=update_event&id=<?=$evento['id_evento']?>" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
                                        <td><a href="eventos.php?action=delete&id=<?=$evento['id_evento']?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                                        <td><a href="" class="btn btn-info"><i class="fas fa-file-pdf"></a></td>
                                    </tr>
                                <?php }?>
                                </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

<?php
    }
}

?>