<?=$this->extend('layouts/layout');?>

<?=$this->section('content');?>
	
	<style>
		input[type="date"]:not(.has-value):before{
		  color: lightgray;
		  content: attr(placeholder);
		}
		.rs-services.style5 .services-item {
			min-height: 120px;
		}
		
		.services-icon i{
		    border: 1px solid lightgreen;
			padding: 6px;
			border-radius: 50%;
			background-color: white;
		}
	</style>
	
	<!-- Services Section Start -->
	<div class="rs-services style5 pt-50 md-pt-80" style="min-height:480px;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12" >
					<h3>Details of Registration Certificate</h3>
					<form method="post" >
						<div class="row">
							<div class="col-sm-5" >
							<span> <b>Search Certificate by:</b><br>
							<?php $srchBy = set_value('searchby'); if(empty($srchBy)){ $srchBy="plant_name"; } ?>
								<!--
								<div class="form-check-inline">
								  <label class="form-check-label">
									<input type="radio" class="form-check-input" id="radio1" name="searchby" value="entity_name" <?php if($srchBy=='entity_name'){ echo "checked"; } ?> >Entity Name
								  </label>
								</div>
								-->
								<div class="form-check-inline">
								  <label class="form-check-label">
									<input type="radio" class="form-check-input" id="radio2" name="searchby" value="plant_name" <?php if($srchBy=='plant_name'){ echo "checked"; } ?> >Plant Name
								  </label>
								</div>
								<div class="form-check-inline">
								  <label class="form-check-label">
									<input type="radio" class="form-check-input" id="radio3" name="searchby" value="registration_number" <?php if(set_value('searchby')=='registration_number'){ echo "checked"; } ?> > Registration Number
								  </label>
								</div>
							</div>
							<div class="col-sm-5 text-left" >
								<div class="form-group" style="margin-top:10px;" >
									<input type="text" class="form-control" placeholder="Enter Search Text" name="searchtxt" id="searchtxt" value="<?=set_value('searchtxt') ?>" required />
								</div>
							</div>
							<div class="col-sm-2" style="margin-top:10px;">
								<button class="btn btn-success form-control">Search</button>
							</div>
						</div>
					</form>
				</div>
				
				<!-- Services Section Start -->
				<div class="rs-services style5 pt-40 md-pt-80">
					<div class="container">
						<div class="row">
							<div class="col-lg-12" >
								<h3>Download Your Certificate</h3>
							</div>
							<?php
								foreach($projects as $project){ ?>
									<div class="col-lg-4 mb-20">
										<div class="services-item">
											<div class="services-icon">
											   <a href="<?=base_url()?>public/certificate/certficate<?=$project['user_id'].$project['project_id'];?>.pdf" target="_blank" download ><i class="fa fa-download"></i></a>
											</div>
											<div class="services-content">
												<h3 class="services-title"><?=$project['project_name']?></h3>
											</div>
										</div>
									</div>
								<?php
								}
							?>
						</div> 
					</div>
				</div>
				<!-- Services Section End -->
				
			</div> 
		</div>
	</div>
	<!-- Services Section End -->
	
<?=$this->endSection(); ?>
