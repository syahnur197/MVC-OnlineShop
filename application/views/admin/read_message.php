<div class="content-wrapper">
    <div class="container-fluid">
      <?php echo $this->session->flashdata("success"); ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= site_url('admin');?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Read Message</li>
      </ol>
      <!-- Icon Cards-->
      <div class="card mb-3">
        <div class="card-header">
          Read Message 
        </div>
        <div class="card-body">
            <label><strong>Full Name</strong></label>
            <br>
            <p><?= $message->full_name;?></p>
            
            <label><strong>E-Mail</strong></label>
            <br>
            <p><?= $message->email;?></p>
            
            <label><strong>Message</strong></label>
            <br>
            <p><?= $message->message;?></p>
        </div>
        <div class="card-footer">
          <i class="fa fa-clock-o"></i> <?= date_format(date_create($message->submit_time), 'd M Y H:i') ?> 
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

