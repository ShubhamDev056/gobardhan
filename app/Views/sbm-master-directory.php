<?=$this->extend('layouts/layout');?>

<?=$this->section('content');?>
	<style>
	.table-header {
		background-color: #195c10;
		color: white;
		font-weight: bold;
	}
	.pagination{
		margin:10px 0;
		margin-bottom:15px;
	}
	.pagination li{
	}
	.pagination li a {
		display: inline-block;
		background: #919191;
		padding: 8px 15px;
		margin: 1px;
		color: white;
		border-radius:5px;
		transition:all .3s ease-in-out;
	}
	.pagination li a:hover {
	    background-color: #28a745;
	}
	.pagination li:first-child a {
		margin-left: 0px;
	}
	.pagination li:last-child a {
		margin-right: 0px;
	}
	.pagination li.active a {
		background: #4caf50;
	}
	
	</style>
	<!-- Services Section Start -->
	<div class="rs-services style5 pt-50 md-pt-80" style="min-height:480px;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12" >
					<h3>SBM Master Directory Report</h3>
					<form>
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<select class="form-control" name="state" id="state" required >
										<option value="">Select State</option>
										<?php
											foreach($states as $state){ ?>
												<option value="<?=$state['state_code'];?>" <?php if(@$_REQUEST['state']==$state['state_code']){ echo "selected"; } ?> ><?=$state['state_name'];?></option>
											<?php	
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<select class="form-control" name="district" id="district" >
										<option value="">Select District</option>
										<?php
											foreach($districts as $district){ ?>
												<option value="<?=$district['district_code'];?>" <?php if(@$_REQUEST['district']==$district['district_code']){ echo "selected"; } ?> ><?=$district['district_name'];?></option>
											<?php	
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<select class="form-control" name="block" id="block" >
										<option value="">Select Block</option>
										<?php
											foreach($districts as $district){ ?>
												<option value="<?=$district['district_code'];?>" <?php if(@$_REQUEST['district']==$district['district_code']){ echo "selected"; } ?> ><?=$district['district_name'];?></option>
											<?php	
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<select class="form-control" name="gp" id="gp" >
										<option value="">Select GP</option>
										<?php
											foreach($districts as $district){ ?>
												<option value="<?=$district['district_code'];?>" <?php if(@$_REQUEST['district']==$district['district_code']){ echo "selected"; } ?> ><?=$district['district_name'];?></option>
											<?php	
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<select class="form-control" name="village" id="village" >
										<option value="">Select Village</option>
										<?php
											foreach($districts as $district){ ?>
												<option value="<?=$district['district_code'];?>" <?php if(@$_REQUEST['district']==$district['district_code']){ echo "selected"; } ?> ><?=$district['district_name'];?></option>
											<?php	
											}
										?>
									</select>
								</div>
							</div>
							
							<div class="col-sm-2">
								<button class="btn btn-success form-control">Search</button>
							</div>
						</div>
					</form>
				</div>
				
				<div class="col-sm-12 table-responsive">
					<table class="table table-bordered">
						<tr class="table-header">
							<th>Name of the Plant</th>
							<th>Name of the Entity</th>
							<th>Type of the Plant </th>
							<th>Status of the Plant </th>
							<th>Gas Production Capacity</th>
							<th>Feedstock Capacity</th>
							<th>Bioslurry Production Capacity</th>
							<th>FOM Production Capacity</th>
							<th>LFOM Production Capacity</th>
							<!--<th>Location Detail</th>-->
						</tr>
						
						<?php 
							$entTypes = [''=>'','17'=>'Biogas plant operator','18'=>'Compressed Bio Gas/ Bio CNG plant operator'];
							$plntStatus = [''=>'','22'=>'Yet to start construction','23'=>'Under Construction','24'=>'Functional','290'=>'Completed','292'=>'Temporary Nonfunctional','293'=>'Defunct'];
							if(count($locateDetails)>0){ 
								foreach($locateDetails as $key=>$locateDetail){
									$solidUnit = 'Tons/day';
									$liquidUnit = 'KLD';
									if($locateDetail['entity_type_id']=="17"){
										$solidUnit='Kg/day';
										$liquidUnit='Liters/day';
									}
									
								?>
									<tr>
										<td><?=$locateDetail['project_name'];?></td>
										<td><?=$locateDetail['entity_name'];?></td>
										<td><?=$entTypes[$locateDetail['entity_type_id']];?></td>
										<td><?=$plntStatus[$locateDetail['plant_status_id']];?></td>
										<td><?=$locateDetail['gas_production_capacity'];?> <?php if($locateDetail['entity_type_id']=="17"){ echo "m³/day"; }else{  echo "Tons/day"; } ?>  </td>
										<td><?=$locateDetail['solid_feedstock_capacity']+$locateDetail['liquid_feedstock_capacity'];?>  <?=$solidUnit;?> </td>
										<td><?=$locateDetail['bio_slurry_output'];?> <?=$liquidUnit;?> </td>
										<td><?=$locateDetail['FOM_output'];?> <?=$solidUnit;?> </td>
										<td><?=$locateDetail['LFOM_output'];?> <?=$liquidUnit;?> </td>
										<!--<td><?=$locateDetail['block_id'].$locateDetail['village_id'].$locateDetail['street_area_address'];?></td>-->
									</tr>
								<?php
								}
							}else{ ?>
								<tr>
									<td colspan="11" class="text-center" >Records Not Found</td>
								</tr>
							<?php	
							}
						?>
					</table>
					
				</div>
				<div class="col-md-12">
					<div class="d-md-flex justify-content-between"> 
						<div>
							<!--<a class="btn btn-success text-white mt-2"><i class="fa fa-file-excel-o"></i> Export to Excel</a>-->
						</div>
						<?php if($pager!=""){ echo $pager->links(); } ?>
					</div>
				</div>
			</div> 
		</div>
	</div>
	<!-- Services Section End -->
	
<?=$this->endSection(); ?>

<?=$this->section('script');?>

<script>
$("#state").on("change", function(){
	let s = $(this).val();
	if(s!=""){
		$.ajax({
			url:"<?=base_url()?>/get-districts-data",
			type:"post",
			data:{scode:s},
			success:function(res){
				$("#district").html(res);
			}
		});
	}
	
});

$("#district").on("change", function(){
	let s = $(this).val();
	if(s!=""){
		$.ajax({
			url:"<?=base_url()?>/get-blocks-data",
			type:"post",
			data:{dcode:s},
			success:function(res){
				$("#block").html(res);
			}
		});
	}
	
});

$("#block").on("change", function(){
	let s = $(this).val();
	if(s!=""){
		$.ajax({
			url:"<?=base_url()?>/get-grampanchayats-data",
			type:"post",
			data:{bcode:s},
			success:function(res){
				$("#gp").html(res);
			}
		});
	}
	
});

$("#gp").on("change", function(){
	let s = $(this).val();
	if(s!=""){
		$.ajax({
			url:"<?=base_url()?>/get-villages-data",
			type:"post",
			data:{gcode:s},
			success:function(res){
				$("#village").html(res);
			}
		});
	}
	
});


</script>

<?= $this->endSection(); ?>