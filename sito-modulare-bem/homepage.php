<?php
session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Marenghisrl.it</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.css">
	<link rel="stylesheet" href="style.css">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="immagini/marenghi_srl_piccola.jpg">

</head>
<body>

	<header class="header clearfix">
		<a href="index.html" class="header__logo"><img src="immagini\logo completo.jpg"></a>
		<a href="" class="header__icon-bar">
			<span></span>
			<span></span>
			<span></span>
		</a>
		<ul class="header__menu animate">
			<li class="header__menu__item"><a href="index.html">Home</a></li>
			<li class="header__menu__item"><a href="storia.html">La nostra storia</a></li>
			<li class="header__menu__item"><a href="servizi.html">Servizi</a></li>
			<li class="header__menu__item"><a href="gallery.html">Gallery</a></li>
      <li class="header__menu__item"><a href="login.php">Login</a></li>
			<li class="header__menu__item"><a href="Contatti.html">Contatti</a></li>
		</ul>
	</header>


	<section class="cover">
		<div class="cover__filter"></div>
		<div class="cover__caption">
			<div class="cover__caption__copy">
			</div>
		</div>
	</section>



  <div class="content">
    <?php if (isset($_SESSION['success'])):?>
      <div class="error success">
        <h3>
          <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
           ?>
        </h3>
      </div>
    <?php endif?>



      <section class="cards clearfix">
        <div class="card">
          <img class="card__image"src="immagini\vendite.png">
          <div class="card__copy">
          <a href="vendite.php" class="button">Vendite</a>
          </div>
        </div>

        <div class="card">
          <img class="card__image"src="immagini\catalogo.png">
          <div class="card__copy">
          <a href="catalogo.php" class="button">Catalogo</a>
          </div>
        </div>

        <div class="card">
          <img class="card__image"src="immagini\cliente.png">
          <div class="card__copy">
          <a href="clienti.php" class="button">Clienti</a>
          </div>
        </div>

        <div class="card">
          <img class="card__image"src="immagini\fornitori.png">
          <div class="card__copy">
          <a href="fornitori.php" class="button">Fornitori</a>
          </div>
        </div>

      </section>


    <?php if (isset($_SESSION["username"])): ?>

          <p><a href="login.php?logout='1'" style="color: red;">Logout</a></p>
    <?php endif ?>
  </div>








<rect x=”100″ y=”4000″ rx=”2″ ry=”2″ width=”700″ height=”700″ style=”fill:#	eee”/>


<footer class="footer">
	<p>&emsp;&emsp;Copyright - 2019 Marenghi S.R.L.</p>
	<p> &emsp;&emsp;Via Daveri 5 - 29010 Pontenure (PC)&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
		&emsp;&emsp;&emsp;<a href="https://www.instagram.com/marenghi_s.r.l/" target=”_blank” class="buttoni"><img src="immagini\Instagram-logo-1.png"></a></p>
	<p> &emsp;&emsp;P.IVA 01033710334</p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
	 $(document).ready(function(){

			$(".header__icon-bar").click(function(e){

				$(".header__menu").toggleClass('is-open');
				e.preventDefault();

			});
	 });
</script>


</body>
</html>
