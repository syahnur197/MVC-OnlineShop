<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Dashboard</a></li>
			<li class="breadcrumb-item active">Users</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-users"></i> Customers</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Username</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($users as $index => $user) : ?>
								<tr>
									<td><?= $index + 1 ?></td>
									<td><?= esc($user->username) ?></td>
									<td><?= esc($user->first_name) ?></td>
									<td><?= esc($user->last_name) ?></td>
									<td><?= esc($user->email) ?></td>
									<td class="text-center">
										<?= form_open(site_url('admin/users/' . $user->id . ($user->is_banned ? '/unban' : '/ban'))) ?>
											<button type="submit" class="btn btn-sm btn-<?= $user->is_banned ? 'success' : 'danger' ?>">
												<?= $user->is_banned ? 'Unban' : 'Ban' ?>
											</button>
										<?= form_close() ?>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

