<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('user/dashboard') ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="<?= site_url('user/your_cart') ?>">Your Cart</a></li>
			<li class="breadcrumb-item active">Checkout</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-list"></i> Your order</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table mb-0" width="100%" cellspacing="0">
						<tbody>
							<?php foreach ($items as $item) : ?>
								<tr>
									<td><?= esc($item->name) ?></td>
									<td class="text-right">&times; <?= esc($item->quantity) ?></td>
									<td class="text-right">B$ <?= esc(number_format($item->subtotal, 2)) ?></td>
								</tr>
							<?php endforeach ?>
							<tr>
								<td colspan="2" class="text-right"><strong>Total</strong></td>
								<td class="text-right"><strong>B$ <?= esc(number_format($total, 2)) ?></strong></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<?= form_open(site_url('user/checkout')) ?>
			<div class="card mb-3">
				<div class="card-header"><i class="fa fa-truck"></i> Shipping information</div>
				<div class="card-body">
					<div class="row">
						<div class="form-group col-md-6">
							<label>First Name</label>
							<input type="text" class="form-control" value="<?= esc($user->first_name) ?>" disabled>
						</div>
						<div class="form-group col-md-6">
							<label>Last Name</label>
							<input type="text" class="form-control" value="<?= esc($user->last_name) ?>" disabled>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-6">
							<label for="street">Address</label>
							<input type="text" class="form-control" id="street" name="street" value="<?= set_value('street', $address->street ?? '') ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label for="town">Town</label>
							<input type="text" class="form-control" id="town" name="town" value="<?= set_value('town', $address->town ?? '') ?>" required>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-6">
							<label for="postcode">Postcode</label>
							<input type="text" class="form-control" id="postcode" name="postcode" value="<?= set_value('postcode', $address->postcode ?? '') ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label for="country">Country</label>
							<input type="text" class="form-control" id="country" name="country" value="<?= set_value('country', $address->country ?? '') ?>" required>
						</div>
					</div>

					<button type="submit" class="btn btn-success btn-block">Place Order</button>
				</div>
			</div>
		<?= form_close() ?>
