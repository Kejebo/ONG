<?php
class GUI{
	
	var $config;
	
	function __construct($config=null){
		
		$this->config = array(
			'titulo'	=> 'Sin Título',
			'url'		=> 'index.php',
		);
		
		if($config){
			$this->config = $config;
        }
        
    }
    
    function get_header(){
        session_start();
        $nav = array(
			array(
				'url'	=> 'index.php',
				'text'	=> 'Inicio'
			),
			array(
				'url'	=> 'nosotros.php',
				'text'	=> 'Nosotros'
			),
			array(
				'url'	=> 'programas.php',
				'text'	=> 'Programas'
			),
			array(
				'url'	=> 'eventos.php',
				'text'	=> 'Eventos'
            ),
            array(
                'url'	=> 'preguntas.php',
                'text'	=> 'Preguntas'
            ),
            array(
                'url'	=> 'index.php#h2_url',
                'text'	=> 'Testimonios'
            )
        );

        ?>
        <!DOCTYPE html>
		<html lang="en">
		<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSS only -->
        <link rel="stylesheet" href="assets/fontawesome/css/all.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/carousel.css">
        <link rel="stylesheet" href="assets/css/profile.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/flickity.css">
        <link rel="stylesheet" href="assets/css/session.css">

        <title><?=$this->config['titulo'];?></title>
        </head>
        
		<body>
<!-- ml-auto mr-4 -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand nav_logo" href="#">
                <img src="assets/img/logo/logo.svg" width="100" heigth="100" alt="">
            </a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">

                    <?php foreach($nav as $item){ ?>
                    <li class="nav-item <?=($this->config['url']==$item['url']?'active':'');?> mr-4">
                        <a class="nav-link" href="<?=$item['url'];?>"><?=$item['text'];?></a>
                    </li>
                    <?php } ?>
                    <?php if (isset($_SESSION["id"])) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="session.php?action=logout">Cerrar Sesión</a>
                            </div>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item mr-4">
                            <a class="nav-link" href="session.php"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <a href="" class="btn btn-warning" id="boton_donar">DONAR</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>

        <?php
    }

    function get_partial_pages($a, $b){

        $limit = ($a % $b != 0) ? floor($a/$b)+1 : $a/$b;
        ?>

        <div class="container text-center">
            <nav>
                <ul class="pagination">
                <?php if($a > 1) { ?>
                    <li id="p" class="page-item pasar disabled"><a class="page-link" href="#">anterior</a></li>
                <?php } ?>
            <?php for ($i=1; $i <= $limit; $i++) { ?>
                    <li id="<?=$i;?>" class="page-item pasar"><a class="page-link" href="home.php?pag=<?=$i;?>"><?=$i;?></a></li>  
                <?php } ?>
                <?php if($a > 1) { ?>
                    <li id="n" class="page-item pasar disabled"><a class="page-link" href="#">siguiente</a></li>
                <?php } ?>
                </ul>
            </nav>
        </div>

        <?php
    }

    function get_footer(){
        ?>
        <footer>
            <div class="container-fluid p-4 background_yellow color_orange text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 p-2">
                            <h6>ALIADOS</h6>
                        </div>
                        <div class="col-sm-4 p-2">
                            <h6>CONSULTAS</h6>
                            <span>correodaleunamanoacr@gmail.com</span><br>
                            <span>+506 888 8888</span><br>
                            <span>+506 888 8888</span>
                        </div>
                        <div class="col-sm-4 p-2">
                            <h6>SEGUINOS EN</h6>
                            <span><i class="fab fa-facebook"></i> Facebook</span><br>
                            <span><i class="fab fa-youtube"></i> YouTube</span><br>
                            <span><i class="fab fa-instagram"></i> Instagram</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="background_orange container-fluid my-auto p-3">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Dale una Mano a Costa Rica <?=date('Y');?></span>
                </div>
            </div>
        </footer>

        <!-- JS, Popper.js, and jQuery -->
        <script src="assets/js/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="assets/js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="assets/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="assets/js/functions.js"></script>
        <script src="assets/js/flickity.pkgd.min.js"></script>
        </body>
        </html>

        <?php
    }

}

?>