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
												<option value="<?=$state['LGDStateCode'];?>" <?php if(@$_REQUEST['state']==$state['LGDStateCode']){ echo "selected"; } ?> ><?=$state['StateName'];?></option>
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
												<option value="<?=$district['LGDDistrictCode'];?>" <?php if(@$_REQUEST['district']==$district['LGDDistrictCode']){ echo "selected"; } ?> ><?=$district['DistrictName'];?></option>
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
											foreach($blocks as $block){ ?>
												<option value="<?=$block['LGDBlockCode'];?>" <?php if(@$_REQUEST['block']==$block['LGDBlockCode']){ echo "selected"; } ?> ><?=$block['BlockName'];?></option>
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
											foreach($gps as $gp){ ?>
												<option value="<?=$gp['LGDGramPanchayatCode'];?>" <?php if(@$_REQUEST['gp']==$gp['LGDGramPanchayatCode']){ echo "selected"; } ?> ><?=$gp['GrampanchayatName'];?></option>
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
											foreach($villages as $village){ ?>
												<option value="<?=$village['LGDVillageCode'];?>" <?php if(@$_REQUEST['village']==$village['LGDVillageCode']){ echo "selected"; } ?> ><?=$village['VillageName'];?></option>
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
							<th>State</th>
							<th>District</th>
							<th>Block </th>
							<th>Gram Panchayat </th>
							<th>Village</th>
						</tr>
						
						<?php 
							$entTypes = [''=>'','17'=>'Biogas plant operator','18'=>'Compressed Bio Gas/ Bio CNG plant operator'];
							$plntStatus = [''=>'','22'=>'Yet to start construction','23'=>'Under Construction','24'=>'Functional','290'=>'Completed','292'=>'Temporary Nonfunctional','293'=>'Defunct'];
							if(count($locateDetails)>0){ 
								foreach($locateDetails as $key=>$locateDetail){
									
								?>
									<tr>
										<td><?=$locateDetail['StateName'];?> (<?=$locateDetail['LGDStateCode'];?>)</td>
										<td><?=$locateDetail['DistrictName'];?> (<?=$locateDetail['LGDDistrictCode'];?>)</td>
										<td><?=$locateDetail['BlockName'];?> (<?=$locateDetail['LGDBlockCode'];?>)</td>
										<td><?=$locateDetail['GrampanchayatName'];?> (<?=$locateDetail['LGDGramPanchayatCode'];?>)</td>
										<td><?=$locateDetail['VillageName'];?> (<?=$locateDetail['LGDVillageCode'];?>)</td>
										
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
	$('#district').val('');
	$('#block').val('');
	$('#gp').val('');
	$('#village').val('');
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
	$('#block').val('');
	$('#gp').val('');
	$('#village').val('');
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
	$('#gp').val('');
	$('#village').val('');
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
	$('#village').val('');
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