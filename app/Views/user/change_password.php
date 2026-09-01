<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('user/dashboard') ?>">Dashboard</a></li>
			<li class="breadcrumb-item active">Change Password</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-key"></i> Change your password</div>
			<div class="card-body">
				<?= form_open(site_url('user/change_password')) ?>
					<div class="form-group">
						<label for="current_password">Current Password</label>
						<input class="form-control" id="current_password" name="current_password" type="password" required>
					</div>
					<div class="form-group">
						<label for="password">New Password</label>
						<input class="form-control" id="password" name="password" type="password" minlength="8" required>
						<small class="form-text text-muted">At least 8 characters.</small>
					</div>
					<div class="form-group">
						<label for="password_confirm">Re-type New Password</label>
						<input class="form-control" id="password_confirm" name="password_confirm" type="password" minlength="8" required>
					</div>
					<button class="btn btn-primary btn-block" type="submit">Update</button>
				<?= form_close() ?>
			</div>
		</div>
