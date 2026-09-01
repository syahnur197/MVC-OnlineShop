<div class="container">
	<?= $this->include('layout/_alerts') ?>

	<h1 class="text-center mt-5" style="color:white; font-family:'Lobster', cursive">LOGIN</h1>

	<div class="card card-login mx-auto mt-2">
		<div class="card-body">
			<?= form_open(site_url('account/login')) ?>
				<div class="form-group">
					<label for="username">Username</label>
					<input class="form-control" id="username" name="username" type="text" placeholder="Enter username" value="<?= set_value('username') ?>" required autofocus>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" id="password" name="password" type="password" placeholder="Enter password" required>
				</div>
				<button class="btn btn-primary btn-block" type="submit">Login</button>
			<?= form_close() ?>

			<div class="text-center">
				<a class="d-block small mt-3" href="<?= site_url('account/register') ?>">Register an Account</a>
			</div>
		</div>
	</div>
</div>
