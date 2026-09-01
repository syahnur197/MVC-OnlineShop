<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active">Your Account</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-user"></i> Welcome back, <?= esc($user->full_name) ?></div>
			<div class="card-body">
				<dl class="row mb-0">
					<dt class="col-sm-3">Username</dt>
					<dd class="col-sm-9"><?= esc($user->username) ?></dd>
					<dt class="col-sm-3">Email</dt>
					<dd class="col-sm-9"><?= esc($user->email) ?></dd>
				</dl>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 mb-3">
				<a class="btn btn-primary btn-block" href="<?= site_url('user/your_cart') ?>">
					<i class="fa fa-shopping-cart"></i> Your Cart
				</a>
			</div>
			<div class="col-md-6 mb-3">
				<a class="btn btn-secondary btn-block" href="<?= site_url('user/your_order') ?>">
					<i class="fa fa-list"></i> Your Orders
				</a>
			</div>
		</div>
