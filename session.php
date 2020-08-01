<?php
require_once('ui/ui_session.php');
$config = array(
	'titulo'	=> 'Sesion',
	'url'		=> 'session.php',
);

$ui = new ui_session($config);
$ui->action_controller();
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

<title>Sesion</title>
</head>

<body id="body_bg">

<?php $ui->build(); ?>

<!-- JS, Popper.js, and jQuery -->
<script src="assets/js/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="assets/js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="assets/js/functions.js"></script>
<script src="assets/js/flickity.pkgd.min.js"></script>
</body>
</html>
<?php
?>
	