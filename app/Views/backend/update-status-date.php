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

.svdate{
	background-color: lightgreen;
}

</style>

<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">
				Update Date
			</h3>
		</div>
		<div class="col-lg-12" >
			<form>
				<div class="row">
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
					<div class="col-sm-2">
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
					
					<div class="col-sm-1">
						<button class="btn btn-primary " style="padding:5px;">Search</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-lg-12 col-12">
		
			
		
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr class="table-header">
						<th>#SN</th>
						<th>State</th>
						<th>District</th>
						<th>Block</th>
						<th>GP Name</th>
						<th>Village</th>
						<!--<th>Name of the Entity</th> -->
						<th>Status of the Plant </th>
						<th>Gas Production Capacity</th>
						<th>Date</th>
						<th>New Portal Date</th>
						<td>Action</td>
					</tr>
					
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
							
							$old_date = "";
							if($project['plant_status_id']=="22"){
								$old_date = $project['construction_date'];
							}
							if($project['plant_status_id']=="23"){
								$old_date = $project['proposed_date'];
							}
							
							if($project['plant_status_id']=="24" || $project['plant_status_id']=="290"){
								$old_date = $project['date_of_commissioning'];
							}
						?>
							<tr id="svrow<?=$project['project_id'];?>">
								<td><?php if(isset($_GET['page']) && $_GET['page']>1){ echo ($per_page*$_GET['page']-$per_page)+$key+1;}else{ echo $key+1;};?></td>
								<td><?=$project['state_name'];?></td>
								<td><?=$project['district_name'];?></td>
								<td><?=$project['block_name'];?></td>
								<td><?=$project['gp_name'];?></td>
								<td><?=$project['village_name'];?></td>
								<!--<td><?php //ucfirst($project['entity_name']);?></td>-->
								<td>
									<select id="pstatus<?=$project['project_id'];?>">
										<option value="">Status</option>
										<option value="22" <?php if($project['plant_status_id']==22){ echo "selected"; } ?> >Yet to start construction</option>
										<option value="23" <?php if($project['plant_status_id']==23){ echo "selected"; } ?> >Under Construction</option>
										<option value="290" <?php if($project['plant_status_id']==290){ echo "selected"; } ?> >Completed</option>
										<option value="24" <?php if($project['plant_status_id']==24){ echo "selected"; } ?> >Functional</option>
										<option value="292" <?php if(@$_REQUEST['plant_status']==292){ echo "selected"; } ?> >Temporary Nonfunctional</option>
										<option value="293" <?php if(@$_REQUEST['plant_status']==293){ echo "selected"; } ?> >Defunct</option>
									</select>
								</td>
								<td><?=$project['gas_production_capacity'];?> <?php if($project['entity_type_id']=="17"){ echo "m³/day"; }else{  echo "Tons/day"; } ?>  </td>
								<td> <input type="text" value="<?=$project['plant_status_date'];?>" placeholder="<?=$plntStatus[$project['plant_status_id']];?> Date" id="psdate<?=$project['project_id'];?>" /> </td>
								<td> <input type="text" value="<?=$old_date?>" placeholder="" data-id="<?=$project['plant_status_id'];?>" id="olddate<?=$project['project_id'];?>" /> </td>
								<td>
									<a href="javascript:" class="savedate" data-id="<?=$project['project_id'];?>" ><i class="fa fa-save badge bg-primary text-white"> </i></a>
									
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

$(".savedate").on("click", function(){
	let pid = $(this).data("id");
	let olddt = $("#olddate"+pid).data("id");
	let olddtval = $("#olddate"+pid).val();
	let psdate = $("#psdate"+pid).val();
	let pstatus = $("#pstatus"+pid).val();
	if(pid!="" & olddt!="" & olddtval!="" & psdate!="" && pstatus!=""){
		$.ajax({
			url:"<?=base_url()?>changedate",
			type:"post",
			data:{pid:pid,plant_status_id:olddt,oldDate:olddtval,psdate:psdate,pstatus:pstatus},
			success:function(res){
				let ress = JSON.parse(res);
				if(ress.status==1){
					$("#svrow"+pid).addClass('svdate');
				}
			}
		});
	}
})


</script>


<?= $this->endSection(); ?>