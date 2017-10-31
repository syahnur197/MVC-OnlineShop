  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Tables</li>
      </ol>
      <div id="successAlert">
        
      </div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-users"></i> Users list</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tbody>
                <?php $count = 1; foreach($userlist->result() as $ul) : ?>
                  <tr>
                    <td><?= $count++; ?></td>
                    <td><?= $ul->username ?></td>
                    <td><?= $ul->first_name ?></td>
                    <td><?= $ul->last_name ?></td>
                    <td><?= $ul->email ?></td>
                <?php if ($ul->ban_flag == 1) : ?>
                  <td align='center' id="banCell<?= $ul->user_id ?>"><a data-toggle='modal' data-target='#unbanmodal' href='#' onclick='passId(<?= $ul->user_id ?>)' >Unban</a></td>
                <?php else: ?>
                    <td align='center' id="banCell<?= $ul->user_id ?>"><a data-toggle='modal' data-target='#banmodal' href='#' onclick='passId(<?= $ul->user_id ?>)' >Ban</a></td>
                <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <!-- Unban Modal-->
    <div class="modal fade" id="unbanmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Unban this user?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Are you sure you want to unban this user?</div>
          <div class="modal-footer">
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="button" onclick="acceptUnban()"data-dismiss="modal">Accept</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Ban Modal-->
    <div class="modal fade" id="banmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ban this User?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Are you sure you want to ban this user?.</div>
          <div class="modal-footer">
            <input type="hidden" id="passedUserId" />
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="button" onclick="acceptBan()"data-dismiss="modal">Accept</button>
          </div>
        </div>
      </div>
    </div>


<script>
  function passId(userId) {
    $('#passedUserId').val(userId);
  }

  function acceptBan() {
      var userid = $('#passedUserId').val();
      $.get('<?php echo site_url("admin/ban_user") ?>', {'userId' : userid}, function(data){
        var html = "<a data-toggle='modal' data-target='#unbanmodal' href='#' onclick='passId("+userid+")' >Unban</a>";
        $("#banCell"+userid).html(html);
        showSuccessAlert("Ban user successfully!")
      }, 'json') ;    
  }

  function acceptUnban() {
      var userid = $('#passedUserId').val();
      $.get('<?php echo site_url("admin/unban_user") ?>', {'userId' : userid}, function(data){
        var html = "<a data-toggle='modal' data-target='#banmodal' href='#' onclick='passId("+userid+")' >Ban</a>";
        $("#banCell"+userid).html(html);
        showSuccessAlert("Unban user successfully!")
      },'json');
  }

  function showSuccessAlert(message) {
    var string = "<div class='alert alert-success'>"
          + "<strong>Success!</strong> "+message
          +"</div>";
    $("#successAlert").html(string);
    $("#successAlert").show();
    $('#successAlert').delay(3000).fadeOut('slow');
  }
</script>
