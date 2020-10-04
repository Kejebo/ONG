window.addEventListener('load', function () {
  var tipo = $("[name=tipo]:checked").val();
  var buscar = $("[name=busqueda]:checked").val();

  $("input[name=tipo]").change(function () {
    if ($(this).is(":checked")) {
      selec_report($(this).val());
      tipo = $("[name=tipo]:checked").val();
      buscar = $("[name=busqueda]:checked").val();

    }
  });

  $("input[name=busqueda]").change(function () {
    if ($(this).is(":checked")) {
      selec_report($(this).val());
      tipo = $("[name=tipo]:checked").val();
      buscar = $("[name=busqueda]:checked").val();
      if(buscar=='seguimiento'){
        $('#excel').css('display', 'none')
      }else{
        $('#excel').css('display', 'inline-block');
      }
    }

  });


  $("#consultar").click(function () {
    switch (tipo) {
      case 'diario':
        consultas_diarias();
        break;
      case 'mes':
        consultas_mensual();
        break;
      case 'anual':
        consultas_anual();
        break
      case 'periodo':
        consultas_periodos()
        break
    }
  });

  $("#excel").click(function () {
    switch (tipo) {
      case 'diario':
        excel_diarias();
        break;
      case 'mes':
        excel_mensual();
        break;
      case 'anual':
        excel_anual();
        break
      case 'periodo':
        excel_periodo();
        break
    }
  });
  function excel_diarias() {
    switch (buscar) {
      case 'evento':
        redirect_evento_diaria();
        break;
      case 'reunion':
        redirect_reunion_diaria();
        break;

      case 'seguimiento':
        redirect_seguimiento_diaria();
        break;
    }
  }
  function excel_mensual() {
    switch (buscar) {
      case 'evento':
        redirect_evento_mensual();
        break;
      case 'reunion':
        redirect_reunion_mensual();
        break;

      case 'seguimiento':
        redirect_seguimiento_mensual();
        break;
    }
  }
  function excel_anual() {
    switch (buscar) {
      case 'evento':
        redirect_evento_anual();
        break;
      case 'reunion':
        redirect_reunion_anual();
        break;
      case 'seguimiento':
        redirect_seguimiento_anual();
        break;
    }
  }
  function excel_periodo() {
    switch (buscar) {
      case 'evento':
        redirect_evento_periodo();
        break;
      case 'reunion':
        redirect_reunion_periodo();
        break;

      case 'seguimiento':
        redirect_seguimiento_periodo();
        break;
    }
  }
  function redirect_evento_diaria() {
    $('#excel').attr('href', 'excel.php?action=eventos_diarios&fecha='+$('#fecha_uno').val());
  }
  function redirect_reunion_diaria() {
    $('#excel').attr('href', 'excel.php?action=reuniones_diarios&fecha='+$('#fecha_uno').val());
  }
  function redirect_seguimiento_diaria() {
    $('#excel').attr('href', 'excel.php?action=seguimiento_diarios&fecha='+$('#fecha_uno').val());
  }
  function redirect_evento_mensual() {
    $('#excel').attr('href', 'excel.php?action=eventos_mensual&fecha='+$('#fecha_uno').val()+"-01");
  }
  function redirect_reunion_mensual() {
    $('#excel').attr('href', 'excel.php?action=reunion_mensual&fecha='+$('#fecha_uno').val()+"-01");
  }
  function redirect_seguimiento_anual() {
    $('#excel').attr('href', 'excel.php?action=seguimiento_mensual&fecha='+$('#fecha_uno').val()+"-01");
  }
  function redirect_evento_anual() {
    $('#excel').attr('href', 'excel.php?action=eventos_anual&fecha='+$('#fecha_uno').val());
  }
  function redirect_reunion_anual() {
    $('#excel').attr('href', 'excel.php?action=reunion_anual&fecha='+$('#fecha_uno').val());
  }
  function redirect_seguimiento_anual() {
    $('#excel').attr('href', 'excel.php?action=seguimiento_anual&fecha='+$('#fecha_uno').val());
  }
  function redirect_evento_periodo() {
    $('#excel').attr('href', 'excel.php?action=eventos_periodo&inicio='+$('#fecha_uno').val()+"&final="+$('#fecha_dos').val());
  }
  function redirect_reunion_periodo() {
    $('#excel').attr('href', 'excel.php?action=reunion_periodo&inicio='+$('#fecha_uno').val()+"&final="+$('#fecha_dos').val());
  }
  function redirect_seguimiento_periodo() {
    $('#excel').attr('href', 'excel.php?action=seguimiento_periodo&inicio='+$('#fecha_uno').val()+"&final="+$('#fecha_dos').val());
  }


  function consultas_diarias() {
    switch (buscar) {
      case 'evento':
        eventos_consulta('evento_diario', $('#fecha_uno').val());
        break;
      case 'reunion':
        reuniones_consulta('reunion_diario', $('#fecha_uno').val());
        break;

      case 'seguimiento':
        seguimientos_consulta('seguimiento_diario', $('#fecha_uno').val());
        break;
    }
  }

  function consultas_mensual() {
    switch (buscar) {
      case 'evento':
        eventos_consulta('evento_mensual', $('#fecha_uno').val() + "-01");
        break;
      case 'reunion':
        reuniones_consulta('reunion_mensual', $('#fecha_uno').val() + "-01");
        break;
      case 'seguimiento':
        seguimientos_consulta('seguimiento_mensual', $('#fecha_uno').val() + "-01");
        break;

    }
  }

  function consultas_anual() {
    switch (buscar) {
      case 'evento':
        eventos_consulta('evento_anual', $('#fecha_uno').val());
        break;
      case 'reunion':
        reuniones_consulta('reunion_anual', $('#fecha_uno').val());
        break;
      case 'seguimiento':
        seguimientos_consulta('seguimiento_anual', $('#fecha_uno').val());

        break;

    }
  }

  function consultas_periodos() {
    switch (buscar) {
      case 'evento':
        eventos_consulta_periodo($('#fecha_uno').val(), $('#fecha_dos').val(), 'evento_periodo');
        break;
      case 'reunion':

        reunion_consulta_periodo($('#fecha_uno').val(), $('#fecha_dos').val(), 'reunion_periodo');
        break;
      case 'seguimiento':
        seguimientos_consulta_periodo($('#fecha_uno').val(), $('#fecha_dos').val(), 'seguimiento_periodo');
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
      success: function (response) {

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
      <td>${list.inicio + ' - ' + list.cierre}</td>
      <td>${list.nombre_evento}</td>
      <td>${list.lugar}</td>
      <td><a target="_blank" href="evento.php?action=update_event&id=${list.id_evento}" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
      <td><a target="_blank" href="" class="btn btn-info"><i class="fas fa-file-pdf"></a></td>
  </tr>`

          });

        } else {
          alert('No se generaron Eventos el ' + $('#fecha_uno').val());
        }
      }
    });
  }

  function seguimientos_consulta(action, fecha) {
    $.ajax({
      type: "post",
      url: "controller.php?action=" + action,
      data: {
        fecha
      },
      dataType: "json",
      success: function (response) {

        document.getElementById('encabezado').innerHTML = `
              <th>Fecha</th>
                              <th>Ultima Edicion</th>
                              <th>Asunto</th>
                              <th>Editar</th>
                              <th>Exportar</th>
                     `
        let tabla = document.getElementById('cuerpo');
        tabla.innerHTML = '';
        if (response != false) {

          response.forEach(list => {
            tabla.innerHTML += `  <tr>

                      <td>${list.fecha}</td>
      <td>${list.nombre + ' ' + list.primer_apellido + ' ' + list.segundo_apellido}</td>
      <td>${list.asunto}</td>
      <td><a target"blanck" href="seguimiento.php?id_seguimiento=${list.id_seguimiento}" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
      <td><a target="blank" href="pdfs.php?action=seguimiento&id=${list.id_seguimiento}" class="btn btn-dark"><i class="fas fa-file-pdf"></i></a></td>
 
      </tr>`

          });

        } else {
          alert('No se generaron Seguimientos el ' + $('#fecha_uno').val());
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
      success: function (response) {
        document.getElementById('encabezado').innerHTML = `<th>Fecha</th>
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
      <td>${list.nombre + " " + list.primer_apellido + " " + list.segundo_apellido}</td>
      <td>${list.objectivo}</td>                                         
      <td><a <a target="_blank" href="acta.php?id_reunion=${list.id_reunion}" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
      <td><a target="_blank" href="actas.php?id_reunion=${list.id_reunion}" class="btn btn-dark"><i class="fas fa-file-pdf"></i></a></td>
</tr>`

          });

        } else {
          alert('No se generaron Eventos el ' + $('#fecha_uno').val());
        }
      }
    });
  }


  function seguimientos_consulta_periodo(inicio, final, action) {
    $.ajax({
      type: "post",
      url: "controller.php?action=" + action,
      data: {
        inicio,
        final
      },
      dataType: "json",
      success: function (response) {

        document.getElementById('encabezado').innerHTML = `
              <th>Fecha</th>
                              <th>Ultima Edicion</th>
                              <th>Asunto</th>
                              <th>Editar</th>
                              <th>Exportar</th>
                     `
        let tabla = document.getElementById('cuerpo');
        tabla.innerHTML = '';
        if (response != false) {

          response.forEach(list => {
            tabla.innerHTML += `  <tr>

                      <td>${list.fecha}</td>
      <td>${list.nombre + ' ' + list.primer_apellido + ' ' + list.segundo_apellido}</td>
      <td>${list.asunto}</td>
      <td><a target"blanck" href="seguimiento.php?id_seguimiento=${list.id_seguimiento}" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
      <td><a target="blank" href="pdfs.php?action=seguimiento&id=${list.id_seguimiento}" class="btn btn-dark"><i class="fas fa-file-pdf"></i></a></td>
 
      </tr>`

          });

        } else {
          alert('No se generaron Seguimientos el ' + $('#fecha_uno').val());
        }
      }
    });
  }

  function eventos_consulta_periodo(inicio, final, action) {
    $.ajax({
      type: "post",
      url: "controller.php?action=" + action,
      data: {
        inicio,
        final
      },
      dataType: "json",
      success: function (response) {
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
      <td>${list.inicio + ' - ' + list.cierre}</td>
      <td>${list.nombre_evento}</td>
      <td>${list.lugar}</td>
      <td><a target="_blank" href="evento.php?action=update_event&id=${list.id_evento}" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
      <td><a target="_blank" href="" class="btn btn-info"><i class="fas fa-file-pdf"></a></td>
  </tr>`

          });

        } else {
          alert('No se generaron Eventos desde el ' + $('#fecha_uno').val() + ' al ' + $('#fecha_dos').val());
        }
      }
    });
  }

  function reunion_consulta_periodo(inicio, final, action) {
    $.ajax({
      type: "post",
      url: "controller.php?action=" + action,
      data: {
        inicio,
        final
      },
      dataType: "json",
      success: function (response) {
        document.getElementById('encabezado').innerHTML = `<th>Fecha</th>
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
      <td>${list.nombre + " " + list.primer_apellido + " " + list.segundo_apellido}</td>
      <td>${list.objectivo}</td>                                         
      <td><a <a target="_blank" href="acta.php?id_reunion=${list.id_reunion}" class="btn btn-warning"><i class="far fa-edit"></i></a></td>
      <td><a target="_blank" href="actas.php?id_reunion=${list.id_reunion}" class="btn btn-dark"><i class="fas fa-file-pdf"></i></a></td>
</tr>`

          });
        } else {
          alert('No se generaron Reuniones desde el ' + $('#fecha_uno').val() + ' al ' + $('#fecha_dos').val());
        }
      }
    });
  }



});
