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
    <title>Getränke Shop Sign Up</title>

    <!--Header Import (css-Links)-->
    <?php include 'imports/headerImport.php';?>
</head>
<body>
    <?php include 'imports/navImport.php';?>

    <section>
        <h1 class="homeH1">Sign Up!</h1>
    </section>

    <div class="signUpFormDiv">
        <form method="POST" action="checkReg.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="vorname">Vorname*</label>
                <input name="vorname" type="vorname" class="form-control" id="vorname" placeholder="Vorname" required>
                </div>
                <div class="form-group col-md-6">
                <label for="nachname">Nachname*</label>
                <input name="nachname" type="nachname" class="form-control" id="nachname" placeholder="Nachname" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email*</label>
                    <input name="email" type="email" class="form-control" id="emailInput" onkeyup="checkUsername()" placeholder="Email" required>
                </div>
                <div class="form-group" id="usernameDisplay" style="text-align: center; color: red;">
                    
                </div>
                <div class="form-group col-md-6">
                    <h3 style="text-align: center;">Dir wird ein zufäliges generiertes Einmal-Passwort <br> per Email zugeschickt.</h3>
                </div>
            </div>
            <div class="form-group">
                <label for="street">Straße und Hausnummer*</label>
                <input name="street" type="text" class="form-control" id="street" placeholder="" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="city">Stadt*</label>
                <input name="city" type="text" class="form-control" id="city" required>
                </div>
                
                <div class="form-group col-md-2">
                <label for="plz">Postleitzahl*</label>
                <input type="text" for="plz" name="plz" class="form-control" id="plz" required>
                </div>
            </div>
            <div class="form-row" id="check">
                <input class="form-check-input" type="checkbox" id="check" required>
                <label class="form-check-label" for="check">
                    Ich bin mit der Weiterverarbeitung meiner personenbezogenen <br> Daten einverstanden.*
                </label> 
            </div>
            <div id="submitBtn" class="form-group">
                <button id="sbt" type="submit" class="btn btn-primary">Sign me up!</button>
            </div>
        </form>
    </div>

    


    <br>
    <!-- Newsletter Registrierung -->
    <form class="newsletter">
        <h3>Trag dich hier für unseren Newsletter ein!</h3>
        <div class="form-group">
            <label for="exampleInputEmail1">Email Adresse</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
            <small id="emailHelp" class="form-text text-muted">Deine Daten bleiben bei uns sicher!</small>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <label class="form-check-label" for="exampleCheck1">Ich bin mit der Aufnahme in den Newsletter einverstanden!</label>
        </div>
        <button type="submit" id="formSubmitButton" class="btn btn-success" style="font-size: 20px;">Get it!</button>
    </form>

    
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
                <li class="nav-item"><a href="../index.php" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="alleArtikel.php" class="nav-link px-2 text-muted">Alle Artikel</a></li>
                <li class="nav-item"><a href="meinProfil.php" class="nav-link px-2 text-muted">Mein Profil</a></li>
                <li class="nav-item"><a href="impressum.php" class="nav-link px-2 text-muted">Impressum</a></li>
                <li class="nav-item"><a href="datenschutz.php" class="nav-link px-2 text-muted">Datenschutz</a></li>
            </ul>
            <p class="text-center text-muted"><?php echo date("Y"); ?> © Marios Tzialidis, Kevin Koch</p>
        </footer>
    </div>

    <?php include 'imports/scriptImport.php';?>
    

    <script>

        let input = document.getElementById('emailInput').value;
        let display = document.getElementById('usernameDisplay');

        function checkUsername() {

            let input = document.getElementById('emailInput').value;
            let display = document.getElementById('usernameDisplay');

            console.log(input);
        

            if(input == ""){
                display.textContent = "Bitte gib eine valide E-Mail Adresse an!";
            }else {
                display.textContent="";
                $.ajax({
                    url : "ajax/usernameAjax.php",
                    method : "POST",
                    data:{
                        email: input
                    },
                    success: function(data){
                        $("#usernameDisplay").html(data);
                    }
                })
            }
        }

    </script>

</body>
</html>