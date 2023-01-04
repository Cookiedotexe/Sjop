<?php

    include '../imports/dbSettings.php';

    if(isset($_POST['search'])){

        $search = $_POST['search'];

        $con = MySQLi_connect(
            'localhost', //Server host name.
            'root', //Database username.
            '', //Database password.
            'getraenkeHandel2' //Database name or anything you would like to call it.
        );

        //Check connection
        if (MySQLi_connect_errno()) {
            echo "Failed to connect to MySQL: " . MySQLi_connect_error();
        }

        try{

            $sql = "SELECT * FROM artikel WHERE name LIKE '%$search%'";

            if($search == "")
                $sql = "SELECT * FROM artikel";

            $stmt = MySQLi_query($con, $sql);

            if(mysqli_num_rows($stmt) > 0){
                while ($row = MySQLi_fetch_assoc($stmt)) {
                    echo '
                        <section style="background-color: #eee;">
                            <div class="container py-5">
                                <div class="row justify-content-center">
                                <div class="col-md-8 col-lg-6 col-xl-4">
                                    <div class="card text-black">
                                    <img src="'.$row['path'].'"
                                        class="card-img-top" alt="'.$row['name'].'" />
                                    <div class="card-body">
                                        <div class="text-center">
                                        <p class="text-muted mb-4">'.$row['name'].'</p>
                                        </div>
                                        <div>
                                        <div class="d-flex justify-content-between">
                                            <span>'.$row['name'].'</span><span>Art.Nr.: '.$row['artikelNummer'].'</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>Füllmenge</span><span>'.$row['inhalt'].' Liter</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>On Stock</span><span> '.$row['onStock'].' Stück</span>
                                        </div>
                                        </div>
                                        <div class="d-flex justify-content-between total font-weight-bold mt-4">
                                        <span>Preis/ Stück</span><span>'.$row['preis'].' €</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </section>
                    ';
                }
            }else {
                echo "
                <div style='height: 80vh; width: 100%;'>
                    <h3 class='text-danger text-center mt-3'>Kein passender Artikel gefunden!</h3>
                    <img src='../images/spongebob2.gif' alt='Spongebob Gif' style='width: 50%;, height: 40%; margin-left:25%;'/>
                </div>
                ";
            }
        }catch(Exception $e){
            echo "Fehler: ".$e;
        }
    }else{
        echo "<h6 class='text-danger text-center mt-3'>Parameter wurden nicht übergeben!</h6>";
    }

?>