<?php
/**
 * @var string|null $activeNav One of users.manage, products.manage, products.add,
 *                             categories.manage, categories.add, orders.manage,
 *                             orders.carts. Null on pages with no sidebar entry.
 */
$activeNav ??= null;
$group = $activeNav === null ? null : strtok($activeNav, '.');

$open   = static fn (string $name): string => $group === $name ? 'show' : '';
$active = static fn (string $name) => $activeNav === $name ? 'active' : '';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
	<a class="navbar-brand" href="<?= site_url('admin') ?>">Admin Dashboard</a>
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

			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
				<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#navUsers" data-parent="#sidenavAccordion">
					<i class="fa fa-fw fa-users"></i>
					<span class="nav-link-text">Users</span>
				</a>
				<ul class="sidenav-second-level collapse <?= $open('users') ?>" id="navUsers">
					<li class="<?= $active('users.manage') ?>"><a href="<?= site_url('admin/view_users') ?>">Manage</a></li>
				</ul>
			</li>

			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Products">
				<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#navProducts" data-parent="#sidenavAccordion">
					<i class="fa fa-fw fa-gift"></i>
					<span class="nav-link-text">Products</span>
				</a>
				<ul class="sidenav-second-level collapse <?= $open('products') ?>" id="navProducts">
					<li class="<?= $active('products.manage') ?>"><a href="<?= site_url('admin/view_product') ?>">Manage</a></li>
					<li class="<?= $active('products.add') ?>"><a href="<?= site_url('admin/add_product') ?>">Add</a></li>
				</ul>
			</li>

			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Categories">
				<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#navCategories" data-parent="#sidenavAccordion">
					<i class="fa fa-fw fa-tag"></i>
					<span class="nav-link-text">Categories</span>
				</a>
				<ul class="sidenav-second-level collapse <?= $open('categories') ?>" id="navCategories">
					<li class="<?= $active('categories.manage') ?>"><a href="<?= site_url('admin/view_category') ?>">Manage</a></li>
					<li class="<?= $active('categories.add') ?>"><a href="<?= site_url('admin/add_category') ?>">Add</a></li>
				</ul>
			</li>

			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Orders and carts">
				<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#navOrders" data-parent="#sidenavAccordion">
					<i class="fa fa-fw fa-shopping-cart"></i>
					<span class="nav-link-text">Orders and Carts</span>
				</a>
				<ul class="sidenav-second-level collapse <?= $open('orders') ?>" id="navOrders">
					<li class="<?= $active('orders.manage') ?>"><a href="<?= site_url('admin/manage_order') ?>">Manage Orders</a></li>
					<li class="<?= $active('orders.carts') ?>"><a href="<?= site_url('admin/manage_cart') ?>">Manage Carts</a></li>
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
