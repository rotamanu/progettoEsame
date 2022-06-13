<?php

$servername="localhost";
$username="root";
$password="";
$db="rotaspa";
$connessione=mysqli_connect($servername,$username,$password,$db);
if(!$connessione){
  die("Connessione fallita:".mysqli_connect_error());
}
else{
  echo"CONNESSIONE ESEGUITA CON SUCCESSO";
}
if (isset($_POST['codice'])) ){
  $codice= $_POST['codice'];
  $sql="DELETE FROM prodotti WHERE codice=$codice";
  if(mysqli_query($connessione, $sql)){
    echo"record cancellato con successo";
  }else{
    echo "errore".$sql."<br>".mysqli_error($connessione);
  }
}
else{
  echo "codice non trovato";
}

mysqli_close($connessione);
?>
