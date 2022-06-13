<?php
$my_database=new mysqli("localhost", "root", "", "rotaspa");
$stmt=$my_database->prepare("DELETE FROM prodotti WHERE codice=?");
$codice=$_POST['codice'];
$stmt->bind_param('s', $codice);
$stmt->execute();
echo "<script>
alert('Stai per essere redirezionato alla pagina principale');
window.location.href='../../_admin/admin.html';
</script>";
?>
