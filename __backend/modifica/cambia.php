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
if (isset($_POST['codice'])){
  $codice= $_POST['codice'];
  $updateA=$_POST['componente_a'];
  $updateB=$_POST['componente_b'];
  $updateC=$_POST['componente_c'];
  $updateD=$_POST['componente_d'];
  $updateCodCli=$_POST['codice_esterno'];
  $sql="UPDATE prodotti SET componente_a=$updateA AND componente_b=$updateB AND componente_c=$updateC AND componente_d=$updateD AND codice_esterno=$updateCodCli WHERE codice=$codice";
    if(mysqli_query($connessione,$sql)){
      echo"record modificato con successo";
    }
    else{
      echo"errore".$sql."<br>".mysqli_error($connessione);
    }
  }
  else{
  echo "codice non esiste";
}
mysqli_close($connessione);
?>
