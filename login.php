<?php 
session_start();
require("connectionpdo.php");
?>
<?php
$msg = " "; 
if(isset($_POST['submitBtnLogin'])) {
  $username = trim($_POST['username']);
  $password = md5($_POST['password']);
  $_SESSION['username']=$username;
  if($username != "" && $password != "") {
    try {
      $query = "select * from `users` where `username`=:username and `password`=:password";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam('username', $username, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
      
        $_SESSION['sess_user_name'] = $row['username'];
        header('location:album.php?username='.$username);
        exit();
       
       
      } else {
        $msg = "Invalid username and password! Please Register to Login.";
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
    $msg = "Both fields are required!";
  }
}
?>

 
<!doctype html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 
</head>
<body class="bg-dark">
 
<div class="container h-100">
	<div class="row h-100 mt-5 justify-content-center align-items-center">
		<div class="col-md-5 mt-5 pt-2 pb-5 align-self-center border bg-light">
			<h1 class="mx-auto w-25" >Login</h1>
			<?php 
				if(isset($errors) && count($errors) > 0)
				{
					foreach($errors as $error_msg)
					{
						echo '<div class="alert alert-danger">'.$error_msg.'</div>';
					}
				}
			?>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="text" name="username" id="username" value="" placeholder="Enter Username" class="form-control">
				</div>
				<div class="form-group">
				<label for="password">Password:</label>
					<input type="password" name="password" id="password" value="" placeholder="Enter Password" class="form-control">
				</div>
 
				<button type="submit" name="submitBtnLogin" id="submitBtnLogin" value="Login" class="btn btn-primary">Submit</button>
				
				<a href="register.php" class="btn btn-primary">Register</a>

                <span class="loginMsg"><?php echo @$msg;?></span>
			</form>
		</div>
	</div>
</div>
</body>
</html>

