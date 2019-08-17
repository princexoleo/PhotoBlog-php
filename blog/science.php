<?php
require_once ("assets/layouts/header.php");
require_once("assets/db_connection.php");
require_once("assets/functions.php");
require_once ("assets/classes/post.php");
require_once ("assets/classes/user.php");

$post=new post($connection);
$result=$post->getSciencePosts();
$user=new user($connection);
?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
          <br><br>
         
         <?php
            if($result == false) { 
                trigger_error("Query result returns -1");
            }else{
            while ($data=mysqli_fetch_assoc($result)){
        ?>
          <!-- Blog Post -->
          <div class="card mb-4">
            <img class="card-img-top" src="<?php echo $data["Image"]; ?>" alt="Card image cap">
            <div class="card-body">
              <h2 class="card-title"><?php echo ucfirst($data["Title"]); ?></h2>
              <p class="card-text"><?php echo $data["Post"]; ?></p>
               <?php $link = "post.php?id=";?>
              <a href="<?php echo $link.$data["ID"]; ?>" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo $data["Date_Time"]; ?> by
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
                }else{
                    if($_SESSION["id"] == $data["User_ID"]){
                        echo "Me";
                    }else{
                        echo $data2["Fname"]." ".$data2["Lname"]; 
                    }
                }
                  ?></a>
            </div>
          </div>
          <?php } }?>
        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
          <?php
            // Search Widget
             require_once("assets/layouts/search.php");
            // Categories Widget
            require_once("assets/layouts/categories.php");
         ?>
        </div>

      </div>

    </div>

<?php
require_once("assets/layouts/footer.php");
?>