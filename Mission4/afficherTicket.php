<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="ticket.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">

    <title>Display Tickets Informations</title>
  </head>
  <body>
    <?php
        $dsn='mysql:dbname=zootickoonmission6;host=localhost';
        $user='root';
        $pwd='';

        try{
            $dbh=new PDO($dsn,$user,$pwd,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch(PDOException $e){
            echo 'Connexion échouée : '.$e->getMessage();
        }

        $id=$_GET['id'];
        $sql="SELECT * FROM ticket WHERE id=$id";
        $statement=$dbh->query($sql) or die(print_r($dbh->errorInfo(), true));

        ?>
        <img src="images/LOGO_DinoWorld.png" class="logo">
        <h1 class="name">DinoWorld</h1>
        <h2 class="pageName">Ticket form page</h2>
        <br>
        <?php
        foreach ($statement->fetchAll(PDO::FETCH_OBJ) as $row) {
        ?>
            <form action="modifierTicket.php" method="POST" class="ticket">
                <fieldset class="m-auto p-2">

                <div class="form-group w-25">
                    <input type="text" class="input-group-text rounded-pill justify-content-center" id="id", name="id" value="<?php echo $row->id; ?>" readonly="true">
                </div>
                
                <div class="form-group m-auto p-2">
                    <label for="Login">Email address</label>
                    <input type="email" class="form-control rounded-pill" id="Login" name="Login" value="<?php echo $row->login; ?>"> 
                </div>

                <div class="form-group m-auto p-2">
                    <label for="Password">Password</label>
                    <input type="password" class="form-control rounded-pill" id=Password name="Password" value="<?php echo $row->pwd; ?>">
                </div>

                <div class="form-group m-auto p-2">
                    <label for="Subject">Subject</label>
                    <input type="text" class="form-control rounded-pill" id="Subject" name="Subject" value="<?php echo $row->subject; ?>">
                </div>

                <div class="form-group m-auto p-2">
                    <label for="Description">Description</label>
                    <textarea class="form-control" id="Description" name="Description"><?php echo $row->description; ?></textarea> 
                </div>

                <?php
                    $selectedStatus = $row->status;
                    $optionsStatus = array('FINISHED', 'IN PROGRESS', 'TO DO');
                ?>
                <div class="input-group mb-3">
                    <div class="input-group-prepend ml-1 p-2 w-50">
                        <label class="input-group-text rounded-pill justify-content-center" for="Status">Status</label>
                    </div>
                        <select class="custom-select rounded-pill m-auto p-2" id="Status" name="Status">
                            <?php 
                                foreach($optionsStatus as $optionStatus){
                                    if($selectedStatus==$optionStatus){
                                        echo "<option selected value='$optionStatus'>$optionStatus</option>";
                                    } else {
                                        echo "<option value='$optionStatus'>$optionStatus</option>";
                                    }
                                }
                            ?>
                        </select>
                </div>
                
                <?php 
                    $selectedZooSector = $row->zooSector; 
                    $optionsZooSector = array('CARNIVOROUS', 'HERBIVOROUS', 'AQUATIC', 'FLYING');
                ?>
                <div class="input-group mb-3 text-center">
                    <div class="input-group-prepend ml-1 p-2 w-50">
                        <label class="input-group-text rounded-pill justify-content-center" for="ZooSector">Zoo Sector</label>
                    </div>
                        <select class="custom-select rounded-pill m-auto p-2" id="ZooSector" name="ZooSector">
                            <?php 
                                foreach($optionsZooSector as $optionZooSector){
                                    if($selectedZooSector==$optionZooSector){
                                        echo "<option selected value='$optionZooSector'>$optionZooSector</option>";
                                    } else {
                                        echo "<option value='$optionZooSector'>$optionZooSector</option>";
                                    }
                                }
                            ?>
                        </select>
                </div>

                <?php 
                    $selectedPrioLevel = $row->priorityLevel; 
                    $optionsPrioLevel = array('HIGH', 'MEDIUM', 'LOW');
                ?>
                <div class="input-group mb-3 text-center">
                    <div class="input-group-prepend ml-1 p-2 w-50">
                        <label class="input-group-text rounded-pill justify-content-center" for="PriorityLevel">Zoo Sector</label>
                    </div>
                        <select class="custom-select rounded-pill m-auto p-2" id="PriorityLevel" name="PriorityLevel">
                            <?php 
                                foreach($optionsPrioLevel as $optionPrioLevel){
                                    if($selectedPrioLevel==$optionPrioLevel){
                                        echo "<option selected value='$optionPrioLevel'>$optionPrioLevel</option>";
                                    } else {
                                        echo "<option value='$optionPrioLevel'>$optionPrioLevel</option>";
                                    }
                                } 
                            ?>
                        </select>
                </div>
                <?php } ?>

                <div class="text-center m-2">
                    <button type="submit" name="update" class="btn btn-light rounded-pill">Modify Ticket</button>
                </div>

                </fieldset>
            </form>
        <?php 
            $statement->closeCursor();
        ?>
    </body>
</html>