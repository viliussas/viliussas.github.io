<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css"/>
</head>

<body>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Login</h3>
				</div>
				<div class="panel-body">
					<?php
					$success_msg= $this->session->flashdata('success_msg');
					$error_msg= $this->session->flashdata('error_msg');
					if($success_msg){
						?>
						<div class="alert alert-success">
							<?php echo $success_msg; ?>
						</div>
						<?php
					}
					if($error_msg){
						?>
						<div class="alert alert-danger">
							<?php echo $error_msg; ?>
						</div>
						<?php
					}
					?>

					<form role="form" method="post" action="<?php echo base_url('Login/login_user'); ?>">
						<fieldset>
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input class="form-control" placeholder="User Name" name="User_name" type="text" autofocus required>
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input class="form-control" placeholder="Password" name="Password" type="password" required>
							</div>
							<input class="btn btn-lg btn-success btn-block" type="submit" value="Login" name="Login">
						</fieldset>
					</form>

                </div>
            </div>
		</div>
	</div>
</div>

</body>

</html>
