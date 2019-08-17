<?php
require_once ("assets/layouts/header.php");
require_once("assets/session.php");
?>
<div class="col-md-8">
    <h1 class="my-4" style="margin-left:50px; color:#002699;">"Words are free. It's how you use them that may cost you."
        <small style="color:#002699;">-KushandWizdom</small>
    </h1>
</div>
<span style="color: #FF0000; margin-left:55px;"><?php echo sessionMessages(); ?></span>
<form class="form-horizontal" action="login_validation.php"   method="post" style="width:55%; margin-left:55px;">
  <div class="form-group">
    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Log in</button>
    </div>
  </div>
</form>
<br>
<?php
require_once("assets/layouts/footer.php");
?>