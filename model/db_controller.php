<?php
class dbController{
    private $server;
    private $name;
    private $passWord;
    private $connectedToServer;
    public function __construct($server ,$name ,$passWord){
       $this->server=$server;
       $this->name=$name;
       $this->passWord=$passWord;
    }
    public function getConnection(){
        $this->connectedToServer=new mysqli($this->server,$this->name,$this->passWord);
        if(!$this->connectedToServer){
            die('Could not connect: ' . mysqli_error($this->connectedToServer));
        }
        else return $this->connectedToServer;
    }
}
?>