<?php $ci=& get_instance() ?>
<div class="row">
  <div class="col-sm-12">
    <?php $ci->showFlash(); ?>
    <div class="card p-3">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-info">

            <div class="panel-body">
              <form action="<?php echo base_url('admin/users/user_registration')?>" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-9">
                    <input type="hidden" name="id" value="<?php echo isset($value->id) ? $value->id :'';?>">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>First Name</label>
                          <input id="#" type="text" class="form-control mb-2 mr-sm-2" name="first_name" value="<?php echo isset($value->first_name) ? $value->first_name :'';?>" placeholder="Enter First Name" required="true">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Last Name</label>
                          <input id="#" type="text" class="form-control mb-2 mr-sm-2" name="last_name" placeholder="Enter Last Name" value="<?php echo isset($value->last_name) ? $value->last_name :'';?>" required="true">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Email Address</label>
                          <input id="#" type="email" class="form-control mb-2 mr-sm-2" name="email" placeholder="Enter Email Address" value="<?php echo isset($value->email) ? $value->email :'';?>" required="true">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>User Name</label>
                          <input id="#" type="text" class="form-control mb-2 mr-sm-2" name="username" placeholder="Enter User Name" value="<?php echo isset($value->username) ? $value->username :'';?>" required="true">
                        </div>
                      </div>
                    </div>  
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group text-left">
                          <input type="submit" class="btn btn-success green_btn" value="Update">
                        </div>
                      </div>
                    </div>            
                  </div>
                  <div class="col-md-3 choose_file">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="#" class="mr-sm-2">Update Image:</label><br>
                          <span class="text-left"><img src="<?php echo base_url() ?>assets/images/<?php echo isset($value->image)?$value->image:'user2-160x160.jpg'?>" id="profile-img-tag" alt="profile image" class="img-fluid img-thumbnail"  height="200" width="200"></span>
                          <input type="file" class="mb-2 mr-sm-2 btn btn-info" name="file" value="<?php echo isset($value->image) ? $value->image :'';?>" onchange="readURL(this);">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <?php $ci->showFlash(); ?>
    <div class="card p-3">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-info">

            <div class="panel-body">
              <form action="<?php echo base_url('admin/profile/update_password')?>" method="post">
                <input type="hidden" name="id" value="<?php echo isset($value->id) ? $value->id :'';?>">
                  <div class="form-group">
                    <label>Current Password</label>
                    <input id="#" type="password" class="form-control mb-2 mr-sm-2" name="old_password" autocomplete="off" value="" placeholder="Enter Old Passord">
                  </div>
                  <div class="form-group">
                    <label>New Password</label>
                    <input id="#" type="password" class="form-control mb-2 mr-sm-2" name="new_password" autocomplete="off" placeholder="Enter New Passord" value="">
                  </div>
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input id="#" type="password" class="form-control mb-2 mr-sm-2" name="confirm_password" autocomplete="off" placeholder="Enter New Passord Again" value="">
                  </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group text-left">
                      <input type="submit" class="btn btn-success green_btn" value="Update">
                    </div>
                  </div>
                </div>            

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>