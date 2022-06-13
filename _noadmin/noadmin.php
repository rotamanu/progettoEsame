<!DOCTYPE html>
<html>
    <head>
        <title>Utente Generico</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="../../style.css">
    </head>
    <body>
      <form method="post" action="../__backend/visualizza/visualizza.php" id="codice">
        <h1>Visualizzare un kit</h1>
        <?php
          $my_database=new mysqli("localhost", "root", "", "rotaspa");
          $stmt=$my_database->prepare("SELECT distinct codice FROM prodotti");
          $stmt->execute();
          $result=$stmt->get_result();
          echo "<div style=\"width: 100%; height: 100%;\">";
          echo "<select style=\"width: 100%; height: 100%;\" placeholder=\"stampa\" name=\"codice\" id=\"codice\" form=\"codice\" required>";
          while($row=$result->fetch_assoc()){
                  echo "<option value=\"".$row['codice']."\">".$row['codice']."</option>";
                }
          echo "</select>";
          echo "</div>";
        ?>
        <button type="submit" name="login">Visualizza</button>
      </form>

      <form method="post" action="../__backend/stampa/test.php" id="stampa">
        <h1>Stampa Etichetta</h1>
        <?php
          $my_database=new mysqli("localhost", "root", "", "rotaspa");
          $stmt=$my_database->prepare("SELECT distinct codice, marca, anteriore FROM prodotti order by codice");
          $stmt->execute();
          $result=$stmt->get_result();
          echo "<div style=\"width: 100%; height: 100%;\">";
          echo "<select style=\"width: 100%; height: 100%;\" placeholder=\"stampa\" name=\"codice\" id=\"codice\" form=\"stampa\" required>";
          while($row=$result->fetch_assoc()){
                  echo "<option value=\"".$row['codice']."\">".$row['codice']." - ".$row['marca']." - ".$row['anteriore']."</option>";
                }
          echo "</select>";
          echo "</div>";
        ?>
        <input type="number" min="1" max="1000" placeholder="Seleziona qta etichette" name="num_etichette" id="num_etichette" form="stampa" required>
        <input type="submit" name="login" value="stampa" form="stampa"/>
      </form>

      <form method="post" action="../index.html">
        <h1>Torna alla Home</h1>
        <button type="submit" name="login">indietro</button>
      </form>
    </body>
</html>
