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


      <form method="post" action="clienti.php">
        <?php include('errors.php'); ?>
        <h3>Registra nuovo cliente</h3>

        <label >Nome:</label>
        <div class='input-group'>
          <input type="nome_nuovo" name="nome_nuovo"/>
        </div>

        <label >Residenza:</label>

        <div class='input-group'>
          <input type="residenza_nuovo" name="residenza_nuovo"/>
        </div>

        <label >Mail:</label>

        <div class='input-group'>
          <input type="mail_nuovo" name="mail_nuovo"/>
        </div>

        <div class='input-group'>
          <button type="submit" name="invio_nuovo_cliente" class="btn">Invio </button>
        </div>
      </form>



      <form method="post" action="clienti.php">
        <?php include('errors.php'); ?>
        <h3>Cerca cliente con codice:</h3>

        <div class='input-group'>
          <input type="codice" name="codice"/>
        </div>

        <div class='input-group'>
          <button type="submit" name="invio_codice" class="btn">Invio </button>
        </div>
      </form>

      <form method="post" action="clienti.php">
        <?php include('errors.php'); ?>
        <h3>Cerca cliente per nome:</h3>

        <div class='input-group'>
          <input type="nome" name="nome"/>
        </div>

        <div class='input-group'>
          <button type="submit" name="invio_nome" class="btn">Invio </button>
        </div>
      </form>


      <form method="post" action="clienti.php">
        <?php include('errors.php'); ?>
        <h3 color: solid red>Elimina cliente:</h3>
        <label >Codice cliente:</label>
        <div class='input-group'>
          <input type="codice_cliente_eliminare" name="codice_cliente_eliminare"/>
        </div>

        <div class='input-group'>
          <button type="submit" name="invio_elimina_cliente" class="btn">Invio </button>
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
      <th>Codice Cliente</th>
      <th>Nome</th>
      <th>Indirizzo</th>
      <th>Mail</th>
      </tr>

      <?php
  $conn = mysqli_connect('localhost','marenghisrlbasidati', '','my_marenghisrlbasidati');
  $errors = array();

  if(isset($_POST['invio_nuovo_cliente'])){

    $nome=mysql_real_escape_string($_POST['nome_nuovo']);
$residenza=mysql_real_escape_string($_POST['residenza_nuovo']);
$mail=mysql_real_escape_string($_POST['mail_nuovo']);
$cod_cliente="CL". rand(10000,99999);


if(empty($nome)){array_push($errors, "nome mancante");}
if(empty($residenza)){array_push($errors, "residenza mancante");}
if(empty($mail)){array_push($errors, "mail mancante");}
if(empty($cod_cliente)){array_push($errors, "mail mancante");}

    /*  $user_check_query = "SELECT * FROM CLIENTE WHERE Codice_Cliente='$cod_cliente' LIMIT 1";
      $result = mysqli_query($db, $user_check_query);
      $cod = mysqli_fetch_assoc($result);
      while ($cod) {
        $cod_cliente="CL". rand(10000,99999);
        $user_check_query = "SELECT * FROM CLIENTE WHERE Codice_Cliente='$cod_cliente' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
      }*/


      if(count($errors)==0){
      $query = "INSERT INTO CLIENTE(Codice_Cliente, Nome, Indirizzo, Mail) VALUES ('$cod_cliente','$nome','$residenza','$mail')";
      mysqli_query($db, $query);
      $query1=  "SELECT * FROM CLIENTE WHERE Codice_Cliente='$cod_cliente'";
      $result1 =mysqli_query($db, $query1);
      if(mysqli_num_rows($result1)>0){
        while($row1 = $result1->fetch_assoc()) {
          echo "<tr><td>" . $row1["Codice_Cliente"].
          "</td><td>" . $row1["Nome"] .
          "</td><td>". $row1["Indirizzo"].
          "</td><td>". $row1["Mail"].
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



  if(isset($_POST['invio_codice'])){
    $codice=mysql_real_escape_string($_POST['codice']);

    if(empty($codice)){
      array_push($errors, "codice cliente mancante");
    }

  if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

  if(count($errors)==0){
    $query=  "SELECT * FROM CLIENTE WHERE Codice_Cliente='$codice'";
    $result =mysqli_query($db, $query);
    if(mysqli_num_rows($result)>0){
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Codice_Cliente"].
        "</td><td>" . $row["Nome"] .
        "</td><td>". $row["Indirizzo"].
        "</td><td>". $row["Mail"].
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
    $nome=mysql_real_escape_string($_POST['nome']);

    if(empty($nome)){
      array_push($errors, "Nome mancante");
    }

  if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

  if(count($errors)==0){
    $query = "SELECT * FROM CLIENTE WHERE NOME LIKE '%$nome%'";
    $result =mysqli_query($db, $query);
    if(mysqli_num_rows($result)>0){
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Codice_Cliente"].
        "</td><td>" . $row["Nome"] .
        "</td><td>". $row["Indirizzo"].
        "</td><td>". $row["Mail"].
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


  if(isset($_POST['invio_elimina_cliente'])){
    $codice_elimanre=mysql_real_escape_string($_POST['codice_cliente_eliminare']);

    if(empty($codice_elimanre)){
      array_push($errors, "codice mancante");
    }

  if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

  if(count($errors)==0){
    $query = "DELETE FROM CLIENTE WHERE Codice_Cliente='$codice_elimanre'";
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
