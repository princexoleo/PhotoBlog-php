<?php
require_once("session.php");

function redirect_to ($newLocation){
    header ("Location: ". $newLocation);
    exit;
}

function isLoggedIn()
{
    if(isset($_SESSION["id"])&&!empty($_SESSION["id"]))
    {
        return true;
    }
    else return false;

}

?>