<?php $auth = service('auth') ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Awesome eStore <?= esc($title ?? '') ?></title>
	<link rel="icon" href="<?= base_url('style/assets/images/icon.png') ?>" type="image/png">

	<link href="<?= base_url('style/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('style/css/shop.css') ?>" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Merriweather:900" rel="stylesheet">
	<link href="<?= base_url('style/css/font-awesome.min.css') ?>" rel="stylesheet">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="<?= site_url('shop') ?>">Awesome eStore</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item <?= ($navItem ?? '') === 'home' ? 'active' : '' ?>">
						<a class="nav-link" href="<?= site_url('shop') ?>"><b>Home</b></a>
					</li>
					<li class="nav-item <?= ($navItem ?? '') === 'about' ? 'active' : '' ?>">
						<a class="nav-link" href="<?= site_url('shop/about') ?>"><b>About</b></a>
					</li>
					<li class="nav-item <?= ($navItem ?? '') === 'contact' ? 'active' : '' ?>">
						<a class="nav-link" href="<?= site_url('shop/contact') ?>"><b>Contact</b></a>
					</li>

					<?php if ($auth->isAdmin()) : ?>
						<li class="nav-item"><a class="nav-link" href="<?= site_url('admin') ?>"><b>Admin Dashboard</b></a></li>
					<?php elseif ($auth->isCustomer()) : ?>
						<li class="nav-item"><a class="nav-link" href="<?= site_url('user/dashboard') ?>"><b>Your Profile</b></a></li>
					<?php endif ?>

					<?php if ($auth->check()) : ?>
						<li class="nav-item">
							<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
								<button class="btn btn-danger py-1" type="button">Log Out</button>
							</a>
						</li>
					<?php else : ?>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('account') ?>">
								<button class="btn btn-success py-1" type="button">Log In</button>
							</a>
						</li>
					<?php endif ?>
				</ul>
			</div>
		</div>
	</nav>
