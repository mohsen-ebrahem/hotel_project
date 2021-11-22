<?php
include "../model/reservation.php";
include "../paths/path.php";
$newReservation=new Reservation($_GET['reservationNumber'],$_GET['reservedRoomNumber'],$_GET['guestNumber'],$_GET['cost'],$_GET['roomType'],$_GET['incomeDate'],$_GET['exitDate'],$connected);

 if(checkNumOfRow(mysqli_fetch_row(mysqli_query($connected,"SELECT * from reservation WHERE reservationNumber=$newReservation->reservationNumber")))>0){
    $newReservation->updateReservation();
    response('updated',null);
}
else response('NotFound',null);
?>