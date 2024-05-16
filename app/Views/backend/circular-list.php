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

</style>


<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">
				Circular List 
				<a href="add-circular" class="btn btn-primary btn-sm pull-right mt--5" >Add New</a>
			</h3>
		</div>
		<div class="col-lg-12" >
			<form>
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<select class="form-control" name="ministry_id">
								<option value="" selected hidden >Select Ministry</option>
								<?php 
									foreach(allOptions('ministry') as $k=>$ministry){ if(empty($ministry)){ continue; } ?>
										<option value="<?=$k;?>"><?=$ministry;?></option>
									<?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<input type="text" name="title" class="form-control" placeholder="Circular Title" value="<?=@$_REQUEST['title'];?>" />
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
						<th>Date</th>
						<th>PDF</th>
						<th>Ministry</th>
						<th>Title</th>
						<th>Action</th>
					</tr>
					
					<?php 
						foreach($circulars as $key=>$circular){ ?>
							<tr>
								<td><?=$key+1;?></th>
								<td><?=date("d-M-Y", strtotime($circular['circular_date']));?></td>
								<td>
									<a href="<?=base_url()?>whats-new/<?=$circular['file_path'];?>" target="_blank">
										<i class="fa fa-file-pdf-o"></i>
									</a>
								</td>
								<td><?php echo getNameFromId('ministry', $circular['ministry_id']); ?></td>
								<td><?=$circular['title'];?></td>
								<td>
									<a href="<?=base_url()?>circular-delete/<?=$circular['important_circular_id'];?>" onclick=" return confirm('Are you sure to delete?') " ><i class="fa fa-trash badge bg-danger text-white"> </i></a>
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


</script>


<?= $this->endSection(); ?>