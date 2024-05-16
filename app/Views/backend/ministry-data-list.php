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

<!--
<div id="pre-load" class="loading-indicator">
   <div id="loader" class="loader">
	   <div class="loader-container">
		   <div class='loader-icon'><img src="https://mquad.org/mis/img/mquad-logo.png" alt=""></div>
	   </div>
   </div>              
</div>
-->

<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">
				Ministry Data List 
				<!-- <a href="export-all-projects?<?=$_SERVER['QUERY_STRING'];?>"> <i class="fa fa-download pull-right"></i> </a> -->
			</h3>
			
		</div>
		<div class="col-lg-12" >
			<form>
				<div class="row">
					<?php /*
					<div class="col-sm-3">
						<div class="form-group">
							<select class="form-control" name="state" id="state"  >
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
					*/ ?>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" name="project_name" class="form-control" placeholder="Project Name" value="<?=@$_REQUEST['project_name']?>" />
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
						<th>
							<input type="checkbox" id="checkAll" />
						</th>
						<th>Ministry</th>
						<th>Organization</th>
						<th>project_name</th>
						<th>contact_person_name</th>
						<th>contact_number</th>
						<th>email</th>
						<th>Status</th>
						<td>Action</td>
					</tr>
					
					<?php
						$per_page=10;
						$ministries = ['2'=>'DA&FW'];
						foreach($mdatas as  $key=>$mdata){ 
						?>
							<tr>
								<td><?php if(isset($_GET['page']) && $_GET['page']>1){ echo ($per_page*$_GET['page']-$per_page)+$key+1;}else{ echo $key+1;};?></td>
								<td><input type="checkbox" class="sendmail" value="<?=$mdata['id']?>" /></td>
								<td><?=$ministries[$mdata['ministry']];?></td>
								<td><?=ucfirst($mdata['org_name']);?></td>
								<td><?=ucfirst($mdata['project_name']);?></td>
								<td><?=ucfirst($mdata['contact_person_name']);?></td>
								<td><?=$mdata['contact_number'];?> </td>
								<td><?=$mdata['email'];?>  </td>
								<td> 
									<?php
										if($mdata['mail_status']=='mailsent'){ 
											echo '<span class="badge badge-success" data-html="true" title="Mail sent on '.date("d-M-Y",strtotime($mdata['mail_on'])).' ">Mail Sent</span>';
										}
										else{
											echo '<span class="badge badge-warning">Pending</span>';
										}
									?>
								</td>
								<td>
									<a href="<?=base_url()?>" ><i class="fa fa-eye badge bg-primary text-white"> </i></a>
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
						<a class="btn btn-success text-white mt-2" id="send_mail"><i class="fa fa-external-link"></i> Send Mail</a>
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
	}
});

 $('#checkAll').click(function () {    
    $('input:checkbox').prop('checked', this.checked);    
 });
 
 $("#send_mail").on("click", function(){ 
	let allBnfry = $('.sendmail:checkbox:checked').map(function() {
		return this.value;
	}).get();
	if(allBnfry!="")
	{
		$.ajax({
			url:"<?=base_url()?>inform-all",
			type:"post",
			data:{beneficiary:allBnfry},
			success:function(res){
				let ress = JSON.parse(res);
				if(ress.status==1){
					window.location.href="<?=base_url()?>ministry-data-list";
				}
			}
		});
	}
 })
 

</script>


<?= $this->endSection(); ?>