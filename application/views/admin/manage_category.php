<div class="content-wrapper">
	<div class="container-fluid">
		<?php echo $this->session->flashdata("msg"); ?>
		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="<?= site_url('admin');?>">Dashboard</a>
			</li>
			<li class="breadcrumb-item">
				<a href="<?= site_url('admin/view_category');?>">Category Listing</a>
			</li>
			<li class="breadcrumb-item active">Manage Category</li>
		</ol>
		<!-- Example DataTables Card-->
		<?= form_open('category/update/'.$category_id, array('class' => 'form-horizontal')) ?>
		<div class="card mb-3">
			<div class="card-header">
				Edit Category 
			</div>
			<div class="card-body">
				<div class="form-group">
					<label class="control-label">Category Name</label>
					<div>
						<input id="category_name" type="text" class="form-control" name="category_name" value="<?= $category->category_name; ?>">
						<input id="original_category_name" type="hidden" class="form-control" name="original_category_name" value="<?= $category->category_name; ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label">Parent Category</label>
					<div>
						<select id="parent_category_id" type="text" class="form-control" name="parent_category_id">
							<option value="0" <?php if ($category->parent_category_id == 0){echo "selected";}?>>No Parent</option>
							<?php 
								foreach($parent_categories as $cat):
							?>
								<option value="<?= $cat->category_id?>" <?php if ($cat->category_id == $category->parent_category_id){echo "selected";}?>>
									<?= $cat->category_name; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<input type="submit" value="Update" Class="btn btn-primary form-control">
				</div>
			</div>
		</div>
		<?= form_close(); ?>

		
		<!-- View Product Card-->
		<div class="card mb-3">
			<div class="card-header">
				<i class="fa fa-tags"></i> <?= $category->category_name; ?> List </div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th width="10%">N0</th>
								<th width="20%">Product Name</th>
								<th width="10%">Price</th>
								<th width="20%">Description</th>
								<th width="20%">Category</th>
								<th width="10%">Options</th>
							</tr>
						</thead>
						<tbody>
							<?php $count = 1; foreach($productlist->result() as $pl) : ?>
									<tr>
										<td><?= $count++; ?></td>
										<td><?= $pl->product_name ?></td>
										<td>$ <?= $pl->price ?></td>
										<td><?= $pl->short_desc ?></td>
										<td><?= $pl->category_name ?></td>
										<td>
											<a href='<?= site_url('admin/edit_product/'.$pl->product_id)?>'>
												<button class="btn btn-primary" style="width:100%">Edit</button>
											</a>
											<?php if($pl->active_flag == 0): ?>
												<a href='<?= site_url('product/changeActiveStatus/'.$pl->product_id).'/1'?>'>
													<button class="btn btn-danger" style="width:100%" >Deactivate</button>
												</a>
											<?php elseif($pl->active_flag == 1): ?>
												<a href='<?= site_url('product/changeActiveStatus/'.$pl->product_id).'/0'?>'>
													<button class="btn btn-success" style="width:100%" >Re-activate</button>
												</a>
											<?php endif; ?>
										</td>
										</tr>
								<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



