<?php
session_start();
$my_database=new mysqli("localhost", "root", "", "rotaspa");
if(!$my_database){
  die("Connessione fallita:".mysqli_connect_error());
}
else{
  echo"CONNESSIONE ESEGUITA CON SUCCESSO";
}

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
<!DOCTYPE html>
<html>
    <head>
        <title>Amministratore</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
      <div id="page">
      <form method="post" id="modifica" action="./cambia.html">
        <table bgcolor=white border=3>
            <tr>
                <th>Disegno</th>
                <th>Codice</th>
                <th>Codice esterno</th>
            </tr>
            <tr >
              <td rowspan="5"><img src="<?php echo $_SESSION['disegno']; ?>"></td>
              <td><input type="text" id="codice" name="codice"  form="insert" value ="<?php echo $_SESSION['codice'];?>"readonly></input></td>
              <td><input type="text" id="codice esterno" name="codice esterno"  form="insert" value ="<?php echo $_SESSION['codice_esterno'];?>"required></input></td>
          </tr>
          <tr>
              <th colspan="2">Componenti</th>
          </tr>
          <tr>
              <th> - A - </th><td><input type="text" id="componente a" placeholder="componente a" name="componente a" form="insert" value ="<?php echo $_SESSION['componente_a'];?>"required></input></td>
          </tr>
          <tr>
              <th> - B - </th><td><input type="text" id="componente b" placeholder="componente b" name="componente b" form="insert" value ="<?php echo $_SESSION['componente_b'];?>"required></input></td>
          </tr>
            <tr>
              <th> - C - </th>
              <td><input type="text" id="componente c" placeholder="componente c" name="componente c"  form="insert" value ="<?php echo $_SESSION['componente_c'];?>"required></input></td>
            </tr>
            <tr>
              <td><input type="file" id="upload" placeholder="disegno" name="disegno" form="insert" required></input></td>
              <th> - D - </th>
              <td><input type="text" id="componente d" placeholder="componente d" name="componente d"  form="insert" value ="<?php echo $_SESSION['componente_d'];?>"required></input></td>
              </tr>
              <tr>
                <th>Foto</th>
                <th>Marca</th>
               <th>Montato_su</th>
              </tr>
              <tr>
                <td rowspan="3"><img src="<?php echo $_SESSION['foto']; ?>"></input><td>
                     <?php
                       $my_database=new mysqli("localhost", "root", "", "rotaspa");
                       $stmt=$my_database->prepare("SELECT distinct marca FROM prodotti order by marca");
                       $stmt->execute();
                       $result=$stmt->get_result();
                       echo "<div style=\"width: 100%; height: 100%;\">";
                       echo "<select style=\"width: 100%; height: 100%;\" id=\"marca\" placeholder=\"marca\" name=\"marca\"  form=\"insert\" required>";
                       while($row=$result->fetch_assoc()){
                               echo "<option value=\"".$row['marca']."\">".$row['marca']."</option>";
                             }
                       echo "</select>";
                       echo "</div>";
                     ?>
                    </td>
                    <td>
                       <?php
                         $my_database=new mysqli("localhost", "root", "", "rotaspa");
                         $stmt=$my_database->prepare("SELECT distinct montato_su FROM prodotti order by montato_su");
                         $stmt->execute();
                         $result=$stmt->get_result();
                         echo "<div style=\"width: 100%; height: 100%;\">";
                         echo "<select style=\"width: 100%; height: 100%;\" id=\"montato_su\" placeholder=\"montato_su\" name=\"montato_su\"  form=\"insert\" required>";
                         while($row=$result->fetch_assoc()){
                                 echo "<option value=\"".$row['montato_su']."\">".$row['montato_su']."</option>";
                               }
                         echo "</select>";
                         echo "</div>";
                       ?>
                     </td>
                   </tr>
                   <tr>
                      <th>Level</th>
                      <th>Anteriore</th>
                    </tr>
                    <tr>
                      <td><input type="text" id="level" placeholder="level" name="level"  form="insert" value ="<?php echo $_SESSION['level'];?>"required></input></td>
                      <td><input type="text" id="anteriore" placeholder="anteriore" name="anteriore"  form="insert" value ="<?php echo $_SESSION['anteriore'];?>"required></input></td>
            </tr>
            <tr>
              <td colspan="1">
                <div style="width: 100%; height: 100%;">
                <input type="file" id="upload" placeholder="disegno" name="disegno" form="insert" required></input>
                </div>
              </td>
              <td colspan="2">
                <div style="width: 100%; height: 100%;">
                <input type="submit" style="width: 100%; height: 100%;" type="submit" name="login" form="insert" value="Modifica kit"></input>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="6"><a href="../../_admin/admin.html"><div align="center">Indietro</div></a></td>
            </tr>
        </table>
      </form>
    </div>
    </body>
</html>
