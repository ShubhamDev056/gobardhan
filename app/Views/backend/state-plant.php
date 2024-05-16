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
				State Plant
				<a href="export-state-plant?<?=$_SERVER['QUERY_STRING'];?>"> <i class="fa fa-download pull-right"></i> </a>
			</h3>
			
		</div>
		<div class="col-lg-12" >
			<form>
				<div class="row">
					
					<div class="col-sm-3">
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
							<select class="form-control" name="entity_type" id="entity_type" >
								<option value="">Select Type of Entity</option>
								<option value="" selected >All</option>
								<option value="1" <?php if(@$_REQUEST['entity_type']==1){ echo "selected"; } ?> >Government including Co-operatives</option>
								<option value="2" <?php if(@$_REQUEST['entity_type']==2){ echo "selected"; } ?> >Private</option>
								
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<select class="form-control" name="plant_type" id="plant_type" >
								<option value="">Select Type of the Plant</option>
								<option value="" selected >All</option>
								<option value="17" <?php if(@$_REQUEST['plant_type']==17){ echo "selected"; } ?> >Biogas</option>
								<option value="18" <?php if(@$_REQUEST['plant_type']==18){ echo "selected"; } ?> >CBG/ Bio CNG</option>
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<select class="form-control" name="plant_status" id="plant_status" >
								<option value="">Select Status of the Plant</option>
								<option value="" selected >All</option>
								<option value="22" <?php if(@$_REQUEST['plant_status']==22){ echo "selected"; } ?> >Yet to start construction</option>
								<option value="23" <?php if(@$_REQUEST['plant_status']==23){ echo "selected"; } ?> >Under Construction</option>
								<option value="290" <?php if(@$_REQUEST['plant_status']==290){ echo "selected"; } ?> >Completed</option>
								<option value="24" <?php if(@$_REQUEST['plant_status']==24){ echo "selected"; } ?> >Functional</option>
								
							</select>
						</div>
					</div>
					
					<div class="col-sm-2">
						<div class="form-group">
							<input type="date" name="created_at" class="form-control" placeholder="" value="<?=@$_REQUEST['created_at']?>" />
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
				<table class="table table-bordered" style="background-color:aliceblue;">
					<tr class="table-header">
						<th>#SN</th>
						<th>District Name</th>
						<th>Block Name</th>
						<th>GP Name</th>
						<th>Village Name</th>
						<th>Name of the Plant</th>
						<th>Name of the Entity</th>
						<th>Type of the Entity</th>
						<th>Type of the Plant </th>
						<th>Status of the Plant </th>
						<th>Gas Production Capacity</th>
						<th>Feedstock Capacity</th>
						<th>Bioslurry Production Capacity</th>
						<th>FOM Production Capacity</th>
						<th>LFOM Production Capacity</th>
						<td>Action</td>
					</tr>
					
					<?php
						$per_page=10;
						$entTypes = [''=>'','0'=>'','17'=>'Biogas plant operator','18'=>'Compressed Bio Gas/ Bio CNG plant operator'];
						$entityTypes = [''=>'','0'=>'','1'=>'Government including Co-operatives','2'=>'Private'];
						$plntStatus = [''=>'','0'=>'','22'=>'Yet to start construction','23'=>'Under Construction','24'=>'Functional','290'=>'Completed'];
						foreach($reports as $key=>$report){ 
							$unt= "Tons/day";
							$solidUnit = 'Tons/day';
							$liquidUnit = 'KLD';
							if($report['entity_type_id']=="17"){
								$unt= "m³/day"; 
								$solidUnit='Kg/day';
								$liquidUnit='Liters/day';
							}
							
						?>
							<tr>
								<td><?php if(isset($_GET['page']) && $_GET['page']>1){ echo ($per_page*$_GET['page']-$per_page)+$key+1;}else{ echo $key+1;};?></td>
								<td><?=$report['district_name']?></td>
								<td><?=$report['block_name']?></td>
								<td><?=$report['gp_name']?></td>
								<td><?=$report['village_name']?></td>
								<td><?=$report['project_name']?></td>
								<td><?=$report['entity_name']?></td>
								<td><?=$entityTypes[$report['entity_type']];?></td>
								<td><?=$entTypes[$report['entity_type_id']];?></td>
								<td><?=$plntStatus[$report['plant_status_id']];?></td>
								<td><?=$report['gas_production_capacity'].' '.$unt;?></td>
								<td><?=$report['solid_feedstock_capacity'].' '.$solidUnit;?></td>
								<td><?=$report['bio_slurry_output'].' '.$liquidUnit;?></td>
								<td><?=$report['FOM_output'].' '.$solidUnit;?></td>
								<td><?=$report['LFOM_output'].' '.$liquidUnit;?></td>
								<td>
									<a href="<?=base_url()?>project-details/<?=$report['project_id'];?>" ><i class="fa fa-eye badge bg-primary text-white"> </i></a>
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

</script>


<?= $this->endSection(); ?>