<?php
include "../model/room.php";
include "../model/guest.php";
include "../connect/connect_to_mySQL.php";


$newGuest=new Guest(null,$_GET['firstName'],$_GET['lastName'],$_GET['phoneNumber'],$_GET['nationality'],$_GET['guestRoomNumber'],$connected);

$newGuest->addingToHotel($connected,$newGuest);
?>