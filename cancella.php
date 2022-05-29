<?php

$servername="localhost";
$username="root";
$password="";
$db="telefonia";
$connessione=mysqli_connect($servername,$username,$password,$db);
if(!$connessione){
  die("Connessione fallita:".mysqli_connect_error());
}
else{
  echo"CONNESSIONE ESEGUITA CON SUCCESSO";
}
if (isset($_POST['modello']) AND ($_POST['marca']) ){
  $modello= $_POST['modello'];
  $marca= $_POST['marca'];
  $sql="DELETE FROM prodotti WHERE modello=$modello AND marca=$marca";
  if(mysqli_query($connessione, $sql)){
    echo"record cancellato con successo";
  }else{
    echo "errore".$sql."<br>".mysqli_error($connessione);
  }
}
else{
  echo "modello non trovato";
}

mysqli_close($connessione);
?>
