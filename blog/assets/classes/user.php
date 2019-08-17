<?php

class user
{
    
 private $connection;
    function __construct ($c){
        $this->connection=$c;
    }

    public function addUser($Fname ,$Lname ,$Password ,$Email)
    {
        //escape strings to insert safely in database
        $fn=mysqli_real_escape_string($this->connection ,$Fname);
        $ln=mysqli_real_escape_string($this->connection ,$Lname);
        $p=mysqli_real_escape_string($this->connection, $Password);
        $e =mysqli_real_escape_string($this->connection , $Email);

        $query = "INSERT INTO user (Fname , Lname ,Password , Email) ".
            "VALUES ('{$fn}' , '{$ln}' , '{$p}' , '{$e}')";

        $result = mysqli_query($this->connection , $query);
        if($result){
            //success
           return 1;
        }else {
            //failure , message= subject creatin failed;
            return -1;
        }
    }
    
    public function getUserByEmail($Email){
        $query = "SELECT * FROM user Where Email= {$Email}";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ //to test if there's a query error or not that the database didn't find a match for the required
           return -1;
        }
        else{
            return mysqli_fetch_assoc($result);
        }
    }
    
   public function getUserID($password,$email)
    {
        $p=mysqli_real_escape_string($this->connection ,$password);
        $e=mysqli_real_escape_string($this->connection,$email);
        $query="SELECT ID FROM user WHERE Password='{$p}' and Email='{$e}'";
        $result=mysqli_query($this->connection,$query);
        if(!$result){
            return -1;
        }
        else{  
                if(mysqli_num_rows($result) == 1){
                    $res=mysqli_fetch_assoc($result);
                    $id=(int)$res["ID"];
                    mysqli_free_result($result);
                    return $id;
                }
                else return -2;

            }
    }
    
    public function getIdByEmail($email)
    {
        $query="select ID from user where Email= '{$email}' ";
        $result=mysqli_query($this->connection , $query);
        if(!$result){
            return -1;
        }
        else{
            $res=mysqli_fetch_assoc($result);
            $id=(int)$res["ID"];
            mysqli_free_result($result);
            return $id;
        }

    }
    
    public function getUserInfo($id){
        $query="select * from user where ID= '{$id}' ";
        $result=mysqli_query($this->connection , $query);
        if(!$result){
            return -1;
        }
        else{
            return $result;
        }
    }
    
    public function deleteUser($id)
    {
        $query="DELETE FROM user WHERE ID = {$id} ";
        $result=mysqli_query($this->connection , $query);
        if(!$result){
            return -1;
        }
        else return 1;
    }
    
    public function updateUser($id, $fname, $lname, $email, $password){
        
        $fn=mysqli_real_escape_string($this->connection ,$fname);
        $ln=mysqli_real_escape_string($this->connection ,$lname);
        $p=mysqli_real_escape_string($this->connection, $password);
        $e =mysqli_real_escape_string($this->connection , $email);
        
        $query="UPDATE user SET Fname='$fname' ,Lname='$lname' ,Email='$email', Password='$password' WHERE ID='$id' ";
        $result=mysqli_query($this->connection , $query);
        if(!$result){
            return -1;
        }
        else return 1;
    }
    
    ///////////Messages////////////
    public function sendMsg($msg,$from,$to){
        
        //escape strings to insert safely in database
        $m=mysqli_real_escape_string($this->connection ,$msg);
        $f=mysqli_real_escape_string($this->connection ,$from);
        $t=mysqli_real_escape_string($this->connection, $to);
        $date = new DateTime();
        
        $query = "INSERT INTO messages (Msg , Date_Time , Sender_ID , Receiver_ID) ".
            "VALUES ('{$m}' , '{$date->format("Y-m-d H:i:s")}' , '{$f}' , '{$t}')";

        $result = mysqli_query($this->connection , $query);
        if($result){
            //success
           return 1;
        }else {
            //failure , message= subject creatin failed;
            return -1;
        }
    }
    
    public function Inbox($user_id) {
	
	$sql = "select * from messages where Receiver_ID='$user_id' ORDER BY Date_time DESC";
	$result = mysqli_query($this->connection , $sql);
        
	 if($result){
            //success
           return $result;
        }else {
            //failure , message= subject creatin failed;
            return -1;
        }

    }

}