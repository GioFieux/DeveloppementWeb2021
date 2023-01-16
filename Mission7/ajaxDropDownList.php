<?php include 'connect.php';

$sql="SELECT id FROM ticket ORDER BY id ASC";
$statement=$dbh->prepare($sql);
$statement->execute();

$result = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="ajaxDropDownList.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="ajaxDropDownList.css">
        <title>Drop Down Ticket List</title>
    </head>
    <body>
    <div class="header">
        <a href="http://localhost/ZooTickoon/Mission7/index.html"><img src="images/LOGO_DinoWorld.png" class="logo"></a>
        <h1 class="name">DinoWorld</h1>
        <h2 class="pageName">Ticket List</h2>
    </div>
    <br/>
    <div class="ticketOptions">
        <p> <a href="http://localhost/ZooTickoon/Mission7/formTicket.html"> Create New Ticket </a> </p>
    </div>
    <br>
    <div class="container">
        <select name="search" id="search" class="form-control selectpicker">
            <option value="" selected>All tickets</option>
        <?php
        foreach($result as $row) {
            echo '<option value="'.$row["id"].'">'.$row["id"].'</option>';}
        ?>
        </select>
        <input type="hidden" name="hidden_ticket" id="hidden_ticket"/>
        <div style="clear:both"></div>
        <br/>
            
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
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
                </tbody>
            </table>
    </div> <br>
    <div id="arrow">
        <p style="text-align: center">Edit your ticket<br>|<br>v</p>
    </div> <br>

    <div id="result" class="form-group m-auto p-2"></div>
    
    </body>
</html>

<script>
$(document).ready(function(){
    $("#arrow").hide();
    load_data();

    function load_data(sql='') {
        $.ajax({
            url: "editTicket.php",
            method: "POST",
            data: {sql: sql},
            success:function(data) {
                $('tbody').html(data);
            }
        })
    }

    $('#search').change(function() {
        $('#hidden_ticket').val($('#search').val());
        var sql = $('#hidden_ticket').val();
        load_data(sql);
    });

    $("select").click(function(e) {
        $("#arrow").hide();
        $("#result").hide();
    });
});
</script>
