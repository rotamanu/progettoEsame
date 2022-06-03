<!DOCTYPE html>
<html>
    <head>
        <title>Amministratore</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    </head>
    <body>
      <form method="post" id="insert" action="./inserisci.php">
        <table border=1>
            <tr>
                <th>Disegno</th>
                <th>Codice</th>
                <th>Codice esterno</th>
                <th colspan="2">Componente</th>
                <th>Marca</th>
                <th>Level</th>
            </tr>
            <tr>
              <td><input type="test" id="upload" placeholder="disegno" name="disegno" form="insert" required</td>
              <td><input type="text" id="codice" placeholder="codice" name="codice"  form="insert" required></td>
              <td><input type="text" id="codice esterno" placeholder="codice esterno" name="codice esterno" form="insert" required></td>
              <td> - A - </td>
              <td><input type="text" id="componente a" placeholder="componente a" name="componente a" form="insert" required></td>
              <td>
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
              <td><input type="text" id="level" placeholder="level" name="level"  form="insert" required></td>
            </tr>
            <tr>
              <th>Foto</th>
              <td rowspan="3"></td>
              <td rowspan="3"></td>
              <td> - B - </td>
              <td><input type="text" id="componente b" placeholder="componente b" name="componente b" form="insert" required></td>
              <th>Montato_su</th>
              <th>Anteriore</th>
            </tr>
            <tr>
              <td rowspan="2"><input type="text" id="foto" placeholder="foto" name="foto"  form="insert" required></td>
              <td> - C - </td>
              <td><input type="text" id="componente c" placeholder="componente c" name="componente c"  form="insert" required></td>
              <td rowspan="2">
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
              <td rowspan="2"><input type="text" id="level" placeholder="level" name="level"  form="insert" required></td>
            </tr>
            <tr>
              <td> - D - </td>
              <td><input type="text" id="componente d" placeholder="componente d" name="componente d"  form="insert" required></td>
            </tr>
            <tr>
              <td colspan="3">
                <div style="width: 100%; height: 100%;">
                <input type="submit" style="width: 100%; height: 100%;" type="submit" name="login" form="insert" value="Inserisci un kit"></input>
                </div>
              </td>
              <td colspan="4">
                <div style="width: 100%; height: 100%;">
                <input type="reset" style="width: 100%; height: 100%;" name="login" form="insert" value="Azzera campi"></input>
              </div>
            </td>
            </tr>
        </table>
      </form>
    </body>
</html>
