<?php

    $email="";

    if(isset($_POST['email'])){
        $email = $_POST['email'];

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

            $sql = "SELECT * FROM kunde WHERE email = '$email'";

            $stmt = MySQLi_query($con, $sql);

            if(mysqli_num_rows($stmt) === 0){
                //while ($row = MySQLi_fetch_assoc($stmt)) {
                    echo "
                        <div style='height: auto; width: 100%;'>
                            <h3 class='text-success text-center mt-3'>&#10004;</h3>
                        </div>
                    ";
                //}
            }else {
                echo "
                <div style='height: auto; width: 100%;'>
                    <h3 class='text-danger text-center mt-3'>Zu dieser Email Adresse gibt es bereits ein Profil!</h3>
                </div>
                ";
            }

        }catch(Exception $e){
            echo "Fehler: ".$e;
        }


    }else{
        echo "Fehler bei der Übergabe der email-Variablen";
    }


?>