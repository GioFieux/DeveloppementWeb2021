<?php include 'connect.php';
$sql = "SELECT * FROM ticket";
$result = $dbh->query($sql);

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
?>
        <tr>
            <td><?=$row["id"]?></td>
            <td><?=$row["login"]?></td>
            <td><?=$row["pwd"]?></td>
            <td><?=$row["subject"]?></td>
            <td><?=$row["description"]?></td>
            <td><?=$row["status"]?></td>
            <td><?=$row["zooSector"]?></td>
            <td><?=$row["priorityLevel"]?></td>
            <td><div class="text-center m-2">
                <button type="button" id="edit" name="edit" class="btn btn-light rounded-pill" 
                data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#update_ticket"
			    data-id="<?=$row['id'];?>"
                data-login="<?=$row['login'];?>"
                data-password="<?=$row['password'];?>"
                data-subject="<?=$row['subject'];?>"
                data-description="<?=$row['description'];?>"
                data-status="<?=$row['status'];?>"
                data-zooSector="<?=$row['zooSector'];?>"
                data-priorityLevel="<?=$row['priorityLevel'];?>">
                Edit</button></div></td>
        </tr>
<?php
    }
} else {
    echo    "<tr>
                <td colspan='8'> No resut found </td>
            </tr>";
}
$result->closeCursor();
?>