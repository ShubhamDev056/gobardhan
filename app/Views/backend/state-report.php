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
				State Wise Report
				<a href="export-state-plant?<?=$_SERVER['QUERY_STRING'];?>"> <i class="fa fa-download pull-right"></i> </a>
			</h3>
			
		</div>
		<div class="col-lg-12" >
			<form>
				<div class="row">
					
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
						<th>State Name</th>
						<th>Yet to start</th>
						<th>Under Construction</th>
						<th>Completed</th>
						<th>Functional</th>
						<th>Total </th>
						<td>Action</td>
					</tr>
					
					<tr>
						<td>1</td>
						<td>UP</td>
						<td>10</td>
						<td>4</td>
						<td>2</td>
						<td>1</td>
						<td>17</td>
					</tr>
					
					
				</table>
			</div>
			<div class="col-md-12">
				<div class="d-md-flex justify-content-between"> 
					<div>
						<!--<a class="btn btn-success text-white mt-2"><i class="fa fa-file-excel-o"></i> Export to Excel</a>-->
					</div>
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