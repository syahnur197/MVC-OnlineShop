<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Dashboard</a></li>
			<li class="breadcrumb-item active">Add Category</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<?= view('admin/_category_form', [
			'category'    => null,
			'parents'     => $parents,
			'action'      => site_url('admin/add_category'),
			'submitLabel' => 'Add',
		]) ?>
