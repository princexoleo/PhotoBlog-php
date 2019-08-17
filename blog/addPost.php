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
        
          <!-- add form -->
          <span style="color: #FF0000; margin-left:55px;"><?php echo sessionMessages(); ?></span>
          <div class="card mb-4">
            <form class="form-horizontal" action="addpo.php" method="post" enctype="multipart/form-data" style="width:55%; margin:20px auto;">
            <input type="number" name="user_id" value="<?php echo $_SESSION["id"]?>" style="display:none;">
             <div class="form-group">
                <label for="PostTitle" class="control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" placeholder="Post Title" value="" required>
                </div>
              </div>
              <div class="form-group">
                <label for="PostBody" class="control-label">Post</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="3" name="post" placeholder="Post Body" value="" required></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="PostImage" class="control-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" name="image" value="">
                </div>
              </div>
              <div class="form-group">
                <label for="PostCategory" class="control-label">Category</label>
                <div class="col-sm-10">
                  <select class="form-control" name="category" required>
                         <option value="entertainment">Entertainment</option>
                         <option value="science">Science</option>
                         <option value="sports">Sports</option>
                         <option value="others" selected>Others</option>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PostPlace" class="control-label">Place</label>
                <div class="col-sm-10">
                  <select class="form-control" name="place" required>
                         <option value="dhaka">Dhaka</option>
                         <option value="khulna">Khulna</option>
                         <option value="mymensingh">Mymensingh</option>
                         <option value="others" selected>Others</option>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary" name="submit">Add Post</button>
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
            require_once("assets/layouts/places.php");
         ?>
        </div>

      </div>

    </div>

<?php
//require_once("assets/layouts/footer.php");
?>
<script>
    $(document).on('change',':text,textarea', function () {
		if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
			this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
		}
	});
</script>