  <div class="content-wrapper">
    <div class="container-fluid">
      <?php echo $this->session->flashdata("msg"); ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?= site_url('admin');?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Your cart</li>
      </ol>
      <!-- Active Cart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Carts</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <tbody>
                <?php 
                  if ($exist) :
                  $count = 1; 
                  foreach($cartData as $cart): 
                ?>
                  <tr align="center">
                    <td rowspan=2><?= $count++;?></td>
                    <td rowspan=2>put image here</td>
                    <td rowspan=1 align="left" ><strong><em><?= $cart->product_name; ?></em></strong></td>
                    <td rowspan=1 align="left" >Qty: <?=$cart->quantity;?></td>
                    <td rowspan=2><a data-toggle="modal" data-target="#cartmodal" class="btn-sm btn-danger passID" data-id="<?= $cart->product_cart_id; ?>"> x </a></td>
                  </tr><tr>
                    <td rowspan=1 colspan=2 align="left"><?= $cart->short_desc; ?></td>
                  </tr>
                <?php
                  endforeach;
                  else :
                ?>
                <tr align="center"><td>Your cart is empty.</td></tr>
                 <?php endif; ?>
              </tbody>
            </table>
          </div>
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

 