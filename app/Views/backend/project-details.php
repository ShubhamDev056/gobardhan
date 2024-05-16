<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>

<style>
.table-header{
	 background-color: #296fa1;
    color: white;
    font-weight: bold;
}
.table-heading{
	font-size: 13px;
    font-weight: bold;
}

.sub-heading{
	background-color: #52a129;
    padding: 5px;
    color: white;
}
.tr-bg{
	background-color: lightblue;
    font-weight: bold;
}

.nav-tabs .nav-link {
    font-weight: bold;
    font-size: 13px;
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
.updatedon {
    background-color: #4caf50;
    color: white;
    border-radius: 5px;
    padding: 2px;
}
</style>

<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<a href="javascript:void(0)" onclick="window.history.back()" > <i class="fa fa-arrow-left" ></i> Back </a>
		</div>
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">Projects Details</h3>
		</div>
		
		<div class="col-lg-3 col-3">
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr class="table-header">
						<td colspan="2">Entity Basic Information</td>
					</tr>
					<tr>
						<td class="table-heading">Name of the Organization</td>
						<td><?=$org['entity_name']?></td>
					</tr>
					<tr>
						<td class="table-heading">Type of Organization</td>
						<td><?=uniquedetails($conn, 'option_list', 'title', 'id', $org['entity_type'])?>  </td>
					</tr>
					<tr>
						<td class="table-heading">Sub-type</td>
						<td><?=uniquedetails($conn, 'option_list', 'title', 'id', $org['entity_subtype'])?>  </td>
					</tr>
					<tr>
						<td class="table-heading">Mobile No. of Authorised Person</td>
						<td><?=$org['mobile_no'];?></td>
					</tr>
					<tr>
						<td class="table-heading">Email of Authorised Person</td>
						<td><?=$org['email'];?></td>
					</tr>
					<tr>
						<td class="table-heading" colspan="2">Address of Organization</td>
					</tr>
					<tr>
						<td colspan="2" ><?=$org['address'];?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="col-lg-9 col-9">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link tabbutton active" data-toggle="tab" href="#projectBenefits">Benefits/ Support Sought</a>
				</li>
				<li class="nav-item">
					<a class="nav-link tabbutton" data-toggle="tab" href="#projectDetails">Project Details</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link tabbutton" data-toggle="tab" href="#locationDetails">Location Details</a>
				</li>
				<li class="nav-item">
					<a class="nav-link tabbutton" data-toggle="tab" href="#financialDetails">Financial Details</a>
				</li>
				<li class="nav-item">
					<a class="nav-link tabbutton" data-toggle="tab" href="#physicalFinancialProgress">Self-Certification</a>
				</li>
				<?php 
					$bankShow = ['admin','organization','bank','bankAdmin'];
					if(isset($_SESSION['role']) && in_array($_SESSION['role'],$bankShow) && ($org['entity_type']==2 || $project['entity_type_id']=="18") ){ ?>
						<li class="nav-item">
							<a class="nav-link tabbutton" data-toggle="tab" href="#bankDetails">Bank Loan Details</a>
						</li>
				<?php } ?>
				
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<!---PLANT/ PROJECT DETAILS-->
				
				<div class="tab-pane container active" id="projectBenefits">
					
					<div class="table-responsive mt-2">
						<table class="table table-bordered">
							<tr class="table-header">
								<td colspan="2">1. Benefits/ Support Sought:  </td>
							</tr>
							<tr>
								<td class="table-heading">State</td>
								<td><?php echo uniquedetails($conn, 'states', 'state_name', 'state_code', $project['state_id']) ?> </td>
							</tr>
							<tr>
								<td class="table-heading">District</td>
								<td><?php echo uniquedetails($conn, 'districts', 'district_name', 'district_code', $project['district_id']) ?> </td>
							</tr>
							<tr>
								<td class="table-heading">Plant Name</td>
								<td><?=$project['project_name'];?></td>
							</tr>
							<tr>
								<td colspan="2">
									<h4 class="sub-heading">Benefits/ Support Sought</h4>
									<table class="table table-bordered">
										<tr class="tr-bg">
											<td>Benefits</td>
											<td>Status</td>
										</tr>
										<?php
											foreach($pbenefits as $pbenefit) { ?>
												<tr>
													<td><?=$pbenefit['title'];?></td>
													<td>
														<?=$pbenefit['status'];?>
														<?php
															if($pbenefit['option_list_id']=="260"){
																echo '<br><span class="badge badge-primary p-2">'.$pbenefit['other'].'</span>';
															}
														?>
														
													</td>
												</tr>
											<?php	
											}
										?>
									</table>
								</td>
							</tr>
						</table>
					</div>
					
				</div>
				
				
				<div class="tab-pane container " id="projectDetails">
					
					
					<div class="table-responsive mt-2">
						<table class="table table-bordered">
							<tr class="table-header">
								<td colspan="4">2. Plant/ Project Details: </td>
							</tr>
							
							<?php 
								if(@$_SESSION['user_id']=="5"){
									$plntStatus = [''=>'','22'=>'Yet to start construction','23'=>'Under Construction','24'=>'Functional','290'=>'Completed','292'=>'Temporary Nonfunctional','293'=>'Defunct'];
									foreach($plantsStatusLogs as $sk=>$plantsStatusLog){
									?>
										<tr style="background-color:lightgreen;">
											<th colspan="2"><?=$plntStatus[$sk];?></th> 
											<td colspan="2"><?=date("d-m-Y",strtotime($plantsStatusLog['plant_status_date']));?></td>
										</tr>
									<?php 
									} 
								}
							?>
							
							<tr>
								<td class="table-heading">2.1 Type of Entity</td>
								<td><?php echo uniquedetails($conn, 'option_list', 'title', 'id', $project['entity_type_id']) ?> </td>
								<td class="table-heading">2.2 Type of plant</td>
								<td><?php echo uniquedetails($conn, 'option_list', 'title', 'id', $project['plant_type_id']) ?> </td> 
							</tr>
							<tr>
								<td class="table-heading">2.3 Status of plant </td>
								<td><?php echo $status = uniquedetails($conn, 'option_list', 'title', 'id', $project['plant_status_id']) ?></td>
								<td class="table-heading">2.3 (A) <?=$status;?> Date </td>
								<td><?=$project['plant_status_date'] ?> </td>
							</tr>
							<tr>
								<td class="table-heading">2.4 Designed Gas Production Capacity </td>
								<td><?=$project['gas_production_capacity'] ?>  <?=$project['gpc_unit']?></td>
								<td class="table-heading">2.5 (A) Designed Solid Feedstock Capacity </td>
								<td><?php echo $project['solid_feedstock_capacity']; ?>  <?=$project['sfc_unit'];?> </td>
							</tr>
							
							<tr>
								<td class="table-heading">2.5 (B) Designed Liquid Feedstock Capacity </td>
								<td><?php echo $project['liquid_feedstock_capacity']; ?> <?=$project['lfc_unit'];?></td>
								<td class="table-heading">2.6 (A) Designed bio-slurry output</td>
								<td ><?php echo $project['bio_slurry_output']; ?> <?=$project['bso_unit'];?> </td>
							</tr>
							<tr>
								<td class="table-heading">2.6 (B) Designed FOM output</td>
								<td><?php echo $project['FOM_output']; ?> <?=$project['FOM_unit'];?>  </td>
								<td class="table-heading">2.6 (C) Designed LFOM output</td>
								<td><?php echo $project['LFOM_output']; ?> <?=$project['LFOM_unit'];?> </td>
							</tr>
							<tr>
								<td colspan="4">
									<h4 class="sub-heading">2.7 Type & Source of designed Feedstock</h4>
									<table class="table table-bordered">
										<tr class="tr-bg">
											<td colspan="2">A. Solid Feedstock</td>
										</tr>
										<?php
											foreach($solidFsSources as $solidFsSource){ ?>
											<tr>
												<td><?=$solidFsSource['title'];?></td>
												<td><?=$solidFsSource['quantity'];?> <?=$solidFsSource['qty_unit'];?></td>
											</tr>
											<?php	
											}
										?>
										
										<tr class="table-heading">
											<td>Sub Total Solid Feedstock</td>
											<td><?php echo $project['total_solid_feedstock']; ?> <?=$project['tsfs_unit'];?></td>
										</tr>
										
										<tr class="tr-bg">
											<td colspan="2">B. Liquid Feedstock</td>
										</tr>
										
										<?php
											foreach($liquidFsSources as $liquidFsSource){ ?>
											<tr>
												<td><?=$liquidFsSource['title'];?></td>
												<td><?=$liquidFsSource['quantity'];?> <?=$liquidFsSource['qty_unit'];?></td>
											</tr>
											<?php	
											}
										?>
										<tr class="table-heading">
											<td>Sub Total Liquid Feedstock</td>
											<td><?php echo $project['total_liquid_feedstock']; ?> <?=$project['tlfs_unit'];?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<h4 class="sub-heading">2.8 Biogas/ CBG forward linkage</h4>
									<table class="table table-bordered">
										<?php
											foreach($fLinkages as $fLinkage){ ?>
												<tr> 
													<td><?=$fLinkage['title'];?></td>
													<td><?=$fLinkage['quantity'];?></td>
												</tr>
											<?php		
											}
										?>
										
									</table>
								</td>
							</tr>
							<tr>
								<td class="table-heading" colspan="2">2.9 Distance from the nearest grid </td>
								<td colspan="2" ><?=$project['distance_grid'];?></td>
							</tr>
							<tr>
								<td class="table-heading" colspan="2">2.10 Details of Letter of Intent from OMC </td>
								<td colspan="2" >
									<?php echo uniquedetails($conn, 'option_list', 'title', 'id', $project['loi_detail_id']) ?> 
									
									<?php
										if(!empty($project['loi_obtain_details'])){
											echo "<br><i>".$project['loi_obtain_details']."</i>";
										}
									?>
								</td>
							</tr>
							
							<tr>
								<td class="table-heading" colspan="2" > 2.11 Technology for bio slurry management </td>
								<td colspan="2">
									<?php 
										$bioslurry_tech = getMultiple($conn, 'option_list', 'title', 'id', explode(",",$project['bioslurry_tech']));
										foreach($bioslurry_tech as $bioslurrytech){
											echo "<b> -> </b>".$bioslurrytech->title."<br>";
										}
										
										if(!empty($project['bioslurry_tech_other'])){
											echo "<i>".$project['bioslurry_tech_other']."</i>";
										}
									?>
									
								</td>
							</tr>
							
						</table>
					</div>
					
				</div>
				
				
				<!--LOCATION DETAILS-->
				<div class="tab-pane container fade" id="locationDetails">
					
					<div class="table-responsive mt-2">
						<table class="table table-bordered">
							<tr class="table-header">
								<td colspan="4">2. Location details : </td>
							</tr>
							<tr>
								<td class="table-heading">3.1 Location of Plant</td>
								<td><?php echo uniquedetails($conn, 'option_list', 'title', 'id', $project['plant_location_id']) ?> </td>
								<td class="table-heading">State</td>
								<td><?php echo uniquedetails($conn, 'states', 'state_name', 'state_code', $project['state_id']) ?> </td>
							</tr>
							<tr>
								<td class="table-heading">District</td>
								<td><?php echo uniquedetails($conn, 'districts', 'district_name', 'district_code', $project['district_id']) ?> </td>
								<td class="table-heading">Block</td>
								<td><?php echo uniquedetails($conn, 'blocks', 'block_name', 'block_code', $project['block_id']) ?> </td>
							</tr>
							<tr>
								<td class="table-heading">GP</td>
								<td><?php echo uniquedetails($conn, 'gram_panchayat', 'gp_name', 'gp_code', $project['gp_id']) ?> </td>
								<td class="table-heading">Village</td>
								<td><?php echo uniquedetails($conn, 'villages', 'village_name', 'village_code', $project['village_id']) ?> </td>
							</tr>
							
							<?php 
								if($project['plant_location_id']!="83"){ ?>								
									<tr>
										<td class="table-heading">City </td>
										<td><?php echo $project['city'] ?> </td>
										<td class="table-heading">Ward No.</td>
										<td><?php echo $project['ward_no'] ?> </td>
									</tr>
									
									<tr>
										<td class="table-heading">Street Area Address</td>
										<td><?php echo $project['street_area_address'] ?> </td>
										<td class="table-heading">Plot No.</td>
										<td><?php echo $project['plot_number'] ?> </td>
									</tr>
							<?php
								}
							?>
							
							<tr>
								<td class="table-heading">3.3 Project/ Plant Area </td>
								<td><?=$project['plant_area'];?></td>
								<td class="table-heading">3.4 Land ownership</td>
								<td><?php echo uniquedetails($conn, 'option_list', 'title', 'id', $project['land_ownership_id']) ?></td>
							</tr>
							
							<tr>
								
								<td class="table-heading" >3.5 Geo tag of location</td>
								<td colspan="3"><?=$project['latitude'];?>, <?=$project['longitude'];?></td>
							</tr>
							
						</table>
					</div>
					
				</div>
				
				
				<!--FINANIAL DETAILS-->
				<div class="tab-pane container fade" id="financialDetails">
					
					<div class="table-responsive mt-2">
						<table class="table table-bordered">
							<tr class="table-header">
								<td colspan="4">4. Financial details :</td>
							</tr>
							
							<tr>
								<td class="table-heading">4.1 Total CAPEX only</td>
								<td><?=$project['total_capex'];?></td>
							</tr>
							
							<tr>
								<td colspan="4">
									<table class="table table-bordered">
										<tr class="tr-bg">
											<td colspan="4">4.2 Funding source</td>
										</tr>
										<?php
											foreach($fSources as $fSource){ ?>
												<tr>
													<td class="table-heading"><?=$fSource['title'];?></td>
													<td><?=$fSource['quantity'];?></td>
												</tr>
											<?php	
											}
										?>
										
									</table>
								</td>
							</tr>
							<?php
								$cdate=$cstr=''; 
								$plant_status_id = $project['plant_status_id'];
								if($plant_status_id=="22"){
									$cdate= $project['construction_date'];
									$cstr= 'Construction date';
								}
								if($plant_status_id=="23"){
									$cdate= $project['proposed_date'];
									$cstr= 'Proposed date';
								}
								if($plant_status_id=="24" || $plant_status_id=="290"){
									$cdate= $project['date_of_commissioning'];
									$cstr= 'Commissioning date';
								}
							?>
							<tr>
								<td class="table-heading"> <?=$cstr;?></td> 
								<td>
									<?=$cdate;?>
								</td>
							</tr>
							
						</table>
					</div>
					
				</div>
				
				<!--PHYSICAL AND FINANCIAL PROGRESSS-->
				<div class="tab-pane container fade" id="physicalFinancialProgress">
					
					<div class="table-responsive mt-2">
						<table class="table table-bordered">
							<tr class="table-header">
								<td colspan="4">5. Self-Certification :</td>
							</tr>
							
							<tr>
								<td>I hereby declare that the above particulars of facts and information stated are true, correct and complete to the best of my belief and knowledge.</td>
							</tr>
							<tr>
								<td>Subsequently, if such registration is found to have been obtained on the basis of false information, DDWS reserves the right to revoke the registration number immediately without any prior notice</td>
							</tr>
						</table>
					</div>
					
				</div>
				
				
				<!-- BANK DETAILS -->
				<?php //if($_SESSION['user_id']=="3"){ ?>
				<div class="tab-pane container fade" id="bankDetails">
					
					<div class="mt-2" id="accordion">
						<?php 
							foreach($project_banks as $project_bank){
						?>
							<div class="card mb-2">
							  <div class="card-header bg-primary">
								<a class="card-link text-white" data-toggle="collapse" href="#collapse<?=$project_bank['project_bank_id'];?>">
								  <?=$project_bank['bank_name'];?>
								</a>
							  </div>
							  <div id="collapse<?=$project_bank['project_bank_id'];?>" class="collapse show" data-parent="#accordion">
								<div class="card-body">
									<div class="table-responsive mt-2">
										<table class="table table-bordered">
											
											<tr>
												<th>Have You Applied For Bank Loan</th>
												<td><?=@$project_bank['bankloan_applied'];?></td>
											</tr>
											
											<?php if(@$project_bank['bankloan_applied']=="Yes"){ ?>
												<tr>
													<th>IFSC Code</th>
													<td><?=@$project_bank['ifsc_code'];?></td>
												</tr>
												<tr>
													<th>Bank Name</th>
													<td><?=@$project_bank['bank_name'];?></td>
												</tr>
												<tr>
													<th>Location State</th>
													<td><?=@$project_bank['bank_state'];?></td>
												</tr>
												<tr>
													<th>District Name</th>
													<td><?=@$project_bank['bank_district'];?></td>
												</tr>
												<tr>
													<th>City</th>
													<td><?=@$project_bank['bank_city'];?></td>
												</tr>
												<tr>
													<th>Branch</th>
													<td><?=@$project_bank['bank_branch'];?></td>
												</tr>
												<tr>
													<th>Loan account ID</th>
													<td><?=@$project_bank['loan_account_id'];?></td>
												</tr>
												<tr>
													<th>Branch contact number</th>
													<td><?=@$project_bank['branch_contact'];?></td>
												</tr>
												<tr>
													<th>Loan Amount (In Crores)</th>
													<td><?=@$project_bank['loan_ammount'];?></td>
												</tr>
												 
												<tr>
													<th>Application submission date</th>
													<td><?=date('d-m-Y',strtotime(@$project_bank['loan_apply_date']));?></td>
												</tr>
												<tr>
												<th>Reason</th>
													<td><?=@$project_bank['reason'];?></td>
												</tr>
												<th>Remarks</th>
													<td><?=@$project_bank['remarks'];?></td>
												</tr>
												 
												<tr>
													<th>Status of loan application</th>
													<td>
														<?php 
															if($project_bank['loan_status']>0){
																echo allOptions('loan_application_status')[$project_bank['loan_status']];
															}
					
														?>
													</td>
												</tr>
												
												<?php 
													if($project_bank['loan_status']==1){ ?>
														<tr>
															<th>Sanctioned amount (in Crores)</th>
															<td><?=@$project_bank['sanctioned_amount'];?></td>
														</tr>
														<tr>
															<th>Sanctioned Date</th>
															<td><?=date('d-m-Y',strtotime(@$project_bank['sanctioned_date']));?></td>
														</tr>
														<tr>
															<th>Upload sanctioned letter</th>
															<td><?php if(!empty(@$project_bank['sanctioned_doc'])){?><a href="/sanctioned_docs/<?=@$project_bank['sanctioned_doc'];?>" target="_blank"><i class="fa fa-file-pdf-o"></i></a><?php } ?></td>
														</tr>
													<?php												
													}
												?>
												
												<?php 
													if($project_bank['loan_status']==4){ ?>
														
														<tr>
															<th>Date of rejection</th>
															<td><?=date('d-m-Y',strtotime(@$project_bank['reject_date']));?></td>
														</tr> 
													<?php												
													}
												?>
												
												<th>Reason by bank</th>
													<td><?=@$project_bank['bank_reason'];?></td>
												</tr>
												<th>Remarks by bank</th>
													<td><?=@$project_bank['bank_remarks'];?></td>
												</tr>
												
											<?php } ?>
											
											
										</table>
											
											<?php if($_SESSION['role']=='organization'){ ?> 
											<div>
												<input type="text" id="remark<?=@$project_bank['project_bank_id'];?>" class="form-control" placeholder="Remarks" />
											</div>
											<button class="btn btn-primary pull-right mt-2 orgRemarks" data-id="<?=@$project_bank['project_bank_id'];?>">Submit</button>
											<?php } ?>
									</div>
								</div>
							  </div>
							</div>
						<?php } ?>
						
					</div>
					
					
					
				</div>
				<?php //} ?>
				
			</div>
			
			
		</div>
		
	</div>
	
</div>

<?= $this->endSection(); ?>




<?=$this->section('script');?>

<script>
$(".orgRemarks").on("click", function(){
	var bnkId = $(this).data("id");
	var rmks = $("#remark"+bnkId).val();
	if(bnkId!="" && rmks!=""){
		$.ajax({
			url:"<?=base_url();?>loan-remarks-plants",
			type:"post",
			dataType:"json",
			data:{rmks:rmks,bnkId:bnkId},
			success:function(res){
				//console.log(res);
				if(res.status=="200"){
					location.reload();
				} 
			}
		});
	}
	
})
</script>

<?= $this->endSection(); ?>