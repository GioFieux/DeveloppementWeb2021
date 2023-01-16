<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="ticket.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">

    <title>Verify Login Informations</title>
  </head>
  <body>
      <?php
      $dsn='mysql:dbname=zootickoonmission6;host=localhost';
      $user='root';
      $pwd='';

      try {
          $dbh=new PDO($dsn,$user,$pwd,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
      } catch(PDOException $e) {
          echo 'Connexion échouée : '.$e->getMessage();
      }

      if (isset($_POST['submit'])) {
        $email=$_POST['email'];
        $password=$_POST['password']; 
                
        $sql="SELECT * FROM user WHERE email=:email AND password=:password";
        $stmt=$dbh->prepare($sql);

        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->bindParam(':password',$password,PDO::PARAM_STR);

        $stmt->execute();

        $users=$stmt->fetch();

        if ($users) { ?>
            <div class="alert alert-success m-auto mt-5 p-5 w-75 text-center" role="alert"> <?php
            echo "Connection Success <br>"; ?> 
            <a href="http://localhost/ZooTickoon/Mission7/index.html"> Home </a>
            </div> <?php
        } else { ?>
            <div class="alert alert-danger m-auto mt-5 p-5 w-75 text-center" role="alert"> <?php
            echo "ERROR! <br>Verify your e-mail or password <br>"; ?> 
            <a href="http://localhost/ZooTickoon/Mission7/authentification.html"> Back to login </a>
            </div> <?php
        }
    }
    ?>
  </body>
</html>
