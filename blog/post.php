<?php
require_once ("assets/layouts/header.php");
require_once("assets/db_connection.php");
require_once("assets/functions.php");
require_once ("assets/classes/post.php");
require_once ("assets/classes/user.php");

$post=new post($connection);
$user=new user($connection);
$result=$post->getPostInfo($_GET["id"]);
if($result == false) { 
    trigger_error("Query result returns -1");
}else{
    $data=mysqli_fetch_assoc($result);
}
?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Post Content Column -->
        <div class="col-md-8">
        <br>
        <span style="color: #FF0000; margin-left:55px;"><?php echo sessionMessages(); ?></span>
        <!-- Title -->
          <h1 class="mt-4"><?php echo ucfirst($data["Title"]); ?></h1>

          <!-- Author -->
          <p class="lead">
            by
            <?php 
                $userlink = "profile.php?user=";
                $result2=$user->getUserInfo($data["User_ID"]);
                if($result2 == false) { 
                    trigger_error("Query result2 returns -1");
                } else{ 
                    $data2=mysqli_fetch_assoc($result2); } 
                ?>
              <a href="<?php echo $userlink.$data["User_ID"]; ?>" style="text-transform: capitalize;"><?php 
                if(!isset($_SESSION["id"])){
                    echo $data2["Fname"]." ".$data2["Lname"];
                    $displayedit = "display: none;";
                    $display = "display:block;";
                }
                if($_SESSION["id"] == $data["User_ID"]){
                        echo "Me";
                        $displayedit = "display: inline;";
                        $display = "display:none;";
                    }else{
                        echo $data2["Fname"]." ".$data2["Lname"]; 
                        $displayedit = "display: none;";
                        $display = "display:block;";
                    }
                  ?></a>
                  </p>
                  
                  <p>Rate: <?php echo $data["Total_Rates"];?></p>
                  
                  <form method="post" action="deletePost.php" style="margin-left:20px; float:right;<?php echo $displayedit; ?>">
                     <input type="number" style="display:none;" name="id" value="<?php echo $data["ID"];?>"> 
                      <button type="submit" class="btn btn-primary" name="submit">Delete Post</button>
                  </form>
                 <form method="post" action="editPost.php" style="float:right;<?php echo $displayedit; ?>"> 
                    <input type="number" style="display:none;" value="<?php echo $data["ID"];?>">
                     <input type="number" style="display:none;" name="id" value="<?php echo $data["ID"];?>">
                      <button type="submit" class="btn btn-primary" name="submit">Edit Post</button>
                </form>
          
          <hr>

          <!-- Date/Time -->
          <p><?php echo $data["Date_Time"]; ?></p>
          <hr>
          
          <!-- Preview Image -->
          <img class="img-fluid rounded" src="<?php echo $data["Image"]; ?>" alt="post image">
          <hr>
          
          <!-- Post Content -->
          <!--check link in text-->
          <?php
            // The Regular Expression filter
            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
            // The Text you want to filter for urls
            $text = $data["Post"];
            // Check if there is a url in the text
            if(preg_match($reg_exUrl, $text, $url)) {
                   // make the urls hyper links
                   echo preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow">'.$url[0].'</a>', $text);
            } else {
                   // if no urls in the text just return the text
                   echo $text;
            }
            ?>
      <!--    <p class="lead"><?php // $data["Post"]; ?></p> -->
          <hr>
                <!-- Rate Form -->
          <div class="card my-4" style="<?php echo $display; ?>">
            <h5 class="card-header">Rate This Post</h5>
            <div class="card-body">
              <form method="post" action="rating.php">
              <input type="number" name="post_id" value="<?php echo $data["ID"];?>" style="display:none;">
              <input type="number" name="rater_id" value="<?php echo $_SESSION["id"];?>" style="display:none;">
               <div class="form-group rating">
                    <input type="radio" id="star5" name="rate" value="5" /><label for="star5" title="Excellent">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4" /><label for="star4" title="Pretty good">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3" /><label for="star3" title="Good">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" /><label for="star2" title="Bad">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1" /><label for="star1" title="Very bad">1 star</label>
                </div>    
                <button type="submit" class="btn btn-primary" style="margin-left: 20px; margin-top: 7px;" name="submit">Submit</button>
              </form>
            </div>
          </div>
          

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
          <?php
            // Search Widget
             require_once("assets/layouts/search.php");
            // Categories Widget
            require_once("assets/layouts/categories.php");
            require_once("assets/layouts/places.php");
         ?>
        </div>

      </div>

    </div>

<?php
//require_once("assets/layouts/footer.php");
?>