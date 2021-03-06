<?PHP
session_start();
require('code128.php');
$day=date("d");
$month=date("m");
$year=date("Y");
$data_produzione=$day."-".$month."-".$year;
$data_di_scadenza=$day."-".$month."-".($year+5);
$pdf = new PDF_Label('L7163');
$pdf->AddPage();
$my_database=new mysqli("localhost", "root", "", "rotaspa");
$stmt=$my_database->prepare("SELECT * FROM prodotti WHERE codice=?");
$codice=$_POST['codice'];
$stmt->bind_param('s', $codice);
$stmt->execute();
$result=$stmt->get_result();
$row=$result->fetch_assoc();
// Print labels
$num_etichette=$_POST['num_etichette'];
for($i=1;$i<=$num_etichette;$i++) {
    $text = sprintf("Cod. %s\nC.Es. %s\nMatr: %s\nMounted on: %s\n%s Marca: %s; %s\n%s\nScade il: %s", $row['codice'], $row['codice_esterno'], $_SESSION['matricola_utente'], $row['montato_su'], $row['anteriore'], $row['marca'], 'MADE IN ITALY', $data_produzione, $data_di_scadenza);
    $pdf->Add_Label($text);
}
ob_start();
$pdf->Output();
?>
