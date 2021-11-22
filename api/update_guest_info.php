<?php
include "../model/guest.php";
include "../paths/path.php";

$newGuest=new Guest($_GET['guestNumber'],$_GET['firstName'],$_GET['lastName'],$_GET['phoneNumber'],$_GET['nationality'],null,$connected);

if(checkNumOfRow(mysqli_fetch_row(mysqli_query($connected,"SELECT * from guest WHERE guestNumber=$newGuest->guestNumber")))>0){
    $newGuest->updateGuestInfo();
    response('updated',null);
}
else response('NotFound',null);

?>