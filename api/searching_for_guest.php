<?php
include "../model/guest.php";

include "../connect/connect_to_mySQL.php";

$requeredGuest=$_GET['name'];


searchingForGuestByName($connected,$requeredGuest);

function searchingForGuestByName($connected ,$name){

$result= mysqli_query($connected,"SELECT * FROM guest");
$requeredGuest=[];

while($row=mysqli_fetch_array($result,MYSQLI_BOTH)){
    if(thisGuestHasThisName($row['firstName'].' '.$row['lastName'],$name))$requeredGuest[]=$row['firstName'].' '.$row['lastName'];
}
$encodedRequeredGuest=json_encode($requeredGuest);
print $encodedRequeredGuest;
}

function thisGuestHasThisName($fullName,$requeredName){
    return substr_count($fullName,$requeredName)>0?true:false;
}

?>