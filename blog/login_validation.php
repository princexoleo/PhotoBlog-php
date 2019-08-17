<?php
require_once("assets/validation_functions.php");
require_once("assets/functions.php");
require_once("assets/db_connection.php");
require_once("assets/classes/user.php");
require_once("assets/session.php");

if(!empty($_POST["email"]) && !empty($_POST["password"]))
{
   if(!validateEmail($_POST["email"]) || !validatePassword($_POST["password"]))
   {
         $_SESSION["message"]= "Your Email or Password is invalid.";
         redirect_to("login.php");

   }
   else
   {
   	    $obj= new user($connection);
   	    $result=$obj->getUserId($_POST["password"],$_POST["email"]);
   	    if($result==-1)
   	    {
			$_SESSION['message']="There was an error in connection";
   	    	redirect_to("login.php");


   	    }
   	    if($result == -2)
   	    {
   	    	$_SESSION['message']="E-mail and password don't match.";
   	    	redirect_to("login.php");
   	    }
   	    else
   	    {    
            $_SESSION["id"]=$result;
            redirect_to("profile.php?user=".$result);
            //redirect_to("index.php");
   	    }

   }

}
else{
    $_SESSION['message']="Both Email and Password are required.";
    redirect_to("login.php");
}


?>