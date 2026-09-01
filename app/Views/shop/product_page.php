<?php $auth = service('auth') ?>
<div class="container">
	<?= $this->include('layout/_alerts') ?>

	<div class="row">
		<div class="col-lg-4">
			<img class="card-img-top img-fluid my-5" src="<?= base_url($product->image_path) ?>" alt="<?= esc($product->name, 'attr') ?>">
		</div>

		<div class="col-lg-8">
			<div class="card mt-4">
				<div class="card-body">
					<h3 class="card-title"><?= esc($product->name) ?></h3>
					<h4>B$ <?= esc(number_format($product->price, 2)) ?></h4>
					<strong>Short Description</strong>
					<p class="card-text"><?= esc($product->short_description) ?></p>
					<input type="number" min="1" class="form-control" placeholder="Quantity" id="quantity_<?= $product->id ?>">
					<br>
					<button class="btn btn-block btn-primary" type="button" onclick="addToCart(<?= $product->id ?>)">
						<span class="fa fa-shopping-cart pull-left"></span> Add to cart
					</button>
				</div>
			</div>

			<div class="card mt-4">
				<div class="card-body">
					<div class="card-title"><h4>Description</h4></div>
					<?php /* The description is rich text written by the admin in CKEditor. */ ?>
					<div class="card-text"><?= $product->description ?></div>
				</div>
			</div>

			<div class="card card-outline-secondary my-4">
				<div class="card-header">Product Reviews</div>
				<div class="card-body">
					<?php foreach ($reviews as $review) : ?>
						<p><?= esc($review->body) ?></p>
						<small class="text-muted">
							Posted by <?= esc($review->username) ?> on <?= esc($review->created_at->format('d M Y')) ?>
						</small>
						<hr>
					<?php endforeach ?>

					<?php if ($auth->isCustomer()) : ?>
						<?= form_open(site_url('user/review')) ?>
							<input type="hidden" name="product_id" value="<?= $product->id ?>">
							<textarea class="form-control" name="body" rows="3" required></textarea>
							<br>
							<button type="submit" class="btn btn-success">Leave a Review</button>
						<?= form_close() ?>
					<?php else : ?>
						<p class="text-muted mb-0">
							<a href="<?= site_url('account') ?>">Log in</a> with a customer account to leave a review.
						</p>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
