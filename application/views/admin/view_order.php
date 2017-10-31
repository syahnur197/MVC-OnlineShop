	<div class="content-wrapper">
		<div class="container-fluid">
			<!-- Breadcrumbs-->
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?= site_url('admin');?>">Dashboard</a>
				</li>
				<li class="breadcrumb-item">
					<a href="<?= site_url('admin/manage_order');?>">Order Listing</a>
				</li>
				<li class="breadcrumb-item active">View Order</li>
			</ol>
			
			<!-- Active Cart Card-->
			<div class="card mb-3">
				<div class="card-header">
					<i class="fa fa-shopping-cart"></i> Orders</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Product Name</th>
									<th>Unit Price</th>
									<th>Quantity</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								<?php $count = 1; foreach($products as $product): ?>
									<tr align="center">
										<td><?= $count++;?></td>
										<td align="left"><?= $product->product_name; ?></td>
										<td>$ <?= $product->price; ?></td>
										<td><?= $product->quantity; ?></td>
										<td>$ <?= number_format ( $product->quantity * $product->price, 2  );  ?></td>
									</tr>
								<?php endforeach; ?>
								<tr>
										<td colspan="4"  align="right"><strong>Total</strong></td>
										<td>$ <?= number_format ( $totalPrice, 2  );  ?></td>
									</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Active Cart Card-->
			<div class="card mb-3">
				<div class="card-header">
					<i class="fa fa-user"></i> Customer's Details</div>
				<div class="card-body">
					<label><strong>Full Name</strong></label>
					<br>
					<p><?= $shippingAddress->first_name?> <?= $shippingAddress->last_name?></p>
					<label><strong>Country</strong></label>
					<br>
					<p><?= $shippingAddress->country; ?></p>
					<label><strong>Postcode</strong></label>
					<br>
					<p><?= $shippingAddress->postcode; ?></p>
					<label><strong>Address</strong></label>
					<br>
					<p><?= $shippingAddress->address; ?></p>
					<label><strong>Town</strong></label>
					<br>
					<p><?= $shippingAddress->town; ?></p>
				</div>
			</div>
		</div>
		<!-- /.container-fluid-->
		<!-- /.content-wrapper-->

		<script>
		$(document).ready(function() {
				$('table.display').DataTable();
		} );
		</script>
 