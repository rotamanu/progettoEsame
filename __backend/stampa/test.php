<?PHP
require('code128.php');
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
    $text = sprintf("Cod. %s\nC.Es. %s\nMounted on: %s\n%s Marca: %s; %s", $row['codice'], $row['codice_esterno'], $row['montato_su'], $row['anteriore'], $row['marca'], 'MADE IN ITALY');
    $pdf->Add_Label($text);
}
ob_start();
$pdf->Output();
?>
