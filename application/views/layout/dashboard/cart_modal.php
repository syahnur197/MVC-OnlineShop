    <div class="modal fade" id="cartmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Remove product from cart</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <?= form_open('cart/removeFromCart'); ?>
          <input type="hidden" id="productCartId" name="productCartId" value=""/>
          <div class="modal-body">Select "Accept" below if you wish to proceed with removal.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Accept</button>
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>

    <script>
    //triggered when modal is about to be shown
    $('#cartmodal').on('show.bs.modal', function(e) {
        //get data-id attribute of the clicked element
        var product_cart_id = $(e.relatedTarget).data('id');
        //populate the textbox
        $(e.currentTarget).find('input[name="productCartId"]').val(product_cart_id);
    });
    </script>