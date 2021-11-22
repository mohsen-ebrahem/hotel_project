<?php
include "../model/reservation.php";
include "../paths/path.php";

$newReservation =new Reservation(null,null,$_GET['guestNumber'],null,null,null,null,$connected);

if(checkNumOfRow(mysqli_fetch_row(mysqli_query($connected,"SELECT * from reservation WHERE guestNumber=$newReservation->guestNumber")))>0){
    $newReservation->deleteReservation();
    response('deleted',null);
}

else response('NotFound',null);

?>