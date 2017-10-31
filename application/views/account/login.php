<body style="min-height: 350px; background:linear-gradient( rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8) ), url(<?= base_url('style/assets/images/mall.jpeg')?>) no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover; background-size: cover;">
	<div class="container">
		<?php echo $this->session->flashdata("fail"); ?>
		<h1  class="text-center mt-5" style="color:white; font-family: 'Lobster', cursive">LOGIN</h1>
		<div class="card card-login mx-auto mt-2">
			<div class="card-body">
				<?php echo form_open('account/loggingIn'); ?>
					<div class="form-group">
						<label for="exampleInputEmail1">Username</label>
						<input class="form-control" id="username" name="username" type="text" placeholder="Enter Username" required>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input class="form-control" id="password" name="password" type="password" placeholder="Enter Password" required>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="checkbox"> Remember Password</label>
						</div>
					</div>
					<button class="btn btn-primary btn-block" type="submit">Login</button>
				</form>
				<div class="text-center">
					<a class="d-block small mt-3" href="<?php echo base_url('index.php/account/register');?>">Register an Account</a>
					<!-- <a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
				</div>
			</div>
		</div>
	</div>
	<!-- Bootstrap core JavaScript-->
	<script src="<?php echo base_url();?>style/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url();?>style/vendor/popper/popper.min.js"></script>
	<script src="<?php echo base_url();?>style/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!-- Core plugin JavaScript-->
	<script src="<?php echo base_url();?>style/vendor/js/jquery.easing.min.js"></script>
</body>
