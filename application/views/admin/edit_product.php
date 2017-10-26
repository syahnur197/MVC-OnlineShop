<div class="content-wrapper">
  <div class="container-fluid">
    <?php echo $this->session->flashdata("msg"); ?>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?= site_url('admin');?>">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <a href="<?= site_url('admin/view_product');?>">Product Listing</a>
      </li>
      <li class="breadcrumb-item active">Edit Product</li>
    </ol>
    <?= $this->session->flashdata('errors');?>
    <!-- Example DataTables Card-->
    <?= form_open_multipart('product/update/'.$product_id, array('class' => 'form-horizontal')) ?>
    <div class="card mb-3">
      <div class="card-header">
        Edit Product 
      </div>
      <div class="card-body">
        <div class="form-group">
          <?php if(isset($image_error)) {echo $image_error; }?>
          <label class="control-label">Image</label>
          <div class="row">
            <div class="col-md-4">
              <img src="<?= base_url($image_link); ?>" id="product_image" name="product_image" class="img-thumbnail">
              <input type="file" id="my_file" onchange="readURL(this);" accept='image/*' name="image_link"/>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label">Product Name</label>
          <div>
            <input id="product_name" type="text" class="form-control" name="product_name" value="<?= $product->product_name; ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label">Product Price</label>
          <div>
            <input id="product_price" type="text" class="form-control" name="product_price" value="<?= $product->price; ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label">Product Short Description</label>
          <div>
            <input id="product_short_description" type="text" class="form-control" name="product_short_description" value="<?= $product->short_desc; ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label">Product Long Description</label>
          <div>
            <textarea id="textarea" name="product_description"><?= $product->description; ?></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label">Product Category</label>
          <div>
            <select id="product_category" type="text" class="form-control" name="product_category">
              <?php 
                foreach($categories as $category):
                  foreach($category->subCategory as $subCat):
              ?>
                <option value="<?= $subCat->category_id?>" <?php if ($subCat->category_id == $product->category_id){echo "selected";}?>>
                  <?= $category->category_name; ?>: <?= $subCat->category_name; ?>
                </option>
              <?php endforeach; endforeach; ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <input type="submit" value="Update" Class="btn btn-primary form-control">
        </div>
      </div>
    </div>
    <?= form_close(); ?>
  </div>
  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->
</div>

<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#product_image')
                .attr('src', e.target.result)
                .width(300)
                .height(300);
        };

        reader.readAsDataURL(input.files[0]);
    }
  }
</script>



