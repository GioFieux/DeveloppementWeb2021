<?php
$dsn='mysql:dbname=zootickoonmission6;host=localhost';
$user='root';
$pwd='';

try {
    $dbh=new PDO($dsn,$user,$pwd,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch(PDOException $e) {
    echo 'Connexion échouée : '.$e->getMessage();
}

if (isset($_POST['update'])) {
    $id=$_POST['id'];
    $login = $_POST['login'];
    $pwd = $_POST['password'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $zooSector = $_POST['zooSector'];
    $priorityLevel = $_POST['priorityLevel'];

    $sql = "UPDATE ticket SET login=:login, pwd=:pwd, subject=:subject, description=:description, status=:status, zooSector=:zooSector, priorityLevel=:priorityLevel WHERE id=:id";

    $query=$dbh->prepare($sql);
    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->bindParam(':login',$login,PDO::PARAM_STR);
    $query->bindParam(':pwd',$pwd,PDO::PARAM_STR);
    $query->bindParam(':subject',$subject,PDO::PARAM_STR);
    $query->bindParam(':description',$description,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->bindParam(':zooSector',$zooSector,PDO::PARAM_STR);
    $query->bindParam(':priorityLevel',$priorityLevel,PDO::PARAM_STR);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
    <head>
        <title>Ticket Data Updated</title>
    </head>
    <body>

        <div class="alert alert-success m-auto mt-5 p-5 w-25" role="alert">
        <?php
            if ($query->execute()) {
                echo "<p style='text-align: center'>Data successfully updated</p><br><p style='text-align: center'><a href='http://localhost/ajaxDropDownList.php'>Refresh</a></p>";
            } else { 
                echo "<p style='text-align: center'>No update</p>";
            }
        }
        ?>
        </div>
    </body>
</html>