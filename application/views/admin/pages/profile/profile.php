<?php $ci=& get_instance() ?>

    <?php $ci->showFlash(); ?>
      <div class="row m-3">
        <div class="col-sm-4" style="padding: 0;">
          <div class="card choose_file" style="padding-top: 0;" >
            <div class="card-header card_header_bg main_head_box">
              <h6 class="mb-0">Profile Image</h6>

            </div>
            <div class="card-body">
              
              <img src="<?php echo base_url() ?>assets/images/<?php echo isset($value->image)?$value->image:'user2-160x160.jpg'?>" id="profile-img-tag" alt="profile image" class="img-fluid img-thumbnail"  height="200" width="200">
              <form action="<?php echo base_url('admin/users/user_registration')?>" method="POST" enctype="multipart/form-data" class="m-2 md-form">
                <input type="hidden" name="id" value="<?php echo isset($value->id) ? $value->id :'';  ?>">
                <div class="form-group">
                  <input type="file" name="file" class="mb-2 mr-sm-2 btn btn-info" value="<?php echo isset($value->image) ? $value->image :'';  ?>" id="profile-img" onchange="readURL(this);">
                </div>
                <button type="submit" class="btn btn-success mb-2 green_btn">Save</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="card"  style="padding-top: 0;" >
            <div class="card-header card_header_bg main_head_box">
              <div class="row">
                <div class="col-sm-6 sidegapp">
                  <h6 class="mb-0">Profile Details</h6>
                </div>
                <div class="col-sm-6 sidegapp">
                  <div class="text-right">
                    <div class="btn-group">
                        <a style="background: #fff;color: #000;padding: 2px 12px;" href="<?php echo base_url('admin/profile/edit_profile').'/'.$value->id ?>" class="btn btn-success">Edit Profile</a>
                    </div>
                  </div>
                </div>
              </div>
              
              
            </div>
            <div class="row">
              <div class="col-sm-12 well">
                <table class="table table-hover table-white ">
                    <tbody>
                      <tr>
                        <td>Name</td>
                        <td><?php echo isset($value->first_name) ? $value->first_name :'';  ?> <?php echo isset($value->last_name) ? $value->last_name :'';  ?> </td>
                      </tr>
                      <tr>
                        <td>Gender</td>
                        <td><?php echo (isset($value->gender) && $value->gender == 'Female') ? 'Female':'Male';?></td>
                      </tr>
                      <tr>
                        <td>Email Address</td>
                        <td><?php echo isset($value->email) ? $value->email :'';  ?></td>
                      </tr>
                      <tr>
                        <td>Date of Birth</td>
                        <td><?php echo isset($value->dob) ? date('M d Y',strtotime($user->dob)) :'';  ?></td>
                      </tr>
                      <tr>
                        <td>Martial Status</td>
                        <td><?php echo (isset($value->marital_status) && $value->marital_status == 'Married') ? 'Married':'Single';?></td>
                      </tr>
                      <tr>
                        <td>Mobile Number</td>
                        <td><?php echo isset($value->mobile_no) ? $value->mobile_no :'';  ?></td>
                      </tr>
                      <tr>
                        <td>city</td>
                        <td><?php echo isset($value->city) ? $value->city :'';  ?></td>
                      </tr>
                      <tr>
                        <td>Qualification</td>
                        <td><?php echo isset($value->qualification) ? $value->qualification :'';  ?></td>
                      </tr>
                      <tr>
                        <td>Work Experience</td>
                        <td><?php echo isset($value->experience) ? $value->experience :'';  ?></td>
                      </tr>
                      <tr>
                        <td>Description</td>
                        <td><?php echo isset($value->Description) ? $value->Description :'';  ?></td>
                      </tr>
                    </tbody>
                  </table>
                <!--     <div class="card">
                      <div class="card-header card_header_bg">
                        <h6 class="mb-0">Address</h6>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover table-white ">
                            <tbody>
                              <tr>
                                <td>Current Address</td>
                                <td><?php echo isset($value->address) ? $value->address :'';  ?></td>
                              </tr>
                              <tr>
                                <td>Permanent Address</td>
                                <td><?php echo isset($value->address) ? $value->address :'';  ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>

