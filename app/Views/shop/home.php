<div class="container">
	<?= $this->include('layout/_alerts') ?>

	<div class="row">
		<div class="col-lg-3">
			<h3 class="my-4">Category</h3>
			<ul class="list-group">
				<?php foreach ($categories as $category) : ?>
					<li class="list-group-item">
						<a data-toggle="collapse" href="#category<?= $category->id ?>">
							<div>
								<?= esc($category->name) ?>
								<?php if ($category->children !== []) : ?>
									<i class="fa fa-chevron-right pull-right" aria-hidden="true"></i>
								<?php endif ?>
							</div>
						</a>
						<div id="category<?= $category->id ?>" class="panel-collapse collapse">
							<ul class="list-unstyled">
								<?php foreach ($category->children as $child) : ?>
									<li class="list-group-item" style="border:none">
										<a href="#" onclick="selectCategory(<?= $child->id ?>, <?= esc(json_encode($child->name), 'attr') ?>); return false;">
											<?= esc($child->name) ?>
										</a>
									</li>
								<?php endforeach ?>
							</ul>
						</div>
					</li>
				<?php endforeach ?>
			</ul>
		</div>

		<div class="col-lg-9">
			<div id="search-bar" class="mt-4 mb-2">
				<div class="input-group">
					<input type="text" id="search" class="form-control" placeholder="Search Product...">
					<span class="input-group-btn">
						<button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</div>

			<div id="content">
				<div id="carouselHeadline" class="carousel slide my-4" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselHeadline" data-slide-to="0" class="active"></li>
						<li data-target="#carouselHeadline" data-slide-to="1"></li>
						<li data-target="#carouselHeadline" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner" role="listbox">
						<div class="carousel-item active">
							<img class="d-block img-fluid" src="<?= base_url('style/assets/images/headline/top-brand.jpg') ?>" alt="Top brands">
						</div>
						<div class="carousel-item">
							<img class="d-block img-fluid" src="<?= base_url('style/assets/images/headline/fab.png') ?>" alt="Fabulous deals">
						</div>
						<div class="carousel-item">
							<img class="d-block img-fluid" src="<?= base_url('style/assets/images/headline/projector.png') ?>" alt="Electronics">
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselHeadline" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselHeadline" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span>
					</a>
				</div>

				<div class="row">
					<?php foreach ($products as $product) : ?>
						<?php $url = site_url('shop/product/' . $product->id) ?>
						<div class="col-lg-4 col-md-6 mb-4">
							<div class="card h-100">
								<a href="<?= $url ?>">
									<img class="card-img-top" src="<?= base_url($product->image_path) ?>" alt="<?= esc($product->name, 'attr') ?>" height="300px">
								</a>
								<div class="card-body">
									<h5 class="card-title"><a href="<?= $url ?>"><?= esc($product->name) ?></a></h5>
									<h6>B$ <?= esc(number_format($product->price, 2)) ?></h6>
									<p class="card-text"><?= esc($product->short_description) ?></p>
								</div>
								<div class="card-footer">
									<input type="number" min="1" class="form-control" placeholder="Quantity" id="quantity_<?= $product->id ?>">
									<br>
									<button class="btn btn-block btn-primary" type="button" onclick="addToCart(<?= $product->id ?>)">
										<span class="fa fa-shopping-cart pull-left"></span> Add to cart
									</button>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>

				<div class="text-center"><?= $pager->links() ?></div>
			</div>
		</div>
	</div>
</div>
