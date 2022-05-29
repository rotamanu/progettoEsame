<?php
session_start();
$my_database=new mysqli("localhost", "root", "", "rotaspa");
$stmt=$my_database->prepare("SELECT * FROM utenti WHERE password=? AND username=?");
$user=$_POST['password'];
$pwd1=$_POST['username'];
$stmt->bind_param('ss', $user,$pwd1);
$stmt->execute();
$result=$stmt->get_result();
//var_dump($result->fetch_all());
if($row=$result->fetch_assoc()){
  //echo $row['matricola'];
  $_SESSION['matricola_utente']=$row['matricola'];
  //var_dump($row['matricola']);
  switch($row['amministratore']){
    case 0:
      header("Location: ../_admin/admin.html" );
      break;
    case 1:
      header("Location: ../_noadmin/noadmin.html" );
      break;
    default:
      header("Location: ../index.html" );
    break;
  }
}else{
  header("Location: ../index.html" );
}

?>
