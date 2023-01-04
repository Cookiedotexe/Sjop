<?php

    require '../libraries/PHPMailer/src/Exception.php';
    require '../libraries/PHPMailer/src/PHPMailer.php';
    require '../libraries/PHPMailer/src/SMTP.php';

    require_once '../libraries/GoogleAuthenticator-master/PHPGangsta/GoogleAuthenticator.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
         
    $vorname="";
    $nachname="";
    $email="";
    $password="";
    $lastLogin= date("r");
    $online=0;
    $street="";
    $plz="";
    $city="";
    $land="Deutschland";
    $hasNewPassword=0;   

    try{

        include 'imports/dbSettings.php';

        if(isset($_POST['vorname']) && isset($_POST['nachname']) && isset($_POST['email']) && isset($_POST['street']) && isset($_POST['plz']) && isset($_POST['city'])){
            $vorname = $_POST['vorname'];
            $nachname = $_POST['nachname'];
            $email = $_POST['email'];
            $street = $_POST['street'];
            $plz = $_POST['plz'];
            $city = $_POST['city'];

            $bytes = openssl_random_pseudo_bytes(4);
            $password = bin2hex($bytes);

            $ga = new PHPGangsta_GoogleAuthenticator();
            $secret = $ga->createSecret();

            $qrCodeUrl = $ga->getQRCodeGoogleUrl('softdrinks.com - 2FA', $secret);


            try{

                $sql = "INSERT INTO kunde (vorname, nachname, email, password, lastLogin, online, street, plz, city, land, hasNewPassword, secret) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$vorname, $nachname, $email, $password, $lastLogin, $online, $street, $plz, $city, $land, $hasNewPassword, $secret]);

            } catch(PDOException $f){
                echo "Fehler: ".$f;
            }


            // Passwort wird per E-Mail an den Kunden gesendet
    
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
                    $mail->Subject = 'New One-Way-Password for your Account';
                    $mail->Body    = '
                                    <div style="text-align: center; backgound-color: white; color: black; width: 90%; padding-left: 5%; margin: 5px;">
                                      <h2 style="color: white;">softdrinks.com</h2>
                                      
                                      <h5>Du hast erfolgreich ein neues Konto angelegt. <br> Anbei die von dir angegebenen Daten, <br> sowie das One-Way-Passwort.</h5>
                                      <br>
                                      <h3> Vorname: '.$vorname.'</h3> 
                                      <br>
                                      <h3> Nachname: '.$nachname.'</h3>
                                      <br>
                                      <h3> Adresse: '.$street.'  '.$plz.'   '.$city.'   '.$land.'</h3>
                                      <h3> E-Mail: '.$email.'</h3>
                                      <h3> One-Way-Passwort: '.$password.'</h3>
                                      <br>
                                      <h4>Scannen Sie bitte folgenden QR-Code in der <br> Google Authenticator - App für die Zwei-Faktor-Authentifizierung:</h4> 
                                      <br>
                                      <img style="width: 200px; height: 200px;" src="'.$qrCodeUrl.'" />
                                      <br>
                                      <h5>Hier klicken, falls kein QR-Code angezeigt wird: <br> '.$qrCodeUrl.'</h5>
                                      <br>
                                      <h4>Oder sie pflegen den folgenden Code manuell ein: </h4>
                                      <br>
                                      <h3><strong>'.$secret.'</strong></h3>
                                      <h3>Bitte klicke auf den folgenden <a style="color: black;" href="localhost/php/setNewPassword.php" > Link </a> und erstelle <br> dein neues Passwort</h3>
                                      <br>
                                      <h3>Beste Grüße</h3>
                                      <br>
                                      <h3>Ihr softdrinks.com - Team</h3>
                                    </div>
                                      ';
                
                    $mail->send();

                    header("Location: successfullRegistred.php");
                } catch(Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    echo "<br>";
                    echo "Fehler".$e;
                }


            echo "<h3>".$sql."</h3>";
            
            $conn=null;

            header("Location: successfullRegistred.php");
        }else{
            echo "<h3>Eine oder mehrere der Variablen wurden nicht übermittelt.</h3>";
        }
    }catch(PDOException $e){
        echo "Fehler: ".$e;
    }

?>