<?php
include "../model/guest.php";
include "../connect/connect_to_mySQL.php";
include "../response/response.php";


response('all guests',giveMeAllGuests());

function giveMeAllGuests(){
    global $connected;
    $result=mysqli_query($connected,'SELECT * FROM guest');

    while($row=mysqli_fetch_array($result,MYSQLI_BOTH)){
        $guest=[
            'guestNumber'=>$row['guestNumber'],
            'firstName'=>$row['firstName'],
            'lastName'=>$row['lastName'],
            'guestRoomNumber'=>$row['guestRoomNumber']
        ];
        $guests[]=$guest;
    }
    return $guests;
}
?>