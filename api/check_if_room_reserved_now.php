<?php
include "../connect/connect_to_mySQL.php";
include "../response/response.php";

checkRoom($_GET['roomNumber'])?response('reserved',null):response('not reserved',null);

function checkRoom($roomNumber){
    global $connected;
    $result=mysqli_query($connected,"SELECT incomeDate,exitDate FROM reservation where roomNumber=$roomNumber");
    while($row=mysqli_fetch_array($result))
        if(checkIfThisDateIsReservedNowForThisRoom($row[0],$row[1]))return true;
    return false;
}


function checkIfThisDateIsReservedNowForThisRoom($incomeDate,$exitDate){
    $currentDate=new DateTime();
    return (new DateTime($incomeDate)<=$currentDate & new DateTime($exitDate)>=$currentDate);
}