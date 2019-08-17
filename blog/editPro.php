<?php
require_once("assets/validation_functions.php");
require_once("assets/functions.php");
require_once("assets/db_connection.php");
require_once("assets/classes/user.php");
require_once("assets/session.php");

if(!$_POST["submit"])
{
    if(!validateEmail($_POST["email"]) || !validatePassword($_POST["password"]) || !validateName($_POST["fname"]) || !validateName($_POST["lname"]))
   {
         $_SESSION["message"]= "Your Name or Email or Password is invalid.";
         redirect_to("editProfile.php");

   }
   else
   {
   	    $obj= new user($connection);
   	    $result=$obj->updateUser($_POST["id"],$_POST["fname"],$_POST["lname"],$_POST["email"],$_POST["password"]);
   	    if($result == -1)
   	    {
			$_SESSION['message']="There was an error in connection";
   	    	redirect_to("editProfile.php");


   	    }
   	    if($result == 1){
            $_SESSION['message'] = "User has been updated succssfuly.";
            redirect_to("editProfile.php");
   	    }

   }
   
}
else{
    redirect_to("editProfile.php");
}


?>