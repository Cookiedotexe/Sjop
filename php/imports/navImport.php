<nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header" style="width: 100%;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <a id="navbar-brand" class="navbar-brand" href="../index.php">softdrinks.com</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="alleArtikel.php">Alle Artikel</a></li>
                    <li><a href="meinProfil.php">
                        <?php 

                        if(isset($_SESSION['UserID'])){
                            echo $_SESSION['vorname'];
                            echo'<li><a href="Warenkorb.php">Warenkorb <button type="button" class="btn btn-primary">';
                        }else{
                             //   echo "Mein Profil";
                            }
                        ?></a></li>
                                           
                        <?php
                        include 'imports/dbSettings.php';
                        if(isset($_SESSION['UserID'])){
                        $sql = "SELECT COUNT(*) AS A
                                FROM Warenkorb AS W
                                where UserID='" . $_SESSION['UserID'] ."'";      //Variable id evtl veraltet swecks db wurde angepasst                        
                        
                        foreach($conn->query($sql) as $row){
                        echo'
                           <span class="badge badge-light"> '.$row['A'].'</span>
                    </button></li>';}//Schriftfarbe muss angepasst sein
                    }
                    ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <?php

                    if(!isset($_SESSION['UserID'])){
                        echo ' <li>
                                    <a href="signUp.php">
                                        <span class="glyphicon glyphicon-user"></span> Sign Up
                                    </a>
                                </li>';
                    }else{
                            echo "";
                        }

                    ?>

                    <?php

                   

                    ?>

                    <li>

                        <?php
                            if(!isset($_SESSION['UserID'])){
                                echo '  <a href="login.php">
                                            <span class="glyphicon glyphicon-log-in"></span> Login
                                        </a>';
                            }else {
                                echo '  <a href="logout.php">
                                            <span class="glyphicon glyphicon-log-out"></span> Logout
                                        </a>';
                            }   
                        ?>

                        
                    </li>
                </ul>
            </div>
        </div>
    </nav>