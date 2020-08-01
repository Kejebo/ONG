function asuntos(form){

    event.preventDefault();
    let id=document.getElementById('id').value;
    let asunto=document.getElementById('asunto').value; 
    form.reset();
    $.ajax({
    data:  {id,asunto},
    url:   'controller.php?action=asunto', 
    type:  'post', 
    success: function (response){
        let dato= JSON.parse(response);
        let tabla=document.querySelector("#asuntos");
        dato.forEach(element => {
            tabla.innerHTML+=`<tr><td>${element.actividad}</td>
            <td><a href="acta.php?action=delete_asunto&id=${element.id_asunto}&id_reunion=${element.id_reunion}" class="btn btn-danger">-</a></td>
            </tr>`;
                        
        });
    }
  
  });
  }


    
    function escritura(){
      document.querySelector('.alert').style.display='none';
  }
  
  function acuerdos(form){

    event.preventDefault();
    let id=document.getElementById('id').value;
    let encargado=document.getElementById('encargado_acuerdo').value; 
    let actividad=document.getElementById('actividad_acuerdo').value; 
    form.reset();
    $.ajax({
    data:  {id,encargado,actividad},
    url:   'controller.php?action=acuerdos', 
    type:  'post', 
    success: function (response){
        let dato= JSON.parse(response);
        let tabla=document.querySelector("#acuerdo");
        tabla.innerHTML='';
        dato.forEach(element => {
            tabla.innerHTML+=`<tr><td>${element.actividad}</td><td>${element.encargado}</td>
            <td><a href="acta.php?action=delete_acuerdo&id=${element.id_acuerdo}&id_reunion=${element.id_reunion}" class="btn btn-danger">-</a></td>
            </tr>`;
                        
        });
    }
  
  });
  }

  function objectivo(){

    let nombre=document.getElementById('nombre_objectivo').value; 
    $.ajax({
    data:  {nombre},
    url:   'controller.php?action=objectivos', 
    type:  'post', 
    success: function (response){
        let dato= JSON.parse(response);
        let combo=document.querySelector("#objectivo");
        combo.innerHTML='';
        dato.forEach(element => {
          if(nombre==element.nombre_objectivo){
            combo.innerHTML+= `<option selected value="${element.id_objectivo}">${element.nombre_objectivo}</option>`
          }else{
            combo.innerHTML+= `<option value="${element.id_objectivo}">${element.nombre_objectivo}</option>`
        
          }
        });
    }
  
  });
  }

  function categoria(){

    let nombre=document.getElementById('nombre_categoria').value; 
    $.ajax({
    data:  {nombre},
    url:   'controller.php?action=categorias', 
    type:  'post', 

    success: function (response){
      console.log(response);
      let dato= JSON.parse(response);

        let combo=document.querySelector("#categoria");
        combo.innerHTML='';
        dato.forEach(element => {
          if(nombre==element.nombre_categoria){
            combo.innerHTML+= `<option selected value="${element.id_categoria}">${element.nombre_categoria}</option>`
          }else{
            combo.innerHTML+= `<option value="${element.id_categoria}">${element.nombre_categoria}</option>`
        
          }
        });
    }
  
  });
  }
  
  function agenda(form){

    event.preventDefault();
    let id=document.getElementById('id').value;
    let encargado=document.getElementById('encargado_agenda').value; 
    let actividad=document.getElementById('actividad_agenda').value; 
    form.reset();
    $.ajax({
    data:  {id,encargado,actividad},
    url:   'controller.php?action=agenda', 
    type:  'post', 
    success: function (response){
        let dato= JSON.parse(response);
        let tabla=document.querySelector("#agenda");
        tabla.innerHTML='';
        dato.forEach(element => {
            tabla.innerHTML+=`<tr><td>${element.encargado}</td><td>${element.actividad}</td>
            <td><a href="acta.php?action=delete_agenda&id=${element.id_agenda}&id_reunion=${element.id_reunion}" class="btn btn-danger">-</a></td>
            </tr>`;
                        
        });
    }
  
  });
  }
  function asistencia(form){

    event.preventDefault();
    let id=document.getElementById('id').value;
    let encargado=document.getElementById('encargado_asistencia').value; 
    let representa=document.getElementById('representa').value; 
    form.reset();
    $.ajax({
    data:  {id,encargado,representa},
    url:   'controller.php?action=asistencia', 
    type:  'post', 
    success: function (response){
        let dato= JSON.parse(response);
        let tabla=document.querySelector("#asistencia");
        tabla.innerHTML='';
        dato.forEach(element => {
            tabla.innerHTML+=`<tr><td>${element.encargado}</td><td>${element.representa}</td>
            <td><a href="acta.php?action=delete_asistencia&id=${element.id_asistencia}&id_reunion=${element.id_reunion}" class="btn btn-danger">-</a></td>
            </tr>`;
                        
        });
    }
  
  });
  }
