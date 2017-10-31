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
          <i class="fa fa-shopping-cart"></i> Cart Listing</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Customer Name</th>
                  <th>Total Price</th>
                  <!-- <th>Checkout Time</th> -->
                  <th>Options</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Checkout ID</th>
                  <th>Client</th>
                  <th>Total Price</th>
                  <!-- <th>Checkout Time</th> -->
                  <th>Options</th>
                </tr>
              </tfoot>
              <tbody>
                <?php $count = 1; foreach($carts as $cart): ?>
                  <tr align="center">
                    <td><?= $count++;?></td>
                    <td align="left"><?= $cart->first_name . " " . $cart->last_name; ?></td>
                    <td>$ <?= number_format ( $cart->totalPrice, 2  );  ?></td>
                    <!-- <td>datetime</td> -->
                    <td><a href="<?= site_url('admin/view_cart/'.$cart->cart_id)?>">View Cart</a></td>
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
 