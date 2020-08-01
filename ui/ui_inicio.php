<?php
require_once('ui/GUI.php');

class ui_inicio extends GUI {
	
	function __construct($config=null) {
		parent::__construct($config);
  }
    
  function action_controller() {}

  function build() {
    $this->get_slider();
    $this->get_options_principals();
    $this->get_testimonials();
  }

  public function get_slider()
  {
    ?>
    <div class="main-carousel" data-flickity="{&quot;autoPlay&quot;: true, &quot;wrapAround&quot;: true}">
      <div class="carousel-cell" style="background-image: url(assets/img/banners/banner1.jpg);
          background-position: center;
          background-size: cover">
        <div class="oscurecido centrar_items">
          <div class="container text-left margen_main_slider">
            <h1 class="color_white">¡ BIENVENIDO !</h1>
            <p class="margen_p color_gray">Lorem ipsum dolor sit amet, consectetur adipisicing elit.<br> 
            Rem exercitationem earum porro consectetur iusto atque iure illum est,<br></p>
            <p><a href="" class="btn btn-lg btn-light">Ver más</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-cell"></div>
      <div class="carousel-cell"></div>
    </div>
    <?php
  }

  function get_options_principals() {
    ?>
    <div id="options_principals" class="container">

      <div class="row">
        <div class="col-sm-6 about_us">
          <div class="descrip_fill container-fluid text-center">
            <h5 class="text-center">¿ QUIÉNES SOMOS ?</h5>
            <p class="margen_p text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Rem exercitationem earum porro consectetur iusto atque iure illum est,
            cupiditate distinctio sed enim animi, voluptates ex dignissimos ducimus
            nulla inventore soluta.</p>
            <a href="nosotros.php" class="btn btn-outline-secondary"> ver más</a>
          </div>
        </div>

        <div class="col-sm-6 more_details">
          <div class="pt-5 pb-5">
            <span style="font-size: 1.75rem; font-weight: 500; line-height:1">¡ FORMA PARTE DE</span><br>
            <span style="font-size: 2.7rem; font-weight: 500; line-height:1"> NOSOTROS !</span><br>
            <a href="" class="btn btn-light mt-2">MÁS DETALLES <i class="fas fa-plus-circle"></i></a>
          </div>
        </div>
      </div>

      <!-- --------------------- -->

      <div class="row" style="position:relative;">

        <div class="our_mission absolute_position">
          <div class="container-fluid text-left mission_text">
            <h5>NUESTRA MISIÓN</h5>
            <p class="margen_p">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Rem exercitationem earum porro consectetur iusto atque iure illum est,
            cupiditate distinctio sed enim animi, voluptates ex dignissimos ducimus
            nulla inventore soluta.</p>
          </div>
        </div>
      
        <div class="col-sm-4 our_mission oscurecido_2" style="background-image: url(assets/img/banners/banner2.jpg);
          background-position: center;
          background-size: cover; height:370px">
        </div>
        <div class="col-sm-4 our_mission oscurecido_2" style="background-image:url(assets/img/banners/banner3.jpg);
          background-position: center;
          background-size: cover;"></div>
        <div class="col-sm-4 our_mission oscurecido_2" style="background-image: url(assets/img/banners/banner4.jpg);
          background-position: center;
          background-size: cover;"></div>
      </div>

    </div>
    <?php
  }

  function get_testimonials(){
    ?>
    <div class="container-fluid text-center pb-4">
      <h2 id="h2_url" class="subtitle_header">TESTIMONIOS</h2>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <?php $this->get_testimonio(); ?>
          </div>
          <div class="col-sm-6">
            <?php $this->get_iframe(); ?>
          </div>         
        </div>
        <div class="row">
          <div class="col-sm-6">
          <?php $this->get_testimonio(); ?>
          </div>
          <div class="col-sm-6">
            <?php $this->get_playlist(); ?>
          </div>
        </div>   
      </div>
    </div>
    <?php
  }

  function get_iframe(){
    ?>
    <div class="card event event_fill mt-4 mb-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/JkK8g6FMEXE" allowfullscreen></iframe>
          </div>
          </div>
          <div class="col-sm-6">
            <div class="card-block descrip_fill_3 descrip_margen_left">
              <h5 class="color_orange">TÍTULO TESTIMONIO</h5><hr class="background_orange"><label for="">Descripción</label><br>
              <p class="event_p color_dark_gray text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }

  function get_playlist(){
    ?>
    <div class="card event event_fill mt-4 mb-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          <div class="embed-responsive embed-responsive-16by9">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/videoseries?list=PLx0sYbCqOb8TBPRdmBHs5Iftvv9TPboYG" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>          </div>
          </div>
          <div class="col-sm-6">
            <div class="card-block descrip_fill_3 descrip_margen_left">
              <h5 class="color_orange">TÍTULO TESTIMONIO</h5><hr class="background_orange"><label for="">Descripción</label><br>
              <p class="event_p color_dark_gray text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }

  function get_testimonio(){
    ?>
    <div class="card event event_fill mt-4 mb-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          <video controls>
          <source src="assets/videos/video-1.mp4" type="video/mp4">
          </video>
          </div>
          <div class="col-sm-6">
            <div class="card-block descrip_fill_3 descrip_margen_left">
              <h5 class="color_orange">TÍTULO TESTIMONIO</h5><hr class="background_orange"><label for="">Descripción</label><br>
              <p class="event_p color_dark_gray text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }

  function get_modal(){
    ?>

    <?php
  }

}
?>