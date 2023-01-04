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
    <title>softdrinks.com - Home</title>

    <!--Header Import (css-Links)-->
    <?php include 'php/imports/headerImport.php';?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
    
    <?php include 'php/imports/scriptImport.php';?>

   
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header" style="width: 100%;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <a id="navbar-brand" class="navbar-brand" href="#">softdrinks.com</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="php/alleArtikel.php">Alle Artikel</a></li>
                    <li><a href="php/meinProfil.php">
                        <?php                     
                        if(isset($_SESSION['UserID'])){
                        echo $_SESSION['vorname'];
                        echo'<li><a href="Warenkorb.php">Warenkorb <button type="button" class="btn btn-primary">';
                        }else{
                        //   echo "Mein Profil";
                        }
                        ?></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <?php

                    if(!isset($_SESSION['UserID'])){
                        echo ' <li>
                                    <a href="php/signUp.php">
                                        <span class="glyphicon glyphicon-user"></span> Sign Up
                                    </a>
                                </li>';
                    }else{
                            echo "";
                        }

                    ?>

                   
                    <li>

                        <?php
                            if(!isset($_SESSION['UserID'])){
                                echo '  <a href="php/login.php">
                                            <span class="glyphicon glyphicon-log-in"></span> Login
                                        </a>';
                            }else {
                                echo '  <a href="php/logout.php">
                                            <span class="glyphicon glyphicon-log-out"></span> Logout
                                        </a>';
                            }   
                        ?>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <h1 class="homeH1">Home</h1>
    </section>

    <!-- Begrüßung über SESSION Variablen -->
    <?php if(isset($_SESSION['UserID'])){
            echo "<div style='width: 100%;'><h3 style='text-align: center;'>Hallo ".$_SESSION['vorname'].". <br> Schön, dass du wieder da bist! <br> Dein letzter Login war am ".$_SESSION['lastLogin']."</h3></div>";} 
    ?>

    <div class="aboutShop">
        <div class="item"><i class="bi bi-truck"></i><br>Versand aus Deutschland</div>
        <span></span>
        <div class="item"><i class="bi bi-currency-bitcoin" data-toggle="tooltip" data-placement="top" title="Soon available!"></i><br>BTC Checkout</div>
        <span></span>
        <div class="item"><i class="bi bi-wallet2"></i><br>Beste Preise</div>
    </div>


    <div class="slider">
        <h2 style="text-align: center;" class="soon">Bald bei uns erhältlich!</h2>
        <br>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="images/slider/slider1.png" alt="First slide">
                </div> 
                <div class="carousel-item">
                    <img class="d-block w-100" src="images/slider/slider2.jpeg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="images/slider/slider3.png" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>


    <br>
     <!-- Newsletter Registrierung -->
     <!-- Newsletter Registrierung -->
    <form class="newsletter">
        <h3>Trag dich hier für unseren Newsletter ein!</h3>
        <div class="form-group">
            <label for="exampleInputEmail1">Email Adresse</label>
            <input style="font-size: 22px; text-align: center;" type="email" class="form-control" id="newsletterEmail" aria-describedby="emailHelp" placeholder="Enter email" required>
            <small id="emailHelp" class="form-text text-muted">Deine Daten bleiben bei uns sicher!</small>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <label class="form-check-label" for="exampleCheck1">Ich bin mit der Aufnahme in den Newsletter einverstanden!</label>
        </div>
        <button onclick="addToNewsletter()" type="button" id="formSubmitButton" class="btn btn-success" style="font-size: 20px;">Get it!</button>
        <div style="width: 100%; height: 50px; text-align: center;" id="responseDisplay"></div>
    </form>

    <?php include "scriptImport.php"; ?>

    <script>

        let input = document.getElementById('newsletterEmail').value;
        let display = document.getElementById('responseDisplay');

        function addToNewsletter() {

            let input = document.getElementById('newsletterEmail').value;
            let display = document.getElementById('responseDisplay');
        

            if(input == ""){
                display.textContent = "Bitte gib eine valide E-Mail Adresse an!";
            }else {
                display.textContent="";
                $.ajax({
                    url : "php/ajax/newsletterAjax.php",
                    method : "POST",
                    data:{
                        email: input
                    },
                    success: function(data){
                        $("#responseDisplay").html(data);
                    }
                })
            }
        }


    </script>

    

    
    <!-- Social Media -->
    <div class="socialMedia">
        <div class="template-demo">
            <span></span>
            <button type="button" class="btn btn-social-icon btn-facebook btn-rounded"><i class="fa fa-facebook"></i></button>
            <button type="button" class="btn btn-social-icon btn-youtube btn-rounded"><i class="fa fa-youtube"></i></button>                                        
            <button type="button" class="btn btn-social-icon btn-twitter btn-rounded"><i class="fa fa-twitter"></i></button>
            <button type="button" class="btn btn-social-icon btn-linkedin btn-rounded"><i class="fa fa-linkedin"></i></button>
            <button type="button" class="btn btn-social-icon btn-instagram btn-rounded"><i class="fa fa-instagram"></i></button>
            <span></span>
        </div>
    </div>

    <div class="container3">
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="php/alleArtikel.php" class="nav-link px-2 text-muted">Alle Artikel</a></li>
            <li class="nav-item"><a href="php/meinProfil.php" class="nav-link px-2 text-muted">Mein Profil</a></li>
            <li class="nav-item"><a href="php/impressum.php" class="nav-link px-2 text-muted">Impressum</a></li>
            <li class="nav-item"><a href="php/datenschutz.php" class="nav-link px-2 text-muted">Datenschutz</a></li>
        </ul>
        <p class="text-center text-muted"><?php echo date("Y"); ?> © Marios Tzialidis, Kevin Koch</p>
    </footer>
</div>
    
    
    <script>

        let input = document.getElementById('newsletterEmail').value;
        let display = document.getElementById('responseDisplay');

        function addToNewsletter() {

            let input = document.getElementById('newsletterEmail').value;
            let display = document.getElementById('responseDisplay');
        
            if(input != ""){
                display.textContent = "Bitte gib eine valide E-Mail Adresse an!";
            }else {
                display.textContent="";
                $.ajax({
                    url : "php/ajax/newsletterAjax.php",
                    method : "POST",
                    data:{
                        email: input
                    },
                    success: function(data){
                        $("#responseDisplay").html(data);
                    }
                })
            }
        }
    </script>
</body>
</html>