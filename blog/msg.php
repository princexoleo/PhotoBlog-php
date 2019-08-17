<?php
require_once("assets/functions.php");
require_once("assets/db_connection.php");
require_once("assets/classes/user.php");

if(!$_POST["submit"])
{
    if(empty($_POST["msg"]))
   {
         $_SESSION["message"]= "Please write a message!";
         redirect_to("sendMsg.php?user_id=".$_POST["to"]);

   }
   else
   {
   	    $obj= new user($connection);
   	    $result=$obj->sendMsg($_POST["msg"],$_POST["from"],$_POST["to"]);
   	    if($result == -1)
   	    {
			$_SESSION['message']="There was an error in connection";
   	    	redirect_to("sendMsg.php?user_id=".$_POST["to"]);


   	    }
   	    if($result == 1){
            $_SESSION['message'] = "Message has been sent succssfuly.";
            redirect_to("sendMsg.php?user_id=".$_POST["to"]);
   	    }

   }
   
}
else{
    redirect_to("sendMsg.php?user_id=".$_POST["to"]);
}


?>