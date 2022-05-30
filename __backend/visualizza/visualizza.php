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
//var_dump($result->fetch_all());
echo "<table border='1'>";
if($row=$result->fetch_assoc()){

  //variable with image path by database
  //$img=realpath($row['foto']);
  //$content = file_get_contents($img);
  //header('Content-Type: image/jpg');
  //echo $content;

        echo "<tr>";
        echo "<td>Numero matricola: ".$_SESSION['matricola_utente']."</td>";
        echo "</tr>";
        echo "<td><img src=".$row['disegno']." width=\"450px\" height=\"450px\"></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        //echo <form method="post" action="./index.html">
        //echo <h1>torna alla home</h1>
        //echo <button type="submit" name="login">indietro</button>
        //echo </form>
        echo "</td>";
        echo "</tr>";
}
echo "</table>";
?>
</body>
</html>
