<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: cart_view.php');
  }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page" dir="rtl">
<div class="login-box">
  	<?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
      if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-success text-center'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
  	<div class="login-box-body">
    	<p class="login-box-msg">قم بتسجيل الدخول لتبدء التسوق</p>

    	<form action="verify.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="البريد الالكترونى" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="كلمة السر" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-4" style="float: right;">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="login">دخول  <i class="fa fa-sign-in"></i></button>
        		</div>
      		</div>
    	</form>
      <br>
      <a href="password_forgot.php">نسيت كلمة السر</a><br>
      <a href="signup-ar.php" class="text-center">سجل عضو جديد</a><br>
      <a href="index.php"><i class="fa fa-home"></i> الرئيسية</a>
  	</div>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>