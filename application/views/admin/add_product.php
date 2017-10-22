<div class="content-wrapper">
  <div class="container-fluid">
    <?php echo $this->session->flashdata("msg"); ?>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?= site_url('admin');?>">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <a href="<?= site_url('admin/view_product');?>">View Product</a>
      </li>
      <li class="breadcrumb-item active">Add Product</li>
    </ol>
    <!-- Example DataTables Card-->
    <?= form_open('product/add', array('class' => 'form-horizontal')) ?>
    <div class="card mb-3">
      <div class="card-header">
        Add Product 
      </div>
      <div class="card-body">
        <div class="form-group">
          <label class="control-label">Product Name</label>
          <div>
            <input id="product_name" type="text" class="form-control" name="product_name">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label">Product Price</label>
          <div>
            <input id="product_price" type="text" class="form-control" name="product_price">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label">Product Description</label>
          <div>
            <input id="product_description" type="text" class="form-control" name="product_description">
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
                <option value="<?= $subCat->category_id?>">
                  <?= $category->category_name; ?>: <?= $subCat->category_name; ?>
                </option>
              <?php endforeach; endforeach; ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <input type="submit" value="Add" Class="btn btn-primary form-control">
        </div>
      </div>
    </div>
    <?= form_close(); ?>
  </div>
  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->
</div>



