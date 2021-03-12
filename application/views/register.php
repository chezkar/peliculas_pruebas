
<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration form using codeigniter 3</title>
	<!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>

<style>

body{
	background:#d9edf7;
}
.custom-bottom-margin{
	padding-bottom:30px;
}

.error-msg{
	margin:5px auto;
	width:30%;
	background:#db3737;
	color:#ffffff;
}
</style>
<body >
	
<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<h2>Registration Form</h2>
		</div>
	</div>
	
	<div class="row">
		
			<?php 
				echo validation_errors(); 
				
				if(isset($errorMsg))
				{
					echo '<div class="error-msg">';
					echo $errorMsg;
					echo '</div>';
					unset($errorMsg);
				}
			?>
			
			<?php echo form_open('user/RegisterUser'); ?>
				<div class="form-group custom-bottom-margin">
					<label class="control-label col-sm-4 text-right" for="name">First Name</label>
					<div class="col-sm-5">
					  <input type="text" name="first_name" class="form-control" value="<?php echo set_value('first_name'); ?>" placeholder="Enter First name" id="fname">
					</div>
				</div>
				<div class="form-group custom-bottom-margin">
					<label class="control-label col-sm-4 text-right" for="name">Last Name</label>
					<div class="col-sm-5">
					  <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Enter Last name" id="lname">
					</div>
				</div>
				<div class="form-group custom-bottom-margin">
					<label class="control-label col-sm-4 text-right" for="email">Email</label>
					<div class="col-sm-5">
					  <input type="email" name="email" class="form-control" value="<?php echo set_value('email');?>" placeholder="Enter email" id="email">
					</div>
				</div>
				<div class="form-group custom-bottom-margin">
					<label class="control-label col-sm-4 text-right" for="confirm_email">Confirm Email</label>
					<div class="col-sm-5">
					  <input type="text"  name="confirm_email" class="form-control" value="<?php echo set_value('confirm_email');?>" placeholder="Confirm email" id="confirm_email">
					</div>
				</div>
				
				<div class="form-group custom-bottom-margin">
					<label class="control-label col-sm-4 text-right" for="password">Password</label>
					<div class="col-sm-5">
					  <input type="password" name="password" class="form-control" value="<?php echo set_value('password');?>" placeholder="Enter password" id="password">
					</div>
				</div>
				
				<div class="form-group custom-bottom-margin">
					<label class="control-label col-sm-4 text-right" for="phone">Phone</label>
					<div class="col-sm-5">
					  <input type="text" name="phone" class="form-control" value="<?php echo set_value('phone');?>" placeholder="Enter phone" id="phone">
					</div>
				</div>
				
				<div class="form-group custom-bottom-margin">
					<label class="control-label col-sm-4 text-right"></label>
					<div class="col-sm-5">
                      <button class="btn btn-primary" type="submit"> Submit</button>
                      <a class="btn btn-success" href="<?php echo base_url()."index.php/login/LoginUser"?>">Login</a>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>	

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

	
</body>

</html>
