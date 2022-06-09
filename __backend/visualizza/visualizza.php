<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Amministratore</title>
  <link rel="stylesheet" href="./style.css">
</head>
<body>
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
  <form method="post" id="modifica" action="../modifica/cambia.php">
  <div id="page"><table border=3>
      <tr>
          <th>Disegno</th>
          <th>Codice</th>
          <th>Codice esterno</th>
      </tr>
      <tr >
        <td rowspan="6"><img src="<?php echo $_SESSION['disegno']; ?>"</td>

        <td><?php echo $_SESSION['codice'];?></td>
        <td><?php echo $_SESSION['codice_esterno'];?></td>
    </tr>
    <tr>
        <th colspan="2">Componenti</th>
    </tr>
    <tr>
        <th> - A - </th><td><?php echo $_SESSION['componente_a'];?></td>
    </tr>
    <tr>
        <th> - B - </th><td><?php echo $_SESSION['componente_b'];?></td>
    </tr>
      <tr>
        <th> - C - </th>
        <td><?php echo $_SESSION['componente_c'];?></td>
      </tr>
      <tr>
        <th> - D - </th>
        <td><?php echo $_SESSION['componente_d'];?></td>
        </tr>
        <tr>
          <th>Foto</th>
          <th>Marca</th>
         <th>Montato_su</th>
        </tr>
        <tr><td rowspan="6"><img src="<?php echo $_SESSION['foto']; ?>"</td>
          <td><?php echo $_SESSION['marca'];?></td>
          <td><?php echo $_SESSION['montato_su'];?></td>
             </tr>
             <tr>
                <th>Level</th>
                <th>Anteriore</th>
              </tr>
              <tr>
                <td><?php echo $_SESSION['level'];?></td>
                <td><?php echo $_SESSION['anteriore'];?></td>
      </tr>
      <tr>
        <td colspan="3">
          <div style="width: 100%; height: 100%;">
          <input type="submit" style="width: 100%; height: 100%;" type="submit" name="login" form="modifica" value="Modifica kit"></input>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="6"><a href="../../_admin/admin.html"><div align="center">Indietro</div></a></td>
      </tr>
  </table>

</div>
</body>
</html>
