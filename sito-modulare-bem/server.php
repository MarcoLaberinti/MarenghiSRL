<?php
    session_start();
    $username ="";
    $password="";
    $errors= array();


    $db=mysqli_connect('localhost','marenghisrlbasidati', '','my_marenghisrlbasidati');

    if(isset($_POST['login'])){
      $username=mysql_real_escape_string($_POST['username']);
      $password=mysql_real_escape_string($_POST['password']);

      if(empty($username)){
        array_push($errors, "Username mancante");
      }

      if(empty($password)){
        array_push($errors, "Password mancante");
      }

      if(count($errors)==0)
      {
        $password = md5($password);
        $query = "SELECT * FROM USER WHERE Username= '$username' AND Password='$password'";
        $result =mysqli_query($db, $query);
        if(mysqli_num_rows($result)==1){
          $_SESSION['username']=$username;
          $_SESSION['success']="login avvenuto con successo";
          header('location: homepage.php');
        } else {
          array_push($errors, "username o password errati");
          echo mysqli_num_rows($result);
        }
      }

    }

    $tabella_vendite= array();

    if(isset($_POST['invio_vendite'])){
      $data_inizio=mysql_real_escape_string($_POST['data_inizio']);
      $data_fine=mysql_real_escape_string($_POST['data_fine']);

      if(empty($data_inizio)){
        array_push($errors, "data di inizio mancante");
      }

      if(empty($data_fine)){
        array_push($errors, "data di fine mancante");
      }

      if(count($errors)==0)
      {
        $query = "SELECT * FROM VENDITE WHERE Data>= '$data_inizio' AND Data<='$data_fine'";
        $result =mysqli_query($db, $query);
        if(mysqli_num_rows($result)>0){
          while($row = $result->fetch_assoc()) {
              echo "<tr><td>" . $row["Codice vendita"].
              "</td><td>" . $row["Codice cliente"] .
              "</td><td>". $row["Codice prodotto"].
              "</td><td>". $row["Quantità"].
              "</td><td>". $row["Prezzo"].
              "</td><td>". $row["Data"].
              "</td></tr>";
            }
        } else {
          array_push($tabella_vendite, "Nessuna vendita nel periodo selezionato");
          echo mysqli_num_rows($result);
        }
      }

    }
