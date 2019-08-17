<?php
require_once ("assets/layouts/header.php");
require_once("assets/db_connection.php");
require_once("assets/functions.php");
require_once ("assets/classes/post.php");

if(!$_POST["submit"])
{
 
   	    $post=new post($connection);
   	    $result=$post->Rate($_POST["rater_id"],$_POST["post_id"],$_POST["rate"]);
   	    if($result == -1)
   	    {
			$_SESSION['message']="There was an error in connection"." ".$_POST["rater_id"]." ".$_POST["post_id"]." ".$_POST["rate"];
   	    	redirect_to("post.php?id=".$_POST["post_id"]);


   	    }
         else if($result == 1)
   	    {
   	    	$_SESSION['message']="Post rated successfuly.";
   	    	redirect_to("post.php?id=".$_POST["post_id"]);
   	    }
        
     else if($result == 0)
   	    {
   	    	$_SESSION['message']="You already rated this post before.";
   	    	redirect_to("post.php?id=".$_POST["post_id"]);
   	    }
}
else{
    redirect_to("post.php?id=".$_POST["post_id"]);
}

?>