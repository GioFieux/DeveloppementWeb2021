<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="ticket.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">

        <title>Registration</title>
    </head>
    <body>            
        <img src="images/LOGO_DinoWorld.png" class="logo">
        <h1 class="name">DinoWorld</h1>
        <h2 class="pageName">Registration page</h2>
        <br>
        <form action="confirmedRegistration.php" method="POST" class="ticket">
            <fieldset class="m-auto p-2">

            <div class="form-group m-auto p-2">
                <label for="email">Email address</label>
                <input type="email" class="form-control rounded-pill" id="email" name="email" placeholder="Email"> 
            </div>

            <div class="form-group m-auto p-2">
                <label for="password">Password</label>
                <input type="password" class="form-control rounded-pill" id=password name="password" placeholder="Password">
            </div>

            <div class="form-group m-auto p-2">
                <label for="repeatPassword">Password</label>
                <input type="password" class="form-control rounded-pill" id=repeatPassword name="repeatPassword" placeholder="Repeat Password">
            </div>

            <div class="text-center m-2">
                <button type="submit" name="register" id="register" class="btn btn-light rounded-pill">Register</button>
            </div> 

            </fieldset>
        </form>
        <div id="result"></div>
    </body>
    <script>
        /*let users = [];

        const addUser=() => {
            let user = {email: document.getElementById('email').value}
            users.push(user);
            console.warn('New user added', {users});
            sessionStorage.setItem('UsersList', JSON.stringify(users) );
        }

        document.addEventListener('DOMContentLoaded', ()=> {
            document.getElementById('register').addEventListener('click', addUser);
        })*/

        $(document).ready(function(){
            // Get value on button click and show alert
            $("#register").click(function(e) {
                e.preventDefault();
                var email = $("#email").val();
                var password = $("#password").val();
                var repeatPassword = $("#repeatPassword").val();
                sessionStorage.setItem('User', email);
                $(".ticket").hide();
                $.ajax({
                    url: "confirmedRegistration.php",
                    method: "POST",
                    data: {
                        register: 'register',
                        email: email,
                        password: password,
                        repeatPassword: repeatPassword
                    },
                    success: function(response) {
                        $("#result").html(response);
                    }
                });
            });
        });
    </script>

</html>