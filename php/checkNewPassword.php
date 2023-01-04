<?php
    $email="";
    $oldPassword="";
    $newPassword="";
    $dbEmail="";

    if(isset($_POST['email']) && isset($_POST['oldPassword']) && isset($_POST['newPassword'])){

        include 'imports/dbSettings.php';

        $email = $_POST['email'];
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];


        $hashed = hash('sha512', $newPassword);

        try{

            $sql = "SELECT * FROM kunde WHERE email='".$email."' and password='".$oldPassword."' ";
    
            foreach($conn-> query($sql) as $row){
                $dbEmail = $row['email'];
                $dbPassword = $row['password'];
                $dbId = $row['UserID'];
            }

            if($dbEmail == $email && $dbPassword == $oldPassword){
                
                $sql2 = "UPDATE kunde SET password = '".$hashed."' WHERE UserID = '".$dbId."' ";
                $stmt = $conn->prepare($sql2);
                $stmt->execute();
                
                $sql3 = "UPDATE kunde SET hasNewPassword = 1 WHERE UserID = ".$dbId." ";
                $stmt2 = $conn->prepare($sql3);
                $stmt2->execute();

                header("Location: login.php");
            }
        }catch(PDOException $e){
            echo "Fehler bei der Datenbankanfrage! ".$e;
        }

        
        //hier das Passwort hashen und die Datenbank updaten (hasNewPassword==1 && newPassword)
        //Prüfen, ob das Passwort lang genug ist und alle notwendigen Zeichen enthält
        //Papa muss jetzt schlafen gehen


    }else{
        echo "Ein oder mehrere Parameter wurden falsch übergeben!";
    }
?>