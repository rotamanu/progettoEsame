<?php

$codice=$_SESSION['codice'];
$updateA=$_POST['componente_a'];
$updateB=$_POST['componente_b'];
$updateC=$_POST['componente_c'];
$updateD=$_POST['componente_d'];
$updateCodCli=$_POST['codice_esterno'];

$my_database=new mysqli("localhost", "root", "", "rotaspa");
$stmt=$my_database->prepare("UPDATE prodotti SET componente_a=? AND componente_b=? AND componente_c=? AND componente_d=? AND codice_esterno=? WHERE codice=?");
$codice=$_POST['codice'];
$stmt->bind_param('ssssss', $updateA, $updateB, $updateC, $updateD, $updateCodCli, $codice);
$stmt->execute();

?>
