<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
    <title>Verification</title>
  </head>
  <body>
    <?php session_start();
      date_default_timezone_set('Europe/Paris');
      $utilisateurs = ["test@gmail.com","test1234","Lina@gmail.com","passeLina","Edgar@gmail.com","passeEdgar","Flo@gmail.com","passeFlo","Gio@gmail.com","passeGio"];
      $len = count($utilisateurs);
      $key_mail = 0;
      $key_pwd = 0;
      $session = $_POST['Email'];
      /*
      if (isset($_POST['Email']) && isset($_POST['Password'])) {
        echo "Email : ".$_POST['Email']."<br> Password : ".$_POST['Password']."<br>";
      } else {
        echo "Wrong Mail or Password ! <br>";
      }

      for ($i=0; $i<$len; $i++) {
        if ($utilisateurs[$i]==$_POST['Email']) {
          $key_mail = 1;
          echo "Mail : OK <br/>";
        }
      }

      for ($i=0; $i<$len; $i++) {
        if ($utilisateurs[$i]==$_POST['Password']) {
          $key_pwd = 1;
          echo "Password : OK <br/>";
        }
      }

      if ( ($key_mail==1) && ($key_pwd==1) ) {
        echo "Le couple existe <br/> Connected as ".$session."<br/>";
      } else {
        echo "Le coupe n'existe pas <br/> Not connected <br/>";
        ?>
        <div class="alert alert-danger w-25" role="alert">
          <?php
            if ($key_mail!=1) {
              echo "Mail : NOT OK <br/>";
            }

            if ($key_pwd!=1) {
              echo "Password : NOT OK <br/>";
            }
          ?> 

        </div> 
        <?php
      } */

      $auth = new class {};
      $auth->log=[['mail' => "test@gmail.com", 'pwd'=>"test1234"],
                  ['mail'=>"Lina@gmail.com", 'pwd'=>"passeLina"],
                  ['mail'=>"Edgar@gmail.com", 'pwd'=>"passeEdgar"],
                  ['mail'=>"Flo@gmail.com", 'pwd'=>"passeFlo"],
                  ['mail'=>"Gio@gmail.com", 'pwd'=>"passeGio"]
                ];
      $utilisateurs = file_put_contents("login.json", json_encode($auth));
      $verifUsers = file_get_contents("login.json");

      $json_data = json_decode($verifUsers);

      //var_dump($json_data);
      $size = count($json_data->{'log'});

      if (isset($_POST['Email']) && isset($_POST['Password'])) {
        echo "Email : ".$_POST['Email']."<br> Password : ".$_POST['Password']."<br>";
      } else {
        echo "Wrong Mail or Password ! <br>";
      }

      for ($i=0; $i<$size; $i++) {
        $mail = $json_data->{'log'}[$i]->{'mail'};
        if ( $mail==$_POST['Email'] ) {
          $key_mail = 1;
        }
      }

      for ($i=0; $i<$size; $i++) {
        $pwd = $json_data->{'log'}[$i]->{'pwd'};
        if ( $pwd==$_POST['Password'] ) {
          $key_pwd = 1;
        }
      }

      if ( $key_mail!=1 || $key_pwd!=1) {
        echo "Le couple n'existe pas <br/> Not connected";
        ?>
        <div class="alert alert-danger w-25" role="alert">
          <?php
            echo "Potential error : <br/>Mail : NOT OK <br/>Or <br/>Password : NOT OK";
          ?>
        </div>
      <?php
      }
      
      if ( $key_mail==1 && $key_pwd==1 ) {
        echo "Le couple existe <br/> Connected as ".$session."<br/>";
        ?>
        <div class="alert alert-success w-25" role="alert">
          <?php
            echo "Mail : OK <br/>Password : OK";
          ?>
        </div>
        <?php
      }

      function addLogin ($utilisateurs) {
        $time = date("D d M Y H:i:s");
        file_put_contents("long.log", $_POST['Email']." ", FILE_APPEND);
        file_put_contents("long.log", " ".$_POST['Password']." ", FILE_APPEND);
        file_put_contents("long.log", " ".$time."\n", FILE_APPEND);
      }
      if ( ($key_mail==1) && ($key_pwd==1) ) {
        addLogin($utilisateurs);
      }
    ?>
  </body>
</html>
