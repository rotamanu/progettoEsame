<?php session_start(); ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Amministratore</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <link rel="stylesheet" href="../../style.css">
  </head>
  <body id="disegnobg">
    <?php
      $my_database=new mysqli("localhost", "root", "", "rotaspa");
      $stmt=$my_database->prepare("SELECT * FROM prodotti WHERE codice=?");
      $codice=$_POST['codice'];
      $stmt->bind_param('s', $codice);
      $stmt->execute();
      $result=$stmt->get_result();
      echo "<table border='6' bgcolor='white'align='center'>";
      if($row=$result->fetch_assoc()){
        //variable with image path by database
        //$img=realpath($row['foto']);
        //$content = file_get_contents($img);
        //header('Content-Type: image/jpg');
        //echo $content;
        echo "<tr><td>".$row['codice']."     </td><td>".$row['codice_esterno']."    </td><td>".$row['marca']."   </td></tr>";
        echo "<tr><td rowspan=\"9\"><img src=".$row['disegno']." width=\"450px\" height=\"450px\"></td><td rowspan=\"9\"><img src=".$row['foto']." width=\"450px\" height=\"450px\"></td></tr>";
        echo "<tr><td>".$row['componente_a']."</td></tr>";
        echo "<tr><td>".$row['componente_b']."</td></tr>";
        echo "<tr><td>".$row['componente_c']."</td></tr>";
        echo "<tr><td>".$row['componente_d']."</td</tr>";
        echo "<tr><td>".$row['montato_su']."</td></tr>";
        echo "<tr><td>".$row['level']."</td></tr>";
        echo "<tr><td>".$row['anteriore']."</td></tr>";
        echo "<tr><td>".$_SESSION['matricola_utente']."</td></tr>";
        //echo <form method="post" action="./index.html">
        //echo <h1>torna alla home</h1>
        //echo <button type="submit" name="login">indietro</button>
        //echo </form>
      }
    echo "</table>";
    ?>
    <form method="post" action="../../_noadmin/noadmin.html">
      <h1>torna alla home</h1>
      <button type="submit" name="login">indietro</button>
    </form>
  </body>
</html>
