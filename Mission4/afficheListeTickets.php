<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
    <title>Display Tickets Informations</title>
  </head>
  <body>
    <?php
        $dsn='mysql:dbname=zootickoonmission6;host=localhost';
        $user='root';
        $pwd='';

        try{
            $dbh=new PDO($dsn,$user,$pwd);
        } catch(PDOException $e){
            echo 'Connexion échouée : '.$e->getMessage();
        }
        $sql="SELECT * FROM ticket";
        $statement=$dbh->query($sql) or die(print_r($dbh->errorInfo(), true));
        /*
        foreach ($statement->fetchAll(PDO::FETCH_OBJ) as $ligne){
            echo 'Login : '.$ligne->login.'<br/>';
            echo 'Password : '.$ligne->pwd.'<br/>';
            echo 'Subject : '.$ligne->subject.'<br/>';
            echo 'Description : '.$ligne->description.'<br/>';
            echo 'Status : '.$ligne->status.'<br/>';
            echo 'Zoo Sector : '.$ligne->zooSector.'<br/>';
            echo 'Priority Level : '.$ligne->priorityLevel.'<br/> <br/>';
        }
        */
    ?> 
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Password</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Status</th>
                <th>Zoo Sector</th>
                <th>Priority Level</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($statement->fetchAll(PDO::FETCH_OBJ) as $ligne){
            ?>
            <tr>
                <td><?php echo '<a href="http://localhost/ZooTickoon/Mission4/afficherTicket.php?id='.$ligne->id.'">'.$ligne->id. '</a><br/>'; ?></td>
                <td><?php echo $ligne->login.'<br/>'; ?></td>
                <td><?php echo $ligne->pwd.'<br/>'; ?></td>
                <td><?php echo $ligne->subject.'<br/>'; ?></td>
                <td><?php echo $ligne->description.'<br/>'; ?></td>
                <td><?php echo $ligne->status.'<br/>'; ?></td>
                <td><?php echo $ligne->zooSector.'<br/>'; ?></td>
                <td><?php echo $ligne->priorityLevel.'<br/>'; }?></td>
            </tr>
        </tbody>
    </table>
        <?php $statement->closeCursor(); ?>
  </body>
</html>
