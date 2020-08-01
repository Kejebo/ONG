<?php
require_once('ui/gui.php');
$ui = new gui();
$ui->check_access("index.php");
$ui->get_header();
?>

<body id="login">

  <div class="row mt-5">
    <div class="col-2 col-sm-2 col-md-4 col-lg-4"></div>
    <div class="col-8 col-sm-8 col-md-4 col-lg-4">
      <div class="card shadow">
        <div class="card-header">
          <img src="" alt=""> Iniciar Seccion
        </div>
        <div class="card-body cuadro">
          <form method="post" id="form_login" action="security.php?action=login" onkeyup="escritura()">

            <div class="form-group">
              <label>CEDULA IDENTIDAD</label>
              <input type="text" class="form-control" name="usuario" title="Ingrese el numero de Cedula" required>
            </div>
            <div class="form-group">
              <label >CONTRASEÑA</label>
              <input type="password" class="form-control" name="pass" required>
            </div>
            <?php if (isset($_GET['msg'])) { ?>
              <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> Datos Incorrectos
.
              </div>
            <?php } ?>
            <div class="mr-auto">
              <a href="">¿Has olvidado la contraseña?</a>
            </div>

            <hr>
            <button type="submit" class="btn btn-block btn-success">Ingresar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="col-2 col-sm-2 col-md-4 col-lg-4"></div>
</body>

<?php
$ui->get_scripts();

?>