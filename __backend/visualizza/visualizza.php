<?php session_start(); ?>
<!DOCTYPE html>
<html>
<<<<<<< HEAD
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
      echo "<table border='6' bgcolor='white'align='center'>";
      if($row=$result->fetch_assoc()){
        //variable with image path by database
        //$img=realpath($row['foto']);
        //$content = file_get_contents($img);
        //header('Content-Type: image/jpg');
        //echo $content;
        echo "<tr><td>".$row['codice']."     </td><td>".$row['codice_esterno']."    </td><td>".$row['marca']."   </td></tr>";
        echo "<tr><td rowspan=\"9\"><img src=".$row['disegno']." width=\"450px\" height=\"450px\"></td><td rowspan=\"9\"><img src=".$row['foto']." width=\"450px\" height=\"450px\"></td></tr>";
        echo "<tr><td>".$row['componente_a']."</td></tr>";
        echo "<tr><td>".$row['componente_b']."</td></tr>";
        echo "<tr><td>".$row['componente_c']."</td></tr>";
        echo "<tr><td>".$row['componente_d']."</td</tr>";
        echo "<tr><td>".$row['montato_su']."</td></tr>";
        echo "<tr><td>".$row['level']."</td></tr>";
        echo "<tr><td>".$row['anteriore']."</td></tr>";
        echo "<tr><td>".$_SESSION['matricola_utente']."</td></tr>";
        //echo <form method="post" action="./index.html">
        //echo <h1>torna alla home</h1>
        //echo <button type="submit" name="login">indietro</button>
        //echo </form>
      }
    echo "</table>";
    ?>
    <form method="post" action="../../_noadmin/noadmin.html">
      <h1>torna alla home</h1>
      <button type="submit" name="login">indietro</button>
    </form>
  </body>
=======
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
  <div id="page"><table border=1><tr><th>Foto</th><th>Disegno</th><th>Valore</th><th>Valore</th><th>Valore</th><th>Valore</th></tr>
    <tr>
      <td rowspan="3">
        <div style="width: 100%; height: 100%;">
          <img style="width: 100%; height: 100%;" src="<?php echo $_SESSION['foto']; ?>" >
        </div>
      </td>
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
      <td>-C-</td><td><?php echo $_SESSION['componente_c']; ?></td>
    </tr>
    <tr>
      <td>Codice: </td><td><?php echo $_SESSION['codice']; ?></td>
      <td colspan="4" rowspan="2"><a href="../../_noadmin/noadmin.php"><div align="center">Indietro</div></a></td>
    </tr>
    <tr>
      <td>Cod Esterno: </td><td><?php echo $_SESSION['codice_esterno']; ?></td>
    </tr>
  </table>
</div>
</body>
>>>>>>> 7d0450d5377fbd8a80c533f150cde041e8df8452
</html>
