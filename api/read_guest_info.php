<?php
include "../model/guest.php";
include "../paths/path.php";

$newGuest=new Guest($_GET['guestNumber'],null,null,null,null,null,$connected);

if(checkNumOfRow(mysqli_fetch_row(mysqli_query($connected,"SELECT * from guest WHERE guestNumber=$newGuest->guestNumber")))>0)
    response('guest',$newGuest->readGuestInfo());
else response('NotFound',null);

?>