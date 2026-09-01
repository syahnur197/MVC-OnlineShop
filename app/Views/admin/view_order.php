<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="<?= site_url('admin/manage_order') ?>">Order Listing</a></li>
			<li class="breadcrumb-item active">Order #<?= $cart->id ?></li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-shopping-cart"></i> Order #<?= $cart->id ?></div>
			<div class="card-body">
				<?= $this->include('admin/_cart_items') ?>
				<p class="mb-0 text-muted">Placed on <?= esc($cart->ordered_at?->format('d M Y H:i') ?? '-') ?></p>
			</div>
		</div>

		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-truck"></i> Shipping to</div>
			<div class="card-body">
				<p class="mb-1"><strong><?= esc($cart->first_name . ' ' . $cart->last_name) ?></strong></p>
				<p class="mb-1"><?= esc($cart->email) ?></p>
				<p class="mb-0"><?= $address === null ? 'No address on file.' : esc($address->single_line) ?></p>
			</div>
		</div>
