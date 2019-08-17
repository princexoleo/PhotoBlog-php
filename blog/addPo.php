<?php
require_once ("assets/layouts/header.php");
require_once("assets/db_connection.php");
require_once("assets/functions.php");
require_once("assets/validation_functions.php");
require_once ("assets/classes/post.php");

if(!$_POST["submit"])
{
      //image handeling/validation 
	if(isset($_FILES["image"])){
	  $image_name = $_FILES["image"]["name"];
	  $image_tmp = $_FILES["image"]["tmp_name"];
	  $image_size = $_FILES["image"]["size"];
      $image_type = $_FILES["image"]["type"];
      $image_error = $_FILES["image"]["error"];
      $image_extension = explode('.',$image_name);    
      $image_actual_extension = strtolower(end($image_extension));
      $allawed = array('jpg','png','jpeg');    
      if(in_array($image_actual_extension,$allawed)){
          if($image_error === 0){
              $image_new_name = uniqid('',true).".".$image_actual_extension;
              $image_des = 'images/'.$image_new_name;
              move_uploaded_file($image_tmp,$image_des);
              //redirect_to("index.php");
              $post= new post($connection);
              $result = $post->addPost($_POST["title"],$image_des,$_POST["post"],$_POST["category"],$_POST["place"],$_POST["user_id"]);
                if($result == -1)
                {
                    $_SESSION["message"] = "Error in database";
                    redirect_to("addPost.php");


                }
                if($result == 1)
                {
                    $_SESSION["message"]= "Post has been added successfuly.";
                    redirect_to("addPost.php");
                }
              
          }else{
              $_SESSION["message"] = "there was an error uploading your image";
              redirect_to("addPost.php");
          }
          
      }else{
          $_SESSION["message"] = "you can't upload images of this type!";
          redirect_to("addPost.php");
      }

}
}
else{
    redirect_to("addPost.php");
}

?>