<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>

<link rel="stylesheet" href="<?=base_url();?>assets/css/plugins.css">
<link rel="stylesheet" href="<?=base_url();?>assets/css/style.css">
<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap-multiselect.css">

<style>
.table-header{
	 background-color: #296fa1;
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
.fa-download{
	border-radius: 50%;
    border: 1px solid;
    padding: 5px;
    font-size: 20px;
    color: black;
}
.SumoSelect > .CaptionCont > span.placeholder {
    color: #524a4a;
}


  
</style>
<?php
if(!isset($_REQUEST['ministry']) || empty($_REQUEST['ministry'])){
	$_REQUEST['ministry']=array();
}


?>

<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">
				Plant List (Ministry)
				<a href="export-all-projects?m=ministry&<?=$_SERVER['QUERY_STRING'];?>" style="float:right;"> <i class="fa fa-download float-end"></i> </a>
			</h3>
		</div>
		<div class="col-lg-12" >
			<form>
				<div class="row">
					<?php
						$slogin="4";
						if(session()->get('role_id')==1 || session()->get('role_id')==4){ 
						$slogin="2";
					?>
					
						<div class="col-sm-2">
							<div class="form-group">
								<select class="form-control" name="state" id="state"  >
									<option value="">State</option>
									<?php
										foreach($states as $state){ ?>
											<option value="<?=$state['state_code'];?>" <?php if(@$_REQUEST['state']==$state['state_code']){ echo "selected"; } ?> ><?=$state['state_name'];?></option>
										<?php	
										}
									?>
								</select>
							</div>
						</div>
					<?php } ?>
					<div class="col-sm-<?=$slogin?>">
						<div class="form-group">
							<select class="form-control" name="district" id="district" >
								<option value="">District</option>
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
							<select class="form-control" name="entity_type" id="entity_type" >
								<option value="" selected >Type of Entity</option>
								<option value="" >All</option>
								<option value="1" <?php if(@$_REQUEST['entity_type']==1){ echo "selected"; } ?> >Government including Co-operatives</option>
								<option value="2" <?php if(@$_REQUEST['entity_type']==2){ echo "selected"; } ?> >Private</option>
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<select class="form-control" name="sub_entity_type" id="sub_entity_type" >
								<option value="" selected >Sub-Type of Entity</option>
								<?php 
									foreach($subTypes as $subType){ ?>
										<option value="<?=$subType['id']?>" <?php if($subType['id']==@$_REQUEST['sub_entity_type']){ echo "selected"; } ?>  ><?=$subType['title']?></option>
									<?php	
									}
								?>
							</select>
						</div>
					</div>
					
					<div class="col-sm-2">
						<div class="form-group">
							<select class="form-control" name="plant_type" id="plant_type" >
								<option value="" selected >Type of the Plant</option>
								<option value="" >All</option>
								<option value="17" <?php if(@$_REQUEST['plant_type']==17){ echo "selected"; } ?> >Biogas</option>
								<option value="18" <?php if(@$_REQUEST['plant_type']==18){ echo "selected"; } ?> >CBG/ Bio CNG</option>
								
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<select class="form-control" name="plant_status" id="plant_status" >
								<option value="" selected >Status of the Plant</option>
								<option value="" >All</option>
								<option value="22" <?php if(@$_REQUEST['plant_status']==22){ echo "selected"; } ?> >Yet to start construction</option>
								<option value="23" <?php if(@$_REQUEST['plant_status']==23){ echo "selected"; } ?> >Under Construction</option>
								<option value="290" <?php if(@$_REQUEST['plant_status']==290){ echo "selected"; } ?> >Completed</option>
								<option value="24" <?php if(@$_REQUEST['plant_status']==24){ echo "selected"; } ?> >Functional</option>
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<select class="form-control check_multiselect " name="ministry[]" id="ministry" multiple placeholder="Ministry" >
								<option value="253" <?php if(in_array(253,@$_REQUEST['ministry'])){ echo "selected"; } ?> >DAHD</option>
								<option value="254" <?php if(in_array(254,@$_REQUEST['ministry'])){ echo "selected"; } ?> >DA&FW </option>
								<option value="256" <?php if(in_array(256,@$_REQUEST['ministry'])){ echo "selected"; } ?> >MNRE</option>
								<option value="257" <?php if(in_array(257,@$_REQUEST['ministry'])){ echo "selected"; } ?> >MoHUA</option>
								<option value="258" <?php if(in_array(258,@$_REQUEST['ministry'])){ echo "selected"; } ?> >MoPNG</option>
								<option value="259" <?php if(in_array(259,@$_REQUEST['ministry'])){ echo "selected"; } ?> >DoF</option>
								<option value="255" <?php if(in_array(255,@$_REQUEST['ministry'])){ echo "selected"; } ?> >DDWS</option>
								<option value="260" <?php if(in_array(260,@$_REQUEST['ministry'])){ echo "selected"; } ?> >Others</option>
								
							</select>
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							<select class="form-control" name="bnf_status" id="bnf_status" >
								<option value="" selected >Status</option>
								<option value="" >All</option>
								<option value="applied" <?php if(@$_REQUEST['bnf_status']=="applied"){ echo "selected"; } ?> >Applied</option>
								<option value="availed" <?php if(@$_REQUEST['bnf_status']=="availed"){ echo "selected"; } ?> >Availed</option>
								<option value="required" <?php if(@$_REQUEST['bnf_status']=="required"){ echo "selected"; } ?> >Required</option>
								
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<select class="form-control" name="fstype" id="fstype" >
								<option value="" selected >Feedstock Type</option>
								<option value="" >All</option>
								<?php
									foreach($fstypes as $fstype){ ?>
										<option value="<?=$fstype['id'];?>" <?php if($fstype['id']==@$_REQUEST['fstype']){ echo "selected"; } ?> ><?=$fstype['title'];?></option>
									<?php	
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<select class="form-control" name="pt_location" id="pt_location" >
								<option value="" selected >Plant Location</option>
								<option value="" >All</option>
								<option value="82" <?php if(@$_REQUEST['pt_location']=="82"){ echo "selected"; } ?> >Urban</option>
								<option value="83" <?php if(@$_REQUEST['pt_location']=="83"){ echo "selected"; } ?> >Rural</option>
								<option value="224" <?php if(@$_REQUEST['pt_location']=="224"){ echo "selected"; } ?>  >Industrial Area</option>
								
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="date" name="fdate" id="fdate" max="<?=date('Y-m-d')?>" class="form-control" title="Plant date" value="<?=@$_REQUEST['fdate'];?>" />
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="date" name="todate" id="todate" class="form-control" title="Plant date" value="<?=@$_REQUEST['todate'];?>" />
						</div>
					</div>
					
					<div class="col-sm-1">
						<button class="btn btn-primary " style="padding:5px;">Search</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-lg-12 col-12">
		
			
		
			<div class="table-responsive">
				<table class="table table-bordered fixedTable">
					<thead>
						<tr class="table-header">
							<th>#SN</th>
							<th>State</th>
							<th>District</th>
							<!--<th>Block</th>
							<th>GP Name</th>
							<th>Village</th>-->
							<th>Name of the Plant</th>
							<!--<th>Name of the Entity</th>
							<th>Type of the Entity </th>
							<th>Type of the Plant </th> -->
							<th>Status of the Plant </th>
							<th style="white-space: nowrap;">Status date </th>
							<th>Gas Production Capacity</th>
							<th>Feedstock Capacity</th>
							<th>Bioslurry Production Capacity</th>
							<th>FOM Production Capacity</th>
							<th>LFOM Production Capacity</th>
							<td>Action</td>
						</tr>
					</thead>
					<?php
						$per_page=10;
						$entTypes = [''=>'','17'=>'Biogas plant operator','18'=>'Compressed Bio Gas/ Bio CNG plant operator'];
						$entityTypes = [''=>'','0'=>'','1'=>'Government including Co-operatives','2'=>'Private'];
						$plntStatus = [''=>'','22'=>'Yet to start construction','23'=>'Under Construction','24'=>'Functional','290'=>'Completed','292'=>'Temporary Nonfunctional','293'=>'Defunct'];
						foreach($projects as $key=>$project){ 
							$solidUnit = 'Tons/day';
							$liquidUnit = 'KLD';
							if($project['entity_type_id']=="17"){
								$solidUnit='Kg/day';
								$liquidUnit='Liters/day';
							} 
						?>
							<tr>
								<td><?php if(isset($_GET['page']) && $_GET['page']>1){ echo ($per_page*$_GET['page']-$per_page)+$key+1;}else{ echo $key+1;};?></td>
								<td><?=$project['state_name'];?></td>
								<td><?=$project['district_name'];?></td>
								<?php /* ?>
								<td><?=$project['block_name'];?></td>
								<td><?=$project['gp_name'];?></td>
								<td><?=$project['village_name'];?></td>
								<?php */ ?>
								
								<td><?=$project['project_name'];?></td>
								
								<td><?=$plntStatus[$project['plant_status_id']];?></td>
								<td><?php if(!empty($project['plant_status_date'])){ echo date('d-m-Y', strtotime($project['plant_status_date'])); } ?></td>
								<td><?=$project['gas_production_capacity'];?> <?php if($project['entity_type_id']=="17"){ echo "m³/day"; }else{  echo "Tons/day"; } ?>  </td>
								<td><?=$project['solid_feedstock_capacity']?>  <?=$solidUnit;?> </td>
								<td><?=$project['bio_slurry_output'];?> <?=$liquidUnit;?> </td>
								<td><?=$project['FOM_output'];?> <?=$solidUnit;?> </td>
								<td><?=$project['LFOM_output'];?> <?=$liquidUnit;?> </td>
								<td>
									<a href="<?=base_url()?>project-details/<?=$project['project_id'];?>" ><i class="fa fa-eye badge bg-primary text-white"> </i></a>
									<?php 
										if(session()->get('role_id')==1){ ?>
											<a href="<?=base_url()?>project-delete/<?=$project['project_id'];?>" onclick=" return confirm('Are you sure to delete?') " ><i class="fa fa-trash badge bg-danger text-white"> </i></a>
										<?php	
										}
									?>
								</td>
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

<?= $this->endSection(); ?>




<?=$this->section('script');?>
 
<script src="<?=base_url();?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/plugins.js"></script>
<script src="<?=base_url();?>assets/js/main.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap-multiselect.js"></script>

<script>

$("#fdate").on("change", function(){
	let fdt = $(this).val();
	$("#todate").attr('min',fdt);
	$("#todate").attr("required", false);
	if(fdt!=""){
		$("#todate").attr("required", true);
	}
});


$("#state").on("change", function(){
	let scode = $(this).val();
	if(scode!=""){
		$.ajax({
			url:"<?=base_url()?>get-districts",
			type:"post",
			data:{scode:scode},
			success:function(res){
				$("#district").html(res);
			}
		});
	}else{
		$("#district").html('<option value="">Select District</option>');
	}
});

$("#entity_type").on("change", function(){
	let ecode = $(this).val();
	if(ecode!=""){
		$.ajax({
			url:"<?=base_url()?>get-subtype",
			type:"post",
			data:{entityType:ecode},
			success:function(res){
				$("#sub_entity_type").html(res);
			}
		});
	}
});
</script>


<?= $this->endSection(); ?>