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
    if($_POST['amount']>0)
    {
        $menge= $_POST['amount'];
    }
    else
    {
        throw new Exception("No negative amount", 1);
        header('location:alleArtikel.php');
    }



try{

$sql = "SELECT * FROM Warenkorb WHERE ArtikelID= ' " . $artikelID . " ' AND UserID='" . $userID . "' ";

$ExecQuery = MySQLi_query($con,$sql);
if(mysqli_num_rows($ExecQuery) > 0) {

foreach($conn->query($sql) as $row){
    $menge= $row['Menge']+$menge;
}


    
$update = " UPDATE Warenkorb
            SET Menge = '" .$menge.  "'
            WHERE ArtikelID= ' " . $artikelID . " ' AND UserID='" . $userID . "' ";
$stmt3 = $conn->prepare($update);
$stmt3->execute();
}else{



$sql2 = "INSERT INTO warenkorb (ArtikelID,UserID,Menge) VALUES (?,?,?)";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute([$artikelID,$userID,$menge]);
}

} catch(PDOException $f){
echo "Fehler: ".$f;
}
header("Location: alleArtikel.php");

?>