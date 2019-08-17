<?php
require_once ("assets/layouts/header.php");
require_once("assets/db_connection.php");
require_once("assets/functions.php");
require_once ("assets/classes/user.php");
require_once ("assets/classes/post.php");

$user=new user($connection);
$resultInfo=$user->getUserInfo($_SESSION["id"]);
$dataInfo=mysqli_fetch_assoc($resultInfo);
$msgInfo = $user->Inbox($_SESSION["id"]);
$msgData=mysqli_fetch_assoc($msgInfo);
$senderInfo=$user->getUserInfo($msgData["Sender_ID"]);
$senderData=mysqli_fetch_assoc($senderInfo);
?>
          
          
    <div class="container">
      <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
          
           <h1 class="mt-4"style="text-transform: capitalize; color:#002699;">Inbox</h1>
          <br>
          
          <!-- message -->
          <div class="card mb-4">
            <div class="card-body">
              <h2 class="card-title" style="text-decoration: none; color:#000;"><?php echo $senderData["Fname"]." ".$senderData["Lname"]; ?>
              <?php $msgto = "sendMsg.php?user_id=".$senderData["ID"]; ?>
              <a href="<?php echo $msgto;?>" style="text-decoration: none; color:#002699;<?php echo $displaymsg; ?>">
                 <i class="fa fa-envelope" aria-hidden="true" title="Send Message"></i></a>
              </h2>
              <p class="lead"><?php echo $msgData["Date_Time"];?></p>
              <p><?php echo $msgData["Msg"];?></p>
            </div>
          </div>
        </div>
        
         <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
         <!-- Side Widget -->
          <div class="card my-4">
           
            <h5 class="card-header" style="text-transform: capitalize;"><?php echo "about ".$dataInfo["Fname"];?>
            
            <a href="deleteProfile.php" style="text-decoration: none; float:right;<?php echo $display; ?>"><i class="fa fa-trash fa-fw fa-lg" title="Delete Profile"></i></a>
            <a href="editProfile.php" style="text-decoration: none; float:right;<?php echo $display; ?>"><i class="fa fa-cog fa-fw fa-lg" title="Edit Profile"></i></a>
            <a href="<?php echo $inbox; ?>" style="text-decoration: none; float:right;<?php echo $display; ?>"><i class="fa fa-envelope fa-fw fa-lg" title="Inbox"></i></a>
            <a href="addPost.php" style="text-decoration: none; float:right;<?php echo $display; ?>"><i class="fa fa-plus fa-lg" aria-hidden="true" title="Add Post"></i></a>
            
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
require_once("assets/layouts/footer.php");
?>