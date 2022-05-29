<?php
$my_database=new mysqli("localhost", "root", "", "rotaspa");
if(!$my_database){
  die("Connessione fallita:".mysqli_connect_error());
}
else{
  echo"CONNESSIONE ESEGUITA CON SUCCESSO";
}
$codice=$_POST['codice'];
$codiceEsterno=$_POST['codice_esterno'];
$componenteA=$_POST['componente_a'];
$componenteB=$_POST['componente_b'];
$componenteC=$_POST['componente_c'];
$componenteD=$_POST['componente_d'];
$disegno=$_POST['disegno'];
$foto=$_POST['foto'];
$montatoSu=$_POST['montato_su'];
$marca=$_POST['marca'];
$level=$_POST['level'];
$anteriore=$_POST['anteriore'];

try{
$stmt=$my_database->prepare("INSERT INTO prodotti (codice, codice_esterno, componente_a, componente_b, componente_c, componente_d, disegno, foto, montato_su, marca, level, anteriore) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

$stmt->bind_param('sssssssssssi', $codice, $codiceEsterno, $componenteA, $componenteB, $componenteC, $componenteD, $disegno, $foto, $montatoSu, $marca, $level, $anteriore);
$stmt->execute();
} catch(Exception $e){
  echo $e->getMessage();
}

?>
