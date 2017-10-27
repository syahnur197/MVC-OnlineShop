  <div class="content-wrapper">
    <div class="container-fluid">
      <?php echo $this->session->flashdata("msg"); ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?= site_url('user/dashboard');?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Your cart</li>
      </ol>
      <!-- Active Cart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-shopping-cart"> </i> Your Cart</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
              <tfoot><tr><td colspan=3></td><td colspan='2'>Total Price : </td></tr></tfoot>
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
                    <td rowspan=1 align="left" >Qty : <?=$cart->quantity;?></td>
                    <td rowspan=1 align="left" >Price : <?="$".$cart->price;?></td>
                    <td rowspan=2><a data-toggle="modal" data-target="#cartmodal" class="btn-sm btn-danger passID" data-id="<?= $cart->product_cart_id; ?>"> x </a></td>
                  </tr><tr>
                    <td rowspan=1 colspan=3 align="left"><?= $cart->short_desc; ?></td>
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
          <button class="btn btn-primary">Check Out</button>
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

 