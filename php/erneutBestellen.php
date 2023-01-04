<?php 
    session_start();
    if(isset($_SESSION['UserID']))
    {
        $userID = (int) $_SESSION['UserID'];
    }

    include 'imports/dbSettings.php';

    $bestellID=$_POST["BestellID"];

    $artikelbestellung ="SELECT * 
    FROM kunde, bestellitem AS BI ,bestellung AS B 
    WHERE B.BestellID=bi.bestellid 
    AND B.BestellID = '" . $bestellID . "'
    AND kunde.UserID = '" . $userID . "'
    AND B.UserID = Kunde.UserID; ";

    $getOldOrder="  SELECT * 
                    FROM Bestellung 
                    WHERE BestellID = '" . $bestellID . "' 
                    AND UserID = '" . $userID . "' ";
    $stmt3= $conn->query($getOldOrder);
    $stmt3-> execute();

    foreach($conn->query($artikelbestellung) as $row2)
    {
        $gesamptpreis=$row2['Gesamtpreis'];
        $versandpreis=$row2['Versandpreis'];
        $versandart=$row2['Versandart'];
    }

    $getNewOrder="  SELECT BestellID
                    FROM Bestellung 
                    WHERE UserID=' " . $userID . " ' AND Gesamtpreis=" . $Gesamtpreis.  " AND BestellID>=(SELECT MAX(BestellID) FROM Bestellung)";


    $insertneworder="INSERT INTO Bestellung (UserID,Gesamtpreis,Versandpreis,Versandart)";
    $stmt2= $conn->prepare($insertneworder);
    $stmt2-> execute([$userID,$row['Gesamtpreis'],$row['Versandpreis'],$row['Versandart']]);

    $bestellID=

    foreach($conn->query($artikelbestellung) as $row){
        
        $
        }
        
        
            $insert2= "INSERT INTO bestellitem (BestellID,ArtikelID,Menge,PositionsPreis) VALUES (?,?,?,?)";
            $stmt2= $conn->prepare($insert2);
            $stmt2-> execute([$bestellID,$row['ArtikelID'],$row['Menge'],$gpmitRabatt]);
        }
?>
