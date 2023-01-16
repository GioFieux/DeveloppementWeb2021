<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="afficherTicket.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">

    <title>Display Tickets Informations</title>
  </head>
  <body>
    <?php
        include 'connect.php';
        
        $id=$_POST['id'];
        $sql="SELECT * FROM ticket WHERE id=$id";
        $statement=$dbh->query($sql);

        foreach ($statement->fetchAll(PDO::FETCH_OBJ) as $row) {
        ?>
            <form action="modifierTicket.php" method="POST" class="ticket">
                <fieldset class="m-auto p-2">

                <div class="form-group w-25">
                    <input type="text" class="input-group-text rounded-pill justify-content-center" id="id", name="id" value="<?php echo $row->id; ?>" readonly="true">
                </div>
                
                <div class="form-group m-auto p-2">
                    <label for="login">Email address</label>
                    <input type="email" class="form-control rounded-pill" id="login" name="login" value="<?php echo $row->login; ?>"> 
                </div>

                <div class="form-group m-auto p-2">
                    <label for="password">Password</label>
                    <input type="password" class="form-control rounded-pill" id=password name="password" value="<?php echo $row->pwd; ?>">
                </div>

                <div class="form-group m-auto p-2">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control rounded-pill" id="subject" name="subject" value="<?php echo $row->subject; ?>">
                </div>

                <div class="form-group m-auto p-2">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"><?php echo $row->description; ?></textarea> 
                </div>

                <?php
                    $selectedStatus = $row->status;
                    $optionsStatus = array('FINISHED', 'IN PROGRESS', 'TO DO');
                ?>
                <div class="input-group mb-3">
                    <div class="input-group-prepend ml-1 p-2 w-50">
                        <label class="input-group-text rounded-pill justify-content-center" for="Status">Status</label>
                    </div>
                        <select class="custom-select rounded-pill m-auto p-2" id="status" name="status">
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
                        <select class="custom-select rounded-pill m-auto p-2" id="zooSector" name="zooSector">
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
                        <select class="custom-select rounded-pill m-auto p-2" id="priorityLevel" name="priorityLevel">
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
                    <button type="submit" id="update" class="btn btn-light rounded-pill" name="update">Update</button>
                </div>

                <div id="result" class="form-group m-auto p-2"></div>

                </fieldset>
            </form>

        <?php 
            $statement->closeCursor();
        ?>
    </body>
</html>

<script>
$(document).ready(function(){
    $("#update").click(function(e) {
        $("#arrow").hide();
        e.preventDefault();
        var id = $("#id").val();
        var login = $("#login").val();
        var password = $("#password").val();
        var subject = $("#subject").val();
        var description = $("#description").val();
        var status = $("#status").val();
        var zooSector = $("#zooSector").val();
        var priorityLevel = $("#priorityLevel").val();
        $.ajax({
            url: "modifierTicket.php",
            method: "POST",
            data: {
                update: 'update',
                id: id,
                login: login,
                password: password,
                subject: subject,
                description: description,
                status: status,
                zooSector: zooSector,
                priorityLevel: priorityLevel
            },
            success: function(response) {
                $("#result").html(response);
            }
        });
    });
});
</script>