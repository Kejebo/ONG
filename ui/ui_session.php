<?php
require_once('ui/GUI.php');
require_once('ln/ln_session.php');
class ui_session extends GUI {
    
    var $ln;
    
	function __construct($config=null) {
        parent::__construct($config);
        $this->ln = new ln_session();
  }
    
  function action_controller() {
      $this->ln->action_controller();
  }

  function build(){
      
    $this->get_form();
  }

  function get_form(){

    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card card-signin flex-row my-5">
                <div class="card-img-left d-none d-md-flex" style="background: scroll center url('assets/img/banners/banner5.jpg');">
                    <!-- Background image for card set in CSS! -->
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Log In</h5>
                    <form action="session.php?action=login" method="post">
                        <div class="form-label-group">
                        <input name="cedula" type="text" id="inputEmail" class="form-control" placeholder="Identificación" required autofocus>
                        <label for="inputEmail">Identificación</label>
                        </div>
                        <div class="form-label-group">
                        <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
                        <label for="inputPassword">Contraseña</label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block btn-login font-weight-bold mb-2">Iniciar Sesión</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <?php
  }

}
?>