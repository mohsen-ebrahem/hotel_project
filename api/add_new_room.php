<?php
include "../model/room.php";
include "../connect/connect_to_mySQL.php";

$newRoom=new Room(null,$_GET['type'],$connected);


$newRoom->addingToHotel();
?>