<?php
require_once('ui/GUI.php');
class ui_nosotros extends GUI {
	
	function __construct($config=null) {
		parent::__construct($config);
  }
    
  function action_controller() {}

  function build() {
    $this->get_description();
    $this->get_profiles();
  }

  function get_description(){
    ?>
      <div class="banner container-fluid">
        <h2>NOSOTROS</h2>
      </div>
      <div class="contenedor_fill background_light_gray">
        <div class="container-fluid shadow_xl">
          <div class="row">
            <div class="col-sm-6">
              <div class="">
                <div class="us carousel carousel--o-dots" data-flickity="{&quot;autoPlay&quot;: true, &quot;wrapAround&quot;: true}">
                  <div class="carousel-cell imagen"></div>
                  <div class="carousel-cell"></div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
            <div class="row">
              <div class="background_orange  descrip_fill_2 container-fluid text-center">
                  <h4 class="color_white text-center">¿ QUIÉNES SOMOS ?</h4>
                  <p class="color_white margen_p text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                  Rem exercitationem earum porro consectetur iusto atque iure illum est,
                  cupiditate distinctio sed enim animi, voluptates ex dignissimos ducimus
                  nulla inventore soluta.</p>
                </div>
            </div>
            <div class="row">
              <div class="bg-white descrip_fill_2 container-fluid text-center">
                <h4 class="color_blue text-center">NUESTRA MISIÓN</h4>
                <p class="color_dark_gray margen_p text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                Rem exercitationem earum porro consectetur iusto atque iure illum est,
                cupiditate distinctio sed enim animi, voluptates ex dignissimos ducimus
                nulla inventore soluta.</p>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center" style="background-image:url(assets/img/banners/banner.jpg);
          background-position: center;background-size: cover;">
        <div style="background-color: rgba(253,201,81,0.9);" class="descrip_fill_2">
          <h4 class="color_white text-center">NUESTRA VISIÓN</h4>
          <p class="color_white margen_p text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
          Rem exercitationem earum porro consectetur iusto atque iure illum est,
          cupiditate distinctio sed enim animi, voluptates ex dignissimos ducimus
          nulla inventore soluta.</p>
        </div>
      </div>

      <div class="container-fluid background_light_gray descrip_fill_4">
        <div class="container">
          <div class="row">
            <div class="col-sm-5 centrar_items">
              <div class="container mt-4 mb-4">
                <h4 class=" text-left">HISTORIA</h4><hr>
                <p class="margen_p text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                Rem exercitationem earum porro consectetur iusto atque iure illum est,
                cupiditate distinctio sed enim animi, voluptates ex dignissimos ducimus
                nulla inventore soluta.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                Rem exercitationem earum porro consectetur iusto atque iure illum est,
                cupiditate distinctio sed enim animi, voluptates ex dignissimos ducimus
                nulla inventore soluta.Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                Rem exercitationem earum porro consectetur iusto atque iure illum est,
                cupiditate distinctio sed enim animi, voluptates ex dignissimos ducimus
                nulla inventore soluta.
                </p>
              </div>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-6 centrar_items">
              <video controls playsinline>
              <source src="assets/videos/video-1.mp4" type="video/mp4">
              </video>
            </div>
          </div>
        </div>
        
      </div>

    <?php
  }

  function get_profiles(){
    ?>
    <div class="container-fluid text-center">
      <h2 class="subtitle_header">JUNTA DIRECTIVA</h2>
    </div>
    <div class="container text-center">
      <div class="content_grid pb-5">
        <?php $this->get_card_profile(); ?>
        <?php $this->get_card_profile(); ?>
        <?php $this->get_card_profile(); ?>
        <?php $this->get_card_profile(); ?>
      </div>
    </div>
    <?php
  }

  function get_card_profile($data=null){
    ?>
    <!-- <input id="slider" class="customSlider" type="checkbox">
    <label for="slider"></label> -->
    <div class="wrapper">
      <div class="profile">
      <div
        data-container="body"
        data-toggle="popover"
        data-trigger="focus"
        data-placement="bottom"
        data-content="And here's some amazing content. It's very engaging. Right?
        And here's some amazing content. It's very engaging. Right?
        And here's some amazing content. It's very engaging. Right?"
        class="thumbnail "
        style="background-image:url(assets/img/banners/no-photo.png);
          background-position: center;background-size: cover;">
        </div>
        <h4 class="color_orange">Nombre Perfil</h4>
        <p class="title">Gerente General</p>
        <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque aliquam aliquid porro!</p>
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