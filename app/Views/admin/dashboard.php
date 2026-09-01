<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active">Dashboard</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<div class="card mb-3">
			<div class="card-header">
				<i class="fa fa-envelope"></i> Messages
				<?php if ($unreadCount > 0) : ?>
					<span class="badge badge-primary"><?= $unreadCount ?> unread</span>
				<?php endif ?>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Full Name</th>
								<th>Email</th>
								<th>Received</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($messages as $index => $message) : ?>
								<?php $weight = $message->is_read ? '' : 'font-weight:bold' ?>
								<tr>
									<td style="<?= $weight ?>"><?= $index + 1 ?></td>
									<td style="<?= $weight ?>"><?= esc($message->name) ?></td>
									<td style="<?= $weight ?>"><?= esc($message->email) ?></td>
									<td style="<?= $weight ?>"><?= esc($message->created_at?->format('d M Y H:i') ?? '-') ?></td>
									<td>
										<a class="btn btn-primary btn-block" href="<?= site_url('admin/read_message/' . $message->id) ?>">Read</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
