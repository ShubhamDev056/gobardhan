<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>


<style type="text/css">
	
	
	
</style>


<div class="candidate-section section pt-10 pb-40" style="background: #fff;opacity: 0.8;">
        <div class="container">
			
            <div class="row">
				<div class="col-sm-12">
					<a href="javascript:void(0)" onclick="window.history.back()" > <i class="fa fa-arrow-left" ></i> Back </a>
				</div>
                <div class="candidate-content col-lg-12 col-12 mb-30">
                    <h1 style="font-size:29px" >Grievance Form</h1>
                    
                </div>
			</div>
			
			<div class="row">
				<div class="col-sm-12">
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
					<form method="post" enctype="multipart/form-data" >
						<div class="row">
							<div class="form-group col-sm-6">
								<input type="text" class="form-control" placeholder="Enter Name *" id="name" name="name" value="<?=set_value('name') ?>">
							</div>
							<div class="form-group col-sm-6">
								<input type="number" class="form-control" placeholder="Enter Contact Number *" id="contact_number" name="contact_number" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?=set_value('contact_number') ?>" >
							</div>
						</div>
						
						<div class="row">
							<div class="form-group col-sm-6">
								<input type="email" class="form-control" placeholder="Enter Email *" id="email" name="email" value="<?=set_value('email') ?>">
							</div>
							<div class="form-group col-sm-6">
								<select class="form-control" name="ministry">
									<option valu="">Select Ministry *  </option>
									<option value="dahd" <?php if(set_value('ministry')=='dahd'){ echo "selected"; } ?> >DAHD </option>
									<option value="dafw" <?php if(set_value('ministry')=='dafw'){ echo "selected"; } ?> >DA&FW  </option>
									<option value="mnre" <?php if(set_value('ministry')=='mnre'){ echo "selected"; } ?> >MNRE </option>
									<option value="mohua" <?php if(set_value('ministry')=='mohua'){ echo "selected"; } ?> >MoHUA </option>
									<option value="mopng" <?php if(set_value('ministry')=='mopng'){ echo "selected"; } ?> >MoPNG </option>
									<option value="dof" <?php if(set_value('ministry')=='dof'){ echo "selected"; } ?> >DoF </option>
									<option value="ddws" <?php if(set_value('ministry')=='ddws'){ echo "selected"; } ?> >DDWS </option>
								</select>
							</div>
						</div>
						
						
						<div class="form-group">
							<textarea class="form-control" name="message" placeholder="Message *" rows="5"><?=set_value('message') ?></textarea>
						</div>
						<div class="form-group">
							<label>Upload Document (Optional)</label>
							<input type="file" class="form-control" id="grievancedocument" name="grievancedocument" accept=".jpg, .jpeg, .png, .doc, .docs, .pdf" >
						</div>
						<div class="row">
							<div class="form-group col-sm-3">
								<span id="gricaptchaImage"><?=$gcaptcha;?></span>
								<a class="btn btn-success text-white" id="gricaptchaRefresh" style="width:50%;">Refresh</a>
							</div>
							<div class="form-group col-sm-9">
								<input type="text" class="form-control" placeholder="Captcha *" name="grcaptcha">
							</div>
							
						</div>
						<div class="form-group">
							<button class="btn btn-primary pull-right" type="submit">Submit</button>
						</div>
						
					</form>
				</div>
			</div>
		
	</div>
</div>


<?= $this->endSection(); ?>




<?=$this->section('script');?>

<script>
$(document).ready(function(){
	$("#gricaptchaRefresh").on("click", function(){
		$.ajax({
			url:"<?=base_url();?>refresh-grievancecaptcha",
			type:"GET",
			success:function(res){
				$("#gricaptchaImage").html(res);
			}
		})
	})
});
</script>

<?= $this->endSection(); ?>