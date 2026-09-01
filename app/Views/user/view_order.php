<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('user/dashboard') ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="<?= site_url('user/your_order') ?>">Your Orders</a></li>
			<li class="breadcrumb-item active">Order #<?= $order->id ?></li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-shopping-cart"></i> Order #<?= $order->id ?></div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Image</th>
								<th>Product</th>
								<th class="text-right">Quantity</th>
								<th class="text-right">Price</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($items as $index => $item) : ?>
								<tr>
									<td><?= $index + 1 ?></td>
									<td><img src="<?= base_url($item->image_path) ?>" class="img-fluid img-thumbnail" width="70" alt="<?= esc($item->name, 'attr') ?>"></td>
									<td>
										<a href="<?= site_url('shop/product/' . $item->product_id) ?>"><strong><?= esc($item->name) ?></strong></a>
										<div class="text-muted small"><?= esc($item->short_description) ?></div>
									</td>
									<td class="text-right"><?= esc($item->quantity) ?></td>
									<td class="text-right">B$ <?= esc(number_format($item->subtotal, 2)) ?></td>
								</tr>
							<?php endforeach ?>
							<tr>
								<td colspan="4" class="text-right"><strong>Total</strong></td>
								<td class="text-right"><strong>B$ <?= esc(number_format($total, 2)) ?></strong></td>
							</tr>
							<tr>
								<td colspan="4" class="text-right"><strong>Placed on</strong></td>
								<td class="text-right"><?= esc($order->ordered_at?->format('d M Y H:i') ?? '-') ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
