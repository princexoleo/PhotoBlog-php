<?php
require_once("assets/functions.php");

if(isLoggedIn())
{
    $_SESSION["id"]="";
    redirect_to("index.php");
}
else
{
    redirect_to("index.php");
}

?>