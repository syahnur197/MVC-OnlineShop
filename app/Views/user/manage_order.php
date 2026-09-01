<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('user/dashboard') ?>">Dashboard</a></li>
			<li class="breadcrumb-item active">Your Orders</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-shopping-cart"></i> Orders</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Order</th>
								<th class="text-right">Total</th>
								<th>Placed on</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($orders as $order) : ?>
								<tr>
									<td>#<?= $order->id ?></td>
									<td class="text-right">B$ <?= esc(number_format($order->total, 2)) ?></td>
									<td><?= esc($order->ordered_at?->format('d M Y H:i') ?? '-') ?></td>
									<td><a href="<?= site_url('user/view_order/' . $order->id) ?>">View Order</a></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
