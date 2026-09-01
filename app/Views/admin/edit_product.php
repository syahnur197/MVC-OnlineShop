<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="<?= site_url('admin/view_product') ?>">Product Listing</a></li>
			<li class="breadcrumb-item active">Edit Product</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<?= view('admin/_product_form', [
			'product'     => $product,
			'categories'  => $categories,
			'action'      => site_url('admin/edit_product/' . $product->id),
			'submitLabel' => 'Update',
		]) ?>
