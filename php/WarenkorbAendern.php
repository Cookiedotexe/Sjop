<?php 
    session_start();
    if(isset($_SESSION['UserID']))
    {
        $userID = (int) $_SESSION['UserID'];
    }

    include 'imports/dbSettings.php';
    
    $artikelID="";
    $menge="";

    $artikelID= $_POST['artikelID'];
    $menge= $_POST['amount'];
if($menge==0){

    $sql1 = "DELETE FROM Warenkorb WHERE ArtikelID='" . $artikelID . "'
    AND UserID='" . $userID . "' ";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute();
    }


try{

$sql = "UPDATE warenkorb
        SET Menge = '" . $menge . "'
        WHERE ArtikelID='" . $artikelID . "'
        AND UserID='" . $userID . "' ";
$stmt = $conn->prepare($sql);
$stmt->execute();

} catch(PDOException $f){
echo "Fehler: ".$f;
}
header("Location: warenkorb.php");
?>