<?php
include "../model/room.php";
include "../paths/path.php";

$newRoom=new Room($_GET['roomNumber'],$_GET['roomType'],$connected);
if(checkNumOfRow(mysqli_fetch_row(mysqli_query($connected,"SELECT * from room WHERE roomNumber=$newRoom->roomNumber")))>0){
    $newRoom->updateRoomInfo();
    response('updated',null);
}
else response('NotFound',null);
?>