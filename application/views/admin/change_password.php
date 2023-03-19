<?php $ci=& get_instance() ?>
<div class="content-wrapper">
  <div class="content">
    <?php showFlash(); ?>
    <div class="card">
       <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-info">
            <div class="panel-heading">
                Change Password
                <a class="pull-right panel_font_color" href="<?php echo base_url('admin/dashboard') ?>">
                  <i class="fa fa-reply"></i> Go Back
              </a>
            </div>
            <div class="panel-body">
               <form action="<?php echo base_url('login/update_password')?>" method="post">
                <label>Current Password</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input id="#" type="password" class="form-control" name="password" value="" placeholder="Enter Current Password" required="true">
                </div><br>
                <label>New Password</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input id="#" type="password" class="form-control" name="new_password" placeholder="Enter New Password" required="true">
                </div><br>
                <label>New Password Again</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input id="#" type="password" class="form-control" name="re_password" placeholder="Re-Enter New Password" required="true">
                </div>
                <div class="text-center"><input type="submit" class="btn btn-success" name="submit" value="Change"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

