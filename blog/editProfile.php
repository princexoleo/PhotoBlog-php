<?php
require_once ("assets/layouts/header.php");
require_once("assets/db_connection.php");
require_once("assets/functions.php");
require_once ("assets/classes/user.php");

$user=new user($connection);
if(!isset($_GET["user"])){
    $resultInfo=$user->getUserInfo($_SESSION["id"]);
}else{
    $resultInfo=$user->getUserInfo($_GET["user"]);
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
            }else{
                $display = "display: none;";
                $displaymsg = "display: inline;";
                $displayedit = "display: none;";
            }
            
            ?>
          <h1 class="my-4" style="text-transform: capitalize; color:#002699;"><?php echo $dataInfo["Fname"]." ".$dataInfo["Lname"];?>
             <a href="sendMsg.php" style="text-decoration: none; color:#002699;<?php echo $displaymsg; ?>">
                 <i class="fa fa-envelope" aria-hidden="true" title="Send Message"></i></a>
          </h1>
          
          <!-- edit form -->
          <div class="card mb-4">
            <span style="color: #FF0000; margin-left:55px;"><?php echo sessionMessages(); ?></span>
            <form class="form-horizontal" action="editPro.php" method="post" style="width:55%; margin:20px auto;">
             <div class="form-group">
               <input type="number" style="display:none;" name="id" value="<?php echo $dataInfo["ID"];?>">
                <label for="inputFname" class="control-label">First Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo $dataInfo["Fname"]; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputLname" class="control-label">Last Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo $dataInfo["Lname"]; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $dataInfo["Email"];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword" class="control-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="password" placeholder="Password" value="" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary" name="submit">Save Edits</button>
                </div>
              </div>
            </form>
          </div>
          
        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
         <!-- Side Widget -->
          <div class="card my-4">
           
            <h5 class="card-header" style="text-transform: capitalize;"><?php echo "about ".$dataInfo["Fname"];?>
            
            <a href="deleteProfile.php" style="text-decoration: none; float:right;<?php echo $display; ?>"><i class="fa fa-trash fa-fw fa-lg" title="Delete Profile"></i></a>
            <a href="editProfile.php" style="text-decoration: none; float:right;<?php echo $display; ?>"><i class="fa fa-cog fa-fw fa-lg" title="Edit Profile"></i></a>
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