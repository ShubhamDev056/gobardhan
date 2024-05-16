<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>
<style type="text/css">
	.profile-sidebar {
		background: #f38632;
		padding: 20px;
		margin-bottom: 15px;
	}

	.profile-sidebar li {
		display: flex;
		justify-content: center;
		flex-direction: column;
		font-size: 16px;
		color: #fff;
		padding-bottom: 10px;
		padding-top: 10px;
		line-height: 20px;
		border-bottom: 1px solid #e17522;
	}

	.profile-sidebar li strong {
		font-size: 17px;
		font-weight: bold;
		line-height: 35px;
	}

	.profile-sidebar li:last-child {
		border-bottom: none;
	}

	.custom-accordian .accordion-item {
		margin-bottom: 20px;
		border: none;
	}

	.custom-accordian .accordion-item .accordion-body {
		padding: 0;
	}

	.custom-accordian .accordion-item .accordion-body>.table:first-child {
		border-top: none;
	}

	.custom-accordian .accordion-item .accordion-body>.table:first-child tr:first-child {
		border-top: none;
	}

	.custom-accordian .accordion-item,
	.custom-accordian .accordion-item .accordion-button {
		border-radius: 0;
	}

	.custom-accordian .accordion-item .accordion-button h4 {
		margin-bottom: 0;
		font-weight: 600;
		font-size: 16px;
	}

	.custom-accordian .accordion-item .accordion-button:active,
	.custom-accordian .accordion-item .accordion-button:focus {
		outline: none;
		box-shadow: none;
	}

	.custom-accordian .accordion-item .accordion-button {
		background-color: #add8e6;
		border-radius: 0 !important;
	}
	.tblhead{
		font-weight:bold;
	}
	.nav-link.tabbutton.active {
    color: #fff;
    background-color: #007bff;
    border-color: #dee2e6 #dee2e6 #fff;
}
.nav-link.tabbutton {
    color: #fff;
    background-color: #b1adab;
    border-color: #dee2e6 #dee2e6 #fff;
}


