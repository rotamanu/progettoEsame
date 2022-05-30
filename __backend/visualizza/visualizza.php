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
      echo "<table border='6'>";
      if($row=$result->fetch_assoc()){
        //variable with image path by database
        //$img=realpath($row['foto']);
        //$content = file_get_contents($img);
        //header('Content-Type: image/jpg');
        //echo $content;
        echo "<tr><td>codice     </td><td>data oggi    </td><td>scadenza   </td></tr>";
        echo "<tr><td rowspan=\"9\"><img src=".$row['disegno']." width=\"450px\" height=\"450px\"></td><td rowspan=\"9\"><img src=".$row['foto']." width=\"450px\" height=\"450px\"></td></tr>";
        echo "<tr><td>componente a     :</td></tr>";
        echo "<tr><td>componente b     :</td></tr>";
        echo "<tr><td>componente c     :</td></tr>";
        echo "<tr><td>componente d     :</td</tr>";
        echo "<tr><td>montato          </td></tr>";
        echo "<tr><td>level            </td></tr>";
        echo "<tr><td>ant              </td></tr>";
        echo "<tr><td>matr             </td></tr>";
        //echo <form method="post" action="./index.html">
        //echo <h1>torna alla home</h1>
        //echo <button type="submit" name="login">indietro</button>
        //echo </form>
      }
    echo "</table>";
    ?>
  </body>
</html>
