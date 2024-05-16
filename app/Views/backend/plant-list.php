<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>

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
</style>

<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">
				Plant List 
				<a href="export-all-projects?<?=$_SERVER['QUERY_STRING'];?>"> <i class="fa fa-download pull-right"></i> </a>
			</h3>
			
		</div>
		<div class="col-lg-12" >
			<form>
				<div class="row">
					<?php
						$slogin="4";
						if(session()->get('role_id')==1){ 
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
							<select class="form-control" name="plant_type" id="plant_type" >
								<option value="" selected>Type of the Plant</option>
								<option value="" >All</option>
								<option value="17" <?php if(@$_REQUEST['plant_type']==17){ echo "selected"; } ?> >Biogas</option>
								<option value="18" <?php if(@$_REQUEST['plant_type']==18){ echo "selected"; } ?> >CBG/ Bio CNG</option>
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<select class="form-control" name="plant_status" id="plant_status" >
								<option value="" selected>Select Status of the Plant</option>
								<option value="" >All</option>
								<option value="22" <?php if(@$_REQUEST['plant_status']==22){ echo "selected"; } ?> >Yet to start construction</option>
								<option value="23" <?php if(@$_REQUEST['plant_status']==23){ echo "selected"; } ?> >Under Construction</option>
								<option value="290" <?php if(@$_REQUEST['plant_status']==290){ echo "selected"; } ?> >Completed</option>
								<option value="24" <?php if(@$_REQUEST['plant_status']==24){ echo "selected"; } ?> >Functional</option>
								<option value="292" <?php if(@$_REQUEST['plant_status']==292){ echo "selected"; } ?> >Temporary Nonfunctional</option>
								<option value="293" <?php if(@$_REQUEST['plant_status']==293){ echo "selected"; } ?> >Defunct</option>
								
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<select class="form-control" name="completion" id="completion" >
								<option value="" selected >Completion</option>
								<option value="" >All</option>
								<option value="20" <?php if(@$_REQUEST['completion']==20){ echo "selected"; } ?> >20%</option>
								<option value="40" <?php if(@$_REQUEST['completion']==40){ echo "selected"; } ?> >40%</option>
								<option value="60" <?php if(@$_REQUEST['completion']==60){ echo "selected"; } ?> >60%</option>
								<option value="80" <?php if(@$_REQUEST['completion']==80){ echo "selected"; } ?> >80%</option>
								<option value="100" <?php if(@$_REQUEST['completion']==100){ echo "selected"; } ?> >100%</option>
								
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
										<option value="<?=$fstype['id'];?>"><?=$fstype['title'];?></option>
									<?php	
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" name="project_name" class="form-control" placeholder="Project Name" value="<?=@$_REQUEST['project_name']?>" />
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="date" name="fdate" id="fdate" class="form-control" max="<?=date('Y-m-d')?>" title="From Date" value="<?=@$_REQUEST['fdate']?>" />
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="date" name="tdate" id="tdate" class="form-control" title="To Date" value="<?=@$_REQUEST['tdate']?>" />
						</div>
					</div>
					<div class="col-sm-1">
						<button class="btn btn-success form-control">Search</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-lg-12 col-12">
		
			
		
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr class="table-header">
						<th>#SN</th>
						<th>Name of the Plant</th>
						<th>Name of the Entity</th>
						<th>Type of the Entity </th>
						<th>Type of the Plant </th>
						<th>Status of the Plant </th>
						<th>Gas Production Capacity</th>
						<th>Feedstock Capacity</th>
						<th>Bioslurry Production Capacity</th>
						<th>FOM Production Capacity</th>
						<th>LFOM Production Capacity</th>
						<th>Completion</th>
						<td>Action</td>
					</tr>
					
					<?php
						$per_page=10;
						$entTypes = [''=>'','17'=>'Biogas plant','18'=>'Compressed Bio Gas/ Bio CNG plant'];
						$entityTypes = [''=>'','0'=>'','1'=>'Government including Co-operatives','2'=>'Private'];
						$plntStatus = [''=>'','22'=>'Yet to start construction','23'=>'Under Construction','24'=>'Functional','290'=>'Completed','292'=>'Temporary Nonfunctional','293'=>'Defunct'];
						foreach($projects as  $key=>$project){ 
							$solidUnit = 'Tons/day';
							$liquidUnit = 'KLD';
							if($project['entity_type_id']=="17"){
								$solidUnit='Kg/day';
								$liquidUnit='Liters/day'; 
							} 
						?>
							<tr>
								<td><?php if(isset($_GET['page']) && $_GET['page']>1){ echo ($per_page*$_GET['page']-$per_page)+$key+1;}else{ echo $key+1;};?></td>
								<td><?=$project['project_name'];?></td>
								<td><?=ucfirst($project['entity_name']);?></td>
								<td><?=$entityTypes[$project['entity_type']];?></td>
								<td><?=$entTypes[$project['entity_type_id']];?></td>
								<td><?=$plntStatus[$project['plant_status_id']];?></td>
								<td><?=$project['gas_production_capacity'];?> <?php if($project['entity_type_id']=="17"){ echo "m³/day"; }else{  echo "Tons/day"; } ?>  </td>
								<td><?=$project['solid_feedstock_capacity'];?>  <?=$solidUnit;?> </td>
								<td><?=$project['bio_slurry_output'];?> <?=$liquidUnit;?> </td>
								<td><?=$project['FOM_output'];?> <?=$solidUnit;?> </td>
								<td><?=$project['LFOM_output'];?> <?=$liquidUnit;?> </td>
								<td>
									<div class="progress">
										<div class="progress-bar progress-bar-striped progress-bar-animated" style="width:<?=$project['form_completion'];?>%"><?=$project['form_completion'];?>%</div>
									</div>
								</td>
								<td>
									<a href="<?=base_url()?>project-details/<?=$project['project_id'];?>" ><i class="fa fa-eye badge bg-primary text-white"> </i></a>
									<a href="<?=base_url()?>project-edit/<?=$project['project_id'];?>" ><i class="fa fa-pencil badge bg-primary text-white"> </i> </a>
									<a href="<?=base_url()?>project-delete/<?=$project['project_id'];?>" onclick=" return confirm('Are you sure to delete?') " ><i class="fa fa-trash badge bg-danger text-white"> </i></a>
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

<script>
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

$("#fdate").on("change", function(){
	let fd = $(this).val();
	$("#tdate").attr('min',fd);
})
</script>


<?= $this->endSection(); ?>