		<!-- Page Content -->
		<div class="container">

			<?= $this->session->flashdata('msg');?>
			<div class="row">
				<div class="col-lg-4">
					<img class="card-img-top img-fluid my-5" src="<?= base_url($product->image_link); ?>" alt="" >
				</div>
				<!-- /.col-lg-3 -->

				<div class="col-lg-8">
					<div class="card mt-4">
						<div class="card-body">
							<h3 class="card-title"><?= $product->product_name; ?></h3>
							<h4>$ <?= $product->price?></h4>
							<strong>Short Description</strong>
							<p class="card-text"><?= $product->short_desc?></p>
							<input type="number" name="quantity" class="form-control" placeholder="Quantity" id="quantity_<?= $product->product_id; ?>" />
							<input type="hidden" name="product_id" class="form-control" value="<?= $product->product_id; ?>"/>
							<br>
							<button class="pull-right btn btn-block btn-primary" type="button" onclick="addToCart(<?= $product->product_id; ?>)">
								<span class="fa fa-shopping-cart pull-left"></span>
								Add to cart 		
							</button>
							<!-- <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
							4.0 stars -->
						</div>
					</div>
					<div class="card mt-4">
						<div class="card-body">
							<div class="card-title"><h4>Description</h4></div>
							<p class="card-text"><?= $product->description;?></p>
							<!-- <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
							4.0 stars -->
						</div>
					</div>
					<!-- /.card -->

					<div class="card card-outline-secondary my-4">
						<div class="card-header">
							Product Reviews
						</div>
						<div class="card-body">
							<?php foreach($reviews as $review):?>
								<p><?= $review->review; ?></p>
								<small class="text-muted">Posted by <?= $review->username; ?> on <?= date_format(date_create($review->post_time), "d M Y");?></small>
								<hr>
							<?php endforeach; ?>
							<?= form_open('product/addReview'); ?>
								<input type="hidden" name="product_id" value="<?= $product_id; ?>"/>
								<textarea id="textarea" class="form-control" name="review" <?= $disabled; ?>></textarea>
								<br>
								<button type="submit" class="btn btn-success" <?= $disabled; ?>>Leave a Review</button>
							<?= form_close(); ?>
						</div>
					</div>
					<!-- /.card-->

				</div>
				<!-- /.col-lg-9 -->

			</div>

		</div>
		<!-- /.container -->
