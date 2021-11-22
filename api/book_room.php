<?php
include "../model/reservation.php";
include "../model/required_reservations_controller.php";
include "../model/room.php";
include "../model/guest.php";
include "../connect/connect_to_mySQL.php";


$requiredReservation=new RequiredReservationsController($connected,$_GET['roomType'],new DateTime($_GET['incomeDate']),new DateTime($_GET['exitDate']));

if(($availableRoomNumber= $requiredReservation->checkIfThisRoomAvailable())>=0){
    $newGuest=new Guest(null,$_GET['firstName'],$_GET['lastName'],$_GET['phoneNumbers'],$_GET['nationality'],$availableRoomNumber,$connected);
    $newGuest->addingToHotel();   
    $newReservation=new Reservation(null,$availableRoomNumber,$newGuest->guestNumber,$_GET['cost'],$_GET['roomType'],$_GET['incomeDate'],$_GET['exitDate'],$connected);
   $newReservation->addingToHotel(); 
}
else print 'this room isnot availabe in this date';

?>