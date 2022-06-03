<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Amministratore</title>
  <link rel="stylesheet" href="./style.css">
</head>
<body id="disegnobg">
  <?php
  $my_database=new mysqli("localhost", "root", "", "rotaspa");
  $stmt=$my_database->prepare("SELECT * FROM prodotti WHERE codice=?");
  $codice=$_POST['codice'];
  $stmt->bind_param('s', $codice);
  $stmt->execute();
  $result=$stmt->get_result();
  $row=$result->fetch_assoc();
  $_SESSION['disegno']=$row['disegno'];
  $_SESSION['foto']=$row['foto'];
  $_SESSION['codice']=$row['codice'];
  $_SESSION['codice_esterno']=$row['codice_esterno'];
  $_SESSION['componente_a']=$row['componente_a'];
  $_SESSION['componente_b']=$row['componente_b'];
  $_SESSION['componente_c']=$row['componente_c'];
  $_SESSION['componente_d']=$row['componente_d'];
  $_SESSION['montato_su']=$row['montato_su'];
  $_SESSION['marca']=$row['marca'];
  $_SESSION['level']=$row['level'];
  $_SESSION['anteriore']=$row['anteriore'];
?>
<div id="page"><table border=1><tr><th>Disegno</th><th>Codice</th><th>Valore</th><th>Valore</th><th>Valore</th></tr>
    <tr>
      <td rowspan="3">
        <div style="width: 100%; height: 100%;">
          <img style="width: 100%; height: 100%;" src="<?php echo $_SESSION['disegno']; ?>" >
        </div>
      </td>
      <td>Codice</td><td><?php echo $_SESSION['codice']; ?></td>
      <td>-A-</td><td><?php echo $_SESSION['componente_a']; ?></td>
    </tr>
    <tr>
      <td>Cod Esterno</td><td><?php echo $_SESSION['codice_esterno']; ?></td>
      <td>-B-</td><td><?php echo $_SESSION['componente_b']; ?></td>
    </tr>
    <tr>
      <td>Cod Esterno</td><td><?php echo $_SESSION['codice_esterno']; ?></td>
      <td>-B-</td><td><?php echo $_SESSION['componente_b']; ?></td>
    </tr>
    <tr><th></th><td></td><td></td></tr>
    <tr>
      <td rowspan="2"><img src="<?php echo $_SESSION['foto']; ?>" ></td>
      <td>-D-</td><td><?php echo $_SESSION['componente_d']; ?></td>
      <td>Cod Esterno</td><td><?php echo $_SESSION['codice_esterno']; ?></td>
    </tr>
    <tr>
      <td>Marca: </td><td><?php echo $_SESSION['marca']; ?></td>
      <td>Cod Esterno</td><td><?php echo $_SESSION['codice_esterno']; ?></td>
    </tr>
    <tr>
      <td colspan="5">A</td>
    </tr>
  </table>
</div>
</body>
</html>
