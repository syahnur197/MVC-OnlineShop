	<div class="content-wrapper">
		<div class="container-fluid">
			<?php echo $this->session->flashdata("msg"); ?>
			<!-- Breadcrumbs-->
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?= site_url('user/dashboard');?>">Dashboard</a>
				</li>
				<li class="breadcrumb-item">
					<a href="<?= site_url('user/your_cart');?>">Your Cart</a>
				</li>
				<li class="breadcrumb-item active">Checkout</li>
			</ol>

			<div class="card">
				<h3 class="card-header">Checkout Information</h3>
				<div class="card-block px-3 py-3">
					<div class="row">
						<div class="form-group col-xs-2 col-md-2">
							<label for="total_price"><strong>Total Price:</strong></label>
						</div>
						<div class="form-group col-xs-10 col-md-4">
							<input type="text" class="form-control" name="f_name" value="$ <?= number_format( $totalPrice, 2 ); ?>" disabled/>
						</div>
					</div>
				</div>
			</div>
			</br>
			<?= form_open('cart/checkout'); ?>
			<div class="card">
				<h3 class="card-header">Shipping Information</h3>
				<div class="card-block px-3 py-3">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="f_name">First Name:</label>
							<input type="text" class="form-control" name="f_name" value="<?= $user->first_name?>" disabled>
							<input type="hidden" class="form-control" name="user_id" value="<?= $user->user_id?>">
						</div>
						<div class="form-group col-md-6">
							<label for="l_name">Last Name:</label>
							<input type="text" class="form-control" name="l_name" value="<?= $user->last_name?>" disabled>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="country">Country:</label>
							<input type="text" class="form-control" name="country" value="<?= $shipping_address['country']?>">
						</div>
						<div class="form-group col-md-6">
							<label for="postcode">Postcode:</label>
							<input type="text" class="form-control" name="postcode" value="<?= $shipping_address['postcode']?>">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="address">Address:</label>
							<input type="text" class="form-control" name="address" value="<?= $shipping_address['address']?>">
						</div>
						<div class="form-group col-md-6">
							<label for="town">Town:</label>
							<input type="text" class="form-control" name="town" value="<?= $shipping_address['town']?>">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
						</div>
						<div class="col-md-6">
							<input type="submit" class="form-control btn btn-success" name="submit" value="Checkout">
						</div>
					</div>
						
				</div>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
		<!-- /.container-fluid-->
		<!-- /.content-wrapper-->

		<script>
		$(document).ready(function() {
				$('table.display').DataTable();
		} );
		</script>

 