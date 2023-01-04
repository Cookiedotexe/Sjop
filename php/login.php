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
    <title>Getränke Shop Login</title>

    <!--Header Import (css-Links)-->
    <?php include 'imports/headerImport.php';?>
</head>
<body>
    <?php include 'imports/navImport.php';?>


    <section>
        <h1 class="homeH1">Login</h1>
    </section>

    <section class="vh-80" style="background-color: #d9d9d9;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                    <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="../images/logo.png"
                        alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                    </div>
                    <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">

                        <form class="loginForm" method="POST" action="checkLogin.php">

                            <div class="d-flex align-items-center mb-3 pb-1">
                                <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                <span class="h1 fw-bold mb-0" id="logoText">softdrinks.com</span>
                            </div>

                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;" id="loginH5">Login</h5>

                            <div class="form-outline mb-4">
                                <input placeholder="Email" style="font-size: 22px; font-weight:bolder;" for="email" name="email" type="email" class="form-control form-control-lg" />
                                <label class="form-label" for="email">Email Adresse</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input placeholder="Passwort" style="font-size: 18px; font-weight: bolder;" for="password" name="password" type="password" class="form-control form-control-lg" />
                                <label class="form-label" for="password">Passwort</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input placeholder="2FA-Code" style="font-size: 18px; font-weight: bolder;" for="2FA" name="2FA" type="password" class="form-control form-control-lg" />
                                <label class="form-label" for="password">2FA - Code</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button name="submit" class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                            </div>

                            <a class="small text-muted" href="forgotPassword.php">Passwort vergessen?</a>
                            <p class="mb-5 pb-lg-2" style="color: #393f81;">Noch keinen Account? <a href="signUp.php" style="color: #393f81;">Hier registrieren!</a></p>
                            <a href="impressum.php" class="small text-muted">Impressum.</a>
                            <a href="datenschutz.php" class="small text-muted">Datenschutz</a>
                        </form>

                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>


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