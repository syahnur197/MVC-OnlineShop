<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('user/dashboard') ?>">Dashboard</a></li>
			<li class="breadcrumb-item active">Change Details</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-user"></i> Your details</div>
			<div class="card-body">
				<?= form_open(site_url('user/change_details')) ?>
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input class="form-control" id="first_name" name="first_name" type="text" value="<?= set_value('first_name', $user->first_name) ?>" required>
					</div>
					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input class="form-control" id="last_name" name="last_name" type="text" value="<?= set_value('last_name', $user->last_name) ?>" required>
					</div>
					<div class="form-group">
						<label for="username">Username</label>
						<input class="form-control" id="username" name="username" type="text" value="<?= set_value('username', $user->username) ?>" required>
					</div>
					<div class="form-group">
						<label for="email">Email Address</label>
						<input class="form-control" id="email" name="email" type="email" value="<?= set_value('email', $user->email) ?>" required>
					</div>
					<button class="btn btn-primary btn-block" type="submit">Update</button>
				<?= form_close() ?>
			</div>
		</div>
