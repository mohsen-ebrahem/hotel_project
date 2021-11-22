<?php

class Guest{
    public $guestNumber;
    public $firstName;
    public $lastName;
    public $phoneNumber=array();
    public $nationality=array();
    public $guestRoomNumber;
    private $connection;
    public function __construct($guestNumber,$firstName,$lastName,$phoneNumber,$nationality,$guestRoomNumber,$connection){
        $this->guestNumber=$guestNumber;
        $this->firstName=$firstName;
        $this->lastName=$lastName;
        $this->phoneNumber=$phoneNumber;
        $this->nationality=$nationality;
        $this->guestRoomNumber=$guestRoomNumber;
        $this->connection=$connection;
    }


public function addingToHotel(){
    mysqli_query($this->connection,"INSERT INTO guest(firstName,lastName,guestRoomNumber) VALUES($this->firstName,$this->lastName,$this->guestRoomNumber)");
    $this->guestNumber= mysqli_insert_id($this->connection);
    $this->addGuestPhoneNumbers();
    $this->addGuestNationality();
  }
  
private function addGuestPhoneNumbers(){
   $stmt= mysqli_prepare($this->connection,"INSERT INTO phone(phoneNumber,phoneNumberOwner) VALUES(?,?)");
   foreach($this->phoneNumber as $phone){
       $stmt->bind_param("si",$phone,$this->guestNumber);
       $stmt->execute();
   }
}

private function addGuestNationality(){
    $stmt= mysqli_prepare($this->connection,"INSERT INTO nationality(nationality,nationalityOwner) VALUES(?,?)");
    foreach($this->nationality as $national){
        $stmt->bind_param("si",$national,$this->guestNumber);
        $stmt->execute();
    }
   }
public function deleteGuestFromHotel(){
    mysqli_query($this->connection,"DELETE FROM phone where phoneNumberOwner=$this->guestNumber");
    mysqli_query($this->connection,"DELETE FROM nationality where nationalityOwner=$this->guestNumber");
    mysqli_query($this->connection,"DELETE FROM guest where guestNumber=$this->guestNumber");
}
public function updateGuestInfo(){
    mysqli_query($this->connection,"UPDATE guest SET firstName=$this->firstName,lastName=$this->lastName WHERE
     $this->guestNumber =guestNumber");
     mysqli_query($this->connection,"DELETE  FROM nationality WHERE nationalityOwner= $this->guestNumber");
     $this->addGuestNationality();
    mysqli_query($this->connection,"DELETE  FROM phone WHERE phoneNumberOwner= $this->guestNumber");
    $this->addGuestPhoneNumbers();
}
public function readGuestInfo(){
    $stmt="SELECT  * from guest WHERE guestNumber=$this->guestNumber ";
$result=mysqli_query($this->connection,$stmt);
$guest=mysqli_fetch_row($result);
$guestInfo=[
    'guestNumber'=>$guest[0],
    'firstName'=>$guest[1],
    'lastName'=>$guest[2],
    'guestRoomNumber'=>$guest[3],
    'phones'=>$this->readGuestPhone(),
    'nationality'=>$this->readGuestNationality()
];

return $guestInfo;
}
private function readGuestPhone(){
    $result=mysqli_query($this->connection,"SELECT PhoneNumber from phone WHERE phoneNumberOwner=$this->guestNumber");
    $phones=[];
    while($phone=mysqli_fetch_array($result)){
        $phones[]=$phone[0];
    }
    return $phones;
}
private function readGuestNationality(){
    $result=mysqli_query($this->connection,"SELECT nationality from nationality WHERE nationalityOwner=$this->guestNumber");
    $nationals=[];
    while($national=mysqli_fetch_array($result)){
        $nationals[]=$national[0];
    }
    return $nationals;
}
}
?>