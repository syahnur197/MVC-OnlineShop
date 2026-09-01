<?php
/**
 * @var string|null $activeNav One of profile.details, profile.password, cart.view,
 *                             orders.list. Null on the dashboard landing page.
 */
$activeNav ??= null;
$group = $activeNav === null ? null : strtok($activeNav, '.');

$open   = static fn (string $name): string => $group === $name ? 'show' : '';
$active = static fn (string $name) => $activeNav === $name ? 'active' : '';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
	<a class="navbar-brand" href="<?= site_url('user/dashboard') ?>">Your Account</a>
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav navbar-sidenav" id="sidenavAccordion">
			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Go to site">
				<a class="nav-link" href="<?= site_url('shop') ?>">
					<i class="fa fa-fw fa-dashboard"></i>
					<span class="nav-link-text">Go to Site</span>
				</a>
			</li>

			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profile">
				<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#navProfile" data-parent="#sidenavAccordion">
					<i class="fa fa-fw fa-user"></i>
					<span class="nav-link-text">Manage Profile</span>
				</a>
				<ul class="sidenav-second-level collapse <?= $open('profile') ?>" id="navProfile">
					<li class="<?= $active('profile.details') ?>"><a href="<?= site_url('user/change_details') ?>">Change Details</a></li>
					<li class="<?= $active('profile.password') ?>"><a href="<?= site_url('user/change_password') ?>">Change Password</a></li>
				</ul>
			</li>

			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Carts and orders">
				<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#navCart" data-parent="#sidenavAccordion">
					<i class="fa fa-fw fa-shopping-cart"></i>
					<span class="nav-link-text">Cart and Orders</span>
				</a>
				<ul class="sidenav-second-level collapse <?= $open('cart') . $open('orders') ?>" id="navCart">
					<li class="<?= $active('cart.view') ?>"><a href="<?= site_url('user/your_cart') ?>">Your Cart</a></li>
					<li class="<?= $active('orders.list') ?>"><a href="<?= site_url('user/your_order') ?>">Your Orders</a></li>
				</ul>
			</li>
		</ul>

		<ul class="navbar-nav sidenav-toggler">
			<li class="nav-item"><a class="nav-link text-center" id="sidenavToggler"><i class="fa fa-fw fa-angle-left"></i></a></li>
		</ul>

		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
					<i class="fa fa-fw fa-sign-out"></i> Log out
				</a>
			</li>
		</ul>
	</div>
</nav>
