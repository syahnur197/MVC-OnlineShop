  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?= site_url('admin');?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Cart Listing</li>
      </ol>
      <!-- Active Cart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Carts</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<!--               <thead>
                <tr>
                  <th width='20px'>No</th>
                  <th>Image</th>
                  <th>Product Detail</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th width='20px'>No</th>
                  <th>Image</th>
                  <th>Product Detail</th>
                  <th>Options</th>
                </tr>
              </tfoot> -->
              <tbody>
                <?php $count = 1; foreach($cartData as $cart): ?>
                  <tr align="center">
                    <td rowspan=2><?= $count++;?></td>
                    <td rowspan=2>put image here</td>
                    <td rowspan=1 align="left" ><strong><em><?= $cart->product_name; ?></em></strong></td>
                    <td rowspan=1 align="left" >Qty:</td>
                    <td rowspan=2><a class="btn-sm btn-danger"> X </a></td>
                  </tr><tr>
                    <td rowspan=1 colspan=2 align="left"><?= $cart->short_desc; ?></td>

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

    <script>
    $(document).ready(function() {
        $('table.display').DataTable();
    } );
    </script>
 