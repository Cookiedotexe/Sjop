<?php 
    session_start();
    if(isset($_SESSION['UserID']))
    {
        $userID = (int) $_SESSION['UserID'];
    }

    include 'imports/dbSettings.php';
    
    require '../libraries/PHPMailer/src/Exception.php';
    require '../libraries/PHPMailer/src/PHPMailer.php';
    require '../libraries/PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $PositionsPreis=0;
    $versandpreis=0;
    $versandart=0;
    $versandart=$_POST["Versandart"];

try{

$sql = "SELECT * FROM Warenkorb WHERE UserID='" . $userID . "' ";

$ExecQuery = MySQLi_query($con,$sql);
if(mysqli_num_rows($ExecQuery) > 0) {

    $Gesamtpreis=0;

$alles= "SELECT * FROM Warenkorb AS W LEFT JOIN Artikel AS A  ON W.ARtikelID=A.ArtikelID";

    $gpmitRabatt=0;


foreach($conn->query($alles) as $row){
    if($row['Menge'] >= 5)
    {
    $rabattanz="10 %";
    $gpmitRabatt=round((($row['preis'] * $row['Menge']) * 0.9),2);
    }
    
    if($row['Menge'] < 5 )
    {
    $rabattanz="0 %";
    $gpmitRabatt=round(($row['preis'] * $row['Menge']),2);
    }

    if($row['Menge'] >= 10)
    {
    $rabattanz="20 %";   
    $gpmitRabatt=round((($row['preis'] * $row['Menge']) * 0.8),2);
    }
    $Gesamtpreis=$Gesamtpreis +$gpmitRabatt;

}
}
/*
foreach($conn->query($sql) as $row){
    
}
*/
if($versandart=="DHL"){
    $versandpreis=15;
}
if($versandart=="DPD"){
    $versandpreis=6;
}
if($versandart=="DHL Express"){
    $versandpreis=48;
}





$insert= "INSERT INTO Bestellung (Gesamtpreis,UserID,Versandpreis,Versandart) VALUES (?,?,?,?)";
$stmt= $conn->prepare($insert);
$stmt-> execute([$Gesamtpreis,$userID,$versandpreis,$versandart]);


$krasserBefehl= "SELECT *
FROM bestellung
WHERE UserID=' " . $userID . " ' AND Gesamtpreis=" . $Gesamtpreis.  " AND BestellID>=(SELECT MAX(BestellID) FROM Bestellung)";
$bestellID=0;
foreach($conn->query($krasserBefehl) as $row){
    $bestellID=$row['BestellID'];
}


$sql = "SELECT * FROM Warenkorb WHERE UserID='" . $userID . "' ";

$ExecQuery = MySQLi_query($con,$sql);
if(mysqli_num_rows($ExecQuery) > 0) {

    $Gesamtpreis=0;

$alles= "SELECT * FROM Warenkorb AS W LEFT JOIN Artikel AS A  ON W.ARtikelID=A.ArtikelID";

    $gpmitRabatt=0;


foreach($conn->query($alles) as $row){
    if($row['Menge'] >= 5)
    {
    $rabattanz="10 %";
    $gpmitRabatt=round((($row['preis'] * $row['Menge']) * 0.9),2);
    }
    
    if($row['Menge'] < 5 )
    {
    $rabattanz="0 %";
    $gpmitRabatt=round(($row['preis'] * $row['Menge']),2);
    }

    if($row['Menge'] >= 10)
    {
    $rabattanz="20 %";   
    $gpmitRabatt=round((($row['preis'] * $row['Menge']) * 0.8),2);
    }
    
    
        $insert2= "INSERT INTO bestellitem (BestellID,ArtikelID,Menge,PositionsPreis) VALUES (?,?,?,?)";
        $stmt2= $conn->prepare($insert2);
        $stmt2-> execute([$bestellID,$row['ArtikelID'],$row['Menge'],$gpmitRabatt]);
        
    

}
}
$delete="DELETE FROM Warenkorb WHERE UserID = '".$userID."'";
$stmt3= $conn-> prepare($delete);
$stmt3->execute();

$emailinfo="SELECT * 
            FROM kunde, bestellitem AS BI ,bestellung AS B 
            WHERE B.BestellID=bi.bestellid 
            AND b.BestellID>=	(   SELECT MAX(bb.BestellID) 
                                    FROM bestellung AS bb)
            AND kunde.UserID = '" . $userID . "'
            AND B.UserID = Kunde.UserID";

$stmt4= $conn-> prepare($emailinfo);
$stmt4->execute();

$recipient="SELECT * FROM Kunde WHERE UserID='".$userID."' ";
$stmt6= $conn-> prepare($recipient);
$stmt6->execute();





foreach  ($conn->query($recipient) as $row3){

        $email=$row3['email'];
        $vorname=$row3['vorname'];
        $nachname=$row3['nachname'];
}

$mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'getraenkeonlineshop@gmail.com';                     //SMTP username
                    $mail->Password   = 'iehyzxkbsjshkbgk';                               //SMTP password
                    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->SMTPSecure = 'ssl';
                    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                
                    //Recipients
                    $mail->setFrom('getraenkeonlineshop@gmail.com', 'Marios Test');
                    $mail->addAddress(''.$email.'', ''.$vorname.''.$nachname.'');     //Add a recipient
                    
                
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Ihre Rechnung';
                    $mail->Body    = '
                    <!DOCTYPE html>
                    <html lang="de">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>softdrinks.com - Ihre Rechnung</title>
                    
                        <style>
                            @import url("https://fonts.cdnfonts.com/css/barley-script-personal-use");
                            @import url("https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe&display=swap");
                    
                            *{
                                font-size: 20px;
                                font-family: "Alumni Sans Pinstripe";
                                font-weight: 800;
                                text-align: center;
                            }
                    
                            .logo{
                                font-family: "Barley Script PERSONAL USE", sans-serif;
                            font-size: 40px;
                            }
                            hr{
                                width: 80%;
                                margin-left: 10%;
                                opacity: 0.8;
                            }
                            .title{
                                font-size: 25px;
                                font-family: "Alumni Sans Pinstripe";
                                font-weight: 800;
                                text-align: center;
                            }
                            .infoBox{
                                display: flex;
                                justify-content: space-evenly;
                            }
                            table{
                                width: 100%;
                            }
                            tr th, tr td {
                                height: 50px;
                            }
                            .bestaetigt{
                                width: 100%;
                            }
                            
                        </style>
                    </head>
                    <body style="margin: 0; padding:0; ">
                    
                        <div style="width: 100%; height: auto; min-height: 500px; background-color: beige;">
                            <br>
                            <h1 class="logo" style="text-align: center;">softdrinks.com</h1>
                            <br>
                            <hr>
                            <h3 class="title">Ihre Rechnung</h3>
                            <br>
                            <div class="infoBox">
                                <div class="boxLeft">'.
                                $emailinfo="SELECT * 
                                            FROM kunde ,bestellung AS B 
                                            WHERE b.BestellID>=	(   SELECT MAX(bb.BestellID) 
                                                                    FROM bestellung AS bb)
                                            AND kunde.UserID = '" . $userID . "'
                                            AND B.UserID = Kunde.UserID";

                                $stmt4= $conn-> prepare($emailinfo);
                                $stmt4->execute();
                                
                                
                                
                                foreach($conn->query($emailinfo) as $row){

                                echo
                                '
                                    <p><strong>Vorname: </strong>'.$row['vorname'].'</p>
                                    <p><strong>Nachname: </strong>'.$row['nachname'].'</p>
                                    <p><strong>Bestellnummer: </strong>'.$row['BestellID'].'</p>
                                    <p><strong>Lieferadresse: </strong>'.$row['plz'].' '.$row['city'].' '.$row['street'].'</p>
                                    <p><strong>Email: </strong>'.$row['email'].'</p>
                                </div>
                                <div class="boxRight">
                                    <p><strong>Datum: </strong><p id="datum2"></p></p>
                                    <p><strong>Versandkosten: </strong>'.$row['Versandpreis'].' €</p>
                                    <p><strong>Versandart: </strong>'.$row['Versandart'].'</p> 
                                    <p><strong>Gesamtsumme: </strong>'.$row['Gesamtpreis'] + $row['Versandpreis'].' €</p>
                                </div>
                            </div>';

                            }
                            
                            '
                            <hr>
                            <div class="orderContent">
                                <table>
                                
                                    <tr>
                                        <th>Artikel</th>
                                        <th>Menge</th>
                                        <th>Preis in €</th>
                                    </tr>
                                '.
                                $email2="SELECT * 
                                            FROM kunde, bestellitem AS BI ,bestellung AS B 
                                            WHERE B.BestellID=bi.bestellid 
                                            
                                            AND b.BestellID>=	(   SELECT MAX(bb.BestellID) 
                                                                    FROM bestellung AS bb)
                                            AND kunde.UserID = '" . $userID . "'
                                            AND B.UserID = Kunde.UserID";

                                $stmt5= $conn-> prepare($email2);
                                $stmt5->execute();
                                




                                foreach($conn->query($email2) as $row2){
                                echo
                                '
                                    <tr>
                                        <td>'.$row2['name'].'</td>
                                        <td>'.$row2['Menge'].'</td>
                                        <td>'.$row2['PositionsPreis'].'</td>
                                    </tr>
                                    ';
                                }
                                '   
                                </table> 
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="bestaetigt">
                                <h1 style="font-size: 30px;">Betrag dankend erhalten.</h1><span>&#9989;</span>
                    
                    
                                <br>
                    
                                <h2> Ihr softdrinks.com Team</h2>
                            </div>
                            <br>
                            <hr>
                            <footer>
                                <p> Diese Rechnung wurde am <strong id="datum"></strong> automatisch generiert.</p>
                                <p> © Marios Tzialidis, Kevin Koch</p>
                            </footer>
                        </div>
                    
                        <script>
                            document.getElementById("datum").innerHTML =new Date().toLocaleDateString("de-us", { weekday:"long", year:"numeric", month:"short", day:"numeric"}) ;
                            document.getElementById("datum2").innerHTML =new Date().toLocaleDateString("de-us", { weekday:"long", year:"numeric", month:"short", day:"numeric"}) ;
                        </script>
                    </body>
                    </html>
                                      ';
                
                    $mail->send();

                   // header("Location: thx.php"); 
                   echo $email;
                } catch(Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    echo "<br>";
                    echo "Fehler".$e;
                }


            

} catch(PDOException $f){
echo "Fehler: ".$f;
}
//header("Location: thx.php");

?>