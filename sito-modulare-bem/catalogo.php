<?php include('server.php');
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


<form method="post" action="catalogo.php">
      <?php include('errors.php'); ?>


      <label >Cerca prodotto per codice EAN:</label>

      <div class='input-group'>
        <input type="cod_ean" name="cod_ean"/>
      </div>

      <div class='input-group'>
        <button type="submit" name="invio_ean" class="btn">Invio </button>
      </div>
</form>

<form method="post" action="catalogo.php">
      <?php include('errors.php'); ?>
      <label >Cerca prodotto per nome:</label>

      <div class='input-group'>
        <input type="nome_p" name="nome_p"/>
      </div>

      <div class='input-group'>
        <button type="submit" name="invio_nome" class="btn">Invio </button>
      </div>
</form>


<form method="post" action="catalogo.php">
      <?php include('errors.php'); ?>
      <label >Cerca prodotto per diametro:</label>

      <div class='input-group'>
        <input type="diametro" name="diametro"/>
      </div>

      <div class='input-group'>
        <button type="submit" name="invio_diametro" class="btn">Invio </button>
      </div>
</form>


<form method="post" action="catalogo.php">
      <?php include('errors.php'); ?>
      <label >Cerca prodotto per Fornitore:</label>

      <div class='input-group'>
        <input type="fornitore" name="fornitore"/>
      </div>

      <div class='input-group'>
        <button type="submit" name="invio_fornitore" class="btn">Invio </button>
      </div>
</form>


    <style>
    table {
    border-collapse: collapse;
    width: 100%;
    color: #2c2c60;
    font-family: monospace;
    font-size: 15px;
    text-align: center;
    }
    th {
    background-color: #2c2c60;
    color: white;
    text-align: center;
    }
    tr:nth-child(even) {background-color: #f2f2f2}
    </style>
    </head>
    <body>
    <table>
    <tr>
    <th>Ean</th>
    <th>Prodotto</th>
    <th>Diametro</th>
    <th>Prezzo</th>
    <th>Fornitore</th>
    <th>Scaffale</th>
    </tr>
<?php
$conn = mysqli_connect('localhost','marenghisrlbasidati', '','my_marenghisrlbasidati');
$tabella_vendite= array();

if(isset($_POST['invio_ean'])){
  $ean=mysql_real_escape_string($_POST['cod_ean']);

  if(empty($ean)){
    array_push($errors, "codice EAN mancante");
  }

if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}

if(count($errors)==0){
  $query = "SELECT p.Ean, p.Nome, p.Diametro, p.Prezzo, f.NomeF, p.Scaffale
            FROM PRODOTTO p, FORNITORE f, CATALOGO c
            WHERE c.CodiceProdotto=p.Codice_Prodotto
                  AND c.CodiceFornitore=f.Codice_Fornitore
                  AND p.Ean='$ean'";
  $result =mysqli_query($db, $query);
  if(mysqli_num_rows($result)>0){
    while($row1 = $result->fetch_assoc()) {
        echo "<tr><td>" . $row1["Ean"].
        "</td><td>" . $row1["Nome"] .
        "</td><td>". $row1["Diametro"].
        "</td><td>". $row1["Prezzo"].
        "</td><td>". $row1["NomeF"].
        "</td><td>". $row1["Scaffale"].
        "</td></tr>";
      }
    //  echo "</table>";
  }  else {
  array_push($tabella_vendite, "Nessuna vendita nel periodo selezionato");
  echo mysqli_num_rows($result);
$conn->close();}
}
}



if(isset($_POST['invio_fornitore'])){
  $fornitore=mysql_real_escape_string($_POST['fornitore']);

  if(empty($fornitore)){
    array_push($errors, "codice EAN mancante");
  }

if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

if(count($errors)==0){
  $query = "SELECT p.Ean, p.Nome, p.Diametro, p.Prezzo, f.NomeF, p.Scaffale
            FROM PRODOTTO p, FORNITORE f, CATALOGO c
            WHERE c.CodiceProdotto=p.Codice_Prodotto
            AND c.CodiceFornitore=f.Codice_Fornitore
            AND f.Nomef like'%$fornitore%'";
  $result =mysqli_query($db, $query);
  if(mysqli_num_rows($result)>0){
    while($row1 = $result->fetch_assoc()) {
        echo "<tr><td>" . $row1["Ean"].
        "</td><td>" . $row1["Nome"] .
        "</td><td>". $row1["Diametro"].
        "</td><td>". $row1["Prezzo"].
        "</td><td>". $row1["NomeF"].
        "</td><td>". $row1["Scaffale"].
        "</td></tr>";
      }
    //  echo "</table>";
  }  else {
  array_push($tabella_vendite, "Nessuna vendita nel periodo selezionato");
  echo mysqli_num_rows($result);
$conn->close();

}
}
}


if(isset($_POST['invio_nome'])){
  $nome=mysql_real_escape_string($_POST['nome_p']);

  if(empty($nome)){
    array_push($errors, "Nome prodotto mancante");
  }

if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

if(count($errors)==0){
  $query = "SELECT p.Ean, p.Nome, p.Diametro, p.Prezzo, f.NomeF, p.Scaffale
            FROM PRODOTTO p, FORNITORE f, CATALOGO c
            WHERE c.CodiceProdotto=p.Codice_Prodotto
            AND c.CodiceFornitore=f.Codice_Fornitore
            AND p.Nome='$nome'";
  $result =mysqli_query($db, $query);
  if(mysqli_num_rows($result)>0){
    while($row1 = $result->fetch_assoc()) {
        echo "<tr><td>" . $row1["Ean"].
        "</td><td>" . $row1["Nome"] .
        "</td><td>". $row1["Diametro"].
        "</td><td>". $row1["Prezzo"].
        "</td><td>". $row1["NomeF"].
        "</td><td>". $row1["Scaffale"].
        "</td></tr>";
      }
    //  echo "</table>";
  }  else {
  array_push($tabella_vendite, "Nessuna vendita nel periodo selezionato");
  echo mysqli_num_rows($result);
$conn->close();

}
}
}



if(isset($_POST['invio_diametro'])){
  $diametro=mysql_real_escape_string($_POST['diametro']);

  if(empty($diametro)){
    array_push($errors, "Diametro cerchio mancante");
  }

if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

if(count($errors)==0){
  $query = "SELECT p.Ean, p.Nome, p.Diametro, p.Prezzo, f.NomeF, p.Scaffale
            FROM PRODOTTO p, FORNITORE f, CATALOGO c
            WHERE c.CodiceProdotto=p.Codice_Prodotto
            AND c.CodiceFornitore=f.Codice_Fornitore
            AND p.Diametro='$diametro'";
  $result =mysqli_query($db, $query);
  if(mysqli_num_rows($result)>0){
    while($row1 = $result->fetch_assoc()) {
        echo "<tr><td>" . $row1["Ean"].
        "</td><td>" . $row1["Nome"] .
        "</td><td>". $row1["Diametro"].
        "</td><td>". $row1["Prezzo"].
        "</td><td>". $row1["NomeF"].
        "</td><td>". $row1["Scaffale"].
        "</td></tr>";
      }
    //  echo "</table>";
  }  else {
  array_push($tabella_vendite, "Nessuna vendita nel periodo selezionato");
  echo mysqli_num_rows($result);
$conn->close();

}
}
}
?>
</table>
</body>


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
