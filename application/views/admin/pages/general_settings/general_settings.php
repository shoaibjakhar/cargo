<?php $ci=& get_instance() ?>
<?php showFlash(); ?>
<div class="card">
	<div class="card-header">
		<div class="page-title d-flex">
			<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">General Settings</span></h4>
		</div>
	</div>
	<div class="card-body">
		<form action="<?php echo base_url('admin/generalSettings/add_general_settings')?>" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-9">
					<input type="hidden" name="id" value="<?php echo isset($single->id) ? $single->id :'';?>">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="#" class="mr-sm-2">Title:</label>
								<input type="text" class="form-control mb-2 mr-sm-2" name="title" placeholder="Title" required="true" id="#" value="<?php echo isset($single->title) ? $single->title :'';?>">
							</div>
						</div> 
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="#" class="mr-sm-2">Footer Address:</label>
								<textarea name="footer_address" class="form-control" placeholder="Footer Address......"><?php echo isset($single->footer_address) ? $single->footer_address :'';?></textarea>
							</div>
						</div> 
					</div>
				</div>
				<div class="col-md-3">
					<div class="col-sm-12">
						<div class="form-group" id="choose_file">
							<label for="#" class="mr-sm-2">Upload Logo Here:</label><br>
							<span class="text-left"><img  src="<?php echo isset($single->logo) ? base_url('assets/images/').$single->logo:base_url('assets/images/AdminLTELogo.png')?>" id="profile-img-tag" class="img-fluid img-thumbnail" height="100" width="100"></span>
							<input  type="file" class="mb-2 mr-sm-2 btn btn-info w-100" name="logo" onchange="readURL(this);">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group text-left">
						<input type="submit" class="btn btn-info" value="submit">
					</div>
				</div>
			</div>            
		</form>
	</div>
</div>
