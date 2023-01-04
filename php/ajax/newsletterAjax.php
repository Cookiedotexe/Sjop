<?php

    include '../imports/dbSettings.php';

    $email= "";
    $vorname= "";
    $nachname = "";
    $time = date("r");

    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];

        $con = MySQLi_connect(
            'localhost',
            'root',
            '',
            'getraenkeHandel2'
        );

        if (MySQLi_connect_errno()) {
            echo "Failed to connect to MySQL: " . MySQLi_connect_error();
        }

        try{


            $sql2 = "SELECT * FROM Newsletter WHERE email='".$email."'";

            $stmt2 = mysqli_query($con, $sql2);

            if(mysqli_num_rows($stmt2) === 0){
               
                    $sql = "INSERT INTO Newsletter (email, time) VALUES (?, ?) ";

                    $stmt = $conn->prepare($sql);

                    $stmt->execute([$email, $time]);

                    
                    echo "
                       <h4 style='color: green; font-size: 25px'>&#10004; <br> Zum Newsletter-Verteiler hinzugefügt!</h4>
                    ";
                
            }else {
                echo "
                    <h4 style='color: red; font-size: 25px'>&#10007; <br> Sie sind bereits für den Newsletter angemeldet!</h4>
                ";
            }

        }catch(Exception $e){
            echo "Fehler: ".$e;
        }


    }else{
        echo "Fehler bei der Übergabe der Variablen";
    }


?>