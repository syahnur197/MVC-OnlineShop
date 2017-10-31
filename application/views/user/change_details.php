  <!-- Navigation-->

  <div class="content-wrapper">
    <div class="container-fluid">
          <?php echo $this->session->flashdata("msg"); ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="<?= site_url('user/dashboard')?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Change Details</li>
      </ol>
      <div class="card-body">
        <?=form_open(site_url('user/change_userdetail'));?>
          <div class="form-group">
            <label for="dispname">First Name</label>
            <input class="form-control" id="fname" name="fname" type="text" aria-describedby="emailHelp" placeholder="Your first name" value="<?= $userData->first_name; ?>">
          </div>
          <div class="form-group">
            <label for="dispname">Last Name</label>
            <input class="form-control" id="lname" name="lname" type="text" aria-describedby="emailHelp" placeholder="Your last name" value="<?= $userData->last_name; ?>">
          </div>
          <div class="form-group">
            <label for="dispname">Username</label>
            <input class="form-control" id="username" name="username" type="text" aria-describedby="emailHelp" placeholder="Username" value="<?= $userData->username; ?>">
          </div>
            <div class="form-group">
            <label for="email">Email Address</label>
            <input class="form-control" id="email" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?= $userData->email; ?>">
          </div>
          <button class="btn btn-primary btn-block" type="submit" >Update</button>
        <?=form_close();?>

      </div>

    </div><!-- /.container-fluid-->  
  </div><!-- /.content-wrapper-->
