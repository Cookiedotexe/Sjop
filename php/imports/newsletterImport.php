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

        let input2 = document.getElementById('newsletterEmail').value;
        let display2 = document.getElementById('responseDisplay');

        function addToNewsletter() {

            let input2 = document.getElementById('newsletterEmail').value;
            let display2 = document.getElementById('responseDisplay');
        

            if(input2 == ""){
                display2.textContent = "Bitte gib eine valide E-Mail Adresse an!";
            }else {
                display2.textContent="";
                $.ajax({
                    url : "ajax/newsletterAjax.php",
                    method : "POST",
                    data:{
                        email: input2
                    },
                    success: function(data){
                        $("#responseDisplay").html(data);
                    }
                })
            }
        }


    </script>