<?php
require_once ("assets/layouts/header.php");
require_once("assets/db_connection.php");
require_once("assets/functions.php");
require_once ("assets/classes/post.php");

if(!empty($_POST["category"]) && !empty($_POST["title"]))
{
 
   	    $post=new post($connection);
   	    $result=$post->SearchPost($_POST["category"],$_POST["title"]);
        $res=mysqli_fetch_assoc($result);
   	    if($res == -1)
   	    {
			//echo "There was an error in connection";
   	    	redirect_to("index.php");


   	    }
         else if($res == 0)
   	    {
   	    	//echo "No results founded!";
   	    	redirect_to("index.php");
   	    }
        else{    
            redirect_to("post.php?id=".$res["ID"]);
   	    }

}
else{
    redirect_to("index.php");
}

?>