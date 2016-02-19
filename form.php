<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE-Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--Bootstrap Core-->
	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/bootstrap.min.css">

	<style>
	    .nav{
		   border:1px solid blue;
		}
		.tab-pane{
		   border:1px solid blue;}
	</style>
	<title>Login/Signup System</title>
</head>
<body>
    
    <div class="container">
    	<div class="row">
    		<div class="col-md-6 col-md-offset-3 col-xs-12">
    			<!--Navigation Tabs-->

    			<ul class="nav nav-tabs" role="tablist">
    				<li role="presentation" class="active"><a href="#signup" aria-controls="signup" role="tab" data-toggle="tab">Sign Up</a></li>
    				<li role="presentation"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">Log In</a></li>
    			</ul>

    			<!--Tab Content-->
    			<div class="tab-content">
    				<div role="tabpanel" class="tab-pane fade in active" id="signup">
					<p></p>
    					<form action="register.php" method="post" class="form-horizontal" role="form" id="register-form">
    						<div class="form-group">
    							<label for="Name" class="col-sm-2 control-label">Name</label>
    							<div class="col-sm-9">
    								<input type="text" id="name" name="name" class="form-control" placeholder="Enter your Name" value="" />
    							</div>
    						</div>

    						<div class="form-group">
    							<label for="email" class="col-sm-2 control-label">E-mail</label>
    							<div class="col-sm-9">
    								<input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" value="" />
    							</div>
    						</div>

    						<div class="form-group">
    							<label for="password" class="col-sm-2 control-label">Password</label>
    							<div class="col-sm-9">
    								<input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" value="" />
    							</div>
    						</div>

    						<div class="form-group">
    							<label for="confirm_password" class="col-sm-2 control-label">Confirm Password</label>
    							<div class="col-sm-9">
    								<input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" value="" />
    							</div>
    						</div>

    						<div class="form-group">
							  <div class="col-sm-4 col-sm-offset-2">
    							<input type="submit" id="register-submit" name="register-submit" class="btn btn-register" value="Register" />
							  </div>
    						</div>
    					</form>
    				</div>

    				<div role="tabpanel" class="tab-pane fade" id="login">
					<p></p>
    						<form action="login.php" method="POST" role="form" class="form-horizontal" id="login-form">

    							<div class="form-group">
    								<label for="email" class="col-sm-2 control-label">Email</label>
    								<div class="col-sm-9">
    									<input type="email" name="email" id="user-email" class="form-control" placeholder="Enter Email" value="">
									</div>
    							</div>

    							<div class="form-group">
    								<label for="password" class="col-sm-2 control-label">Password</label>
    								<div class="col-sm-9">
    									<input type="password" name="password" id="user-password" class="form-control" placeholder="Enter Password" value="">
    								</div>
    							</div>

    							<div class="form-group">
                                    <div class="checkbox col-sm-5 col-sm-offset-2">
                                        <label class="checkbox">
                                        <input type="checkbox" name="approve" value="" checked>
                                            Remember me
                                        </label>
                                    </div>
                                </div>

    							<div class="form-group">
								  <div class="col-sm-4 col-sm-offset-2">
    								<button type="submit" id="login-submit" name="login-submit" class="btn btn-login">Log In</button>
								  </div>
    							</div>
    					  </form>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <!--Scripts for Bootstrap-->
	<script src="./js/jquery-2.1.4.min.js"></script>
	<script src="./js/bootstrap.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/register.js"></script>
	<script src="./js/login.js"></script>
    <script type="text/javascript"></script>
</body>
</html>
