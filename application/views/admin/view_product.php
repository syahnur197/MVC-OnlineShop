<div class="content-wrapper">
  <div class="container-fluid">
    <?php echo $this->session->flashdata("msg"); ?>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?= site_url('admin');?>">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Product Listing</li>
    </ol>
    <!-- View Product DataTables Card-->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-shopping-bag"></i> Product List </div>
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
                <!-- <th width="20%">Add Time</th> -->
                <th width="10%">Options</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <!-- <th>Add Time</th> -->
                <th>Options</th>
              </tr>
            </tfoot>
            <tbody>
              <?php $count = 1; foreach($productlist->result() as $pl) : ?>
                  <tr>
                    <td><?= $count++; ?></td>
                    <td><?= $pl->product_name ?></td>
                    <td>$ <?= $pl->price ?></td>
                    <td><?= $pl->short_desc; ?></td>
                    <td><?= $pl->category_name ?></td>
                    <!-- <td><?php $date = new DateTime($pl->add_time); echo $date->format('d M Y'); ?></td> -->
                    <!-- <td><a data-toggle='modal' data-target='#editProductModal' href='#' onclick="passData(<?= $pl->product_id?>)">Edit</a></td> -->
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
  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->
</div>
