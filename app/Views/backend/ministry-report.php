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
				Ministry Report
				<!--<a href="export-state-plant?<?=$_SERVER['QUERY_STRING'];?>"> <i class="fa fa-download pull-right"></i> </a>-->
			</h3>
			
		</div>
		<div class="col-lg-12" >
			<form>
				<div class="row">
					<div class="col-sm-3">
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
					<div class="col-sm-3">
						<div class="form-group">
							<select class="form-control" name="plant_type" id="plant_type" >
								<option value="">Select Type of the Plant</option>
								<option value="" selected >All</option>
								<option value="17" <?php if(@$_REQUEST['plant_type']==17){ echo "selected"; } ?> >Biogas</option>
								<option value="18" <?php if(@$_REQUEST['plant_type']==18){ echo "selected"; } ?> >CBG/ Bio CNG</option>
							</select>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<select class="form-control" name="plant_status" id="plant_status" >
								<option value="">Select Status of the Plant</option>
								<option value="" selected >All</option>
								<option value="22" <?php if(@$_REQUEST['plant_status']==22){ echo "selected"; } ?> >Yet to start construction</option>
								<option value="23" <?php if(@$_REQUEST['plant_status']==23){ echo "selected"; } ?> >Under Construction</option>
								<option value="290" <?php if(@$_REQUEST['plant_status']==290){ echo "selected"; } ?> >Completed</option>
								<option value="24" <?php if(@$_REQUEST['plant_status']==24){ echo "selected"; } ?> >Functional</option>
								<option value="292" <?php if(@$_REQUEST['plant_status']==292){ echo "selected"; } ?> >Temporary Nonfunctional</option>
								<option value="293" <?php if(@$_REQUEST['plant_status']==293){ echo "selected"; } ?> >Defunct</option>
							</select>
						</div>
					</div>
					
					<div class="col-sm-3">
						<button class="btn btn-success form-control">Search</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-lg-12 col-12">
		
			<div class="table-responsive">
				<table class="table table-bordered" style="background-color:aliceblue;">
					<tr class="table-header">
						<th rowspan="2" >#SN</th>
						<th rowspan="2" >Project Name</th>
						<th rowspan="2" >Entity Name</th>
						<th rowspan="2" >Gas Production Capacity</th>
						<th rowspan="2" >Plant Status</th>
						<th colspan="8" >Benefits</th>
						
					</tr>
					
					<tr class="table-header">
						<td title="Interest subvention (Animal Husbandry Infrastructure Development Fund (AHIDF) - Department of Animal Husbandry & Dairying (DAHD)" >DAHD</td>
						<td title="Interest subvention (Agri Infrastructure Fund (AIF)- Department of Agriculture & Farmers Welfare (DA&FW)" > DA&FW </td>
						<td title="Central Finance Assistance (Waste to Energy- Ministry of New and Renewable Energy (MNRE)" >MNRE</td>
						<td title="Swachh Bharat Mission - Urban (Additional Central Assistance)- Ministry of Housing and Urban Affairs (MoHUA)" >MoHUA</td>
						<td title="Compressed Bio Gas offtake (Sustainable Alternative Towards Affordable Transportation (SATAT)- Ministry of Petroleum and Natural Gas (MoPNG))" >MoPNG</td> 
						<td title="Market Development Assistance (MDA) - Department of Fertilizer (DoF)" >DoF</td>
						<td title="Others" >Others</td>
					</tr>
					<?php
						$per_page=10;
						$plntStatus = [''=>'','22'=>'Yet to start construction','23'=>'Under Construction','24'=>'Functional','290'=>'Completed','292'=>'Temporary Nonfunctional','293'=>'Defunct'];
						foreach($projects as $key=>$project){ ?>
						<tr>
							<td><?php if(isset($_GET['page']) && $_GET['page']>1){ echo ($per_page*$_GET['page']-$per_page)+$key+1;}else{ echo $key+1;};?></td>
							<td><?=$project['project_name'];?></td>
							<td><?=$project['entity_name'];?></td>
							<td><?=$project['gas_production_capacity'];?> <?=$project['gpc_unit'];?></td>
							<td><?=$plntStatus[$project['plant_status_id']];?></td>
							<td><?=$project['dahdStatus'];?></td>
							<td><?=$project['aifStatus'];?></td>
							<td><?=$project['mnreStatus'];?></td>
							<td><?=$project['mohuaStatus'];?></td>
							<td><?=$project['mopngStatus'];?></td>
							<td><?=$project['mdaStatus'];?></td>
							<td><?=$project['otherStatus'];?></td>
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