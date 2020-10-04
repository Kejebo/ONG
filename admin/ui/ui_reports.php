<?php
require_once('gui.php');
require_once('db/db_evento.php');
class ui_reports extends gui
{
    var $db;
    function __construct()
    {
        $this->db = new db_evento();
    }
    function controller()
    {
    }

    function get_build()
    {

?>
        <form id="form" action="" method="get">

            <nav aria-label="Page breadcrumb ">
                <ol class="breadcrumb bg-dark">
                    <li class="breadcrumb-item text-white" aria-current="page">
                        <h4>Modulo de Reportes</h4>
                    </li>
                </ol>
            </nav>
            <div class="p-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Modulo de Reportes</h4>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-sm-12 col-12 col-md-12 col-lg-5 p-4">
                                <span class=""><strong>Tipo Consulta</strong></span>
                                <div class="text-center container">
                                    <label class="btn btn-primary">
                                        <input type="radio" checked name="tipo" class="tipo" value="diario"> Dia
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="tipo" class="tipo" value="mes"> Mensual
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="tipo" class="tipo" value="anual"> Anual
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="tipo" class="tipo" value="periodo"> Periodo
                                    </label> </div>
                                <input type="hidden" name="id" value="">
                                <label for="my-input">Fecha</label>

                                <div class="form-group row text-center">
                                    <div class="col-sm-6">
                                        <input id="fecha_uno" class="form-control" type="date" name="fecha_uno" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="fecha_dos" disabled class="form-control" type="date" name="fecha_dos" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="busqueda" checked value="evento"> Eventos
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="busqueda" value="reunion"> Reuniones
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="busqueda" value="seguimiento"> Seguimientos
                                    </label>
                                </div>

                                <br>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Consultar</button>
                                    <a href="#" class="btn btn-danger pdf">PDF</a>
                                    <a href="#" class="btn btn-success excel">Excel</a>
                                </div>
                            </div>
                            <div class="col-sm-12 col-12 col-md-12 col-lg-7 p-4">
                                <table class="table table-light">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Nombre</th>
                                            <th>Ver</th>
                                            <th>Exportar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->db->get_eventos_anual($_GET['fecha_uno']) as $evento) { ?>
                                            <tr>
                                                <td><?= $evento['fecha'] ?></td>
                                                <td><?= $evento['inicio'] ?></td>
                                                <td><?= $evento['nombre_evento'] ?></td>
                                                <td><?= $evento['lugar'] ?></td>
                                                <td><?= $evento['mentor'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>

                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            </div>
        </form>
        <script>
            window.addEventListener('load', function() {
   
                $("input[name=tipo]").change(function() { // bind a function to the change event
                    if ($(this).is(":checked")) { // check if the radio is checked
                        selec_report($(this).val());
                    }
                });



                function selec_report(select) {
                    let cliente = document.querySelector("#cliente");
                    let fecha_uno = document.querySelector("#fecha_uno");
                    let fecha_dos = document.querySelector("#fecha_dos");
                    let pdf = document.querySelector("#pdf");

                    switch (select) {
                        case "diario":
                            
                            $(fecha_dos).attr('disabled',true);
                            $(fecha_uno).attr('type','date');
                            break;

                        case "mes":
                            $(fecha_dos).attr('disabled',true);
                            $(fecha_uno).attr('type','month');
                            break;

                        case "anual":
                            $(fecha_dos).attr('disabled',true);
                            $(fecha_uno).attr('type','number');
                            $(fecha_uno).attr('min',new Date().getFullYear()-70);
                            $(fecha_uno).attr('value',new Date().getFullYear());
                            $(fecha_uno).attr('max',new Date().getFullYear()+50);


                             break;

                        case "periodo":
                            $(fecha_dos).attr('disabled',false);
                            break;
                        default:
                            break;
                    }
                }
            });
        </script>
<?php
    }
}
?>