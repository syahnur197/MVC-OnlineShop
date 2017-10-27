	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
		<a class="navbar-brand" href="<?php echo base_url().'index.php/admin'?>">Admin Dashboard</a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
					<a class="nav-link" href="<?= site_url('shop'); ?>">
						<i class="fa fa-fw fa-dashboard"></i>
						<span class="nav-link-text">Go to Site</span>
					</a>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
					<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2" data-parent="#exampleAccordion">
						<i class="fa fa-fw fa-users"></i>
						<span class="nav-link-text">Users</span>
					</a>
					<ul class="sidenav-second-level collapse <?= $show_user; ?>" id="collapseMulti2">
						<li class="<?= $manage_user_active; ?>">
							<a href="<?= site_url('admin/view_users'); ?>">Manage</a>
						</li>
					</ul>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Products">
					<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti3" data-parent="#exampleAccordion">
						<i class="fa fa-fw fa-gift"></i>
						<span class="nav-link-text">Products</span>
					</a>
					<ul class="sidenav-second-level collapse <?= $show_product; ?>" id="collapseMulti3">
						<li class="<?= $manage_product_active; ?>">
							<a href="<?= site_url('admin/view_product'); ?>">Manage</a>
						</li>
						<li class="<?= $add_product_active; ?>">
							<a href="<?= site_url('admin/add_product'); ?>">Add</a>
						</li>
					</ul>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Categories">
					<a class="nav-link nav-link-collapse" data-toggle="collapse" href="#collapseMulti4" data-parent="#exampleAccordion">
						<i class="fa fa-fw fa-tag"></i>
						<span class="nav-link-text">Categories</span>
					</a>
					<ul class="sidenav-second-level collapse <?= $show_category; ?>" id="collapseMulti4">
						<li class="<?= $manage_category_active; ?>">
							<a href="<?= site_url('admin/view_category'); ?>">Manage</a>
						</li>
						<li class="<?= $add_category_active; ?>">
							<a href="<?= site_url('admin/add_category'); ?>">Add</a>
						</li>
					</ul>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Orders and Cart">
					<a class="nav-link nav-link-collapse" data-toggle="collapse" href="#collapseMulti5" data-parent="#exampleAccordion">
						<i class="fa fa-fw fa-shopping-cart"></i>
						<span class="nav-link-text">Orders and Cart</span>
					</a>
					<ul class="sidenav-second-level collapse <?= $show_order; ?>" id="collapseMulti5">
						<li class="<?= $manage_order_active; ?>">
							<a href="<?= site_url('admin/manage_order'); ?>">Manage Order</a>
						</li>
						<li class="<?= $manage_cart_active; ?>">
							<a href="<?= site_url('admin/manage_cart'); ?>">Manage Cart</a>
						</li>
					</ul>
				</li>
			</ul>
			<ul class="navbar-nav sidenav-toggler">
				<li class="nav-item">
					<a class="nav-link text-center" id="sidenavToggler">
						<i class="fa fa-fw fa-angle-left"></i>
					</a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<!-- <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-fw fa-envelope"></i>
						<span class="d-lg-none">Messages
							<span class="badge badge-pill badge-primary">12 New</span>
						</span>
						<span class="indicator text-primary d-none d-lg-block">
							<i class="fa fa-fw fa-circle"></i>
						</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="messagesDropdown">
						<h6 class="dropdown-header">New Messages:</h6>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">
							<strong>David Miller</strong>
							<span class="small float-right text-muted">11:21 AM</span>
							<div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">
							<strong>Jane Smith</strong>
							<span class="small float-right text-muted">11:21 AM</span>
							<div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">
							<strong>John Doe</strong>
							<span class="small float-right text-muted">11:21 AM</span>
							<div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item small" href="#">View all messages</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-fw fa-bell"></i>
						<span class="d-lg-none">Alerts
							<span class="badge badge-pill badge-warning">6 New</span>
						</span>
						<span class="indicator text-warning d-none d-lg-block">
							<i class="fa fa-fw fa-circle"></i>
						</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="alertsDropdown">
						<h6 class="dropdown-header">New Alerts:</h6>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">
							<span class="text-success">
								<strong>
									<i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
							</span>
							<span class="small float-right text-muted">11:21 AM</span>
							<div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">
							<span class="text-danger">
								<strong>
									<i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
							</span>
							<span class="small float-right text-muted">11:21 AM</span>
							<div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">
							<span class="text-success">
								<strong>
									<i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
							</span>
							<span class="small float-right text-muted">11:21 AM</span>
							<div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item small" href="#">View all alerts</a>
					</div>
				</li>
				<li class="nav-item">
					<form class="form-inline my-2 my-lg-0 mr-lg-2">
						<div class="input-group">
							<input class="form-control" type="text" placeholder="Search for...">
							<span class="input-group-btn">
								<button class="btn btn-primary" type="button">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>
					</form>
				</li> -->
				<li class="nav-item">
					<a class="nav-link" data-toggle="modal" data-target="#logoutmodal">
						<i class="fa fa-fw fa-sign-out"></i>Logout</a>
				</li>
			</ul>
		</div>
	</nav>