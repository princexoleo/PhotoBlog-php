<?php
require_once ("assets/layouts/header.php");
require_once("assets/db_connection.php");
require_once("assets/functions.php");
require_once ("assets/classes/post.php");

if(!$_POST["submit"])
{
 
   	    $post=new post($connection);
   	    $result=$post->DeletePost($_POST["id"]);
   	    if($result == -1)
   	    {
			//echo "There was an error in connection";
   	    	redirect_to("post.php?id=".$_POST["id"]);

   	    }
         else if($result == 1)
   	    {
   	    	redirect_to("index.php");
   	    }

}
else{
    redirect_to("post.php?id=".$_POST["id"]);
}

?>