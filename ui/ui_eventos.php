<?php
require_once('ui/GUI.php');
class ui_eventos extends GUI {
	
	function __construct($config=null) {
		parent::__construct($config);
  }
    
  function action_controller() {}

  function build() {
    ?>
      <div class="banner container-fluid">
        <h2>EVENTOS</h2>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" name="" id="customSwitch1">
          <label for="customSwitch1" class="color_white custom-control-label">pasados</label>
        </div>
      </div>
    <?php
    $this->get_events();
    $this->get_modal();
  }

  function get_events(){
    ?>
    <div class="container-fluid">
      <div id="contenedor">
      <?php $this->get_card_event(array()); ?>
      <?php $this->get_card_event(array()); ?>
      <?php $this->get_card_event(array()); ?>
      </div>
    </div>
    <?php
    $this->get_partial_pages(3, 3);
  }

  function get_card_event($evento){
    $btn_txt="QUIERO PARTICIPAR";
    if (isset($_SESSION["id"])) {
      $btn_txt="INSCRIBIRME";
    }
    ?>
    <div class="card event event_fill mt-4 mb-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          <?php $this->get_slider(); ?>
          </div>
          <div class="col-sm-6">
            <div class="card-block descrip_fill_3 descrip_margen_left">
              <h4 class="color_orange">TÍTULO DEL EVENTO</h4><hr class="background_orange">
              <label>Fecha y hora</label><br>
              <span class="badge event_date">30 de diciembre, 2020</span>
              <span class="badge event_date">de 12:00 p.m. a 12:59 p.m.</span><br><br>
              <label for="">Lugar</label><br>
              <p class="event_p color_dark_gray text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <label for="">Descripción</label><br>
              <p class="event_p color_dark_gray text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
              Fugit adipisci saepe nisi rerum quo enim soluta, 
              natus temporibus vero architecto nostrum veniam odio. Id hic obcaecati accusantium! Incidunt,
              nisi veniam!</p>
              <div class="card-block text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop"><?=$btn_txt?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }

  function get_slider() {
    ?>
      <div class="carousel carousel--o-dots" data-flickity="{&quot;autoPlay&quot;: true, &quot;wrapAround&quot;: true}">
        <div class="carousel-cell" style="background-image: url(assets/img/banners/banner.jpg);
          background-position: center;background-size: cover;"></div>
        <div class="carousel-cell"></div>
      </div>
    <?php
  }

  function get_modal(){
    ?>
    <div class="modal fade" data-backdrop="static" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Registro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
          <?php if (isset($_SESSION["id"])) { ?>
            <form action="session.php?action=login" method="post">
              <div class="form-label-group" hidden>
              <input name="cedula" type="text" id="inputEmail" class="form-control" placeholder="Identificación" required autofocus>
              <label for="inputEmail">Identificación</label>
              </div>
              <div class="form-label-group">
              <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
              <label for="inputPassword">Contraseña</label>
              </div>
            </form>
          <?php } else { ?>
            <form action="session.php?action=login" method="post">
              <div class="form-label-group">
              <input name="nombre" type="text" id="inputEmail" class="form-control" placeholder="Nombre" required autofocus>
              <label for="inputEmail">Nombre</label>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-label-group">
                  <input name="nombre1" type="text" id="inputnombre1" class="form-control" placeholder="Primer apellido" required autofocus>
                  <label for="inputnombre1">Primer apellido</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-label-group">
                  <input name="nombre2" type="text" id="inputnombre2" class="form-control" placeholder="Segundo apellido" required autofocus>
                  <label for="inputnombre2">Segundo apellido</label>
                  </div>
                </div>
              </div>

              <div class="form-label-group">
              <input name="cedula" type="text" id="inputcedula" class="form-control" placeholder="Cédula" required autofocus>
              <label for="inputcedula">Cédula</label>
              </div>
              
              <div class="form-label-group">
              <input name="correo" type="email" id="inputcorreo" class="form-control" placeholder="Correo" required autofocus>
              <label for="inputcorreo">Correo</label>
              </div>

              <div class="form-label-group">
              <input name="nombre" type="date" id="inputdate" class="form-control" placeholder="fecha" required autofocus>
              <label for="inputdate">fecha</label>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <select class="form-control form-control-lg" id="exampleFormControlSelect1">
                      <option>género</option>
                      <option>Masculino</option>
                      <option>Femenino</option> 
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-label-group">
                  <input name="cantm" type="number" id="inputcantm" class="form-control" placeholder="Cant.Familiares" required autofocus>
                  <label for="inputcantm">Cant. Familiares</label>
                  </div>
                </div>
              </div>

            </form>
          <?php } ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>
    <?php
  }

}
?>