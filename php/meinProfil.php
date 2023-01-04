<?php 
    session_start();
    if(isset($_SESSION['UserID']))
    {
        $userID = (int) $_SESSION['UserID'];
    }
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mein Profil</title>

    <!--Header Import (css-Links)-->
    <?php include 'imports/headerImport.php';?>
</head>
<body>
    <?php include 'imports/navImport.php';?>


    


    <div class="display" id="display">
    <?php 

        include 'imports/dbSettings.php';

        $bestellung ="SELECT * FROM Bestellung WHERE UserID = ' " . $userID . " ' ";
        foreach($conn->query($bestellung) as $row){
            
            $sql = "SELECT *
            FROM kunde, bestellitem AS BI ,bestellung AS B,Artikel AS AR 
            WHERE kunde.UserID = ' " . $userID . " '
            AND B.BestellID = ".$row['BestellID']."
            AND B.BestellID = bi.bestellid 
            AND B.UserID = Kunde.UserID
            AND BI.ArtikelID=AR.ArtikelID";

            echo '
            <section style="background-color: #eee;">
                <div class="container py-5">
                    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card text-black">
                        <div class="card-body">
                            
                            <div>
                            <div class="d-flex justify-content-between">
                                <span>BestellID.: '.$row['BestellID'].'</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Gesamtpreis.: '.$row['Gesamtpreis'].'</span>
                            </div>

                        
                            
                            ';


            foreach($conn->query($sql) as $row2){
                echo '
                <section style="background-color: #eee;">
                    <div class="container py-5">
                        <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-4">
                            <div class="card text-black">
                            <div class="card-body">
                                
                                <div>
                                <div class="d-flex justify-content-between">
                                    <span>'.$row2['name'].'</span><span>ArtikelID.: '.$row2['ArtikelID'].'</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Menge.: '.$row2['Menge'].'</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Artikel</span><span>'.$row2['name'].'</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Preis mit Rabatt</span><span> '.$row2['PositionsPreis'].' Stück</span>
                                </div>
                                </div>
                                <div class="d-flex justify-content-between total font-weight-bold mt-4">
                                <span>Preis/ Stück</span><span>'.$row2['preis'].' €</span>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </section>
                ';
            }
            echo ' </div> </div> </div> </div> </div> </div> </div>
            <div class="d-flex justify-content-between total font-weight-bold mt-4">
                 <form action="erneutbestellen.php" method="post">
                    

                    <input type="hidden" id="BestellID" name="BestellID" value="'.$row['BestellID'].'">
                
                    <span class="centered"><input type="submit" value="Erneut Bestellen"></span>
                </form>
            </div>
                ';
        }

        
    
    ?>
    </div>

    <?php include "imports/newsletterImport.php"; ?>

    <div class="container3">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="php/#" class="nav-link px-2 text-muted">Alle Artikel</a></li>
                <li class="nav-item"><a href="php/#" class="nav-link px-2 text-muted">Mein Profil</a></li>
                <li class="nav-item"><a href="php/#" class="nav-link px-2 text-muted">Impressum</a></li>
                <li class="nav-item"><a href="php/#" class="nav-link px-2 text-muted">Datenschutz</a></li>
            </ul>
            <p class="text-center text-muted"><?php echo date("Y"); ?> © Marios Tzialidis, Kevin Koch</p>
        </footer>
    </div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>  
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

        $(document).ready(function(){
            $("#search").keyup(function(){
                var input = $(this).val();

                console.log(input);

                if(input != ""){
                    $.ajax({
                        url: "ajax/searchAjax.php",
                        method: "POST",
                        data: {
                                search: input
                            },

                        sucess:function(data){
                            $("#display").html(data);
                        }
                    });
                }
            })
        });

    </script>
    <script>
        var input = document.getElementById('search').value;
        var display = document.getElementById('display');

        function search(){

            var searchInput = document.getElementById('search').value;

            if(search != ""){

                $.ajax({
                    url : "ajax/searchAjax.php",
                    method : "POST",
                    data:{
                        search: searchInput
                    },
                    success: function(data){
                        $("#display").html(data);
                    }
                })
            }
        }
    </script>

    <?php include 'imports/scriptImport.php';?>
    
</body>
</html>



<!--
    - Warenkorb Widget in der Nav-Bar
    - Warenkorb Badge
    - Input Field mit Submit Button und Form
    - Ajax mit der Badge
    - Datenbank für Warenkorb erstellen
 -->