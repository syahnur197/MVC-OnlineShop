<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="<?= site_url('admin/manage_cart') ?>">Open Carts</a></li>
			<li class="breadcrumb-item active">Cart #<?= $cart->id ?></li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-user"></i> <?= esc($cart->first_name . ' ' . $cart->last_name) ?> (<?= esc($cart->username) ?>)</div>
			<div class="card-body"><?= $this->include('admin/_cart_items') ?></div>
		</div>
