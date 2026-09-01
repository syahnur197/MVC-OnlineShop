<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Dashboard</a></li>
			<li class="breadcrumb-item active">Category Listing</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-tags"></i> Categories</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Parent Category</th>
								<th>Category</th>
								<th class="text-right">Products</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($categories as $index => $category) : ?>
								<tr>
									<td><?= $index + 1 ?></td>
									<td><?= esc($category->parent_name ?? 'No Parent') ?></td>
									<td><?= esc($category->name) ?></td>
									<td class="text-right"><?= esc($category->product_count) ?></td>
									<td>
										<a class="btn btn-primary btn-block" href="<?= site_url('admin/manage_category/' . $category->id) ?>">Manage</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
