<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
if(!isset($_SESSION['system'])){
    $system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
    foreach($system as $k => $v){
        $_SESSION['system'][$k] = $v;
    }
}
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $_SESSION['system']['name'] ?></title>
  <?php include('./header.php'); ?>
  <?php 
  if(isset($_SESSION['login_id']))
    header("location:index.php?page=home");
  ?>
</head>
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bg-image {
  /* The image used */
  background-image: url('assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>');
  /* Full height */
  height: 100%; 
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.login-container {
  position: relative;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.login-form {
  background-color: rgba(255, 255, 255, 0.9);
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  width: 300px; /* Adjust as needed */
}

.logo {
  margin: auto;
  width: 100px; /* Set the width of the square logo */
  height: 100px; /* Set the height of the square logo */
  border-radius: 10px; /* Adjust the border radius as needed */
  margin-bottom: 20px; /* Add some margin below the logo */
}

</style>
<body>

  <div class="bg-image">
    <div class="login-container">
      <div class="login-form">
        <!-- Square Logo -->
        <img src="assets/img/logo.jpg" class="logo" alt="Logo">
        <form id="login-form">
          <p class="text-center">Welcome to Event Management System!</p>
          <div class="form-group">
            <label for="username" class="control-label">Username</label>
            <input type="text" id="username" name="username" class="form-control">
          </div>
          <div class="form-group">
            <label for="password" class="control-label">Password</label>
            <input type="password" id="password" name="password" class="form-control">
          </div>
          <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
        </form>
      </div>
    </div>
  </div>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

</body>
<script>
$('#login-form').submit(function(e){
  e.preventDefault()
  $('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
  if($(this).find('.alert-danger').length > 0 )
    $(this).find('.alert-danger').remove();
  $.ajax({
    url:'ajax.php?action=login',
    method:'POST',
    data:$(this).serialize(),
    error:err=>{
      console.log(err)
      $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
    },
    success:function(resp){
      if(resp == 1){
        location.href ='index.php?page=home';
      }else if(resp == 2){
        location.href ='voting.php';
      }else{
        $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
        $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
      }
    }
  })
})
</script> 
</html>
