<?php
session_start();
$codice=$_SESSION['codice'];
$updateA=$_POST['componente_a'];
$updateB=$_POST['componente_b'];
$updateC=$_POST['componente_c'];
$updateD=$_POST['componente_d'];
$updateCodCli=$_POST['codice_esterno'];

$my_database=new mysqli("localhost", "root", "", "rotaspa");
$stmt=$my_database->prepare("UPDATE prodotti SET componente_a=?, componente_b=? , componente_c=? , componente_d=? , codice_esterno=? WHERE codice=?");
$stmt->bind_param('ssssss', $updateA, $updateB, $updateC, $updateD, $updateCodCli, $codice);
$stmt->execute();
echo "<script>
alert('Stai per essere redirezionato alla pagina principale');
window.location.href='../../_admin/admin.html';
</script>";
?>
