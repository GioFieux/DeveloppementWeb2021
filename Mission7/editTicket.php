<?php include 'connect.php';

if($_POST["sql"] != '') {
    $search_array = explode(",", $_POST["sql"]);
    $search_id = "'" . implode("', '", $search_array) . "'";
    $sql = "SELECT * FROM ticket WHERE id IN (".$search_id.") ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM ticket ORDER BY id ASC";
}

$statement = $dbh->prepare($sql);
$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();
$output = '';

if($total_row > 0) {
    foreach($result as $row) {
        $output .= '
        <tr>
            <td>'.$row["id"].'</td>
            <td>'.$row["login"].'</td>
            <td>'.$row["pwd"].'</td>
            <td>'.$row["subject"].'</td>
            <td>'.$row["description"].'</td>
            <td>'.$row["status"].'</td>
            <td>'.$row["zooSector"].'</td>
            <td>'.$row["priorityLevel"].'</td>
            <td><div class="text-center m-2">
                    <a href="http://localhost/ZooTickoon/Mission7/afficherTicket.php?id='.$row["id"].'"><button type="button" class="btn btn-dark rounded-pill edit" id="'.$row["id"].'" name="edit" class="btn btn-light rounded-pill">Edit</button></a>
                </div> </td>
        </tr>';
    }
} else {
    $output .= '
    <tr>
        <td colspan="8" align="center">No Data Found</td>
    </tr>';
}

echo $output;
?>

<script>
$(document).ready(function() {
    $(".edit").click(function(e) {
        e.preventDefault();
        $("#arrow").show();
        $("#result").show();
        var id = $(this).attr('id');
        $.ajax({
            url: "afficherTicket.php",
            type: "POST",
            data: {
                id: id,
            },
            success: function(response) {
                $("#result").html(response);
            }
        });
    });
});
</script>