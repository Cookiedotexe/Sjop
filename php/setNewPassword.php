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
    <title>Getränke Shop Set New Password</title>

    <!--Header Import (css-Links)-->
    <?php include 'imports/headerImport.php';?>
</head>
<body>
    <?php include 'imports/navImport.php';?>

    <section style="height: auto;">
        <h1 class="homeH1">Set New Password</h1>
    </section>

    <div class="signUpFormDiv">
        <form method="POST" action="checkNewPassword.php">
            <div class="form-group">
                <label for="email">Email*</label>
                <input name="email" type="text" class="form-control" id="formGroupExampleInput" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="oldPassword">Old Password*</label>
                <input name="oldPassword" type="text" class="form-control" id="oldPassword" placeholder="Old Password" required>
            </div>
            <div class="form-group">
                <label for="newPassword">New Password*</label>
                <input minlength="8" name="newPassword" type="text" class="form-control" id="newPassword" placeholder="New Password" required>
            </div>
            <div class="form-group" id="submitBtn2">
                <button id="sbt2" type="submit" class="btn btn-primary">Change Password!</button>
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
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="php/#" class="nav-link px-2 text-muted">Alle Artikel</a></li>
                <li class="nav-item"><a href="php/#" class="nav-link px-2 text-muted">Mein Profil</a></li>
                <li class="nav-item"><a href="php/#" class="nav-link px-2 text-muted">Impressum</a></li>
                <li class="nav-item"><a href="php/#" class="nav-link px-2 text-muted">Datenschutz</a></li>
            </ul>
            <p class="text-center text-muted"><?php echo date("Y"); ?> © Marios Tzialidis, Kevin Koch</p>
        </footer>
    </div>

    <?php include 'imports/scriptImport.php';?>
    
</body>
</html>