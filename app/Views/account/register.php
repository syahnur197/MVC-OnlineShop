<div class="container">
	<?= $this->include('layout/_alerts') ?>

	<h1 class="text-center mt-5" style="color:white; font-family:'Lobster', cursive">Register</h1>

	<div class="card card-register mx-auto mt-2">
		<div class="card-body">
			<?= form_open(site_url('account/register')) ?>
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<label for="first_name">First name</label>
							<input class="form-control" id="first_name" name="first_name" type="text" placeholder="Enter first name" value="<?= set_value('first_name') ?>" required>
						</div>
						<div class="col-md-6">
							<label for="last_name">Last name</label>
							<input class="form-control" id="last_name" name="last_name" type="text" placeholder="Enter last name" value="<?= set_value('last_name') ?>" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<label for="username">Username</label>
							<input class="form-control" id="username" name="username" type="text" placeholder="Enter username" value="<?= set_value('username') ?>" required>
						</div>
						<div class="col-md-6">
							<label for="email">Email address</label>
							<input class="form-control" id="email" name="email" type="email" placeholder="Enter email" value="<?= set_value('email') ?>" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<label for="password">Password</label>
							<input class="form-control" id="password" name="password" type="password" placeholder="At least 8 characters" required>
						</div>
						<div class="col-md-6">
							<label for="password_confirm">Confirm password</label>
							<input class="form-control" id="password_confirm" name="password_confirm" type="password" placeholder="Confirm password" required>
						</div>
					</div>
				</div>

				<button type="submit" class="btn btn-primary btn-block">Register</button>
			<?= form_close() ?>

			<div class="text-center">
				<a class="d-block small mt-3" href="<?= site_url('account') ?>">Login Page</a>
			</div>
		</div>
	</div>
</div>