.ctable th, .ctable td{
	padding-top:3px;
	padding-bottom:3px;
}
</style>
<div class="container">
	<?php
		if(isset($_SESSION['success']) && $_SESSION['success']!=""){ ?>
			<div class="alert alert-success alert-dismissible mt-2 bg-primary text-white">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Success!</strong> <?php echo $_SESSION['success']; ?>
			</div>
		<?php	
		}
	?>
	<div class="row justify-content-center">
		
		<?php $isAdmin=''; if($_SESSION['role']!=="organization"){ $isAdmin='d-none'; ?>
		
			<div class="col-6 col-md-6">
				<div class="card px-0 p-4 pb-0 mt-3 mb-3" style="padding: 0.4rem!important;">
					<h4 id="heading">Profile Information </h4>
					<ul class=" mt-2">
						<li class=""><strong>Username:</strong>
							<?= $userdata['username']; ?>
						</li>
						<li class=""><strong>Name:</strong>
							<?= $userdata['name']; ?>
						</li>
						<li class=""><strong>Contact Number:</strong>
							<?= $userdata['contact_no']; ?>
						</li>
						<li class=""><strong>Email Address:</strong>
							<?= $userdata['email']; ?>
						</li>
						<li class=""><strong>Designation:</strong>
							<?=$userdata['designation'];?>
						</li>
					</ul> 
					<a class="btn btn-success mt-2" href="javascript:" data-toggle="modal" data-target="#cahnge-password" >Change Password</a>
				</div>
			</div>
		
		<?php  } ?>
		
		
		<div class="col-3 col-md-3 <?=$isAdmin;?>">
			<div class="card px-0 p-4 pb-0 mt-3 mb-3" style="padding: 0.4rem!important;">
				<h4 id="heading">Profile Information </h4>
				<ul class="profile-sidebar mt-2">
					<li class=""><strong>Username:</strong>
						<?= $userdata['username']; ?>
					</li>
					<li class=""><strong>Name:</strong>
						<?= $userdata['name']; ?>
					</li>
					<li class=""><strong>Contact Number:</strong>
						<?= $userdata['contact_no']; ?>
					</li>
					<li class=""><strong>Email Address:</strong>
						<?= $userdata['email']; ?>
					</li>
					<li class=""><strong>Designation:</strong>
						<?=$userdata['designation'];?>
					</li>
				</ul> 
				
				<a class="btn btn-success" href="javascript:" data-toggle="modal" data-target="#update-profile" >Update Profile</a>
				<a class="btn btn-success mt-2" href="javascript:" data-toggle="modal" data-target="#cahnge-password" >Change Password</a>
			</div>
		</div>
		<div class="col-9 col-md-9 <?=$isAdmin;?>">
			<div class="card px-0 pb-0 mt-3 mb-3">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link tabbutton active" data-toggle="tab" href="#home" >Organization Details</a>
					</li>
					<li class="nav-item" >
						<a class="nav-link tabbutton" data-toggle="tab" href="#menu1">Project Details</a>
					</li>
					<?php if($_SESSION['user_id']=="3"){ ?>
					<li class="nav-item">
						<a class="nav-link tabbutton" data-toggle="tab" href="#mda_issues">MDA Issues</a>
					</li>
					<li class="nav-item">
						<a class="nav-link tabbutton" data-toggle="tab" href="#offtake_issues">CBG Offtake Issues</a>
					</li>
					<?php } ?>
					<!--
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#menu2">Menu 2</a>
					</li>
					-->
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div id="home" class="container tab-pane active"><br>
						<?php if(empty($org)){ ?>
							<!--
							<div class="card">
							  <div class="card-header  bg-success text-white">Register Your Entity</div>
							  <div class="card-body" style="border: 1px solid #65dba4;text-align:center">
								
								
							  </div>
							</div> -->
							<a href="<?=base_url()?>organization-registration" class="btn btn-primary">Click here for Registering your Organization</a>
						<?php
						} 
						else{ ?>
							<div class="accordion custom-accordian">
								<div class="accordion-item">
									<h2 class="accordion-header">
										<!--<button class="accordion-button" type="button" data-bs-toggle="collapse"
											data-bs-target="#tab1" aria-expanded="true" aria-controls="tab1" class="btn btn-warning">
											<h4>
												<strong>1.</strong> Organization Details
											</h4>
										</button>-->
										<h5> <strong>1.</strong> Organization Details <a href="<?=base_url()?>organization-edit" class="btn btn-primary btn-sm pull-right">Update Organization Details</a> </h5>
										
									</h2>
									<div id="tab1" class="accordion-collapse collapse show">
										<div class="accordion-body">
											<table class="table table-bordered">
												<tr>
													<td class="tblhead">Name of entity</td>
													<td><?=$org['entity_name']?></td>
												</tr>
												<tr>
													<td class="tblhead">Type of entity</td>
													<td><?php echo uniquedetails($conn, 'option_list', 'title', 'id', $org['entity_type']) ?></td>
												</tr>
												<tr>
													<td class="tblhead">Sub-type</td>
													<td>
														<?php echo uniquedetails($conn, 'option_list', 'title', 'id', $org['entity_subtype']) ?>
													</td>
												</tr>
												<?php if($org['entity_subtype']==5){ ?>
													<tr>
														<td class="tblhead">ULB Code</td>
														<td>
															<?=$org['ulb_code']?>
														</td>
													</tr>
												<?php } ?>
												
												<tr>
													<td class="tblhead">Contact Number</td>
													<td><?=$org['mobile_no']?></td>
												</tr>
												

												<tr>
													<td class="tblhead">Email</td>
													<td><?=$org['email']?></td>
												</tr>
												<tr>
													<td class="tblhead">Address</td>
													<td><?=$org['address']?></td>
												</tr>
												<tr>
													<td class="tblhead">State</td>
													<td><?php echo uniquedetails($conn, 'states', 'state_name', 'state_code', $org['state_id']) ?> </td>
												</tr>
												<tr>
													<td class="tblhead">District</td>
													<td><?php echo uniquedetails($conn, 'districts', 'district_name', 'district_code', $org['district_id']) ?></td>
												</tr>
												<tr>
													<td class="tblhead">Pincode</td>
													<td><?=$org['pincode']?></td>
												</tr>
												<?php if($org['entity_type']==2){ ?>
												<tr>
													<td class="tblhead">CIN / Registration No.</td>
													<td><?=$org['cin_reg_no']?></td>
												</tr>
												<tr>
													<td class="tblhead">Incorporation/ Registration Date</td>
													<td><?=$org['reg_date']?></td>
												</tr>
												<tr>
													<td class="tblhead">PAN No.</td>
													<td><?=$org['pan_no']?></td>
												</tr>
												<tr>
													<td class="tblhead">GST No.</td>
													<td><?=$org['gst_no']?></td>
												</tr>
												<?php } ?>
											</table>
										</div>
									</div>
								</div>
								
							</div>						
						<?php
						}
						?>
						
					</div>
					<div id="menu1" class="container tab-pane fade"><br>
						
						<div class="row">
							<div class="col-sm-12">
								<h3 class="pull-left">Plant List</h3>
								<a href="<?=base_url()?>add-project" class="btn btn-primary pull-right">Add Project</a>
							</div>
							<div class="col-sm-12">
								<table class="table table-bordered">
									<tr>
										<th>Plant Name</th>
										<th>Plant Type</th>
										<th>Plant Status</th>
										<th>Completion</th>
										<th width="22%">Action</th>
									</tr>
									
									<?php
										$pstatus = ['','0','22','23','24','290'];
										foreach($projects as $project){ ?>
											<tr> 
												<td><?=$project['project_name'];?></td>
												<td><?=uniquedetails($conn, 'option_list', 'title', 'id', $project['entity_type_id'])?> </td>
												<td><?=uniquedetails($conn, 'option_list', 'title', 'id', $project['plant_status_id'])?> </td>
												<td>
													<div class="progress">
														<div class="progress-bar progress-bar-striped progress-bar-animated" style="width:<?=$project['form_completion'];?>%"><?=$project['form_completion'];?>%</div>
													</div>
												</td>
												<td width="21%" >
													<a class="btn btn-success btn-sm" href="<?=base_url()?>project-details/<?=$project['project_id'];?>">View</a>
													<?php if(in_array($project['plant_status_id'],$pstatus)){ ?>
													<a href="<?=base_url()?>project-edit/<?=$project['project_id'];?>" class="btn btn-warning btn-sm" >Edit </a>
													<?php } ?>
													<a class="btn btn-primary btn-sm" href="<?=base_url()?>public/certificate/certficate<?=$project['user_id'];?><?=$project['project_id'];?>.pdf" target="_blank" download > <i class="fa fa-download" title="Download Certificate" ></i> </a>
													
													<?php 
														if(!empty($project['project_registration_no']) && ($org['entity_type']==2 || $project['entity_type_id']=="18" )){ ?>
															<a href="<?=base_url()?>add-bank-details/<?=$project['project_id'];?>" class="btn btn-success btn-sm mt-2" >Add Bank Loan Details </a>
														<?php
														}
													?>
													
													<?php 
														if(!empty($project['project_registration_no']) && ($project['plant_status_id']=="24" && $project['entity_type_id']=="18" ) && $_SESSION['user_id']=="3"){ ?>
															<a href="<?=base_url()?>add-mda-issue/<?=$project['project_id'];?>" class="btn btn-success btn-sm mt-2" > MDA Issues </a>
															<a href="<?=base_url()?>add-offtake-issue/<?=$project['project_id'];?>" class="btn btn-success btn-sm mt-2" >CBG Offtake Issues </a>
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
						</div>
						
						
					</div>
					<div id="mda_issues" class="container tab-pane fade"><br>
						<h3>MDA Issues</h3>
						<table class="table table-border">
							<tr>
								<th>Plant Name</th>
								<th>Related Issues</th>
								<th>Remarks</th>
								<th>Post Issue</th>
								<th>Action</th>
							</tr>
							<?php foreach($mdaissues as $mdaissue){ ?>
								<tr>
									<td><?=$mdaissue['project_name'];?></td>
									<td>
										<?php 
											$reissues = explode(",",$mdaissue['related_issues']);
											foreach($reissues as $reissue){
												echo getNameFromId('issues_related', $reissue).", ";
											}
										?>
									</td>
									<td><?=$mdaissue['remarks'];?></td>
									<td><?=date('d-m-Y',strtotime($mdaissue['created_at']));?></td>
									<td>
										<a href="javascript:" class="show-details" data-id="<?=$mdaissue['id'];?>" ><i class="fa fa-eye badge bg-primary text-white"> </i></a>
										<a href="javascript:" class="add-remarks" data-id="<?=$mdaissue['id'];?>" ><i class="fa fa-plus badge bg-primary text-white"> Remarks</i></a>
									</td>
								</tr>
							<?php } ?>
						</table>
					</div>
					
					<div id="offtake_issues" class="container tab-pane fade"><br>
						<h3>Offtake Issues</h3>
						<table class="table table-border">
							<tr>
								<th>Plant Name</th>
								<th>OGMC</th>
								<th>Remarks</th>
								<th>Post Issue</th>
								<th>Action</th>
							</tr>
							<?php foreach($offtakeissues as $offtakeissue){ ?>
								<tr>
									<td><?=$offtakeissue['project_name'];?></td>
									<td>
										<?php 
											echo $offtakeissue['ogmc'];
										?>
									</td>
									<td><?=$offtakeissue['remarks'];?></td>
									<td><?=date('d-m-Y',strtotime($offtakeissue['created_at']));?></td>
									<td>
										<a href="javascript:" class="show-offtake-details" data-id="<?=$offtakeissue['id'];?>" ><i class="fa fa-eye badge bg-primary text-white"> </i></a>
										<a href="javascript:" class="add-offtake-remarks" data-id="<?=$offtakeissue['id'];?>" ><i class="fa fa-plus badge bg-primary text-white"> Remarks</i></a>
									</td>
								</tr>
							<?php } ?>
						</table>
					</div>
					
					<div id="menu2" class="container tab-pane fade"><br>
						<h3>Menu 2</h3>
						<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
							laudantium, totam rem aperiam.</p>
					</div>
					
				</div>

			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="update-profile" style="z-index: 1000000;" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title text-center">Profile Details</h4>
				<button type="button" class="btn-close btn" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form method="post" action="<?=base_url()?>update-profile" >
					<div class="col-12 mt-3">
						<label for="name" class="form-label">Enter Name of Authorised Person * </label>
						<input type="text" class="form-control" placeholder="Enter Name of Authorised Person *" name="name" id="name" value="<?=$userdata['name'];?>">
					</div>
					
					<div class="col-12 mt-3">
						<label for="name" class="form-label">Enter Designation of the Authorised Person * </label>
						<input type="text" class="form-control" required="" placeholder="Enter Designation of the Authorised Person *" name="designation" id="designation" value="<?=$userdata['designation'];?>">
					</div>
					<div class="col-12 mt-3">
						<label for="name" class="form-label">Enter Mobile Number of Authorised Person * </label>
						<input type="text" required="" class="form-control" value="<?=$userdata['contact_no']?>" onkeypress="return isNumber(event)" data-validation-regexp="^([0-9- ]+)$" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" placeholder="Enter Mobile Number of Authorised Person *" name="contact_number">
					</div>
					<div class="col-12 mt-3">
						<button type="submit" class="btn btn-primary float-right">Update</button>
					</div>
					
				</form>
			</div>

		</div>
	</div>
</div>



<div class="modal fade" id="cahnge-password" style="z-index: 1000000;" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title text-center">Change Password</h4>
				<button type="button" class="btn-close btn" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form method="post"  >
				    <div id="changePasswordErrors">
				        
				    </div>
					<div class="col-12 mt-3">
						<label for="name" class="form-label">Enter Current Password * </label>
						<input type="password" class="form-control" name="old_password" id="old_password" required="" >
					</div>
					
					<div class="col-12 mt-3">
						<label for="name" class="form-label">New Password * </label>
						<input type="password" class="form-control" required="" name="new_password" id="new_password" >
					</div>
					<div class="col-12 mt-3">
						<label for="name" class="form-label">Confirm Password * </label>
						<input type="password" class="form-control" required="" name="confirm_password" id="confirm_password">
					</div>
					<div class="col-12 mt-3">
						<button type="button" class="btn btn-primary float-right changePassword">Update</button>
					</div>
					
				</form>
			</div>

		</div>
	</div>
</div>



<div class="modal fade" id="mdadetails" style="z-index: 1000000;">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-lightblue">
				<h4 class="modal-title">MDA Issue Details</h4>
				<button type="button" class="btn-close" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" >
				
				<div class="row">
					<div class="col-sm-12" id="mdaIssuDetails">
						
					</div>
					
				</div>
				
				
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="mdaRemarks" style="z-index: 1000000;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-lightblue">
				<h4 class="modal-title">MDA Issue Remarks</h4>
				<button type="button" class="btn-close" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" >
				
				<div class="row">
					<div class="col-sm-12" >
						
						<div class="form-group">
							<input type="hidden" id="mdaIssueRemarksId" />
							<textarea class="form-control" rows="5" name="remarks" id="remarks" required placeholder="Remarks" ></textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-sm pull-right" id="saveremarks">Submit</button>
						</div>
						
					</div>
					
				</div>
				
				
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="offtakedetails" style="z-index: 1000000;">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-lightblue">
				<h4 class="modal-title">Offtake Issue Details</h4>
				<button type="button" class="btn-close" data-dismiss="modal">X</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body" >
				
				<div class="row">
					<div class="col-sm-12" id="offtakeIssuDetails">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="offtakeRemarks" style="z-index: 1000000;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-lightblue">
				<h4 class="modal-title">Offtake Issue Remarks</h4>
				<button type="button" class="btn-close" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" >
				<div class="row">
					<div class="col-sm-12" >
						<div class="form-group">
							<input type="hidden" id="offtakeIssueRemarksId" />
							<textarea class="form-control" rows="5" name="offtakeremarks" id="offtakeremarks" required placeholder="Remarks" ></textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-sm pull-right" id="saveofftakeremarks">Submit</button>
						</div>
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

<style>
.otherIssues{
    color: red;
    border-radius: 8px;
    padding: 3px;
}
</style>
<script>
$(".show-details").on("click", function(){
	var mdaIssueId = $(this).data("id");
	$("#mdadetails").modal("show");
	getMdaDetails(mdaIssueId);
})
$(".add-remarks").on("click", function(){
	var mdaIssueId = $(this).data("id");
	$("#mdaIssueRemarksId").val(mdaIssueId);
	$("#mdaRemarks").modal("show");
})

$(".btn-close").on("click",function(){
	$("#mdadetails").modal('hide');
	$("#mdaRemarks").modal('hide');
});

async function getMdaDetails(mdaId) {
	const mdagetUrl = "<?=base_url();?>"+"mda-issues-details/"+mdaId;
	const response = await fetch(mdagetUrl);
	const mdaIssue = await response.json();
	console.log(mdagetUrl);
	var issue_logs = mdaIssue.issue_log;
	var mdaIssueHtml = '<table class="table table-bordered ctable">\
							<tr><th width="25%" >State Name</th><td>'+mdaIssue.state_name+'</td></tr>\
							<tr><th>Project Name</th><td>'+mdaIssue.project_name+'</td></tr>\
							<tr><th>Related Issue</th><td>'+mdaIssue.related_issues+'</td></tr>\
							<tr><th>Issue with iFMS</th><td>'+mdaIssue.ifms+' <span class="otherIssues">'+mdaIssue.other_ifms+'</span> </td> </tr>\
							<tr><th>Issues with MoU</th><td>'+mdaIssue.mous+' <span class="otherIssues">'+mdaIssue.other_mou+'</span> </td></tr>\
							<tr><th>Issues with PoS Machine</th><td>'+mdaIssue.pos_machines+' <span class="otherIssues">'+mdaIssue.other_pos+'</span> </td></tr>\
							<tr><th>Issues with Testing of FOM/LFOM</th><td>'+mdaIssue.testingIssues+' <span class="otherIssues">'+mdaIssue.other_testing+'</span> </td></tr>\
							<tr><th>Remarks</th><td>'+mdaIssue.remarks+'</td></tr>\
							<tr><th>DoF Remarks</th><td>'+mdaIssue.dof_remarks+'</td></tr>\
							<tr><th>Issue Post Date </th><td>'+mdaIssue.created_at+'</td></tr>\
						</table>';
		$("#mdaIssuDetails").html(mdaIssueHtml);
		
		var logHtml = '<h5>Remarks Log</h5><table class="table table-bordered ctable"> <tr> <th>Remarks Date</th> <th>CBG Remarks</th> <th>DoF Remarks</th> </tr>';
		
		$.each(issue_logs,function(k,log){
			console.log(log);
			logHtml+='<tr><td>'+log.created_at+'</td><td>'+log.remarks+'</td><td>'+log.dof_remarks+'</td></tr>';
		})
		logHtml+='</table>';
		$("#mdaIssuDetails").append(logHtml);
		
}

$("#saveremarks").on("click", function(){
	var mdaIssueRemarksId = $("#mdaIssueRemarksId").val();
	var remarks = $("#remarks").val();
	remarks = addslashes(remarks);
	var remarksdata = {};
	remarksdata['mda_issue_id'] = mdaIssueRemarksId;
	remarksdata['remarks'] = remarks;
	remarksdata['updated_by'] = 'user';
	console.log(remarksdata);
	postRemarks(remarksdata);
	
})

function addslashes(string) {
    return string.replace(/\\/g, '\\\\').
        replace(/\u0008/g, '\\b').
        replace(/\t/g, '\\t').
        replace(/\n/g, '\\n').
        replace(/\f/g, '\\f').
        replace(/\r/g, '\\r').
        replace(/'/g, '\\\'').
        replace(/"/g, '\\"');
}

async function postRemarks(data) {
	var postRemarksUrl = "<?=base_url();?>mda-issues-remarks";
	try {
		const response = await fetch(postRemarksUrl, {
		  method: "POST", // or 'PUT'
		  headers: {
			"Content-Type": "application/json",
		  },
		  body: JSON.stringify(data),
		});
		const result = await response.json();
		if(result.status===200){
			$("#mdaRemarks").modal("hide");
			$("#remarks").val('');
			$("#c-alert").removeClass("d-none");
			window.setTimeout(function(){
				$("#c-alert").addClass('d-none');
			}, 3000);
		}else{
			console.log(res);
		}
	} catch (error) {
		console.error("Error:", error);
	}
}


</script>


<script>

///OFFTAKE ISSUES
$(".show-offtake-details").on("click", function(){
	var offtakeIssueId = $(this).data("id");
	$("#offtakedetails").modal("show");
	getOfftakeDetails(offtakeIssueId);
})
$(".add-offtake-remarks").on("click", function(){
	var offtakeIssueId = $(this).data("id");
	$("#offtakeIssueRemarksId").val(offtakeIssueId);
	$("#offtakeRemarks").modal("show");
})

$(".btn-close").on("click",function(){
	$("#offtakedetails").modal('hide');
	$("#offtakeRemarks").modal('hide');
});

async function getOfftakeDetails(offtakeIssueId) {
	const mdagetUrl = "<?=base_url();?>"+"offtake-issues-details/"+offtakeIssueId;
	const response = await fetch(mdagetUrl);
	const oftkIssue = await response.json();
	
	var issue_logs = oftkIssue.issue_log;
	var gailRemarks=ogmc=ogmcRmk=signedGAIL=signedSATAT=""; 
	if(oftkIssue.gail=="Yes"){
		gailRemarks='<tr><th>GAIL Remarks</th><td>'+oftkIssue.gail_remarks+'</td></tr>';
		signedGAIL='<tr><th>Quantity for which commercial agreement signed under CBG-CGD synchronization scheme (in TPD) </th><td>'+oftkIssue.com_agre_signed_cbg_cdg+'</td></tr>';
	}
	if(oftkIssue.satat_scheme=="Yes"){
		ogmc='<tr><th>OGMC</th><td>'+oftkIssue.ogmc+'</td></tr>';
		ogmcRmk='<tr><th>CBG OGMC '+oftkIssue.ogmc+' Remarks</th><td>'+oftkIssue.cbg_ogmc_remarks+'</td></tr>';
		signedSATAT='<tr><th>Quantity for which commercial agreement signed with OGMCs for CBG offtake (in TPD) </th><td>'+oftkIssue.com_agre_signed+'</td></tr>';
	}
	var mdaIssueHtml = '<table class="table table-bordered ctable">\
							<tr><th width="65%" >State Name</th><td>'+oftkIssue.state_name+'</td></tr>\
							<tr><th>Project Name</th><td>'+oftkIssue.project_name+'</td></tr>\
							<tr><th>MoU Signed Under SATAT Scheme With OGMCs</th><td>'+oftkIssue.satat_scheme+'</td></tr> '+ogmc+' \
							<tr><th>MoU Signed Under CBG-CGD Synchronization Scheme (GAIL)</th><td>'+oftkIssue.gail+'</td> </tr>\
							<tr><th>Designed CBG production Capacity (in TPD) </th><td>'+oftkIssue.prod_capacity+'</td></tr>\
							'+signedSATAT+' '+signedGAIL+' \
							<tr><th>Average CBG production in last 30 days (in Tons)</th><td>'+oftkIssue.avg_actual_prod+'</td></tr>\
							<tr><th>Actual CBG offtake by OGMCs (SATAT) in last 30 days (in Tons)</th><td>'+oftkIssue.actual_offtake+'</td></tr>\
							<tr><th>CBG supplied under CBG-CGD Synchronization scheme in last 30 days (Tons)</th><td>'+oftkIssue.cbg_supplied_sync+'</td></tr>\
							<tr><th>Other sale (Industrial/Own RO) in last 30 days (Tons)</th><td>'+oftkIssue.other_sale+'</td></tr>\
							<tr><th>Own Consumption in last 30 days (Tons)</th><td>'+oftkIssue.internal_consumption+'</td></tr>\
							<tr><th>Flaring/ wastages in last 30 days (Tons)</th><td>'+oftkIssue.flaring_wastage+'</td></tr>\
							<tr><th>Operator Remarks</th><td>'+oftkIssue.remarks+'</td></tr>\
							 '+ogmcRmk+' '+gailRemarks+'\
							<tr><th>Issue Post Date </th><td>'+oftkIssue.created_at+'</td></tr>\
						</table>';
		$("#offtakeIssuDetails").html(mdaIssueHtml);
		
		var logHtml = '<h5>Remarks Log</h5><table class="table table-bordered ctable"> <tr> <th>Remarks Date</th> <th>Operator Remarks</th> <th>'+oftkIssue.ogmc+' Remarks</th> <th>GAIL Remarks</th> </tr>';
		
		$.each(issue_logs,function(k,log){
			//console.log(log);
			logHtml+='<tr><td>'+log.created_at+'</td><td>'+log.remarks+'</td><td>'+log.cbg_ogmc_remarks+'</td><td>'+log.gail_remarks+'</td></tr>';
		})
		logHtml+='</table>';
		$("#offtakeIssuDetails").append(logHtml);
		
}

$("#saveofftakeremarks").on("click", function(){
	var offtakeIssueRemarksId = $("#offtakeIssueRemarksId").val();
	var remarks = $("#offtakeremarks").val();
	remarks = addslashes(remarks);
	var remarksdata = {};
	remarksdata['offtake_issue_id'] = offtakeIssueRemarksId;
	remarksdata['remarks'] = remarks;
	remarksdata['updated_by'] = 'user';
	console.log(remarksdata);
	postRemarks(remarksdata);
	
})

function addslashes(string) {
    return string.replace(/\\/g, '\\\\').
        replace(/\u0008/g, '\\b').
        replace(/\t/g, '\\t').
        replace(/\n/g, '\\n').
        replace(/\f/g, '\\f').
        replace(/\r/g, '\\r').
        replace(/'/g, '\\\'').
        replace(/"/g, '\\"');
}

async function postRemarks(data) {
	var postRemarksUrl = "<?=base_url();?>offtake-issues-remarks";
	try {
		const response = await fetch(postRemarksUrl, {
		  method: "POST", // or 'PUT'
		  headers: {
			"Content-Type": "application/json",
		  },
		  body: JSON.stringify(data),
		});
		const result = await response.json();
		if(result.status===200){
			$("#offtakeRemarks").modal("hide");
			$("#offtakeremarks").val('');
			$("#c-alert").removeClass("d-none");
			window.setTimeout(function(){
				$("#c-alert").addClass('d-none');
			}, 3000);
		}else{
			console.log(res);
		}
	} catch (error) {
		console.error("Error:", error);
	}
}

$(".changePassword").on("click", function(){
    var oldPass = $("#old_password").val();
    var newPass = $("#new_password").val();
    var cnfPass = $("#confirm_password").val();
    $("#changePasswordErrors").html('');
    if(oldPass!="" & newPass!="" & cnfPass!=""){
        oldPass = btoa(oldPass);
        newPass = btoa(newPass);
        cnfPass = btoa(cnfPass);
        if(newPass==cnfPass){
            $.ajax({
                url:"<?=base_url();?>change-password",
                type:"post",
                data:{oldPass:oldPass,newPass:newPass,cnfPass:cnfPass},
                dataType:"json",
                success:function(res){
                    if(res.status==200){
                        $("#changePasswordErrors").html('<h3>Password change successfully.</h3>');
                        window.location.href="<?=base_url();?>logout";
                    }else if(res.status==2){
                        var errs = res.message;
                        var i=0;
                        $.each(errs, function(k,v){
                            i++;
                            $("#changePasswordErrors").append(`<b>`+i+`. </b>`+v+`<br>`);
                        })
                    }else{
                        $("#changePasswordErrors").html(res.message);
                    }
                    console.log(res)
                }
            })
        }else{
            // console.log('New password and confirm password are mismatched.');
            $("#changePasswordErrors").html('New password and confirm password are mismatched.');
        }
    }else{
        // console.log('All fields are required.');
        $("#changePasswordErrors").html('All fields are required.');
    }
});

</script>

<?= $this->endSection(); ?>