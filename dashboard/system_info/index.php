<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		/*border-radius: 100% 100%;*/
	}
	img#cimg2{
		max-height: 30vh;
		width: 100%;
		object-fit: scale-down;
		background:#00000099;
		object-position:center center;
	}
</style>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<h5 class="card-title">System Information</h5>
			<!-- <div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_department" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
			</div> -->
		</div>
		<div class="card-body">
			<form action="" id="system-frm">
				<div id="msg" class="form-group"></div>
				<div class="form-group">
					<label for="name" class="control-label">System Name</label>
					<input type="text" class="form-control form-control-sm" name="website_name" id="website_name" value="<?php echo $_settings->info('website_name') ?>">
				</div>
				<div class="form-group">
					<label for="short_name" class="control-label">System Short Name</label>
					<input type="text" class="form-control form-control-sm" name="website_short_name" id="website_short_name" value="<?php echo  $_settings->info('website_short_name') ?>">
				</div>
			<div style="display:none;" class="form-group">
				<label for="" class="control-label">Welcome Content</label>
	             <textarea name="website_welcome_message" id="" cols="30" rows="5" class="form-control"><?php echo  stripslashes($_settings->info('welcome_message')) ?></textarea>
			</div>
			<div class="form-group">
				<label for="" class="control-label">System Logo</label>
				<div class="custom-file">
	              <input type="file" class="custom-file-input rounded-circle" id="customFile" name="weblogo" onchange="displayImg(this,$(this))">
	              <label class="custom-file-label" for="customFile">Choose file</label>
	            </div>
			</div>
			<div class="form-group d-flex justify-content-center">
				<img src="<?php echo validate_image($_settings->info('website_logo')) ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
			</div>
			<div class="form-group">
				<label for="" class="control-label">Website Banner Image</label>
				<div class="custom-file">
	              <input type="file" class="custom-file-input rounded-circle" id="customFile" name="webbanner" onchange="displayImg2(this,$(this))">
	              <label class="custom-file-label" for="customFile">Choose file</label>
	            </div>
			</div>
			<div class="form-group d-flex justify-content-center">
				<img src="<?php echo validate_image($_settings->info('website_banner')) ?>" alt="" id="cimg2" class="img-fluid img-thumbnail">
			</div>

			</form>
		</div>
		<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-success" form="system-frm">Update</button>
				</div>
			</div>
		</div>

	</div>
</div>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function displayImg2(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg2').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$(document).ready(function(){
		 $('.summernote').summernote({
		        height: 200,
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
	})
</script>