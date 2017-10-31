<div class="content-wrapper">
  <div class="container-fluid">
    <?php echo $this->session->flashdata("msg"); ?>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?= site_url('admin');?>">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Category Listing</li>
    </ol>
    <!-- View Categpory DataTables Card-->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-tags"></i> Category List </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th width="20%">N0</th>
                <th width="20%">Parent Category</th>
                <th width="20%">Category Name</th>
                <th width="20%">No. of Products</th>
                <th width="20%">Options</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th width="20%">N0</th>
                <th width="20%">Parent Category</th>
                <th width="20%">Category Name</th>
                <th width="20%">No. of Products</th>
                <th width="20%">Options</th>
              </tr>
            </tfoot>
            <tbody>
              <?php $count = 1; foreach($subcategorylist as $cl) : ?>
                  <tr>
                    <td><?= $count++; ?></td>
                    <td><?= $cl->parent_category_name ?></td>
                    <td><?= $cl->category_name ?></td>
                    <td><?= $cl->product_count?></td>
                    <td>
                      <a href="<?= site_url('admin/manage_category/').$cl->category_id?>">
                        <button class="btn btn-primary btn-block">
                          Manage
                        </button>
                      </a>
                    </td>
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
