<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Dashboard</a></li>
			<li class="breadcrumb-item active">Open Carts</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-shopping-cart"></i> Carts that have not been checked out</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Cart</th>
								<th>Customer</th>
								<th class="text-right">Total</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($carts as $cart) : ?>
								<tr>
									<td>#<?= $cart->id ?></td>
									<td><?= esc($cart->first_name . ' ' . $cart->last_name) ?></td>
									<td class="text-right">B$ <?= esc(number_format($cart->total, 2)) ?></td>
									<td><a href="<?= site_url('admin/view_cart/' . $cart->id) ?>">View Cart</a></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
