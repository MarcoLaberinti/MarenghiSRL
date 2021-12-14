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


  <form method="post" action="vendite.php">
    <?php include('errors.php'); ?>
    <h3>Registra una nuova vendita</h3>

    <label >Codice cliente:</label>
    <div class='input-group'>
      <input type="codice_cliente" name="codice_cliente"/>
    </div>

    <label >Codice prodotto:</label>
    <div class='input-group'>
      <input type="codice_prodotto" name="codice_prodotto"/>
    </div>

    <label >Quantità:</label>
    <div class='input-group'>
      <input type="quantita" name="quantita"/>
    </div>

    <label >Prezzo:</label>
    <div class='input-group'>
      <input type="prezzo" name="prezzo"/>
    </div>

    <label >Data:</label>
    <div class='input-group'>
      <input type="date" name="data_vendita"/>
    </div>

    <div class='input-group'>
      <button type="submit" name="invio_nuova_vendita" class="btn">Invio </button>
    </div>
  </form>


    <form method="post" action="vendite.php">
      <?php include('errors.php'); ?>

      <h3>Selziona un periodo:</h3>

      <div class='input-group'>
        <input type="date" name="data_inizio"/>
      </div>

      <div class='input-group'>
        <input type="date" name="data_fine"/>
      </div>


      <input type="reset"  value="Resetta il form">
      <div class='input-group'>
        <button type="submit" name="invio_vendite" class="btn">Invio </button>
      </div>
    </form>

    <form method="post" action="vendite.php">
      <?php include('errors.php'); ?>
      <h3>Visualizza gli ordini di un cliente</h3>
      <label >Inserisci il codice cliente:</label>

      <div class='input-group'>
        <input type="codice_ordini" name="codice_ordini"/>
      </div>

      <div class='input-group'>
        <button type="submit" name="invio_codice_ordini" class="btn">Invio </button>
      </div>
    </form>


    <form method="post" action="vendite.php">
      <?php include('errors.php'); ?>
      <h3>Elimina un ordine</h3>
      <label >Inserisci il codice dell'ordine:</label>

      <div class='input-group'>
        <input type="codice_ordine_eliminare" name="codice_ordine_eliminare"/>
      </div>

      <div class='input-group'>
        <button type="submit" name="invio_codice_ordine_eliminare" class="btn">Invio </button>
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
    <th>Codice vendita</th>
    <th>Codice cliente</th>
    <th>Codice prodotto</th>
    <th>Quantità</th>
    <th>Prezzo</th>
    <th>Data</th>
    </tr>

    <?php
$conn = mysqli_connect('localhost','marenghisrlbasidati', '','my_marenghisrlbasidati');
$tabella_vendite= array();


if(isset($_POST['invio_nuova_vendita'])){

$codice_vendita="CV". rand(10000,99999);
$codice_cliente=mysql_real_escape_string($_POST['codice_cliente']);
$codice_prodotto=mysql_real_escape_string($_POST['codice_prodotto']);
$quantita=mysql_real_escape_string($_POST['quantita']);
$prezzo=mysql_real_escape_string($_POST['prezzo']);
$data=mysql_real_escape_string($_POST['data_vendita']);


if(empty($codice_cliente)){array_push($errors, "Codice cliente mancante");}
if(empty($codice_prodotto)){array_push($errors, "codice prodotto mancante");}
if(empty($quantita)){array_push($errors, "quantità mancante");}
if(empty($prezzo)){array_push($errors, "prezzo mancante");}
if(empty($data)){array_push($errors, "data mancante");}


    if(count($errors)==0){
    $query = "INSERT INTO VENDITE(CodiceVendita, CodCliente, CodProdotto, Quantita, Prezzo, Data)
              VALUES ('$codice_vendita','$codice_cliente','$codice_prodotto','$quantita','$prezzo','$data')";

    mysqli_query($db, $query);
    $query1=  "SELECT * FROM VENDITE WHERE CodiceVendita='$codice_vendita'";
    $result1 =mysqli_query($db, $query1);
    if(mysqli_num_rows($result1)>0){
      while($row1 = $result1->fetch_assoc()) {
        echo "<tr><td>" . $row1["CodiceVendita"].
        "</td><td>" . $row1["CodCliente"] .
        "</td><td>". $row1["CodProdotto"].
        "</td><td>". $row1["Quantita"].
        "</td><td>". $row1["Prezzo"].
        "</td><td>". $row1["Data"].
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




if(isset($_POST['invio_vendite'])){
  $data_inizio=mysql_real_escape_string($_POST['data_inizio']);
  $data_fine=mysql_real_escape_string($_POST['data_fine']);

  if(empty($data_inizio)){
    array_push($errors, "data di inizio mancante");
  }

  if(empty($data_fine)){
    array_push($errors, "data di fine mancante");
  }
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

if(count($errors)==0)
{
  $query = "SELECT * FROM VENDITE WHERE Data>= '$data_inizio' AND Data<='$data_fine'";
  $result =mysqli_query($db, $query);
  if(mysqli_num_rows($result)>0){
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["CodiceVendita"].
        "</td><td>" . $row["CodCliente"] .
        "</td><td>". $row["CodProdotto"].
        "</td><td>". $row["Quantita"].
        "</td><td>". $row["Prezzo"].
        "</td><td>". $row["Data"].
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


if(isset($_POST['invio_codice_ordini'])){
  $codice=mysql_real_escape_string($_POST['codice_ordini']);

  if(empty($codice)){
    array_push($errors, "codice mancante");
  }
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

if(count($errors)==0)
{
  $query = "SELECT * FROM VENDITE WHERE CodCliente='$codice'";
  $result =mysqli_query($db, $query);
  if(mysqli_num_rows($result)>0){
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["CodiceVendita"].
        "</td><td>" . $row["CodCliente"] .
        "</td><td>". $row["CodProdotto"].
        "</td><td>". $row["Quantita"].
        "</td><td>". $row["Prezzo"].
        "</td><td>". $row["Data"].
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

if(isset($_POST['invio_codice_ordine_eliminare'])){
  $codice_elimanre=mysql_real_escape_string($_POST['codice_ordine_eliminare']);

  if(empty($codice_elimanre)){
    array_push($errors, "codice mancante");
  }

if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

if(count($errors)==0){
  $query = "DELETE FROM VENDITE WHERE CodiceVendita='$codice_elimanre'";
  $result =mysqli_query($db, $query);

  }  else {
  array_push($tabella_vendite, "Nessuna vendita nel periodo selezionato");
  echo mysqli_num_rows($result);
$conn->close();

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
