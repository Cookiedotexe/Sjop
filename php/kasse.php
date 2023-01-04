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
    <title>Kasse</title>

    <!--Header Import (css-Links)-->
    <?php include 'imports/headerImport.php';?>
</head>
<body>
    <?php include 'imports/navImport.php';?>


    <section class="searchArea">
        <h1 class="homeH1">Kasse</h1>
        
    </section>


    <div class="display" id="display">
    <?php 

        include 'imports/dbSettings.php';

        $sql = "SELECT * 
                FROM artikel AS a
                LEFT JOIN warenkorb as w ON a.artikelID = w.artikelID
                where userID='" . $_SESSION['UserID'] ."'";

        foreach($conn->query($sql) as $row){
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
            echo '
            <section style="background-color: #eee;">
                <div class="container py-5">
                    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card text-black">
                        <img style="width:40%" src="'.$row['path'].'"
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
                            <div class="d-flex justify-content-between total font-weight-bold mt-4">
                            <span>Rabatt:</span><span>'.$rabattanz.' </span>
                            </div>
                            <div class="d-flex justify-content-between total font-weight-bold mt-4">
                            <span>Gesamtpreis</span><span>'.$gpmitRabatt.' €</span>
                            </div>
                            <div class="d-flex justify-content-between total font-weight-bold mt-4">
                            <span>Menge: '.$row['Menge'].'</span>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
            ';
        }//hidden Value evtl. unsicher
    
   

    ?> 
    
    <form action="bestellen.php" method="post">
        <div  class="centered">
            <span></span>
            <select name="Versandart">
                <option value="DPD">DPD: 6 €</option>
                <option value="DHL">DHL: 15 €</option>
                <option value="DHL Express">DHL Express: 48 €</option>
            </select> 

            <span><input type="submit" value="Bestellen"></span>

            <span></span>
         </div>
    
    </form>
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