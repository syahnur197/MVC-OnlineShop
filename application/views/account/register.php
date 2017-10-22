<body class="bg-dark">
  <div class="container">
    <?php echo $this->session->flashdata("register"); ?>
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <?php echo validation_errors(); ?>
        <?php echo form_open('Account/registerAccount'); ?>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="FName">First name</label>
                <input class="form-control" id="FName" name="FName" type="text" aria-describedby="nameHelp" placeholder="Enter first name" value="<?= set_value('FName'); ?>" >
              </div>
              <div class="col-md-6">
                <label for="LName">Last name</label>
                <input class="form-control" id="LName" name="LName" type="text" aria-describedby="nameHelp" placeholder="Enter last name" value="<?= set_value('LName'); ?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="username">Username</label>
                <input class="form-control" id="username" name="username" type="text" placeholder="Enter username" value="<?= set_value('username'); ?>">
              </div>
              <div class="col-md-6">
                <label for="email">Email address</label>
                <input class="form-control" id="email" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?= set_value('email'); ?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="password">Password</label>
                <input class="form-control" id="password" name="password" type="password" placeholder="Password">
              </div>
              <div class="col-md-6">
                <label for="confPassword">Confirm password</label>
                <input class="form-control" id="confPassword" name="confPassword" type="password" placeholder="Confirm password">
              </div>
            </div>
          </div>
          <input type="submit" name="submit" value="Register" class="btn btn-primary btn-block"/>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="<?php echo base_url('index.php/account');?>">Login Page</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
</body>