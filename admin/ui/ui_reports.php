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
        <form id="form" action="" onsubmit="return false">

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
                                    <button id="consultar" type="submit" class="btn btn-primary">Consultar</button>
                                    <a href="#" class="btn btn-danger pdf">PDF</a>
                                    <a href="#" class="btn btn-success excel">Excel</a>
                                </div>
                            </div>
                            <div class="col-sm-12 col-12 col-md-12 col-lg-7 p-4">
                                <table class="table table-light">
                                    <thead class="thead-light" id="encabezado">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Nombre</th>
                                            <th>Ver</th>
                                            <th>Exportar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cuerpo">
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
                var tipo = $("[name=tipo]:checked").val();
                var buscar = $("[name=busqueda]:checked").val();

                $("input[name=tipo]").change(function() { // bind a function to the change event
                    if ($(this).is(":checked")) { // check if the radio is checked
                        selec_report($(this).val());
                        tipo = $("[name=tipo]:checked").val();
                        buscar = $("[name=busqueda]:checked").val();

                    }
                });

                $("input[name=busqueda]").change(function() { // bind a function to the change event
                    if ($(this).is(":checked")) { // check if the radio is checked
                        selec_report($(this).val());
                        tipo = $("[name=tipo]:checked").val();
                        buscar = $("[name=busqueda]:checked").val();
                    }
                });


                $("#consultar").click(function() {
                    switch (tipo) {
                        case 'diario':
                            consultas_diarias();
                            break;
                        case 'mes':
                            eventos_consulta('evento_mensual', $('#fecha_uno').val() + '-01');
                            break;
                        case 'anual':
                            eventos_consulta('evento_anual', $('#fecha_uno').val());
                            break
                    }
                });

                function consultas_diarias(){
                    switch(busqueda){
                        case 'evento':
                            eventos_consulta('evento_diario', $('#fecha_uno').val());
                            break;
                        case 'reunion':
                            reuniones_consulta('reunion_diario',$('#fecha_uno').val());
                            break;

                    }
                }

                function selec_report(select) {
                    let cliente = document.querySelector("#cliente");
                    let fecha_uno = document.querySelector("#fecha_uno");
                    let fecha_dos = document.querySelector("#fecha_dos");
                    let pdf = document.querySelector("#pdf");

                    switch (select) {
                        case "diario":

                            $(fecha_dos).attr('disabled', true);
                            $(fecha_uno).attr('type', 'date');
                            break;

                        case "mes":
                            $(fecha_dos).attr('disabled', true);
                            $(fecha_uno).attr('type', 'month');
                            break;

                        case "anual":
                            $(fecha_dos).attr('disabled', true);
                            $(fecha_uno).attr('type', 'number');
                            $(fecha_uno).attr('min', new Date().getFullYear() - 70);
                            $(fecha_uno).attr('value', new Date().getFullYear());
                            $(fecha_uno).attr('max', new Date().getFullYear() + 50);


                            break;

                        case "periodo":
                            $(fecha_uno).attr('type', 'date');
                            $(fecha_dos).attr('disabled', false);
                            break;
                        default:
                            break;
                    }
                }

                function eventos_consulta(action, fecha) {
                    $.ajax({
                        type: "post",
                        url: "controller.php?action=" + action,
                        data: {
                            fecha
                        },
                        dataType: "json",
                        success: function(response) {

                            document.getElementById('encabezado').innerHTML = `<th>Fecha</th>
            <th>Hora</th>
            <th>Nombre</th>
            <th>Lugar</th>
            <th>Editar</th>
            <th>Exportar</th>`
                            let tabla = document.getElementById('cuerpo');
                            tabla.innerHTML = '';
                            if (response != false) {

                                response.forEach(list => {
                                    tabla.innerHTML += `  <tr>
 
                                    <td>${list.fecha}</td>
                    <td>${list.inicio+ ' - ' + list.cierre}</td>
                    <td>${list.nombre_evento}</td>
                    <td>${list.lugar}</td>
                    <td><a href="evento.php?action=update_event&id=${list.id_evento}" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
                    <td><a href="" class="btn btn-info"><i class="fas fa-file-pdf"></a></td>
                </tr>`

                                });

                            } else {
                                alert('No se generaron Eventos el ' + $('#fecha_uno').val());
                            }
                        }
                    });
                }

                function reuniones_consulta(action, fecha) {
                    $.ajax({
                        type: "post",
                        url: "controller.php?action=" + action,
                        data: {
                            fecha
                        },
                        dataType: "json",
                        success: function(response) {

                            document.getElementById('encabezado').innerHTML = `<th>Fecha</th>
                            <th>Fecha</th>
                                        <th>#Reunion</th>
                                        <th>Elaborado</th>
                                        <th>Asunto</th>
                                                  <th>Editar</th>
            <th>Exportar</th>`
                            let tabla = document.getElementById('cuerpo');
                            tabla.innerHTML = '';
                            if (response != false) {

                                response.forEach(list => {
                                    tabla.innerHTML += `  <tr>
 
                                    <td>${list.fecha}</td>
                    <td>${list.numero}</td>
                    <td>${list.nombre+" "+list.primer_apellido+" "+list.segundo_apellido}</td>
                    <td>${list.objectivo}</td>                                         
                    <td><a <a href="acta.php?id_reunion=${list.id_reunion}" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
                    <td><a target="_blank" href="actas.php?id_reunion=${list.id_reunion}" class="btn btn-dark"><i class="fas fa-file-pdf"></i></a></td>
    </tr>`

                                });

                            } else {
                                alert('No se generaron Eventos el ' + $('#fecha_uno').val());
                            }
                        }
                    });
                }

                function ventas_consulta_periodo(inicio, final, action) {
                    $.ajax({
                        type: "post",
                        url: "controller.php",
                        data: {
                            inicio,
                            final,
                            action
                        },
                        dataType: "json",
                        success: function(response) {
                            document.getElementById('encabezado').innerHTML = `<th>Fecha</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Eliminar</th>
            <th>Editar</th>
            <th>Exportar</th>`
                            let tabla = document.getElementById('cuerpo');
                            tabla.innerHTML = '';
                            if (response != false) {
                                response.forEach(list => {
                                    tabla.innerHTML += `  <tr>
                    <td>${list.fecha}</td>
                    <td>${list.cliente}</td>
                    <td>${list['saldo']}</td>
                 </tr>`
                                });

                            } else {
                                alert('No hay registro de ventas');
                            }
                        }
                    });
                }


            });
        </script>
<?php
    }
}
?>