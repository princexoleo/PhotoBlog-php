<?php
require_once ("assets/layouts/header.php");
require_once("assets/db_connection.php");
require_once("assets/functions.php");
require_once ("assets/classes/user.php");
require_once ("assets/classes/post.php");

$user=new user($connection);
$post=new post($connection);
if(!isset($_GET["user"])){
    $resultInfo=$user->getUserInfo($_SESSION["id"]);
    $resultPosts=$post->getUserOrderedPosts($_SESSION["id"]);
}else{
    $resultInfo=$user->getUserInfo($_GET["user"]);
    $resultPosts=$post->getUserOrderedPosts($_GET["user"]);
}
?>


<!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
          
        <?php
            if($resultInfo == false) { 
                trigger_error("Query result returns -1");
            } else{ 
                $dataInfo=mysqli_fetch_assoc($resultInfo); }
            
            
            if($_SESSION["id"] == $dataInfo["ID"]){
                $display = "display: inline;";
                $displaymsg = "display: none;";
                $displayedit = "display: inline;";
                $inbox = "inbox.php?id=".$_SESSION["id"];
            }else{
                    if(!isLoggedIn()){
                        $displaymsg = "display: none;";
                        $display = "display: none;";
                        $displayedit = "display: none;";
                    }else{
                        $display = "display: none;";
                        $displaymsg = "display: inline;";
                        $displayedit = "display: none;";
                        $msgto = "sendMsg.php?user_id=".$_GET["user"];
                    }
                    
                }
            
            ?>
          <h1 class="my-4" style="text-transform: capitalize; color:#002699;"><?php echo $dataInfo["Fname"]." ".$dataInfo["Lname"];?>
             <a href="<?php echo $msgto;?>" style="text-decoration: none; color:#002699;<?php echo $displaymsg; ?>">
                 <i class="fa fa-envelope" aria-hidden="true" title="Send Message"></i></a>
          </h1>
          <br><br>
            
                            
         <?php
            if($resultPosts == false) { 
                trigger_error("Query result returns -1");
            }else{
            while ($dataPosts=mysqli_fetch_assoc($resultPosts)){
        ?>
          <!-- Blog Post -->
          <div class="card mb-4">
            <div class="card-body">
             <?php $link = "post.php?id=".$dataPosts["ID"];?>
              <h2 class="card-title"><a href="<?php echo $link; ?>" style="text-decoration: none; color:#000;"><?php echo ucfirst($dataPosts["Title"]); ?></a></h2>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo $dataPosts["Date_Time"]; ?>
            </div>
          </div>
          <?php } } ?>
        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
         <!-- Side Widget -->
          <div class="card my-4">
           
            <h5 class="card-header" style="text-transform: capitalize;">
             <?php echo "about ".$dataInfo["Fname"];?>
              <div class="progress">
             <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 90%" aria-valuenow="100" aria-valuemin="0   " aria-valuemax="100"></div>
               </div>
              
            <br>  
            
            <div class="container" style="margin-top: 10px"> <a href="deleteProfile.php" style="text-decoration: none; float:right;<?php echo $display; ?>"><i class="fa fa-trash fa-fw fa-lg" title="Delete Profile"></i></a>
            <a href="editProfile.php" style="text-decoration: none; float:right;<?php echo $display; ?>"><i class="fa fa-cog fa-fw fa-lg" title="Edit Profile"></i></a>
            <a href="<?php echo $inbox; ?>" style="text-decoration: none; float:right;<?php echo $display; ?>"><i class="fa fa-envelope fa-fw fa-lg" title="Inbox"></i></a>
            <!--Add Post -->
            <a href="addPost.php" style="text-decoration: none; float:right;<?php echo $display; ?>"><i class="fa fa-plus fa-lg" aria-hidden="true" title="Add Post"></i></a></div>
            
            </h5>
           
           
            <div class="card-body">
             <dl>
               <dt>Email</dt>
               <dd><?php echo $dataInfo["Email"];?></dd>
             </dl>
            </div>
          </div>
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
//require_once("assets/layouts/footer.php");
?>