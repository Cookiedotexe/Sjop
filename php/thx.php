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
    <title>Getränke Shop Warenkorb</title>

    <!--Header Import (css-Links)-->
    <?php include 'imports/headerImport.php';?>
</head>
<body>
    <?php include 'imports/navImport.php';?>

    <h1>Vielen Dank für Ihren Einkauf!</h1>

        <div  class="centered">
            <span></span>
                
            <span><button onclick="location.href='AlleArtikel.php'">Weiter Einkaufen</button></span>

            <span></span>
         </div>
    
    
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