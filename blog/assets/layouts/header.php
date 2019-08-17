<?php
require_once("assets/session.php");
require_once("assets/functions.php");
$user="";
if(isLoggedIn())
    $user=$_SESSION["id"];

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="blog website">

    <title>Dear Diary</title>

    <!-- Bootstrap CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- font-awesome -->
    <link rel="stylesheet" href="css/css/font-awesome.min.css">

    <!-- Custom styles -->
    <link href="css/blog-home.css" rel="stylesheet">
    <link href="css/blog-post.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Tourist Review Guide</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home
              </a>
            </li>
            <?php
                $parameter="Log in";
                $page ="login.php";
                $pro = "Sign up";
                $pro_page = "signup.php";
                if(isLoggedIn())
				        {
                    $parameter="Log out";
				            $page ="logout.php";
                    $pro = "Profile";
                    $pro_page = "profile.php";
				        }
	         ?>
           <li class="nav-item">
              <a class="nav-link" href="<?php echo $pro_page; ?>"><?php echo $pro;?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $page; ?>"><?php echo $parameter;?></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    