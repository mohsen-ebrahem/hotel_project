<?php

include "../connect/connect_to_mySQL.php";
include "../response/response.php";

response('all rooms',giveMeAllRoom($connected));

function giveMeAllRoom($connected){
    $result=mysqli_query($connected,'SELECT * FROM room');
    while($row=mysqli_fetch_array($result,MYSQLI_BOTH)){
        $room=[
            'roomNumber'=>$row[0],
            'roomType'=>$row[1]
        ];
      $rooms[]=$room;
    }
    return $rooms;
}
?>