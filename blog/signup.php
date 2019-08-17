<?php
require_once ("assets/layouts/header.php");
require_once("assets/db_connection.php");
require_once("assets/session.php");
require_once("assets/functions.php");
require_once("assets/classes/user.php");

// define variables and set to empty values
$fnameErr = $lnameErr = $emailErr = $passwordErr = "";
$fname = $lname = $email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  if (empty($_POST["fname"])) {
    $fnameErr = "First Name is required";
  } else {
    $fname = test_input($_POST["fname"]);
      // check if name only contains letters
      if (!preg_match("/^[a-zA-Z]+$/",$fname)) {
          $fnameErr = "Only letters allowed"; 
      }
  }

  if (empty($_POST["lname"])) {
    $lnameErr = "Last Name is required";
  } else {
    $lname = test_input($_POST["lname"]);
      // check if name only contains letters
      if (!preg_match("/^[a-zA-Z]+$/",$lname)) {
        $lnameErr = "Only letters allowed"; 
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
      // check if a combination of uppercase, lowercase and numbers used.
      if (!preg_match("/^[a-zA-Z0-9]+$/",$password)) {
          $passwordErr ="Password can contains only uppercase, lowercase and numbers."; 
      }
  }
    
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(!empty($_POST["fname"]) && !empty($_POST["lname"]) && !empty($_POST["email"]) && !empty($_POST["password"])){
    $obj= new user($connection);
    //check if user already exist
    $query1 = "SELECT * FROM user Where Email= '$email'";
    $result1 = mysqli_query($connection, $query1);
    $count = mysqli_fetch_assoc($result1);
    if((int)$count !=0){
        $_SESSION["message"]="This Email is already used.";
    }else{ //create new user in database
        $query2 = "INSERT INTO user (Fname , Lname ,Password , Email) ".
            "VALUES ('$fname' , '$lname' , '$password' , '$email')";
        $result2 = mysqli_query($connection, $query2);
        $id= $obj->getIdByEmail($email);
        $_SESSION["id"]=$id;
        redirect_to("index.php");
    }
}


?>

<br>
<p><span style="color: #FF0000; margin-left:55px;">* required field.</span></p>
<span style="color: #FF0000; margin-left:55px;"><?php echo sessionMessages(); ?></span>
<form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="width:55%; margin-left:55px;">
 <div class="form-group">
    <label for="inputFname" class="col-sm-2 control-label">First Name</label>
    <span style="color: #FF0000;">* <?php echo $fnameErr;?></span>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo $fname;?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputLname" class="col-sm-2 control-label">Last Name</label>
    <span style="color: #FF0000;">* <?php echo $lnameErr;?></span>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo $lname;?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
    <span style="color: #FF0000;">* <?php echo $emailErr;?></span>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email;?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
    <span style="color: #FF0000;">* <?php echo $passwordErr;?></span>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Sign Up</button>
    </div>
  </div>
</form>
<br>
<?php
require_once("assets/layouts/footer.php");
?>