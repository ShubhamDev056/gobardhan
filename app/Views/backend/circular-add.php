<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>

<link rel="stylesheet" href="<?=base_url();?>assets/css/plugins.css">
<link rel="stylesheet" href="<?=base_url();?>assets/css/style.css">
<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap-multiselect.css">

<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-lg-3"></div>
		<div class="col-lg-6">
			<div class="text-muted">
				<h3 style="background-color: lightblue; padding: 7px;font-weight: bold; ">
					Add Circular
				</h3>
			</div>
			
			<form method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label text-capitalize text-muted" >Ministry <span class="require">*</span> </label>
					<select class="form-control" name="ministry_id" required >
						<option value="" selected hidden >Select Ministry</option>
						<?php 
							$ministries = allOptions('ministry');
							foreach($ministries as $key=>$mnstry){ if(empty($mnstry)){ continue; }?>
								<option value="<?=$key;?>" <?php if($key==@$_GET['ministry_id']){ echo "selected"; } ?> ><?=$mnstry;?></option>
							<?php }
						?>
					</select>
				</div>
				<div class="mb-3">
					<label class="form-label text-capitalize text-muted" >Title <span class="require">*</span> </label>
					<input class="form-control text-muted" type="text" name="title" placeholder="Title" required />
				</div>
				<div class="mb-3">
					<label class="form-label text-capitalize text-muted" >Circular Date <span class="require">*</span> </label>
					<input class="form-control text-muted" type="date" name="circular_date" required />
				</div>
				
				<div class="mb-3">
					<label class="form-label text-capitalize text-muted" >Document <span class="require">*</span> </label>
					<input class="form-control text-muted" type="file" name="document" placeholder="document" accept=".pdf, .doc, .docs" required />
				</div>
				<div class="">
					<button type="submit" class="btn btn-primary w-25 float-end">Submit</button>
				</div>
			</form>
			
		</div>
		<div class="col-lg-3">
			<?php 
				if(isset($errors)){ ?>
					<div class="alert alert-success">
						<ol>
						  <?php 
							foreach($errors as $error){
								echo '<li>'.$error.'</li>';
							}
						  ?>
					  </ol>
					</div>
				<?php
				}
			?>
		</div>
	</div>
	
</div>

<?= $this->endSection(); ?>




<?=$this->section('script');?>
 
<script src="<?=base_url();?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/plugins.js"></script>
<script src="<?=base_url();?>assets/js/main.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap-multiselect.js"></script>

<script>


</script>


<?= $this->endSection(); ?>