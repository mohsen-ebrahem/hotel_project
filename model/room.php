<?php
class Room{
    public $roomNumber;
    public $type;
    private $connection;


    public function __construct($roomNumber,$type,$connection){
    $this->roomNumber=$roomNumber;
    $this->type=$type;
    $this->connection=$connection;
    }


    public function addingToHotel(){
        mysqli_query($this->connection,"INSERT INTO room(roomType) VALUES($this->type)");
    }
   


    public function deleteFromHotel(){
        mysqli_query($this->connection,"DELETE FROM room WHERE roomNumber =$this->roomNumber");
    }


    public function updateRoomInfo(){
        mysqli_query($this->connection,"UPDATE room SET roomNumber=$this->roomNumber, roomType=$this->type where roomNumber=$this->roomNumber");
    }


    public function readRoomInfo(){
        $result=mysqli_query($this->connection,"SELECT * from room where roomNumber=$this->roomNumber");
        $room=mysqli_fetch_row($result);
        $roomInfo=[
            'roomNumber'=>$room[0],
            'roomType'=>$room[1]
        ];
        return $roomInfo;
    }

    
    }