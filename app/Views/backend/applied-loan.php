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

<style>

#sspre-load {
  /*background-color: rgb(255 255 255 / 95%); */
  background: rgba(0,0,0,.64);
  height: 100%;
  width: 100%;
  position: fixed;
  margin-top: 0px;
  top: 0px;
  z-index: 10000001;
}
.ssloader .ssloader-container {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100px;
  height: 100px;
  border: 5px solid #ebebec;
  border-radius: 50%;
}
.ssloader .ssloader-container:before {
  position: absolute;
  content: "";
  display: block;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100px;
  height: 100px;
  border-top: 4px solid #449a97;
  border-radius: 50%;
  animation: loaderspin 1.8s infinite ease-in-out;
  -webkit-animation: loaderspin 1.8s infinite ease-in-out;
}
.ssloader .ssloader-icon {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80px;
  text-align: center;
  color: white;
}

.ssloader .ssloader-icon div {
  animation: loaderpulse alternate 900ms infinite;
  width: 45px;
}

@keyframes loaderpulse {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(1.2);
  }
}

@keyframes loaderspin {
  0% {
    transform: translate(-50%, -50%) rotate(0deg);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}




.my-3 strong{
	font-size: 25px;
}
.applied{
	background-color: #296fa1;
    color: white;
}

.sanctioned{
	background-color: #527e52;
    color: white;
}
.pending{
	background-color: #fb9e12;
    color: white;
}
.rejected{
	background-color: #bd2e2e;
    color: white;
}
.bankreview{
	background-color: #17a2b8;
    color: white;
}

</style>

<div id="sspre-load" style="display: none;">
	<div id="ssloader" class="ssloader">
		<div class="ssloader-container">
		   <div class="ssloader-icon"><div>Loading...</div></div>
		</div>
	</div>              
</div>

 
<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">
				Loan Application Status
				<a href="<?=base_url();?>applied-loan-export?<?=$_SERVER['QUERY_STRING'];?>" style="float:right;"> <i class="fa fa-download float-end"></i> </a>
			</h3>
		</div>
		<div class="col-lg-12" >
			<form>
				<div class="row">
					
					
					<div class="col-sm-4">
						<div class="form-group">
							<select class="form-control" name="state_name">
								<option selected hidden value="">Select State</option>
								<option value="">All</option>
								<?php 
									foreach($states as $state){ ?>
										<option value="<?=$state['state_code'];?>" <?php if($state['state_code']==@$_GET['state_name']){ echo "selected"; } ?> ><?=$state['state_name'];?></option>
									<?php	
									}
								?>
							</select>
						</div>
					</div>
					<?php if($_SESSION['role_id']==6){ ?>
					<div class="col-sm-2">
						<div class="form-group">
							<select class="form-control" name="bank_name">
								<option selected hidden value="">Select Bank</option>
								<option value="">All</option>
								<?php 
									foreach($banks as $bank){ if(empty($bank['bank_name'])){ continue; } ?>
										<option value="<?=$bank['bank_name'];?>" <?php if($bank['bank_name']==@$_GET['bank_name']){ echo "selected"; } ?> ><?=$bank['bank_name'];?></option>
									<?php	
									}
								?>
							</select>
						</div>
					</div>
					<?php } ?>
					<?php /* ?>
					<div class="col-sm-2">
						<div class="form-group">
							<select class="form-control">
								<option selected hidden value="">Select District</option>
								<?php 
									foreach($districts as $district){ ?>
										<option value=""><?=$district['bank_district'];?></option>
									<?php	
									}
								?>
							</select>
						</div>
					</div>
					<?php */ ?>
					
					<div class="col-sm-4">
						<div class="form-group">
							<select class="form-control" name="loan_application_status">
								<option selected hidden value="">Loan Application Status</option>
								<option value="">All</option>
								<?php /*
									foreach(allOptions('loan_application_status') as $key=>$loanstatus){ ?>
										<option value="<?=$key;?>" <?php if($key==@$_GET['loan_application_status']){ echo "selected"; } ?> ><?=$loanstatus;?></option>
									<?php	
									} */
								?>
								<option value="1" <?php if(@$_GET['loan_application_status']=="1"){ echo "selected"; } ?> >Sanctioned </option>
								<option value="3" <?php if(@$_GET['loan_application_status']=="3"){ echo "selected"; } ?> >Pending</option>
								<option value="4" <?php if(@$_GET['loan_application_status']=="4"){ echo "selected"; } ?> >Rejected</option>
								
							</select>
						</div>
					</div>
					
					
					<div class="col-sm-1">
						<button class="btn btn-primary " style="padding:5px;">Search</button>
					</div>
				</div>
			</form>
		</div>
		
		<div class="col">
			<div class="p-2 my-3 border applied">
				<strong><?=$summary->totalApllied;?></strong>
				<p>Total Loan Applied <?php //print_r($summary); ?> </p>
			</div>
		</div>
		<div class="col">
			<div class="p-2 my-3 border sanctioned">
				<strong><?=$summary->sanctioned;?></strong>
				<p>Total Sanctioned</p>
			</div>
		</div>
		<div class="col">
			<div class="p-2 my-3 border pending">
				<strong><?=$summary->pending;?></strong>
				<p>Total Pending</p>
			</div>
		</div>
		<div class="col">
			<div class="p-2 my-3 border rejected">
				<strong><?=$summary->rejected;?></strong>
				<p>Total Rejected</p>
			</div>
		</div>
		<div class="col">
			<div class="p-2 my-3 border bankreview">
				<strong><?=$summary->bankrevw;?></strong>
				<p>Total Review By Bank</p>
			</div>
		</div>
		
		<div class="col-lg-12 col-12">
		
			
		
			<div class="table-responsive" id="loan_list">
				<table class="table table-bordered fixedTable" >
					<thead>
						<tr class="table-header">
							<th>#SN</th>
							<th>State Name</th>
							<th>Distrcit Name</th>
							<th>Project Name</th>
							<th>Bank Name</th>
							<th>Loan Status</th>
							<th width="10%" >Apply Date</th>
							<th>submission Date </th>
							<th width="8%" >Action</th>
						</tr>
					</thead>
					<?php  
						foreach($appliedLoans as $k=>$appliedLoan){ ?>
							<tr class="<?php if(!empty($appliedLoan['updated_by'])){ echo "bankreview"; } ?>" >
								<td><?php echo $k+1;?> </td>
								<td><?=$appliedLoan['state_name'];?></td>
								<td><?=$appliedLoan['district_name'];?></td>
								<td><?=$appliedLoan['project_name'];?></td>
								<td><?=$appliedLoan['bank_name'];?></td>
								<td><?=allOptions('loan_application_status')[$appliedLoan['loan_status']];?></td>
								<td><?php if(!empty($appliedLoan['loan_apply_date'])){ echo date('d-m-Y', strtotime($appliedLoan['loan_apply_date'])); } ?></td> 
								<td><?php echo date('d-m-Y', strtotime($appliedLoan['created_at'])); ?></td> 
								<td>
									<a class="badge badge-primary text-white btn-sm" href="<?=base_url()?>project-details/<?=$appliedLoan['project_id'];?>">View</a>
									<?php 
										if($_SESSION['role']=='bank' || $_SESSION['role']=='bankAdmin'){
										if($appliedLoan['loan_status']==1 || $appliedLoan['loan_status']==4){ ?>
											<a href="javascript:void(0)" class="badge badge-primary text-white btn-sm openModal1" data-id="<?=$appliedLoan['project_bank_id'];?>" data-usr="<?=$appliedLoan['user_id'];?>" ><i class="fa fa-pencil"></i> Remark</a>
									<?php }else{ ?>
										<a href="javascript:void(0)" class="badge badge-primary text-white btn-sm openModal" data-id="<?=$appliedLoan['project_bank_id'];?>" data-usr="<?=$appliedLoan['user_id'];?>" ><i class="fa fa-pencil"></i> Update</a>
									<?php
										} } ?>
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



<div class="modal fade" id="myModal"    style="z-index: 1000000;" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Loan Application Details</h4>
				<button type="button" class="btn-close" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" >
				<form method="post" enctype="multipart/form-data">
					<div class="input-group">
						<div class="col-sm-12">
							<div class="form-group">
								<input type="hidden" id="project_bank_id" />
								<input type="hidden" id="project_user_id" />
								<select class="form-control" name="loan_application_status" id="loan_application_status">
									<option selected hidden value="">Loan Application Status</option>
									<?php 
										foreach(allOptions('loan_application_status') as $key=>$loanstatus){ ?>
											<option value="<?=$key;?>" <?php if($key==@$_GET['loan_application_status']){ echo "selected"; } ?> ><?=$loanstatus;?></option>
										<?php	
										}
									?>
								</select>
								<span class="text-danger" id="las_err"></span>
							</div>
						</div>
						
						<div class="col-sm-12 d-none" id="sanctioned_sec">
							<div class="mb-3" >
								<label class="form-label text-capitalize text-muted"  >Sanctioned amount (in Crores) * </label>
								<input class="form-control" name="sanctioned_amount" id="sanctioned_amount" type="number" placeholder="Sanctioned amount" />
								<span class="text-danger" id="sanctioned_amount_err"></span>
							</div>
							<div class="mb-3" >
								<label class="form-label text-capitalize text-muted"  >Sanctioned Date * </label>
								<input class="form-control" name="sanctioned_date" id="sanctioned_date" type="date" placeholder="Sanctioned date" />
								<span class="text-danger" id="sanctioned_date_err"></span>
							</div>
							<div class="mb-3" >
								<label class="form-label text-capitalize text-muted"  >Upload sanctioned letter (Max: 10MB) </label>
								<input class="form-control" name="sanctioned_doc" id="sanctioned_doc" type="file" accept=".pdf" />
								<span class="text-danger" id="sanctioned_doc_err"></span>
							</div>
						</div>
						
						<div class="col-sm-12 d-none" id="rejected_sec">
							<div class="mb-3">
								<label class="form-label text-muted" >Date of rejection *</label>
								<input type="date" name="reject_date" id="reject_date" class="form-control" />
								<span class="text-danger" id="reject_date_err"></span>
							</div>
							<div class="mb-3">
								<label class="form-label text-muted" >Reason for rejection *</label>
								<textarea class="form-control" name="bank_reason" id="bank_reason" rows="3" placeholder="Reason"></textarea>
								<span class="text-danger" id="bank_reason_err"></span>
							</div>
							
						</div>
					
						<div class="col-sm-12 d-none" id="pending_sec">
							<div class="mb-3">
								<label class="form-label text-muted" >Remarks *</label>
								<textarea class="form-control" name="remarks" id="remarks" rows="3" placeholder="Description"></textarea>
								<span class="text-danger" id="remark_err"></span>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<input type="button" class="btn btn-primary " id="BankLoanStatus" value="Submit" />
							</div>
						</div>
						
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="myModal1"    style="z-index: 1000000;" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Loan Application Details</h4>
				<button type="button" class="btn-close" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" >
				<form method="post" enctype="multipart/form-data">
					<div class="input-group">
						
						<div class="col-sm-12 mb-3">
							<input type="hidden" id="project_bank_id1" />
							<input type="hidden" id="project_user_id1" />
							<label class="form-label text-muted" >Remarks*</label>
							<textarea class="form-control" name="remarks" id="remarks1" rows="3" placeholder="Description"></textarea>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<input type="button" class="btn btn-primary " id="BankLoanRemarks" value="Submit" />
							</div>
						</div>
						
					</div>
				</form>
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

$(".openModal").on("click", function(){
	$("#project_bank_id").val($(this).data("id"));
	$("#project_user_id").val($(this).data("usr"));
	$('#myModal').modal('show');
});

$(".openModal1").on("click", function(){
	$("#project_bank_id1").val($(this).data("id"));
	$("#project_user_id1").val($(this).data("usr"));
	$('#myModal1').modal('show');
});

$(".btn-close").on("click", function(){
	$('#myModal').modal('hide');
	$('#myModal1').modal('hide');
});

$("#loan_application_status").on("change", function(){
	$("#las_err").html('');
	$("#las_reason").html($("#loan_application_status option:selected").text());
	
	$("#sanctioned_sec").addClass("d-none");
	$("#sanctioned_amount").val("");
	$("#sanctioned_amount").attr('required', false);
	$("#sanctioned_date").attr('required', false);
	
	$("#rejected_sec").addClass("d-none");
	$("#pending_sec").addClass("d-none");
	
	if($(this).val()==1){
		$("#sanctioned_sec").removeClass("d-none");
		$("#sanctioned_amount").attr('required', true);
		$("#sanctioned_date").attr('required', true);
	}
	
	if($(this).val()==4){
		$("#rejected_sec").removeClass("d-none");
		$("#reason").attr('required', true);
		$("#reject_date").attr('required', true);
	}
	if($(this).val()==2 || $(this).val()==3 || $(this).val()==5){
		$("#pending_sec").removeClass("d-none");
	}
})


$("#sanctioned_doc").on("change", function () {
	$("#sanctioned_doc_err").html('');
	var extension = $(this).val().split('.').pop().toLowerCase();
	var validFileExtensions = ['pdf', 'doc'];
	
	var sizebyte = this.files[0].size;
	var sizekb = Math.round((sizebyte / 1024));
	if ($.inArray(extension, validFileExtensions) == -1) {
		$("#sanctioned_doc_err").html('Failed!! Please upload pdf file only.!!');
		$(this).val('');
	}else{
		if( sizekb > 10240) { // 10MB
		   $("#sanctioned_doc_err").html('Please upload file less than 10MB. Thanks!!');
		   $(this).val('');
		}
	}
});



$("#BankLoanRemarks").on("click", function(){
	let remarks = $("#remarks1").val();
	let pbId = $("#project_bank_id1").val();
	let usrId = $("#project_user_id1").val();
	if(pbId!="" && remarks!=""){
		$.ajax({
			url:"<?=base_url();?>loan-remarks",
			type:"post",
			dataType:"json",
			data:{rmks:remarks,pbId:pbId,usrId:usrId},
			success:function(res){
				//console.log(res);
				if(res.status=="200"){
					location.reload();
				} 
			}
		});
	}else{
		console.log('all fields are required');
	}
	
});

$("#BankLoanStatus").on("click", function(){
	var fd = new FormData();
	var file = $( '#sanctioned_doc' )[0].files[0];
	
	let las = $("#loan_application_status").val();
	let reason = $("#reason").val();
	let remarks = $("#remarks").val();
	let pbId = $("#project_bank_id").val();
	let usrId = $("#project_user_id").val();
	let sanctioned_amount = $("#sanctioned_amount").val();
	let sanctioned_date = $("#sanctioned_date").val();
	let reject_date = $("#reject_date").val();
	let bank_reason = $("#bank_reason").val();
	

	fd.append('sanctioned_doc',file);
	fd.append('sanctioned_amount',sanctioned_amount);
	fd.append('sanctioned_date',sanctioned_date);
	fd.append('ls',las);
	fd.append('rmks',remarks);
	fd.append('pbId',pbId);
	fd.append('usrId',usrId);
	fd.append('r',reason);
	fd.append('reject_date',reject_date);
	fd.append('bank_reason',bank_reason);
	 
	if(pbId!="" && las!="" ){
		$("#sanctioned_amount_err").html('');
		$("#sanctioned_date_err").html('');
		var isSanctioned = true;
		if(las==1){
			if($("#sanctioned_amount").val()==""){
				isSanctioned=false;
				$("#sanctioned_amount_err").html('Please enter sanctioned amount.');
			}
			if($("#sanctioned_date").val()==""){
				isSanctioned=false;
				$("#sanctioned_date_err").html('Please enter sanctioned date.');
			}
		}
		rmk=true;
		if(las==2 || las==3 || las==5 ){
			if(remarks=="" && remarks!=null){
				rmk=false;
				$("#remark_err").html('Remark are required');
			}
		}
		var rejct = true;
		var rejctd = true;
		if(las==4){
			if(bank_reason==""){
				rejct = false;
				$("#bank_reason_err").html('Reason are required');
			}
			if(reject_date==""){
				rejctd = false;
				$("#reject_date_err").html('Date are required');
			}
			
		}
		
		if(pbId!="" && isSanctioned==true && rmk==true && rejct==true){
			$.ajax({
				url:"<?=base_url();?>change-loan-status",
				type:"post",
				dataType:"json",
				//data:{ls:las,r:reason,rmks:remarks,pbId:pbId},
				data:fd,
				cache: false,
				processData: false,
				contentType: false,
				beforeSend: function() {
					$('#sspre-load').show();
					//$('.loading-indicator').addClass('active');
				},
				success:function(res){
					//console.log(res);
					if(res.status=="200"){
						location.reload();
					}
					$('#sspre-load').hide('slow');
				}
			})
		}else{
			console.log('all fields are required');
		}
	}else{
		$("#las_err").html('Loan application status are required');
	}
	
})


</script>


<?= $this->endSection(); ?>