<?php
session_start();
$my_database=new mysqli("localhost", "root", "", "rotaspa");
$stmt=$my_database->prepare("SELECT * FROM utenti WHERE password=? AND username=?");
$pwd=$_POST['password'];
$pwd1=$_POST['username'];
$stmt->bind_param('ss', $pwd,$pwd1);
$stmt->execute();
$result=$stmt->get_result();
//var_dump($result->fetch_all());
if($row=$result->fetch_assoc()){
  echo $row['matricola'];
  $_SESSION['matricola_utente']=$row['matricola'];
  //var_dump($row['matricola']);
  switch($row['amministratore']){
    case 0:
      header("Location: ./admin.html" );
      break;
    case 1:
      header("Location: ./noadmin.html" );
      break;
    default:
      header("Location: ./index.html" );
    break;
  }
}else{
  header("Location: ./index.html" );
}

?>
