<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Dashboard</a></li>
			<li class="breadcrumb-item active">Add Product</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<?= view('admin/_product_form', [
			'product'     => null,
			'categories'  => $categories,
			'action'      => site_url('admin/add_product'),
			'submitLabel' => 'Add',
		]) ?>
