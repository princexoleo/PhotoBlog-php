<?php
require_once ("assets/layouts/header.php");
require_once("assets/db_connection.php");
require_once("assets/functions.php");
require_once ("assets/classes/user.php");
require_once ("assets/classes/post.php");

$user=new user($connection);
$resultInfoFrom=$user->getUserInfo($_SESSION["id"]);
$resultInfoTo=$user->getUserInfo($_GET["user_id"]);
$dataInfoFrom=mysqli_fetch_assoc($resultInfoFrom);
$dataInfoTo=mysqli_fetch_assoc($resultInfoTo);
?>
          
          
    <div class="container">
      <div class="row">
        <div class="col-md-8">
<br>
          <!-- Message -->
          <div class="card mb-4">
            <div class="card-body">
             <span style="color: #FF0000; margin-left:55px;"><?php echo sessionMessages(); ?></span>
            <form class="form-horizontal" action="msg.php"   method="post" style="width:60%; margin-left:55px;">
             <label for="msginfo" class="control-label">Message'll be sent from <span style="text-transform: capitalize; color:#002699;"><?php echo $dataInfoFrom["Fname"]." ".$dataInfoFrom["Lname"]; ?></span> to <span style="text-transform: capitalize; color:#002699;"><?php echo $dataInfoTo["Fname"]." ".$dataInfoTo["Lname"]; ?></span></label>
              <div class="form-group">
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="from" value="<?php echo $dataInfoFrom["ID"]; ?>" style="display:none;">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="to" value="<?php echo $dataInfoTo["ID"]; ?>" style="display:none;">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="control-label">Message body:</label>
                <div class="col-sm-12">
                 <textarea class="form-control" rows="5" name="msg" placeholder="Put your message here" cols="12"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary" name="submit">Send Message</button>
                </div>
              </div>
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
         ?>
        </div>
        </div>

    </div>
       <?php
require_once("assets/layouts/footer.php");
?>