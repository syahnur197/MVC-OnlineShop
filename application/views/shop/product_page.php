		<!-- Page Content -->
		<div class="container">

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

					<!-- <div class="card card-outline-secondary my-4">
						<div class="card-header">
							Product Reviews
						</div>
						<div class="card-body">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
							<small class="text-muted">Posted by Anonymous on 3/1/17</small>
							<hr>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
							<small class="text-muted">Posted by Anonymous on 3/1/17</small>
							<hr>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
							<small class="text-muted">Posted by Anonymous on 3/1/17</small>
							<hr>
							<a href="#" class="btn btn-success">Leave a Review</a>
						</div>
					</div> -->
					<!-- /.card -->

				</div>
				<!-- /.col-lg-9 -->

			</div>

		</div>
		<!-- /.container -->

		<div class="modal fade" id="alert_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title">></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
