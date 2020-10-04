$("input[name=tipo]").change(function(){ // bind a function to the change event
        if( $(this).is(":checked") ){ // check if the radio is checked
           alert($(this).val()); // retrieve the value
        }
    });
function selec_report(sel) {
    var opciones = sel.options[sel.selectedIndex].textContent;
    let cliente = document.querySelector("#cliente");
    let fecha_uno = document.querySelector("#fecha_uno");
    let fecha_dos = document.querySelector("#fecha_dos");
    let pdf = document.querySelector("#pdf");
    document.getElementById("cuerpo").innerHTML = '';
  
    switch (opciones) {
      case "diario":
        consultar.disabled = false;
        document.getElementById("excel").hidden = false;
        update_action("Inventory");
        break;
  
      case "Clientes":
        update_action("Clients");
        consultar.disabled = true;
        document.getElementById("excel").hidden = true;
        update_action("Clients");
        break;
  
      case "Motos de Cliente":
        update_action("Motos_cliente");
        cliente.style.display = "block";
        document.getElementById("excel").hidden = true;
        break;
  
      case "Proveedores":
        update_action("Venta_Proveedor");
        consultar.disabled = true;
        document.getElementById("excel").hidden = true;
        break;
      case "Ventas General":
        consultar.disabled = true;
        document.getElementById("excel").hidden = true;
        update_action("Venta_General");
        break;
      case "Ventas Diaria":
        fecha.style.display = "block";
        document.getElementById("excel").hidden = true;
        update_action("Venta_Diaria");
        break;
  
      case "Ventas Mensuales":
        fecha.style.display = "block";
        document.getElementById("excel").hidden = true;
        dia.setAttribute("type", "month");
        update_action("Venta_Mensuales");
        break;
      case "Ventas Anuales":
        fecha.style.display = "block";
        document.getElementById("excel").hidden = true;
        dia.setAttribute("type", "number");
        dia.setAttribute("min", "2020");
        dia.setAttribute("max", "3000");
        dia.value = "2020";
        update_action("Venta_Anual");
        break;
      case "Ventas Periodica":
        update_action("Venta_Periodica");
        document.getElementById("excel").hidden = true;
        inicio.style.display = "block";
        final.style.display = "block";
  
        break;
      case "Compras General":
        consultar.disabled = true;
        document.getElementById("excel").hidden = true;
        pdf.setAttribute("href", "pdf.php?data=Compras");
        break;
      case "Compras Diaria":
        fecha.style.display = "block";
        document.getElementById("excel").hidden = true;
        break;
  
      case "Compras Mensuales":
        fecha.style.display = "block";
        document.getElementById("excel").hidden = true;
        dia.setAttribute("type", "month");
        break;
      case "Compras Anuales":
        fecha.style.display = "block";
        dia.setAttribute("type", "number");
        dia.setAttribute("min", "2020");
        dia.setAttribute("max", "3000");
        document.getElementById("excel").hidden = true;
        dia.value = "2020";
        break;
  
      case "Compras Periodica":
        inicio.style.display = "block";
        final.style.display = "block";
        document.getElementById("excel").hidden = true;
        break;
      case "Reparaciones General":
        consultar.disabled = true;
  
        break;
      case "Reparaciones Diaria":
        fecha.style.display = "block";
        document.getElementById("excel").hidden = true;
        break;
  
      case "Reparaciones Mensuales":
        fecha.style.display = "block";
        dia.setAttribute("type", "month");
        document.getElementById("excel").hidden = true;
  
        break;
      case "Reparaciones Anuales":
        fecha.style.display = "block";
        dia.setAttribute("type", "number");
        dia.setAttribute("min", "2020");
        dia.setAttribute("max", "3000");
        dia.value = "2020";
        document.getElementById("excel").hidden = true;
        break;
      case "Reparaciones Periodica":
        inicio.style.display = "block";
        final.style.display = "block";
        document.getElementById("excel").hidden = true;
        break;
      default:
        break;
    }
  }