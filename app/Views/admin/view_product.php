<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Dashboard</a></li>
			<li class="breadcrumb-item active">Product Listing</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-shopping-bag"></i> Products</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Product</th>
								<th class="text-right">Price</th>
								<th>Description</th>
								<th>Category</th>
								<th>Status</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($products as $index => $product) : ?>
								<tr>
									<td><?= $index + 1 ?></td>
									<td><?= esc($product->name) ?></td>
									<td class="text-right">B$ <?= esc(number_format($product->price, 2)) ?></td>
									<td><?= esc($product->short_description) ?></td>
									<td><?= esc($product->category_name) ?></td>
									<td>
										<span class="badge badge-<?= $product->is_active ? 'success' : 'secondary' ?>">
											<?= $product->is_active ? 'On sale' : 'Withdrawn' ?>
										</span>
									</td>
									<td>
										<a class="btn btn-primary btn-block" href="<?= site_url('admin/edit_product/' . $product->id) ?>">Edit</a>
										<?= form_open(site_url('admin/products/' . $product->id . '/status')) ?>
											<input type="hidden" name="is_active" value="<?= $product->is_active ? 0 : 1 ?>">
											<button type="submit" class="btn btn-block btn-<?= $product->is_active ? 'danger' : 'success' ?>">
												<?= $product->is_active ? 'Withdraw' : 'Put on sale' ?>
											</button>
										<?= form_close() ?>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
