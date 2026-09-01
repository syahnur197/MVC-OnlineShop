<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="<?= site_url('admin/view_category') ?>">Category Listing</a></li>
			<li class="breadcrumb-item active">Manage Category</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<?= view('admin/_category_form', [
			'category'    => $category,
			'parents'     => $parents,
			'action'      => site_url('admin/manage_category/' . $category->id),
			'submitLabel' => 'Update',
		]) ?>

		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-tags"></i> Products in <?= esc($category->name) ?></div>
			<div class="card-body">
				<?php if ($products === []) : ?>
					<p class="mb-0">No products in this category yet.</p>
				<?php else : ?>
					<div class="table-responsive">
						<table class="table table-bordered" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Product</th>
									<th class="text-right">Price</th>
									<th>Description</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($products as $index => $product) : ?>
									<tr>
										<td><?= $index + 1 ?></td>
										<td><?= esc($product->name) ?></td>
										<td class="text-right">B$ <?= esc(number_format($product->price, 2)) ?></td>
										<td><?= esc($product->short_description) ?></td>
										<td>
											<span class="badge badge-<?= $product->is_active ? 'success' : 'secondary' ?>">
												<?= $product->is_active ? 'On sale' : 'Withdrawn' ?>
											</span>
										</td>
										<td><a class="btn btn-primary btn-block" href="<?= site_url('admin/edit_product/' . $product->id) ?>">Edit</a></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				<?php endif ?>
			</div>
		</div>
