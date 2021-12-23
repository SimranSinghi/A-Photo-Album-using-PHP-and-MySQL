<?php
session_start();
require_once('connectionpdo.php');
 
if(isset($_POST['submit']))
{
    if(isset($_POST['username'],$_POST['password'],$_POST['fullname'],$_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['fullname']) && !empty($_POST['email']))
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $fullname = trim($_POST['fullname']);
        $email = trim($_POST['email']);
        
        $password = md5($password);
 
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
            $sql = 'select * from users where email = :email';
            $stmt = $dbh->prepare($sql);
            $p = ['email'=>$email];
            $stmt->execute($p);
            
            if($stmt->rowCount() == 0)
            {

                //images/(username) directory is created in the  database.
                $directory = "images/".$username;
                mkdir($directory);
                $sql = "insert into users (username, password, fullname, email, image_dir) values(:uname,:pass,:fname,:email, :image_dir)";
            
                try{
                    $handle = $dbh->prepare($sql);
                    $params = [
                        ':uname'=>$username,
                        ':pass'=>$password,
                        ':fname'=>$fullname,
                        ':email'=>$email,
                        ':image_dir'=>$directory
                    ];
                    
                    $handle->execute($params);

                    $success = 'User has been created successfully';

                    

                    
                }
                catch(PDOException $e){
                    $errors[] = $e->getMessage();
                }
            }
            else
            {
                $valusername = $username;
                $valPassword = $password;
                $valfullname = $fullname;
                $valEmail = '';
                
 
                $errors[] = 'Email address already registered';
            }
        }
        else
        {
            $errors[] = "Email address is not valid";
        }
    }
    else
    {
        if(!isset($_POST['username']) || empty($_POST['username']))
        {
            $errors[] = 'username is required';
        }
        else
        {
            $valusername = $_POST['username'];
        }
        if(!isset($_POST['password']) || empty($_POST['password']))
        {
            $errors[] = 'Password is required';
        }
        else
        {
            $valPassword = $_POST['password'];
        }
        if(!isset($_POST['full_name']) || empty($_POST['full_name']))
        {
            $errors[] = 'Full name is required';
        }
        else
        {
            $valfullname = $_POST['full_name'];
        }
 
        if(!isset($_POST['email']) || empty($_POST['email']))
        {
            $errors[] = 'Email is required';
        }
        else
        {
            $valEmail = $_POST['email'];
        }
 
        
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
		<div class="col-md-5 mt-3 pt-2 pb-5 align-self-center border bg-light">
			<h1 class="mx-auto w-25" >Register</h1>
			<?php 
				if(isset($errors) && count($errors) > 0)
				{
					foreach($errors as $error_msg)
					{
						echo '<div class="alert alert-danger">'.$error_msg.'</div>';
					}
                }
                
                if(isset($success))
                {
                    
                    echo '<div class="alert alert-success">'.$success.'</div>';
                }
			?>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="form-group">
					<label for="email">Username:</label>
					<input type="text" name="username" placeholder="Enter  username" class="form-control" value="<?php echo ($valusername??'')?>">
				</div>
                <div class="form-group">
				<label for="email">Password:</label>
					<input type="password" name="password" placeholder="Enter Password" class="form-control" value="<?php echo ($valPassword??'')?>">
				</div>
                <div class="form-group">
					<label for="email">Full Name</label>
					<input type="text" name="fullname" placeholder="Enter You Fullname" class="form-control" value="<?php echo ($valfullname??'')?>">
				</div>
 
                <div class="form-group">
					<label for="email">Email:</label>
					<input type="text" name="email" placeholder="Enter Email" class="form-control" value="<?php echo ($valEmail??'')?>">
				</div>
				
 
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				<p class="pt-2"> Back to <a href="login.php">Login</a></p>
				
			</form>
		</div>
	</div>
</div>
</body>
</html>