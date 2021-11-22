<?php

class Reservation{
    public $reservationNumber;
    public $reservedRoomNumber;
    public $guestNumber;
    public $reservationCost;
    public $roomType;
    public $incomeDate;
    public $exitDate;
    private $connection;
    public function __construct($reservationNumber,$reservedRoomNumber,$guestNumber,$reservationCost,$roomType,$incomeDate,$exitDate,$connection){
        $this->reservationNumber=$reservationNumber;
        $this->reservedRoomNumber=$reservedRoomNumber;
        $this->guestNumber=$guestNumber;
        $this->reservationCost=$reservationCost;
        $this->roomType=$roomType;
        $this->incomeDate=$incomeDate;
        $this->exitDate=$exitDate;
        $this->connection=$connection;
    }
    public function addingToHotel(){
            mysqli_query($this->connection,"INSERT INTO reservation(guestNumber,roomNumber,incomeDate,exitDate,reservationCost)VALUES($this->guestNumber,$this->reservedRoomNumber
            ,'$this->incomeDate','$this->exitDate',$this->reservationCost)");
    }

    public function deleteReservation(){

        $result=mysqli_query($this->connection,"DELETE FROM reservation WHERE guestNumber=$this->guestNumber");
    }
    public function updateReservation(){
        mysqli_query($this->connection,"UPDATE reservation SET guestNumber=$this->guestNumber,roomNumber=$this->reservedRoomNumber,reservationCost=$this->reservationCost, incomeDate=$this->incomeDate,exitDate=$this->exitDate WHERE roomNumber=$this->reservedRoomNumber");  
    }
    public  function updateRoomState($newState){
        $stmt= mysqli_prepare($this->connection,"update room SET roomState=? where (room.roomNumber=$this->reservedRoomNumber)");
        $stmt->bind_param('s',$newState);
        $stmt->execute();
    }
}