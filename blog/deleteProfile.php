<?php
require_once("assets/functions.php");
require_once("assets/classes/user.php");
require_once("assets/db_connection.php");
require_once("assets/session.php");

if (!isset($_SESSION["id"]))
{
    redirect_to("login.php");

}else{
    $user = new user($connection);
    $result  =$user->deleteUser($_SESSION["id"]);
    if ($result == 1) {
        $_SESSION["id"]=NULL;
        redirect_to("index.php");
        }

    else {
        $_SESSION['message']="There was an error in deleting your account!";
        redirect_to("profile.php?user={$_SESSION['id']}");
    }
}