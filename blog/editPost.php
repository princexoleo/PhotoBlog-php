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
            
            if($resultPosts == false) { 
                trigger_error("Query result returns -1");
            }else{
                $dataPosts=mysqli_fetch_assoc($resultPosts);
            }
             
            $result2 = $post->getPostInfo($dataPosts["ID"]);
            $data2=mysqli_fetch_assoc($result2);
            
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
            <form class="form-horizontal" action="editPo.php" method="post" enctype="multipart/form-data" style="width:55%; margin:20px auto;">
            <input type="number" name="id" value="<?php echo $dataPosts["ID"]; ?>" style="display:none;">
             <div class="form-group">
                <label for="PostTitle" class="control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" placeholder="Post Title" value="<?php echo $dataPosts["Title"] ;?>">
                </div>
              </div>
              <div class="form-group">
                <label for="PostBody" class="control-label">Post</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="3" name="post" placeholder="Post Body" value="<?php echo $data2["Post"] ;?>"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="PostImage" class="control-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" name="image" value="<?php echo $data2["Image"] ;?>">
                </div>
              </div>
              <div class="form-group">
                <label for="PostCategory" class="control-label">Category</label>
                <div class="col-sm-10">
                 <?php 
                    $c = $data2["Category"];
                    if($c == "entertainment"){
                        ?>
                        <select class="form-control" name="category">
                         <option value="entertainment" selected>Entertainment</option>
                         <option value="science">Science</option>
                         <option value="sports">Sports</option>
                         <option value="others">Others</option>
                    </select>
                    <?php }
                    else if($c == "science"){
                        ?>
                        <select class="form-control" name="category">
                         <option value="entertainment">Entertainment</option>
                         <option value="science" selected>Science</option>
                         <option value="sports">Sports</option>
                         <option value="others">Others</option>
                    </select>
                    <?php }
                     else if($c == "sports"){
                        ?>
                        <select class="form-control" name="category">
                         <option value="entertainment">Entertainment</option>
                         <option value="science">Science</option>
                         <option value="sports" selected>Sports</option>
                         <option value="others">Others</option>
                    </select> 
                    <?php }
                    else if($c == "others"){
                        ?>
                        <select class="form-control" name="category">
                         <option value="entertainment">Entertainment</option>
                         <option value="science">Science</option>
                         <option value="sports">Sports</option>
                         <option value="others" selected>Others</option>
                    </select> 
                    <?php } ?>
                  
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary" name="submit">Edit Post</button>
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