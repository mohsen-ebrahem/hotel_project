<?php
class RequiredReservationsController{
    public $connection;
    public $requiredRoomType;
    public $requiredRoomIncomeDate;
    public $requiredRoomExitDate;
    public function __construct($connection,$requiredRoomType,$requiredRoomIncomeDate,$requiredRoomExitDate){
        $this->connection=$connection;
        $this->requiredRoomType=$requiredRoomType;
        $this->requiredRoomIncomeDate=$requiredRoomIncomeDate;
        $this->requiredRoomExitDate=$requiredRoomExitDate;
    }


    
public function checkIfThisRoomAvailable(){
    $result=mysqli_query($this->connection,"SELECT roomNumber FROM room where roomType=$this->requiredRoomType");
    while($row=mysqli_fetch_array($result,MYSQLI_BOTH)){
      if(($availableRoomNumber=$this->checkIfThisRoomCanBeReserved($row[0]))>=0)return $availableRoomNumber;
      else continue;
    }
    return -1;
  }
  
  
  
  private function checkIfThisRoomCanBeReserved($roomNumber){
    $result=mysqli_query($this->connection,"SELECT * FROM reservation WHERE roomNumber=$roomNumber");
    if(mysqli_num_rows($result)==0)return $roomNumber;
    else return $this->checkIfThisReservedRoomDateContainRequiredDate($result,$roomNumber);
  }
  
  
  
  private function checkIfThisReservedRoomDateContainRequiredDate($result,$roomNumber){
    $thisRoomCanBeReserved=true;
    while($res=mysqli_fetch_array($result))
      $thisRoomCanBeReserved=$thisRoomCanBeReserved & $this->checkIfThisDateConflictWithRequiredDate($res['incomeDate'],$res['exitDate']);
    if($thisRoomCanBeReserved)return $roomNumber;
    else return -1;
  }
  
  
  
  
  private function checkIfThisDateConflictWithRequiredDate($in ,$ex){
     return (! ($this->requiredRoomIncomeDate >= new DateTime($in) & $this->requiredRoomIncomeDate<= new DateTime($ex)) )
     & ! ($this->requiredRoomExitDate >= new DateTime($in) & $this->requiredRoomExitDate <=new DateTime($ex))
       & !($this->requiredRoomExitDate  >new DateTime($ex) & $this->requiredRoomIncomeDate <new DateTime($in));  
  }
}