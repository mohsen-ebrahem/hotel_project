<?php
include "../model/room.php";
include "../paths/path.php";

$newRoom=new Room($_GET['roomNumber'],null,$connected);

if(checkNumOfRow(mysqli_fetch_row(mysqli_query($connected,"SELECT * from room WHERE roomNumber=$newRoom->roomNumber")))>0)
    response('room',$newRoom->readRoomInfo());
else response('NotFound',null);
?>