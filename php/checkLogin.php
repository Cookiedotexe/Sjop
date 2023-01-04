<?php

    require_once '../libraries/GoogleAuthenticator-master/PHPGangsta/GoogleAuthenticator.php';

    $loginSucess = false;

    $email = "";
    $password = "";
    $newLastLogin = date("r");
    $twoFACode = "";
    $ga = new PHPGangsta_GoogleAuthenticator();

    if(isset($_POST['email']) && isset($_POST['password']) && isset ($_POST['2FA'])){
        $email = $_POST['email'];
        $passwordF = $_POST['password'];
        $twoFACode = $_POST['2FA'];

        $password = hash('sha512', $passwordF);
    }

    include 'imports/dbSettings.php';

    try{
        $sql = "SELECT * FROM kunde WHERE email='".$email."' and password='".$password."'";
    
        foreach($conn-> query($sql) as $row){
            
            $dbEmail = $row['email'];
            $dbPassword = $row['password'];
            $dbSecret = $row['secret'];

            $oneCode = $ga->getCode($dbSecret);

            $checkResult = $ga->verifyCode($dbSecret, $oneCode, 2);

            session_start();

            $_SESSION['UserID'] = $row['UserID'];
            $_SESSION['vorname'] = $row['vorname'];
            $_SESSION['nachname'] = $row['nachname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['lastLogin'] = $row['lastLogin'];
     
            if($email == $dbEmail && $password == $dbPassword && $checkResult){
                $loginSucess = true;
            }else{
                $loginSucess=false;
            }

        }

        if($loginSucess){
            try{
                $sql2 = "UPDATE kunde SET lastLogin='".$newLastLogin."' WHERE email='".$email."'";   
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute();

                $conn = null;
                header("Location: ../index.php");
            }catch(PDOException $e){
                echo "Fehler: ".$e;
            }
        }else{
            $conn = null;
            header("Location: login.php");
        }

    }catch(PDOException $e){
        echo "Fehler: ".$e;
    }

?>