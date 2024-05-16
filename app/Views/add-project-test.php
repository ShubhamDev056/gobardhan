<?= $this->extend('layouts/layout'); ?>

<?= $this->section('breadcrum'); ?>
<div class="container">
    <div class="page-banner row align-items-center position-relative">

        <!-- Page Title -->
        <div class="col-lg-6 col-12">
            <h1 class="page-title">
                Project Details
            </h1>
        </div>

        <!-- Page Breadcrumb -->
        <div class="col-lg-6 col-12">
            <ul class="page-breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Project Details</li>
            </ul>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!--
<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url();?>assets/css/icon-font.min.css">
-->
<link rel="stylesheet" href="<?=base_url();?>assets/css/plugins.css">
<link rel="stylesheet" href="<?=base_url();?>assets/css/style.css">
<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap-multiselect.css">
	
<style>
	/*.customRequired{
		border: 1px solid red !important;
	}
	*/
    .required{
        color:red;
    }
    .blocksec{
        background-color: #f7f7f7;
        pointer-events: none;
        border: 1px solid red!important;
        color: #d1d1d1;
		display:none;
    }
    .linkage_tbl tr td{
        width: 15%; 
        vertical-align: middle;
    }
    .linkage_tbl tr td input{
        margin: 0px!important;
    }

    .linkage_tbl tr td select{
        margin: 0px!important;
    }

    .disable-click{
        pointer-events:none;
    }

    .biogas_linkage_addmore, .biogas_linkage_minus{
        font-size: 20px!important;
    }

    .cbg_linkage_addmore, .cbg_linkage_minus{
        font-size: 20px!important;
    }
	.input-group {
		flex-wrap: nowrap;
	}
	.input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
		margin-left: -3px;
		z-index: 10000;
	}
	
	.previewth{
		background-color: #00173c!important;
		color: white;
	}
	.previewthchild{
		background-color: #709bdf!important;
		color: white;
	}
	
	.feedstock_type_addmore, .feedstock_minus, .feedstock_source_addmore, .feedstocksource_minus, .FOMUtilization_addmore, .FOMUtilization_minus, .othProduct_addmore, .othProduct_addmore_minus, .LFOMUtilization_addmore, .LFOMUtilization_minus, .bioSlurryUtilization_addmore, .bioSlurryUtilization_minus, .brqtUtilization_addmore, .brqtUtilization_minus, .statuaryClearance_addmore, .statuaryClearance_addmore_minus, .capex_addmore, .capex_addmore_minus, .fundingSource_addmore, .fundingSource_addmore_minus, .loiBenefits_addmore, .loiBenefits_addmore_minus, .ruralAddress_addmore, .ruralAddress_addmore_minus{
		font-size: 30px!important;
		padding-left: 26px!important;
		padding-right: 26px!important;
	}
	
	.subTotal{
		background-color: lightgreen; font-weight: bold;
	}
	.prgsbar{
		cursor:pointer;
	}
	.input-group.custom-group .fi{
		border-top-right-radius: 0 !important;
		border-bottom-right-radius: 0 !important;
		border-right: none !important;
	}
	.input-group.custom-group .si{
		border-top-left-radius: 0 !important;
		border-bottom-left-radius: 0 !important;
	}
	.input-group-text {
		min-width: 110px;
		justify-content: center;
	}
	#msform input.form-check-input {
		border: 1px solid cadetblue;
	}
	#solidFeedstockError,#liquidFeedstockError{
		color: white;
		background-color: red;
		padding: 2px;
		border-radius: 5px;
		float: right;
	}
	#production_capacity_err{
		color:red;
	}
	#map {
      height: 400px;
      width: 100%;
    }
	.modalbtn{
		font-size: 17px !important;
	}
	
	.form-check-label{
		margin-left: 25px !important;
	}
	#msform .input-group-text {
		line-height: 20px;
	}
	.linkage_tbl{
		border: 1px solid lightblue !important;
	}
	.customRequired{
		border: 3px solid red !important;
	}
	
	.blink{
	  animation: blink .5s infinite;
	}
	@keyframes blink{
	  0% {
		color: #fff;
	  }
	  50% {
		color: #ffe584;
	  }
	  100% {
		color: #bbfa3a;
	  }
	}

	@-webkit-keyframes blink{
	  0% {
		color: #fff;
	  }
	  50% {
		color: #ffe584;
	  }
	  100% {
		color: #bbfa3a;
	  }: #000;
	  }
	}

	

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 mt-4">
			<a href="<?=base_url()?>profile" > <i class="fa fa-arrow-left" ></i> Back </a>
		</div>
        <div class="col-12 col-md-12">
            <div class="card px-0 pt-0 pb-0 mt-0 mb-3">
                <form id="msform" enctype="multipart/form-data" method="post">
                    <!-- progressbar -->
                    <ul id="progressbar">
						<li class="active prgsbar" data-id="8" id="confirm"><strong>Benefits/ support Sought </strong></li>
                        <li class="prgsbar" data-id="1" id="confirm"><strong>Plant/ Project Details</strong></li>
                        <li class="prgsbar" data-id="2" id="confirm" ><strong>Location Details</strong></li>
                        <li class="prgsbar" data-id="5" id="confirm"><strong>Financial Details</strong></li>
                        <li class="prgsbar" data-id="7" id="confirm"><strong>Self-Certification</strong></li>
                    </ul>


                    <fieldset id="fs8">
						<div class="form-card">
							<div class="row">
								<div class="col-md-12">
									<div class="pagetitle-form">
										<div class="row align-items-md-center">
											<div class="col-7">
												<h2 class="fs-title mb-md-0">1. Benefits/ Support Sought:</h2>
											</div>
											<div class="col-5">
												<h2 class="steps mb-md-0">Step 1 - 5 </h2>

											</div>
										</div>
									</div>
								</div>
                            </div>
                            <div class="row">
							
								<div class="col-6 col-sm-6">
                                    <label class="fieldlabels">Do you have any of the following.</label>
									<select class="form-control" id="have_ministry" >
										<option value="">Select Ministry</option>
										<option value="3">Registration number from Waste to Energy (MNRE)</option>
										<option value="5">LoI Referance Number from SATAT (MoPNG)</option>
										<option value="2">Loan Account umber from AIF (DA&FW)</option>
										<option value="">None of the above</option>
									</select>
                                </div> 
								
								<div class="col-6 col-sm-6">
									<div class="row d-none" id="reg-number">
										<div class="col-9 col-sm-9">
											<label class="fieldlabels"> <span id="uniqueNumberMsg">Enter Registration Number</span>  <span class="text-danger" id="uniqueCode_err"></span> </label>
											<input type="text" name="uniqueCode" id="uniqueCode" />
											
										</div> 
										<div class="col-3 col-sm-3 mt-2">
											<button type="button" id="searchdata" class="btn btn-primary btn-sm " style="margin-top: 19%;">Search Data</button>
										</div> 
									</div>
								</div>
							
								<div class="col-12 col-sm-12">
                                    <label class="fieldlabels">Plant/ Project Name : <span class="required">*</span></label>
									 
									<input type="text" class="form-control" name="plant_name" id="plant_name" placeholder="Enter Plant Name" />
									<input type="hidden"  name="organization_id" id="organization_id" value="<?=$org['id'];?>" />
									<input type="hidden"  name="project_id" id="project_id" value="0" />
                                </div>  
								<div class="col-12 col-sm-12">
									<label class="fieldlabels">Benefits/ Support Sought : <span class="required">*</span> <span id="checkRegPurpose_err"></span> </label>
									<div class="table-responsive">
										<table class="table table-bordered linkage_tbl" id="checkRegPurpose">
											<?php 
												foreach($reg_purposes as $reg_purpose){ 
													if($reg_purpose['id']==260){ ?>
														<tr>
															<td  width="15">
																<div class="form-check d-flex align-items-start ps-0">
																  <input class="form-check-input checkRegPurpose" name="regPurpose_other[]" type="checkbox" value="<?=$reg_purpose['id']?>" data-requiredchild="regPurpose_other<?=$reg_purpose['id']?>"  id="regPurpose_other<?=$reg_purpose['id']?>">
																  <label class="form-check-label ms-2" for="regPurpose_other<?=$reg_purpose['id']?>">
																	<?=$reg_purpose['title'];?> 
																  </label>
																</div>
																
															</td>
															<td>
																<div class="">
																	<div class="row" id="regPurpose_other_sec">
																		<div class="col-sm-10">
																			<input type="text" name="regPurpose_other[]" id="regPurpose_otherMsg<?=$reg_purpose['id']?>" class="form-control otherPurpose" placeholder="Please Specify" disabled>
																		</div>
																		<div class="col-sm-2">
																			<a href="javascript:" class="btn btn-primary btn-sm regPurpose_addmore disable-click" id="regPurpose_addmore<?=$reg_purpose['id']?>" >+</a>
																		</div>
																	</div>
																</div>
															</td>
														</tr>
													<?php    
													}else{ ?>
														<tr id="bnf<?=$reg_purpose['id'];?>">
															<td>
																
																<div class="form-check d-flex align-items-start ps-0">
																  <input class="form-check-input checkRegPurpose" name="regPurpose[]" type="checkbox" value="<?=$reg_purpose['id']?>" data-requiredchild="regPurpose<?=$reg_purpose['id']?>" id="regPurpose<?=$reg_purpose['id']?>">
																  <label class="form-check-label ms-2" for="regPurpose<?=$reg_purpose['id']?>" id="regPurposeLbl<?=$reg_purpose['id']?>">
																	<?=$reg_purpose['title'];?> 
																  </label>
																</div>
															</td>
															<td>
																<?php if($reg_purpose['id']==255 | $reg_purpose['id']==257){ ?>
																	<select class="form-select bnfStatus" name="regPurposeStatus[]" id="regPurposeStatus<?=$reg_purpose['id']?>" style="display:none;" >
																		<option value="availed" selected> Availed</option>
																	</select>
																<?php }else{ ?> 
																	<select class="form-select bnfStatus" name="regPurposeStatus[]" id="regPurposeStatus<?=$reg_purpose['id']?>" >
																		<option value=""> Select Status</option>
																		<option value="applied"> Applied</option>
																		<option value="availed"> Availed</option>
																		<option value="required"> Required</option>
																	</select>
																<?php } ?>
															</td>
														</tr>
													<?php
													}
												}
											?>
											
										</table>
									</div>
								</div>
							</div>
						</div>
						<input type="button" name="next" class="next action-button btn btn-primary" value="Next" id="regPurpose" data-id="regPurpose" />
                        <!--<input type="button" name="previous" class="previous action-button btn btn-dark" value="Previous" /> -->
					</fieldset>
					
					<fieldset id="fs1">
                        <div class="form-card">
                            <div class="row">
								<div class="col-md-12">
									<div class="pagetitle-form">
										<div class="row align-items-md-center">
											<div class="col-7">
												<h2 class="fs-title mb-md-0">2. Plant/ Project Details:</h2>
											</div>
											<div class="col-5">
												<h2 class="steps mb-md-0">Step 2 - 5</h2>

											</div>
										</div>
									</div>
								</div>
                            </div>
                            <div class="row">
								
                                <div class="col-12 col-sm-12">
                                    <label class="fieldlabels">2.1 Type of Entity  : <span class="required">*</span></label>
                                    <select class="form-select" name="gas_output" id="gas_output" >
                                        <option value=""> Select type</option>
                                        <?php 
                                            foreach($gasOutputs as $gasOutput){ ?>
                                                <option value="<?=$gasOutput['id']?>"><?=$gasOutput['title'];?></option>                                                
                                            <?php
                                            }
                                        ?>
                                    </select>
									
                                </div>
								

                                <div class="col-12 col-sm-12">
                                    <label class="fieldlabels">2.2 Type of plant : <span class="required">*</span></label>
                                    <select class="form-select" name="" id="plant_type">
                                        <option value="">Select Plant Type</option>
                                    </select>
                                </div>
								
	
                                <div class="col-12 col-sm-12">
                                    <label class="fieldlabels">2.3 Status of plant : <span class="required">*</span></label>
                                    <select class="form-select" name="plant_status" id="plant_status" >
                                        <option value="">Select Plant Status</option>
                                        <?php 
                                            foreach($plant_status as $plantstatus){ ?> 
                                                <option value="<?=$plantstatus['id']?>"><?=$plantstatus['title'];?></option>
                                            <?php 
                                            }
                                        ?>
                                    </select>
                                </div>
								

                                <div class="col-12 col-sm-6">
                                    <div class="row">
                                    <label class="fieldlabels">2.4 Designed Gas Production Capacity : <span class="required">*</span> <span id="production_capacity_err"></span>  </label>

                                        <div class="col-md-8">
                                            <input type="text" name="production_capacity" id="production_capacity" class="form-control onlynumber" placeholder="Please enter the capacity">
                                        </div>
                                        <div class="col-md-4">
											<span class="input-group-text" id="production_capacity_unit" style="height: 40px; margin-top: 1px;">m³/day</span>
                                            <!--<select name="production_capacity_unit" id="production_capacity_unit" class="form-control" disabled>
                                                <option value="1">m<sup>&#xb3</sup>/day</option>
                                                <option value="3">Tons/day</option>
                                            </select>
											-->
                                        </div>
                                    </div>
                                    
                                    
                                </div>
								
								<div class="col-12 col-sm-12">
                                    <label class="fieldlabels">2.5 (A) Designed Solid Feedstock Capacity : <span class="required">*</span></label>
									<div class="input-group">
										<input type="text" name="text" name="feedstockSolid_capacity" id="feedstockSolid_capacity" class="form-control onlynumber" placeholder="Please enter the capacity" >
										<span class="input-group-text solid_output" id="feedstockSolid_capacity_unit" style="height: 40px; margin-top: 1px;">Kg/day</span>
									</div>
                                </div>
								<div class="col-12 col-sm-12">
                                    <label class="fieldlabels">2.5 (B) Designed Liquid Feedstock Capacity : <span class="required">*</span></label>
									<div class="input-group">
										<input type="text" name="text" name="feedstockLiquid_capacity" id="feedstockLiquid_capacity" class="form-control onlynumber" placeholder="Please enter the capacity" >
										<span class="input-group-text liquid_output" id="feedstockLiquid_capacity_unit" style="height: 40px; margin-top: 1px;">Liters/day</span>
									</div>
                                </div>
								
								<div class="col-12 col-sm-12">
                                    <label class="fieldlabels">2.6 (A) Designed bio-slurry output : <span class="required">*</span></label>
									<div class="input-group">
										<input type="text" name="text" name="design_bioslurry" id="design_bioslurry" class="form-control onlynumber" placeholder="Please enter the capacity" >
										<span class="input-group-text liquid_output" id="design_bioslurry_unit" style="height: 40px; margin-top: 1px;">Liters/day</span>
									</div>
                                </div>
								<div class="col-12 col-sm-12">
                                    <label class="fieldlabels">2.6 (B) Designed FOM output : <span class="required">*</span></label>
									<div class="input-group">
										<input type="text" name="text" name="design_FOM" id="design_FOM" class="form-control onlynumber" placeholder="Please enter the capacity" >
										<span class="input-group-text solid_output" id="design_FOM_unit" style="height: 40px; margin-top: 1px;">Kg/day</span>
									</div>
                                </div>
								<div class="col-12 col-sm-12">
                                    <label class="fieldlabels">2.6 (C) Designed LFOM output : <span class="required">*</span></label>
									<div class="input-group">
										<input type="text" name="text" name="design_LFOM" id="design_LFOM" class="form-control onlynumber" placeholder="Please enter the capacity" >
										<span class="input-group-text liquid_output" id="design_LFOM_unit" style="height: 40px; margin-top: 1px;">Liters/day</span>
									</div>
                                </div> 
								
								

				
                                <div class="col-12 col-sm-12">
                                    <label class="fieldlabels">2.7 Type & Source of designed Feedstock : <span class="required">*</span></label>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table table-bordered linkage_tbl" id="checkFeedstock">
												<tr style="background-color:lightblue;font-weight:bold;">
													<td colspan="2" >A. Solid Feedstock <span id="solidFeedstockError"></span> </td>
												</tr>
                                                <?php 
                                                    foreach($feedstock_types as $feedstock_type){
														
														if($feedstock_type['id']==45){?>
															<tr>
                                                                <td>
                                                                    <input class="form-check-input checkFeedstock solidfs" name="feedstock[]" type="checkbox" value="<?=$feedstock_type['id']?>" id="feedstock<?=$feedstock_type['id']?>" /> 
																	<label class="form-check-label ms-2" > <?=$feedstock_type['title']?> </label>
                                                                </td>
                                                                <td class="ps-3 pe-3" style="width: 30%;">
																	<div class="row" id="feedstock_type_other_sec">
																		<div class="col-sm-12">
																			<div class="input-group mb-1">
																			   <input type="text" name="feedstock_type_otherMsg[]" id="feedstock_type_otherMsg<?=$feedstock_type['id']?>" data-requiredchild="feedstock_type_otherNo<?=$feedstock_type['id']?>" class="form-control solidFsOther" placeholder="Please Specify" disabled>
																			  <a href="javascript:" class="btn btn-primary btn-sm feedstock_type_addmore disable-click " data-id="<?=$feedstock_type['id']?>" id="feedstock_type_addmore<?=$feedstock_type['id']?>" >+</a>
																			</div>
																			
																		   
																		</div>
																		<div class="col-sm-12">
																			<div class="row mt-2">
																				<div class="col-sm-6">
																					<div class="input-group">
																						<input type="text" name="feedstock_type_otherNo[]" id="feedstock_type_otherNo<?=$feedstock_type['id']?>" class="form-control fsNumber fssolid solidFsOtherNo" placeholder="Enter Quantity" disabled>
																						<?php  echo getUnits('feedstock_type_other_unit', $feedstock_type['unit_type'], $feedstock_type['id']);?>
																					</div>
																				</div>
																				<div class="col-sm-6">
																					<select class="tblformat check_multiselect  chackfeedstockSourceSelect solidOtherFsSoData0" multiple  name="feedstockSource_other[]" data-id="<?=$feedstock_type['id']?>" id="feedstockSource_other<?=$feedstock_type['id']?>" placeholder="Select Feedstock Sources" disabled >
																						
																						<?php
																							foreach($feedstock_sources as $feedstock_source){ ?>
																								<option value="<?=$feedstock_source['id']?>"><?=$feedstock_source['title']?></option>
																						<?php } ?>
																					</select>
																				</div>
																				<div class="col-sm-12 mt-2">
																					<input type="text" class="form-control solidOtherFsSoOther" id="otherSourceSpecify<?=$feedstock_type['id']?>" style="display:none;" placeholder="Please specify other source" />
																				</div>
																			</div>
																		</div>
																	</div>
                                                                </td>
                                                            </tr>
														<?php	
														}
														else{ ?>
															<tr>
                                                                <td>
                                                                    <input class="form-check-input checkFeedstock solidfs" name="feedstock[]" type="checkbox" value="<?=$feedstock_type['id']?>" data-requiredchild="feedstock_number<?=$feedstock_type['id']?>" id="feedstock<?=$feedstock_type['id']?>" /> 
																	<label class="form-check-label ms-2" > <?=$feedstock_type['title']?> </label>
                                                                </td>
                                                                <td class="ps-3 pe-3" style="width: 30%;">
																	<div class="row">
																		<div class="col-sm-8">
																			<div class="input-group">
																				<input type="text" name="feedstock_number[]" id="feedstock_number<?=$feedstock_type['id']?>" class="form-control tblformat fsNumber fssolid" placeholder="Enter Quantity" disabled >
																				<?php  echo getUnits('feedstock_type_unit', $feedstock_type['unit_type'], $feedstock_type['id']);?>
																			</div>
																		</div>
																		<div class="col-sm-4">
																			<select class="tblformat check_multiselect chackfeedstockSourceSelect" multiple  name="feedstockSource[]" data-id="<?=$feedstock_type['id']?>" id="feedstockSource<?=$feedstock_type['id']?>" placeholder="Select Feedstock Sources" disabled>
																				
																				<?php
																					foreach($feedstock_sources as $feedstock_source){ ?>
																						<option value="<?=$feedstock_source['id']?>"><?=$feedstock_source['title']?></option>
																				<?php } ?>
																			</select>
																		</div>
																		<div class="col-sm-12 mt-2">
																			<input type="text" class="form-control" id="otherSourceSpecify<?=$feedstock_type['id']?>" style="display:none;" placeholder="Please specify other source" />
																		</div>
																	</div>
																	
                                                                </td>
                                                            </tr>
														<?php	
														}
                                                    }
                                                ?>
                                                <tr class="subTotal">
                                                    <td>
                                                        Sub Total Solid Feedstock:
                                                    </td>
                                                    <td>
														<div class="input-group">
															<input type="text" name="total_feedstock" id="total_feedstock" class="form-control tblformat" value="0" placeholder=" " disabled>
															<span class="input-group-text solid_output" id="total_feedstock_unit" >Kg/day</span>
														</div>
                                                    </td>
                                                </tr>
                                                
												
												
												<tr style="background-color:lightblue;font-weight:bold;">
													<td colspan="2" >B. Liquid Feedstock <span id="liquidFeedstockError"></span> </td>
												</tr>
                                                <?php 
                                                    foreach($feedstock_types_liqd as $feedstock_type){
														
														if($feedstock_type['id']==241){?>
															<tr>
                                                                <td>
                                                                    <input class="form-check-input checkFeedstock liquidfs" name="feedstock[]" type="checkbox" value="<?=$feedstock_type['id']?>" data-requiredchild="feedstock_type_otherNo<?=$feedstock_type['id']?>" id="feedstock<?=$feedstock_type['id']?>" /> 
																	<label class="form-check-label ms-2" > <?=$feedstock_type['title']?> </label>
                                                                </td>
                                                                
																<td class="ps-3 pe-3" style="width: 30%;">
																	<div class="row" id="feedstock_type_other_sec">
																		<div class="col-sm-12">
																			<div class="input-group mb-1">
																			   <input type="text" name="feedstock_type_otherMsg[]" id="feedstock_type_otherMsg<?=$feedstock_type['id']?>" data-requiredchild="feedstock_type_otherNo<?=$feedstock_type['id']?>" class="form-control liquidFsOther" placeholder="Please Specify" disabled>
																			  <a href="javascript:" class="btn btn-primary btn-sm feedstock_type_addmore disable-click " data-id="<?=$feedstock_type['id']?>" id="feedstock_type_addmore<?=$feedstock_type['id']?>" >+</a>
																			</div>
																			
																		   
																		</div>
																		<div class="col-sm-12">
																			<div class="row mt-2">
																				<div class="col-sm-6">
																					<div class="input-group">
																						<input type="text" name="feedstock_type_otherNo[]" id="feedstock_type_otherNo<?=$feedstock_type['id']?>" class="form-control fsNumberLiquid liquidFsOtherNo" placeholder="Enter Quantity" disabled>
																						<?php  echo getUnits('feedstock_type_other_unit', $feedstock_type['unit_type'], $feedstock_type['id']);?>
																					</div>
																				</div>
																				
																				<div class="col-sm-6">
																					<select class="tblformat check_multiselect  chackfeedstockSourceSelect liquidOtherFsSoData0" multiple  name="feedstockSource_other[]" data-id="<?=$feedstock_type['id']?>" id="feedstockSource_other<?=$feedstock_type['id']?>" placeholder="Select Feedstock Sources" disabled >
																						
																						<?php
																							foreach($feedstock_sources as $feedstock_source){ ?>
																								<option value="<?=$feedstock_source['id']?>"><?=$feedstock_source['title']?></option>
																						<?php } ?>
																					</select>
																				</div>
																				<div class="col-sm-12 mt-2">
																					<input type="text" class="form-control liquidOtherFsSoOther" id="otherSourceSpecify<?=$feedstock_type['id']?>" style="display:none;" placeholder="Please specify other source" />
																				</div>
																				
																				
																			</div>
																		</div>
																	</div>
                                                                </td>
																
                                                            </tr>
														<?php	
														}
														else{ ?>
															<tr>
                                                                <td>
                                                                    <input class="form-check-input checkFeedstock liquidfs" name="feedstock[]" type="checkbox" value="<?=$feedstock_type['id']?>" data-requiredchild="feedstock_number<?=$feedstock_type['id']?>" id="feedstock<?=$feedstock_type['id']?>" /> 
																	<label class="form-check-label ms-2" > <?=$feedstock_type['title']?> </label
                                                                </td>
																<td>
																	<div class="row container" style="padding:0px;">
																		<div class="col-sm-8">
																			<div class="input-group">
																				<input type="text" name="feedstock_number[]" id="feedstock_number<?=$feedstock_type['id']?>" class="form-control tblformat fsNumberLiquid" placeholder="Enter Quantity" disabled >
																				<?php  echo getUnits('feedstock_type_unit', $feedstock_type['unit_type'], $feedstock_type['id']);?>
																			</div>
																		</div>
																		<div class="col-sm-4">
																			<select class="check_multiselect tblformat chackfeedstockSourceSelect" multiple name="feedstockSource[]" data-id="<?=$feedstock_type['id']?>" id="feedstockSource<?=$feedstock_type['id']?>" placeholder="Select Feedstock Sources" disabled >
																				
																				<?php
																					foreach($feedstock_sources as $feedstock_source){ ?>
																						<option value="<?=$feedstock_source['id']?>"><?=$feedstock_source['title']?></option>
																				<?php } ?>
																			</select>
																		</div>
																		<div class="col-sm-12 mt-2" style="width: 98%; margin-left: 10px;">
																			<input type="text" class="form-control" id="otherSourceSpecify<?=$feedstock_type['id']?>" style="display:none;" placeholder="Please specify other source" />
																		</div>
																	</div>
																	
                                                                </td>
                                                            </tr>
														<?php	
														}
                                                    }
                                                ?>
                                                <tr class="subTotal">
                                                    <td>
                                                        Sub Total Liquid Feedstock:
                                                    </td>
                                                    <td>
														<div class="input-group">
															<input type="text" name="total_feedstockLiquid" id="total_feedstockLiquid" value="0" class="form-control tblformat" placeholder=" " disabled>
															<span class="input-group-text liquid_output" id="total_feedstockLiquid_unit" >Litres/day</span>
														</div>
                                                    </td>
                                                </tr>
												
                                            </table>
                                        </div>
                                    
                                    </div>
                                </div>

                               

								
								<div class="col-12 col-sm-12" id="biogasCbgLinkage">
                                    <label class="fieldlabels">2.8 Biogas/ CBG forward linkage : <span class="required">*</span></label>

                                    
                                    <div class="" id="gaslinkage">

                                        <!--In the case of biogas plant   -->
                                        <div class="table-responsive" id="biogas_linkage">
                                            <table class="table table-bordered linkage_tbl" id="checkBiogas">
                                                <?php 
                                                    foreach($biogas_plants as $biogas_plant){
                                                    ?> 
                                                    <tr>
                                                        <td><input class="form-check-input checkBiogas" type="checkbox" value="<?=$biogas_plant['id']?>" data-requiredchild="biogas_linkage_otherNo<?=$biogas_plant['id']?>" id="biogas_linkage<?=$biogas_plant['id']?>" /> <label class="form-check-label ms-2" > <?=$biogas_plant['title']?></label> </td>
                                                        <td><input type="text" name="biogas_linkage_number biogas_number" id="biogas_linkage_number<?=$biogas_plant['id']?>" class="form-control" placeholder="Enter <?php if($biogas_plant['id']==283){ echo "KW"; }else{ echo "Number"; } ?>" disabled></td>
                                                    </tr>
													
                                                <?php }
                                                ?>
                                            </table>
                                        </div>

                                        <!-- In the case of the CBG plant  -->
                                        <div class="table-responsive" id="cbg_linkage">
                                            <table class="table table-bordered linkage_tbl" id="checkCBG">
                                                <?php 
                                                    foreach($cbg_plants as $cbg_plant){ 
														if($cbg_plant['id']==39){ ?>
															<tr>
																<td><input class="form-check-input checkCBG" type="checkbox" value="<?=$cbg_plant['id']?>" data-requiredchild="cbg_linkage_number<?=$cbg_plant['id']?>" id="cbg_linkage<?=$cbg_plant['id']?>" /> <label class="form-check-label ms-2" > <?=$cbg_plant['title']?> </label> </td>
																<td>
																	<div class="">
																		<div class="row" id="otherCBGLinkage_sec">
																			<div class="col-sm-10">
																				<input type="text" name="other_cbg[]" id="other_cbglinkage0" class="form-control other_cbglinkage" placeholder="Please Specify">
																			</div>
																			<div class="col-sm-2">
																				<a href="javascript:" class="btn btn-primary btn-sm other_cbglinkage_addmore" id="other_cbglinkage0">+</a>
																			</div>
																		</div>
																	</div>
																</td>
															</tr>
														<?php	
														}
														else { ?>
															<tr>
																<td><input class="form-check-input checkCBG" type="checkbox" value="<?=$cbg_plant['id']?>" data-requiredchild="cbg_linkage_number<?=$cbg_plant['id']?>" id="cbg_linkage<?=$cbg_plant['id']?>" /> <label class="form-check-label ms-2" > <?=$cbg_plant['title']?> </label> </td>
																<td>
																<?php if($cbg_plant['id']==269){?> 
																	<input type="text" name="cbg_linkage_number" id="cbg_linkage_number<?=$cbg_plant['id']?>" class="form-control" placeholder="Enter Number" disabled>
																<?php }else{ ?>
																	<input type="hidden" name="cbg_linkage_number" id="cbg_linkage_number<?=$cbg_plant['id']?>" >
																<?php
																} ?>
																</td>
															</tr>
														<?php	
														}
													}
                                                ?>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
								
								<div class="col-12 col-sm-12" id="cbg_distance_grid">
                                    <label class="fieldlabels">2.9 Distance from the nearest grid  : </label>
                                    <input type="text" name="distance_grid" id="distance_grid" class="form-control" placeholder="Distance from the nearest grid (in Km)">
                                </div>
								
								<div class="col-sm-12" id="intent_letter_sec" >
									<label class="fieldlabels">2.10 Details of Letter of Intent from OMC: <span class="required">*</span></label>
									<select class="form-control" name="loiDetails" id="loiDetails">
                                        <option value="">Select Letter of intent Details</option>
                                        <?php 
                                            foreach($loi_detailss as $loi_details){ ?>
                                                <option value="<?=$loi_details['id']?>"><?=$loi_details['title']?></option>                                            
                                            <?php
                                            }
                                        ?> 
                                    </select>
									
									<div class="row mt-3" id="lobtained" style="display:none;" >
										<label class="fieldlabels">Details <span class="required">*</span></label>
										<br>
										<div class="col-sm-12">
											<input type="text" name="loi_obtain_details" id="loi_obtain_details" class="form-control" />
										</div>
									</div>
								</div>

								
								<div class="col-12 col-sm-12">
									<label class="fieldlabels">2.11 Technology for bio slurry management : </label>

									<div class="check-inline" style="padding:10px;" id="checkBioslurry_tech">
                                        <?php 
                                            foreach($technology_for_bioslurrys as $technology_for_bioslurry){ ?>
                                                <label class="form-check-label" for="bioslurry_tech<?=$technology_for_bioslurry['id']?>">
                                                    <input class="form-check-input checkBioslurry_tech" name="bioslurry_tech[]" type="checkbox" value="<?=$technology_for_bioslurry['id']?>" data-requiredchild="bioslurry_tech<?=$technology_for_bioslurry['id']?>" id="bioslurry_tech<?=$technology_for_bioslurry['id']?>" /> <label class="form-check-label ms-2" >  <?=$technology_for_bioslurry['title']?> </label>
                                                </label>
                                            <?php
                                            }
                                        ?>
									</div>
									<input type="text" name="other_technologybioSlurry" id="other_technologybioSlurry" class="form-control " placeholder="Please specify">
								</div>
								
                            </div>

                        </div>
                        <input type="button" name="next" class="next action-button btn btn-primary" value="Next" id="projectDetails" data-id="projectDetails" />
                        <input type="button" name="previous" class="previous action-button btn btn-dark" value="Previous" />
                    </fieldset>

                    <fieldset id="fs2">
						<div class="form-card">
							<div class="row">
								<div class="col-md-12">
									<div class="pagetitle-form">
										<div class="row align-items-md-center">
											<div class="col-7">
												<h2 class="fs-title mb-md-0">3. Location details :</h2>
											</div>
											<div class="col-5">
												<h2 class="steps mb-md-0">Step 3 - 5 </h2>

											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-6">
									<label class="fieldlabels">3.1 Location of Plant : <span class="required">*</span></label>
									<select class="form-select" name="plant_location" id="plant_location" >
										<option value="">Select Location</option>
										<?php 
											foreach($plantLocations as $plantLocation){ ?>
												<option value="<?=$plantLocation['id'];?>"><?=$plantLocation['title'];?></option>
											<?php
											}
										?>
									</select>
								</div>
								<div class="col-12 col-sm-12">
								<label class="fieldlabels">3.2 Address : <span class="required">*</span></label>
								</div>
								<div id="urban_address">
									<div class="col-md-12 col-sm-12">
										<label class="fieldlabels">Urban Address : <span class="required">*</span></label>
									</div>
									<div class="col-md-12 col-sm-12">
									<div class="row">
										<div class="col-md-4 col-sm-6">
											<select class="form-select" name="urban_state" id="urban_state" >
												<option value="">Select State * </option>
												<?php 
													foreach($states as $state){ ?>
														<option value="<?=$state['state_code']?>"><?=$state['state_name'];?></option>
													<?php	
													}
												?>
											</select>
										</div>
										<div class="col-md-4 col-sm-6">
											<select class="form-select" name="urban_district" id="urban_district" >
												<option value="">Select District * </option>
											</select>
										</div>
										
										<div class="col-md-4 col-sm-6">
											<input class="form-control" type="text" name="urban_city" value="" id="urban_city" placeholder="Please enter City * "/>
										</div>
										<div class="col-md-4 col-sm-6">
											<input class="form-control" type="text" name="urban_ward_number" value="" id="urban_ward_number" placeholder="Please enter Ward No *"/>
										</div>
										<div class="col-md-4 col-sm-6">
											<input class="form-control" type="text" name="urban_pincode" value="" id="urban_pin_code" placeholder="Please enter Pin Code *"/>
										</div>
										<div class="col-md-4 col-sm-6">
											<input class="form-control" type="text" name="urban_street_area" value="" id="urban_street_area" placeholder="Please enter Street/ Area"/>
										</div>

										<div class="col-md-4 col-sm-6">
											<input class="form-control onlynumber" type="text" name="urban_plot_number" value="" id="urban_plot_number" placeholder="Please enter plot number"/>
										</div>
										
									</div>
								</div>
								</div>
								<div id="rural_address">
									<div class="col-md-12 col-sm-12">
									<label class="fieldlabels">Rural Address : <span class="required">*</span></label>
									<div class="row">
										<div class="col-md-4 col-sm-6">
											<select class="form-select" name="rural_state" id="rural_state" >
												<option value="">Select State * </option>
												<?php 
													foreach($states as $state){ ?>
														<option value="<?=$state['state_code']?>"><?=$state['state_name'];?></option>
													<?php	
													}
												?>
											</select>
										</div>
										<div class="col-md-4 col-sm-6">
											<select class="form-select" name="rural_district" id="rural_district" >
												<option value="">Select District *</option>
											</select>
										</div>
										<div class="col-md-4 col-sm-6">
											<select class="form-select" name="rural_block" id="rural_block" >
												<option value="">Select Block * </option>
											</select>
										</div>
										<div class="col-md-12 col-sm-12">
											<div class="row">
												<div class="col-sm-11">
													<div class="row">
														<div class="col-md-4 col-sm-6">
															<select class="form-select rural_gp_multiple rgp" data-id="0" name="rural_gp" id="rural_gp0" >
																<option value="">Select GP *</option>
															</select>
														</div>
														<div class="col-md-4 col-sm-6">
															<select class="form-select rvillage" name="rural_village" id="rural_village0" >
																<option value="0">Select Village *</option>
															</select>
														</div>
														<div class="col-md-4 col-sm-6">
															<input class="form-control rpincode" type="text" name="rural_pincode" value="" id="rural_pincode" placeholder="Please enter Pin code"/>
														</div>

														
													</div>
													
												</div>
												<div class="col-sm-1">
													<div class="row">
														<div class="col-sm-12">
															<a style="padding: 6px 20px;" href="javascript:" class="btn btn-primary btn-sm ruralAddress_addmore" id="ruralAddress_addmore">+</a>
														</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
									
									
									</div>
								</div>
								
								<div id="industrial_area_address">
									<div class="col-md-12 col-sm-12">
									<label class="fieldlabels">Industrial Area Address : <span class="required">*</span></label>
									<div class="row">
										<div class="col-md-4 col-sm-6">
											<select class="form-select" name="industrial_state" id="industrial_state" >
												<option value="">Select State * </option>
												<?php 
													foreach($states as $state){ ?>
														<option value="<?=$state['state_code']?>"><?=$state['state_name'];?></option>
													<?php	
													}
												?>
											</select>
										</div>
										<div class="col-md-4 col-sm-6">
											<select class="form-select" name="industrial_district" id="industrial_district" >
												<option value="">Select District * </option>
											</select>
										</div>
										<div class="col-md-4 col-sm-6">
											<input class="form-control" type="text" name="industrial_pincode" value="" id="industrial_pincode" placeholder="Please enter Pin code *"/>
										</div>
										<div class="col-md-12 col-sm-12">
											<input class="form-control" type="text" name="industrial_address" value="" id="industrial_address" placeholder="Please enter Address"/>
										</div>
										
									</div>
								</div>
								</div>
							</div>
							<div class="row">

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">3.3 Project/ Plant Area : <span class="required">*</span></label>
									<input type="text" class="form-control onlynumber" name="plant_area" id="plant_area" placeholder="Total area in acres">
								</div>

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">3.4 Land ownership : <span class="required">*</span></label>
									<select class="form-select" name="landOwnership" id="landOwnership" >
										<option value="">Select land ownership</option>
										<?php 
											foreach($land_ownerships as $land_ownership){ ?>
												<option value="<?=$land_ownership['id']?>"><?=$land_ownership['title'];?></option>
											<?php	
											}
										?>
									</select>
								    <input type="text" name="landOwnership_other" id="landOwnership_other" class="form-control" placeholder="Please specify">
									
								</div>
								
								
								<div class="col-12 col-sm-12">
									<div class="row">
										<div class="col-6 col-sm-4"><label class="fieldlabels">3.5 Geo tag of location : <span class="required " id="geoTag">*</span> </label></div>
										<div class="col-6 col-sm-4">
											<input type="text" name="latitude" id="latitude" class="form-control" placeholder="Latitude" required>
										</div>
										<div class="col-6 col-sm-4">
											<input type="text" name="longitude" id="longitude" class="form-control" placeholder="Longitude" required>
										</div>
									</div>
								</div>
								
							</div>
						</div>
						<input type="button" name="next" class="next action-button btn btn-primary" value="Next" id="locationDetails" data-id="locationDetails" />
						<input type="button" name="previous" class="previous action-button btn btn-dark" value="Previous" />
					</fieldset>

                    
					

                    

                    <fieldset id="fs5">
						<div class="form-card">
							<div class="row">
								<div class="col-md-12">
									<div class="pagetitle-form">
										<div class="row align-items-md-center">
											<div class="col-7">
												<h2 class="fs-title mb-md-0">4. financial Details :</h2>
											</div>
											<div class="col-5">
												<h2 class="steps mb-md-0">Step 4 - 5 </h2>

											</div>
										</div>
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-12 col-sm-12">
									<label class="fieldlabels">4.1 Total CAPEX only : <span class="required">*</span></label> <br></br>
									<input type="text" name="capex_number[]" class="form-control tblformat capaxNumber onlynumber" id="capex_number" placeholder="in lakhs">
								</div>

								<div class="col-md-12 col-sm-12">
									<label class="fieldlabels">4.2 Funding source : <span class="required">*</span></label> <br>

									<div class="table-responsive">
										<table class="table table-bordered linkage_tbl" id="checkFundingSource">
                                            <?php 
                                                foreach($funding_sources as $funding_source){
                                                    if($funding_source['id']==132){?>
                                                        <tr>
                                                            <td>
                                                                <input class="form-check-input checkFundingSource" name="fundingSource_other[]" type="checkbox" data-requiredchild="fundingSource_otherNo<?=$funding_source['id']?>"  value="<?=$funding_source['id']?>" id="fundingSource_other<?=$funding_source['id']?>" /> <label class="form-check-label ms-2" >  <?=$funding_source['title']?> </label>
                                                            </td>
                                                            <td>
																<div class="row container"> 
																	<div class="row" id="fundingSource_other_sec">
																		<div class="col-sm-6">
																			<input type="text" name="fundingSource_otherMsg[]" id="fundingSource_otherMsg<?=$funding_source['id']?>" class="form-control tblformat fundingSourceOther" placeholder="Please specify" disabled>
																		</div>

																		<div class="col-sm-5">
																			<input type="text" name="fundingSource_otherNo[]" id="fundingSource_otherNo<?=$funding_source['id']?>" class="form-control tblformat fusNumber fundingSourceOtherNo" placeholder="in lakhs" disabled>
																		</div>
																		<div class="col-sm-1">
																			<a href="javascript:" class="btn btn-primary btn-sm fundingSource_addmore disable-click " id="fundingSource_addmore<?=$funding_source['id']?>" >+</a>
																		</div>
																	</div>
																	
																</div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }else{ ?>
                                                        <tr>
                                                            <td>
                                                                <input class="form-check-input checkFundingSource" name="fundingSource[]" type="checkbox" value="<?=$funding_source['id']?>" data-requiredchild="fundingSource_number<?=$funding_source['id']?>"  id="fundingSource<?=$funding_source['id']?>" /> <label class="form-check-label ms-2" >  <?=$funding_source['title']?> </label>
                                                            </td>

                                                            <td>
																<input type="text" name="fundingSource_number[]" id="fundingSource_number<?=$funding_source['id']?>" class="form-control tblformat fusNumber" placeholder="In Lakhs" disabled >
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                }
                                            ?>
											
										</table>
									</div>
								</div>

								
							</div>
							<div class="row">
								
								<div class="col-12 col-sm-6">
									
									
									<div id="commissioning" >
										<label class="fieldlabels">4.7 Commissioned Date  : <span class="required">*</span></label>
										<input type="date" name="date_of_commissioning" id="date_of_commissioning" max="<?=date('Y-m-d')?>" class="form-control" >
									</div>

									<div id="proposed">
										<label class="fieldlabels"> 4.7 Proposed date of Commissioning: <span class="required">*</span></label>
										<input type="date" name="proposed_date" id="proposed_date" min="<?=date('Y-m-d')?>" class="form-control" >
									</div>
									
									<div id="construction">
										<label class="fieldlabels"> 4.7 Proposed date of Construction: <span class="required">*</span></label>
										<input type="date" name="construction_date" id="construction_date" min="<?=date('Y-m-d')?>" class="form-control" >
									</div>
								</div>

								
							</div>
						</div>
						<input type="button" name="next" class="next action-button btn btn-primary" value="Next" id="PhysicalProgress" data-id="PhysicalProgress" />
						<input type="button" name="previous" class="previous action-button btn btn-dark" value="Previous" />
					</fieldset>

                   

                    <fieldset id="fs7">
						<div class="form-card">
							<div class="row">
								<div class="col-md-12">
									<div class="pagetitle-form">
										<div class="row align-items-md-center">
											<div class="col-7">
												<h2 class="fs-title mb-md-0">5. Self-Certification :</h2>
											</div>
											<div class="col-5">
												<h2 class="steps mb-md-0">Step 5 - 5 </h2>

											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="check-inline" id="tc" >
										<label class="form-check-label" for="a">
											<input class="form-check-input " name="privacy" type="checkbox" value="108" data-requiredchild="privacy" id="privacy"> 
											<label class="form-check-label ms-2" > I hereby declare that the above particulars of facts and information stated are true, correct and complete to the best of my belief and knowledge. </label>
										</label>
										<label class="form-check-label" for="b">
											<input class="form-check-input " name="terms" type="checkbox" value="109" data-requiredchild="terms" id="terms"> 
											<label class="form-check-label ms-2" >Subsequently, if such registration  is found to have been obtained on the basis of false information, DDWS reserves the right to revoke the registration number immediately without any prior notice. </label>
										</label>
										
									</div>
								</div>
								
								
							</div>
						</div>
						<input type="button" style="background-color:red;" name="next" class="next action-button sscertificate " data-d="finalSubmit" value="Submit" id="finalSubmit" />
						<!--<input type="button" name="previous" class="previous action-button btn btn-dark" value="Previous" /> -->
						<!--<input type="button" name="preview" class="action-button btn btn-dark" data-bs-toggle="modal" data-bs-target="#myModal" value="Preview" id="preview" />-->
					</fieldset>

                    <fieldset id="fs8">
						<div class="form-card form-submitted mt-4">
							<h3 class="text-center"><strong>Form Submitted !</strong></h3> <br>
							<div class="row justify-content-center">
								<div class="col-3"> <i class="fa fa-check subbmited-sign"></i> </div>
							</div> <br><br>
							<div class="row justify-content-center">
								<div class="col-7 text-center">
									<h5 class="text-center">Thank you for registering in the Unified Registration Portal for GOBARdhan. Kindly download the registration certification by clicking <a href="<?=base_url()?>profile">here</a>. The registration certificate is also sent to the registered email.</h3>
								</div>
							</div>
						</div>
					</fieldset>

                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal" style="z-index: 1000000;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Preview Data</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height: 600px; overflow: scroll;">
				<table class="table table-bordered">
					<tr>
						<th colspan="2" class="previewth">1. Benefits/ Support:</th>
					</tr>
					<tr>
						<th>Plant Name</th>
						<td>Biogas Plant</td>
					</tr>
					<tr>
						<th>Benefits</th>
						<td>Interest subvention (Animal Husbandry Infrastructure Development Fund (AHIDF) - Department of Animal Husbandry & Dairying (DAHD)</td>
					</tr>
					<tr>
						<th colspan="2" class="previewth">2. Plant/ Project Details:</th>
					</tr>
					<tr>
						<th>2.1 Type of Entity</th>
						<td>Biogas plant operator</td> 
					</tr>
					<tr>
						<th>2.2 Type of plant</th>
						<td>Community-based</td> 
					</tr>
				</table>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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

  <!-- Load the Google Maps JavaScript API 
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBGDykuELSi8g1GQkyqlUblltEahmERiE&callback=initMap" async defer></script>
 -->
<script>

$(document).ready(function(){
	/*
	$(".prgsbar").on("click", function(e){
		e.preventDefault();
		let prbId = $(this).data("id");
		$(".prgsbar").each(function(){
			let pid = $(this).data("id");
			if(prbId==pid){
				$("#fs"+pid).show();
				$(this).addClass(' active');
			}else{
				$("#fs"+pid).hide();
				//$(this).removeClass('active');
			}
		});
	})
	*/
	
	
	$("#have_ministry").on("change", function(){
		let have_ministry = $(this).val();
		$("#reg-number").addClass(' d-none');
		if(have_ministry!=""){
			$("#reg-number").removeClass('d-none');
			$("#uniqueNumberMsg").html('');
			if(have_ministry==2){
				$("#uniqueNumberMsg").html('Enter Loan Account Number');
			}else if(have_ministry==3){
				$("#uniqueNumberMsg").html('Enter Registration Number');
			}else if(have_ministry==5){
				$("#uniqueNumberMsg").html('Enter LoI Referance Number');
			}else{
				$("#uniqueNumberMsg").html('');
				$("#reg-number").addClass(' d-none');
			}
		}
	});
	
	$("#searchdata").on("click", function(){
		let hminstry = $("#have_ministry").val();
		let ucode =  $("#uniqueCode").val();
		$("#uniqueCode_err").html('');
		if(hminstry!="" && ucode!=""){
			$.ajax({
				url:"<?=base_url()?>check-project",
				type:"post",
				data:{mcode:hminstry,ucode:ucode},
				success:function(res){
					let ress = JSON.parse(res);
					if(ress.status==1){
						window.location.href="<?=base_url()?>project-edit/"+ress.project_id;
					}else{
						$("#uniqueCode_err").html(ress.message);
					}
				}
			});
		}else{
			$("#uniqueCode_err").html('This field is required.');
		}
	});
})
</script>

<script>
	function inArray(myArray,myValue){
		var inArray = false;
		myArray.map(function(key){
			if (key == myValue){
				inArray=true;
			}
		});
		return inArray;
	};
	
	$("#biogas_linkage").addClass(' blocksec');
    $("#cbg_linkage").addClass(' blocksec');
    $("#biogasCbgLinkage").addClass(' blocksec');
	$("#cbg_distance_grid").addClass(' blocksec');
	$("#div_cbg_purification").addClass(' blocksec');
	$("#biogas_revenue").addClass(' blocksec');
	$("#cbg_revenue").addClass(' blocksec');
	
	
	$("#commissioning").addClass(' blocksec');
	$("#proposed").addClass(' blocksec');
	$("#construction").addClass(' blocksec');
	
	var unit='Kg/day';
	var unit_liquid='Liters/day';
    $(document).on("change",'#gas_output', function(){
		$('#production_capacity_unit').html("");
		//$("#production_capacity_unit").attr("disabled", false);
		$("#biogasCbgLinkage").removeClass(' blocksec');
        let gasOut = $(this).val();
        if(gasOut==17){
			unit='Kg/day'; 
			unit_liquid='Liters/day';
            // $("#biogas_linkage").show();
            // $("#cbg_linkage").hide();
            $("#biogas_linkage").removeClass(' blocksec');
            $("#cbg_linkage").addClass(' blocksec');
            $("#cbg_distance_grid").addClass(' blocksec');
            $("#biogas_revenue").removeClass(' blocksec');
            $("#cbg_revenue").addClass(' blocksec');
            $("#div_cbg_purification").addClass(' blocksec');
            $("#intent_letter_sec").addClass(' blocksec');
			
            $('#production_capacity_unit').html("m³/day");
			//$("#production_capacity_unit").attr("disabled", true);
			$(".solid_output").html(unit);
			$(".liquid_output").html(unit_liquid);
			
			$("#geoTag").hide();
			
            
        }else{
			unit='Tons/day';
			unit_liquid='KLD';
            $("#cbg_linkage").removeClass(' blocksec');
            $("#biogas_linkage").addClass(' blocksec');
            $("#cbg_distance_grid").removeClass(' blocksec');
            $("#div_cbg_purification").removeClass(' blocksec');
			$("#intent_letter_sec").removeClass(' blocksec');
			
			$("#biogas_revenue").addClass(' blocksec');
            $("#cbg_revenue").removeClass(' blocksec');
            $('#production_capacity_unit').html("Tons/day");
			//$("#production_capacity_unit").attr("disabled", true); 
			$(".solid_output").html(unit);
			$(".liquid_output").html(unit_liquid);
			
			$("#geoTag").show();
            
        }

        $.ajax({
            url:"<?=base_url()?>get-plantType",
            type:"post",
            data:{gasOutput:gasOut},
            success:function(res){
                $("#plant_type").html(res);
            }
        });
    });
	
	
	$(document).on("change",'#plant_status', function(){
		$("#commissioning").addClass(' blocksec');
		$("#proposed").addClass(' blocksec');
		$("#construction").addClass(' blocksec');
		
		if($(this).val()==23){
			$("#proposed").removeClass(' blocksec');
		}else if($(this).val()==22){
			$("#construction").removeClass(' blocksec');
		}else{
			$("#commissioning").removeClass(' blocksec');
		}
	});
	
	
	var rural_sn=0;
	$(document).ready(function(){
		$("#ruralAddress_addmore").on("click", function(){
			rural_sn++;
			let rurlgpOpt =  $("#rural_gp0").html();
			let moreRuralAddress = '<div class="col-sm-12"> <div  class="row">\
										<div class="col-sm-11"><div class="row"><div class="col-md-4 col-sm-6">\
											<select class="form-select rural_gp_multiple rgp" name="rural_gp" data-id="'+rural_sn+'" id="rural_gp'+rural_sn+'">\
												'+rurlgpOpt+'\
											</select>\
										</div>\
										<div class="col-md-4 col-sm-6">\
											<select class="form-select rvillage" name="rural_village" id="rural_village'+rural_sn+'" >\
												<option value="0">Select Village</option>\
											</select>\
										</div>\
										<div class="col-md-4 col-sm-6">\
											<input class="form-control rpincode" type="text" name="rural_pincode" id="rural_pincode" placeholder="Please enter Pin code"/>\
										</div></div></div>\
										<div class="col-sm-1">\
											<a href="javascript:" class="btn btn-primary btn-sm ruralAddress_addmore_minus" id="ruralAddress_addmore_minus">-</a>\
										</div>\
									</div></div>';
			
			$("#rural_address").append(moreRuralAddress);
			
			$(document).on("click",'.ruralAddress_addmore_minus', function(){
				//let biogas_minus = $(this).data("id");
				//$(".biogasAdded"+biogas_minus).;
				$(this).parent().parent().remove();
			});
		})
	})
	

    /// 4.5 EVENTS BIOGAS
    $(document).ready(function(){
		
		let orgType = "<?=$org['entity_type'];?>";
		if(orgType=="2"){
			$("#bnf255").hide();
		}
		
        $(".checkBiogas").on("change",function(e){
            e.preventDefault();

            $(".checkBiogas").each(function(){
                if(this.checked){
                    $("#biogas_linkage_number"+this.value).attr('disabled',false);
                    if(this.value==34){
                        $("#biogas_linkage_otherMsg34").attr('disabled',false);
                        $("#biogas_linkage_otherNo34").attr('disabled',false);
                        $("#biogas_linkage_addmore34").removeClass('disable-click');
                    }
                }
                else{
                    $("#biogas_linkage_number"+this.value).attr('value','');
                    $("#biogas_linkage_number"+this.value).attr('disabled',true);
                }
            }) 
        })

        var biogasOther_sn=0;
        $(".biogas_linkage_addmore").on("click", function(){
            biogasOther_sn++;
            let biogasLinkageOtherSpecify='<div class="col-sm-6 mt-2 biogasAdded'+biogasOther_sn+'">\
                                                <input type="text" name="biogas_linkage_otherMsg[]" id="biogas_linkage_otherMsg'+biogasOther_sn+'" class="form-control" placeholder="Please Specify" >\
                                            </div>\
                                            <div class="col-sm-5 mt-2 biogasAdded'+biogasOther_sn+'">\
                                                <input type="text" name="biogas_linkage_otherNo[]" id="biogas_linkage_otherNo'+biogasOther_sn+'" class="form-control" placeholder="Enter Number" >\
                                            </div>\
                                            <div class="col-sm-1 mt-2 biogasAdded'+biogasOther_sn+'">\
                                                <a href="javascript:" class="btn btn-primary btn-sm biogas_linkage_minus" data-id="'+biogasOther_sn+'"  >-</a>\
                                            </div>';
            $("#biogas_linkage_other_sec").append(biogasLinkageOtherSpecify);
        });

        $(document).on("click",'.biogas_linkage_minus', function(){
            let biogas_minus = $(this).data("id");
            $(".biogasAdded"+biogas_minus).remove();
        });
		
		
		$("#production_capacity").on("keyup", function(){
			let pcapact = $(this).val();
			if($("#gas_output").val()==17 && pcapact<10){
				$("#production_capacity_err").html('Production should be >=10.');
			}else{
				$("#production_capacity_err").html('');
			}
		});
		
    })

    ///4.5 EVENTS CBG
    $(document).ready(function(){
        $(".checkCBG").on("change",function(e){
            e.preventDefault();
            $(".checkCBG").each(function(){
                if(this.checked){
                    $("#cbg_linkage_number"+this.value).attr('disabled',false);
                    if(this.value==39){
                        $("#cbg_linkage_otherMsg39").attr('disabled',false);
                        $("#cbg_linkage_otherNo39").attr('disabled',false);
                        $("#cbg_linkage_addmore39").removeClass('disable-click');
                    }
                }
                else{
                    $("#cbg_linkage_number"+this.value).attr('value','');
                    $("#cbg_linkage_number"+this.value).attr('disabled',true);
                }
            }) 
        })

        var cbgOther_sn=0;
        $(".cbg_linkage_addmore").on("click", function(){
            cbgOther_sn++;
            let cbgLinkageOtherSpecify='<div class="col-sm-6 mt-2 cbgAdded'+cbgOther_sn+'">\
                                                <input type="text" name="cbg_linkage_otherMsg[]" id="cbg_linkage_otherMsg'+cbgOther_sn+'" class="form-control" placeholder="Please Specify" >\
                                            </div>\
                                            <div class="col-sm-5 mt-2 cbgAdded'+cbgOther_sn+'">\
                                                <input type="text" name="cbg_linkage_otherNo[]" id="cbg_linkage_otherNo'+cbgOther_sn+'" class="form-control" placeholder="Enter Number" >\
                                            </div>\
                                            <div class="col-sm-1 mt-2 cbgAdded'+cbgOther_sn+'">\
                                                <a href="javascript:" class="btn btn-primary btn-sm cbg_linkage_minus" data-id="'+cbgOther_sn+'"  >-</a>\
                                            </div>';
            $("#cbg_linkage_other_sec").append(cbgLinkageOtherSpecify);
        });

        $(document).on("click",'.cbg_linkage_minus', function(){
            let cbg_minus = $(this).data("id");
            $(".cbgAdded"+cbg_minus).remove();
        });

    });

    ///4.7 EVENTS FEEDSTOCK
    $(document).ready(function(){
        $(".checkFeedstock").on("change",function(e){
            e.preventDefault();
			
			$(".solidfs").each(function(){
				if(!this.checked){
					let rmno = parseFloat($("#feedstock_number"+this.value).val());
					if(rmno>0){
						let stotfs = parseFloat($("#total_feedstock").val())-rmno;
						$("#total_feedstock").val(stotfs);
					}
					if($("#total_feedstock").val()==$("#feedstockSolid_capacity").val()){
						$("#solidFeedstockError").html('');
					}
				}
			});
			
			$(".liquidfs").each(function(){
				if(!this.checked){
					let rmno = parseFloat($("#feedstock_number"+this.value).val());
					if(rmno>0){
						let stotfs = parseFloat($("#total_feedstockLiquid").val())-rmno;
						$("#total_feedstockLiquid").val(stotfs);
					}
					if($("#total_feedstockLiquid").val()==$("#feedstockLiquid_capacity").val()){
						$("#liquidFeedstockError").html('');
					}
				}
			});
			
            $(".checkFeedstock").each(function(){
                if(this.checked){
                    $("#feedstock_number"+this.value).attr('disabled',false);
                    $("#feedstock_unit"+this.value).attr('disabled',false);
                    $("#feedstockSource"+this.value).attr('disabled',false);
					$("#feedstockSource"+this.value).closest('.SumoSelect').removeClass('disabled');
                    
                    if(this.value==45){ 
                        $("#feedstock_type_otherMsg45").attr('disabled',false);
                        $("#feedstock_type_otherNo45").attr('disabled',false);
                        $("#feedstock_type_other_unit45").attr('disabled',false);
                        $("#feedstock_type_addmore45").removeClass('disable-click');
                        $("#feedstockSource_other45").attr('disabled',false);
						$("#feedstockSource_other45").closest('.SumoSelect').removeClass('disabled');
                    }
					
					if(this.value==241){ 
                        $("#feedstock_type_otherMsg241").attr('disabled',false);
                        $("#feedstock_type_otherNo241").attr('disabled',false);
                        $("#feedstock_type_other_unit241").attr('disabled',false);
                        $("#feedstock_type_addmore241").removeClass('disable-click');
						$("#feedstockSource_other241").closest('.SumoSelect').removeClass('disabled');
                    }
                }
                else{
                    $("#feedstock_number"+this.value).val('');
                    $("#feedstock_number"+this.value).attr('disabled',true);
                    $("#feedstock_unit"+this.value).attr('disabled',true);
                    $("#feedstockSource"+this.value).attr('disabled',true);
					$("#feedstockSource"+this.value).closest('.SumoSelect').addClass('disabled');
                }
            });
        })
        
        var feedstockOther_sn=0;
        $(".feedstock_type_addmore").on("click", function(){
			let unt=unit;
			let fsNsum='fsNumber';
			let untlbl = 'solid_output';
			let cls = 'solid';
			let cls2 = '';
			if($(this).data("id")==241){
				unt=unit_liquid;
				untlbl = 'liquid_output';
				fsNsum='fsNumberLiquid';
				cls='liquid';
				cls2='l';
			}
            feedstockOther_sn++;
            let feedstockOtherSpecify='<div class="col-sm-12 mt-2 feedstockAdded'+feedstockOther_sn+'"> \
											<div class="input-group mb-1">\
											   <input type="text" name="feedstock_type_otherMsg[]" id="feedstock_type_otherMsg'+feedstockOther_sn+'" data-requiredchild="feedstock_type_otherNo'+feedstockOther_sn+'" class="form-control '+cls+'FsOther" placeholder="Please Specify" >\
											  <a href="javascript:" class="btn btn-primary btn-sm feedstock_minus  " data-id="'+feedstockOther_sn+'" id="feedstock_type_addmore'+feedstockOther_sn+'" >-</a>\
											</div>\
										</div>\
										<div class="col-sm-12 feedstockAdded'+feedstockOther_sn+'">\
											<div class="row mt-2">\
												<div class="col-sm-6">\
													<div class="input-group">\
														<input type="text" name="feedstock_type_otherNo[]" id="feedstock_type_otherNo'+feedstockOther_sn+'" class="form-control fsNumber fssolid '+cls+'FsOtherNo" placeholder="Enter Quantity" >\
														<span class="input-group-text '+cls2+'feedstock_type_other_unit '+untlbl+'">'+unt+'</span>\
													</div>\
												</div>\
												<div class="col-sm-6">\
													<select class="tblformat check_multiselect  chackfeedstockSourceSelect '+cls+'OtherFsSoData'+feedstockOther_sn+'" multiple  name="feedstockSource_other[]" data-id="'+feedstockOther_sn+'" id="feedstockSource_other'+feedstockOther_sn+'" placeholder="Select Feedstock Sources"  >\
														<?php foreach($feedstock_sources as $feedstock_source){ ?>\
																<option value="<?=$feedstock_source['id']?>"><?=$feedstock_source['title']?></option>\
														<?php } ?>\
													</select>\
												</div>\
												<div class="col-sm-12 mt-2 ">\
													<input type="text" class="form-control '+cls+'OtherFsSoOther" id="otherSourceSpecify'+feedstockOther_sn+'" style="display:none;" placeholder="Please specify other source" />\
												</div>\
											</div>\
										</div>';
										
            //$("#feedstock_type_other_sec").append(feedstockOtherSpecify);
			$(this).parent().parent().parent().append(feedstockOtherSpecify);
			$(".check_multiselect[data-id='"+feedstockOther_sn+"']").SumoSelect().sumo.reload();	
        });
		
		

        $(document).on("click",'.feedstock_minus', function(){
            let feedstock_minus = $(this).data("id");
            $(".feedstockAdded"+feedstock_minus).remove();
        });
		
		$(document).on("change",'.chackfeedstockSourceSelect', function(){
		//$(".chackfeedstockSourceSelect").on("change", function(){
			let fgcheckedVals = $('option:selected',this).map(function() {
				return this.value;
			}).get();
			
			let i = $(this).data("id");
			if(inArray(fgcheckedVals,53)){
				$("#otherSourceSpecify"+i).show();
			}else{
				$("#otherSourceSpecify"+i).hide();
			}
			
		})
		
		
		///ENTER ONLY NUMBER 
		// $(".fsNumber, .fsNumberLiquid").on("keypress keyup blur",function (event) {  
		$(document).on("keypress keyup blur",'.fsNumber, .fsNumberLiquid, .onlynumber', function(event){		
		   // $(this).val($(this).val().replace(/[^\d].+/, ""));
			// if ((event.which < 48 || event.which > 57)) {
				// event.preventDefault();
			// }
			
			if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
				event.preventDefault();
			}
		
		});
		
		///TOTAL SUM OF THE FEEDSTOCK
		$(document).on("keyup",'.fsNumber', function(){
			var fsSubTotal = 0;
			$('.fsNumber').each(function(){
				if($(this).val()!=''){
					fsSubTotal = parseFloat($(this).val()) + fsSubTotal;
				}
			});
			$("#total_feedstock").attr("value",fsSubTotal);
		})
		
		$(document).on("keyup",'.fsNumberLiquid', function(){
			var fsSubTotal = 0;
			$('.fsNumberLiquid').each(function(){
				if($(this).val()!=''){
					fsSubTotal = parseFloat($(this).val()) + fsSubTotal;
				}
			});
			$("#total_feedstockLiquid").attr("value",fsSubTotal);
		})
		
		$(document).on("keyup",'#feedstockSolid_capacity, .fssolid', function(){
			let feedstockSolidCapacity = $('#feedstockSolid_capacity').val();
			let totalfeedstock = $('#total_feedstock').val();
			if(feedstockSolidCapacity==totalfeedstock | feedstockSolidCapacity==0){
				$("#solidFeedstockError").html('');
			}else{
				$("#solidFeedstockError").html('Designed Solid Feedstock Capacity should be equal Total Solid Feedstock. ');
			}
			
		});
		
		$(document).on("keyup",'#feedstockLiquid_capacity, .fsNumberLiquid', function(){
			let feedstockLiquidCapacity = $('#feedstockLiquid_capacity').val();
			let total_feedstockLiquid = $('#total_feedstockLiquid').val();
			if(feedstockLiquidCapacity==total_feedstockLiquid | (feedstockLiquidCapacity==0 && total_feedstockLiquid==0 )){
				$("#liquidFeedstockError").html('');
			}else{
				$("#liquidFeedstockError").html('Designed Liquid Feedstock Capacity should be equal Total Liquid Feedstock. ');
			}
			
		});
		
    })

	
    ///4.8 EVENTS FEEDSTOCK SOURCE
    $(document).ready(function(){
        
		///ENTER ONLY NUMBER 
		// $(".fssNumber, .fssNumberLiquid").on("keypress keyup blur",function (event) {    
		$(document).on("keypress keyup blur",'.fssNumber, .fssNumberLiquid', function(){
		   /* $(this).val($(this).val().replace(/[^\d].+/, ""));
			if ((event.which < 48 || event.which > 57)) {
				event.preventDefault();
			} */
			if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
				event.preventDefault();
			}
		});
		
		///TOTAL SUM OF THE FEEDSTOCK
		$(document).on("keyup",'.fssNumber', function(){
			var fssSubTotal = 0;
			$('.fssNumber').each(function(){
				if($(this).val()!=''){
					fssSubTotal = parseFloat($(this).val()) + fssSubTotal;
				}
			});
			$("#total_feedstock_source").attr("value",fssSubTotal);
		})
		
		$(document).on("keyup",'.fssNumberLiquid', function(){
			var fssSubTotal = 0;
			$('.fssNumberLiquid').each(function(){
				if($(this).val()!=''){
					fssSubTotal = parseFloat($(this).val()) + fssSubTotal;
				}
			});
			$("#total_feedstock_sourceLiquid").attr("value",fssSubTotal);
		})
		
    })

	
	$(".checkRegPurpose").on("click", function(){
		if(this.checked){
			if(this.value=="260"){
				$("#regPurpose_otherMsg260").attr('disabled',false);
				$("#regPurpose_addmore260").removeClass('disable-click');
			}
			else{
				$("#regPurpose_otherMsg260").attr('disabled',true);
				$("#regPurpose_addmore260").addClass(' disable-click');
			}
		}
		
		$("#regPurpose253").attr('disabled',false);
		$("#regPurpose254").attr('disabled',false);
		$("#regPurpose255").attr('disabled',false);
		$("#regPurpose256").attr('disabled',false);
		$("#regPurpose257").attr('disabled',false);
		$("#regPurpose258").attr('disabled',false);
		$("#regPurpose259").attr('disabled',false);
		$("#regPurpose_other260").attr('disabled',false);
		//console.log(this.value);
		if(this.checked && this.value==253){
			$("#regPurpose254").attr('disabled',true);
		}
		if(this.checked && this.value==254){
			$("#regPurpose253").attr('disabled',true);
		}
		if(this.checked && this.value==255){
			$("#regPurpose253").attr('disabled',true);
			$("#regPurpose254").attr('disabled',true);
			
			$("#regPurpose256").attr('disabled',true);
			$("#regPurpose257").attr('disabled',true);
			
			$("#regPurpose258").attr('disabled',true);
			$("#regPurpose259").attr('disabled',true);
			$("#regPurpose_other260").attr('disabled',true);
		}
		if(this.checked && this.value==256){
			$("#regPurpose255").attr('disabled',true);
			$("#regPurpose257").attr('disabled',true);
		}
		if(this.checked && this.value==257){
			$("#regPurpose255").attr('disabled',true);
			$("#regPurpose256").attr('disabled',true);
			$("#regPurpose253").attr('disabled',true);
			$("#regPurpose254").attr('disabled',true);
		}
		
		
		
		var regPrpss = $('.checkRegPurpose:checkbox:checked').map(function() {
			return this.value;
		}).get();
		
		$(".checkRegPurpose").each(function(){
			if(!this.checked){
				$("#schemeTr"+this.value).remove();
				$("#regPurposeStatus"+this.value).val('');
			}
		});
		
		$.each(regPrpss, function (key, val) {
			$("#schemeTr"+val).remove();
			let sts = $("#regPurposeStatus"+val).val();
			if((val==253 && sts=='availed' ) | (val==254 && sts=='availed' ) | (val==256 && sts=='availed' ) | (val==257 && sts=='availed' ) | (val==255)){
				let govTxt = $("#regPurposeLbl"+val).text();
				let govSchema = '<tr id="schemeTr'+val+'" >\
									<td>\
										<input class="form-check-input checkFundingSource" name="fundingSource[]" type="checkbox" value="'+val+'" data-requiredchild="fundingSource_number'+val+'" id="fundingSource'+val+'"> <label class="form-check-label ms-2" > '+govTxt+' </label> </td>\
									<td>\
										<input type="text" name="fundingSource_number[]" id="fundingSource_number'+val+'" class="form-control tblformat fusNumber" placeholder="In Lakhs" disabled >\
									</td>\
								</tr>';
				
				$("#checkFundingSource").prepend(govSchema);
			}
		});
		
		$(".bnfStatus").on("change", function(){
			
			let chbxv = $("#regPurpose"+$(this).data("id")).val();
			let vl = $(this).val();
			console.log('---'+chbxv);
			if((vl=='availed' && chbxv==253) | (vl=='availed' && chbxv==254) | (vl=='availed' && chbxv==256) | (vl=='availed' && chbxv==257) | (vl=='availed' && chbxv==255) ){
				let govTxt = $("#regPurposeLbl"+chbxv).text();
				$("#schemeTr"+chbxv).remove();
				let govSchema = '<tr id="schemeTr'+chbxv+'" >\
									<td>\
										<input class="form-check-input checkFundingSource" name="fundingSource[]" type="checkbox" value="'+chbxv+'" data-requiredchild="fundingSource_number'+chbxv+'" id="fundingSource'+chbxv+'"> <label class="form-check-label ms-2" > '+govTxt+' </label> </td>\
									<td>\
										<input type="text" name="fundingSource_number[]" id="fundingSource_number'+chbxv+'" class="form-control tblformat fusNumber" placeholder="In Lakhs" disabled >\
									</td>\
								</tr>';
				
				$("#checkFundingSource").prepend(govSchema);
			}else{
				$("#schemeTr"+chbxv).remove();
			}
		});
		
		
	})
	
	var regPurpose_sn=0;
	$(".regPurpose_addmore").on("click", function(){
		regPurpose_sn++;
		let regPurposeSpecify='<div class="col-sm-10 mt-2 addedRegPur'+regPurpose_sn+'">\
									<input type="text" name="regPurpose_other[]" id="regPurpose_other'+regPurpose_sn+'" class="form-control otherPurpose" placeholder="Please Specify" >\
								</div>\
								<div class="col-sm-2 mt-2 addedRegPur'+regPurpose_sn+'">\
									<a href="javascript:" class="btn btn-primary btn-sm regPurpose_addmore_minus" data-id="'+regPurpose_sn+'" id="othProduct_addmore_minus'+regPurpose_sn+'" >-</a>\
								</div>';
		$("#regPurpose_other_sec").append(regPurposeSpecify);
	});
	$(document).on("click",'.regPurpose_addmore_minus', function(){
		let regPurpose_addmore_minus = $(this).data("id");
		$(".addedRegPur"+regPurpose_addmore_minus).remove();
	});
	
	
	
	
	function noneOfAbove(className,noneValue){
		var checkedVals = $('.'+className+':checkbox:checked').map(function() {
			return this.value;
		}).get();
		let none=noneValue;
		if(inArray(checkedVals,none)){
			$('.'+className).prop('checked', false);
			$("."+className+"[value='" + none + "']").prop('checked', true);
		}
		
	}
	
	///5.1 
	$(document).ready(function(){
		$("#urban_address").addClass(' blocksec');
		$("#rural_address").addClass(' blocksec');
		$("#industrial_area_address").addClass(' blocksec');
		$("#plant_location").on("change", function(){
			$("#urban_address").addClass(' blocksec');
			$("#rural_address").addClass(' blocksec');
			$("#industrial_area_address").addClass(' blocksec');
			let pl = $(this).val();
			if(pl==82){
				$("#urban_address").removeClass(' blocksec');
			}else if(pl==83){
				$("#rural_address").removeClass(' blocksec');
			}else{
				$("#industrial_area_address").removeClass(' blocksec');
			}
			
			
		})
		
		///5.4
		$("#landOwnership_other").hide();
		$("#landOwnership").on("change", function(){
			let lo = $(this).val();
			if(lo==88){
				$("#landOwnership_other").show();
			}else{
				$("#landOwnership_other").hide();
			}
		})
		
		
		
		
		///6.2
		$("#other_cbg_purification").hide();
		$("#cbg_purification").on("change", function(){
			let cbgp = $(this).val();
			if(cbgp==107){
				$("#other_cbg_purification").show();
			}else{
				$("#other_cbg_purification").hide();
			}
		})
		
		///6.3
		$("#other_technologybioSlurry").hide();
		$(".checkBioslurry_tech").on("change", function(){
			$("#other_technologybioSlurry").hide();
			
			
			let diss = ['109','110','111','112'];
			$.each(diss, function (key, val) {
				$("#bioslurry_tech"+val).attr('disabled',false);
			});
			$(".checkBioslurry_tech").each(function(){
                if(this.checked){
                    if(this.value==112){ 
                        $("#other_technologybioSlurry").show();
                    }else{
						$("#other_technologybioSlurry").hide();
					}
					
					if(this.value==108){
						let diss = ['109','110','111','112'];
						$.each(diss, function (key, val) {
							$("#bioslurry_tech"+val).attr('disabled',true);
						});
					}
                }
            });
		})
		
		
	})
	
	
	
	
	//7.4
	$(document).ready(function(){
        // $(".checkFundingSource").on("change",function(e){
		$(document).on('change', '.checkFundingSource', function(e){
            e.preventDefault();
            $(".checkFundingSource").each(function(){
                if(this.checked){
                    $("#fundingSource_number"+this.value).attr('disabled',false);
                    if(this.value==132){ 
                        $("#fundingSource_otherMsg132").attr('disabled',false);
                        $("#fundingSource_otherNo132").attr('disabled',false);
                        $("#fundingSource_addmore132").removeClass('disable-click');
                    }
                }
                else{
                    $("#fundingSource_number"+this.value).attr('disabled',true);
                }
            });
        })
        
        var fsOther_sn=0;
        $(".fundingSource_addmore").on("click", function(){
            fsOther_sn++;
            let fsOtherSpecify='<div class="col-sm-6 mt-2 fsAdded'+fsOther_sn+'">\
											<input type="text" name="fundingSource_otherMsg[]" id="fundingSource_otherMsg'+fsOther_sn+'" class="form-control tblformat fundingSourceOther" placeholder="Please specify" >\
										</div>\
										<div class="col-sm-5 mt-2 fsAdded'+fsOther_sn+'">\
											<input type="text" name="fundingSource_otherNo[]" id="fundingSource_otherNo'+fsOther_sn+'" class="form-control tblformat fundingSourceOtherNo" placeholder="in lakhs" >\
										</div>\
										<div class="col-sm-1 mt-2 fsAdded'+fsOther_sn+'">\
											<a href="javascript:" class="btn btn-primary btn-sm fundingSource_addmore_minus  " data-id="'+fsOther_sn+'" id="fundingSource_addmore'+fsOther_sn+'" >-</a>\
										</div>';
            $("#fundingSource_other_sec").append(fsOtherSpecify);
        });

        $(document).on("click",'.fundingSource_addmore_minus', function(){
            let fundingSource_addmore_minus = $(this).data("id");
            $(".fsAdded"+fundingSource_addmore_minus).remove();
        });
		
		
		///ENTER ONLY NUMBER 
		$(".fusNumber").on("keypress keyup blur",function (event) {    
		   /* $(this).val($(this).val().replace(/[^\d].+/, ""));
			if ((event.which < 48 || event.which > 57)) {
				event.preventDefault();
			} */
			if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
				event.preventDefault();
			}
		});
		
		
		
		var flOther_sn=0;
        $(".other_cbglinkage_addmore").on("click", function(){
            flOther_sn++;
            let fsOtherSpecify='<div class="row flAdded'+flOther_sn+'">\
									<div class="col-sm-10">\
										<input type="text" name="other_cbg[]" id="other_cbglinkage'+flOther_sn+'" class="form-control other_cbglinkage" placeholder="Please Specify">\
									</div>\
									<div class="col-sm-2">\
										<a href="javascript:" class="btn btn-primary btn-sm other_cbglinkage_addmore_minus" data-id="'+flOther_sn+'" id="other_cbglinkage'+flOther_sn+'">-</a>\
									</div>\
								</div>';
            $("#otherCBGLinkage_sec").append(fsOtherSpecify);
        });

        $(document).on("click",'.other_cbglinkage_addmore_minus', function(){
            let other_cbglinkage_addmore_minus = $(this).data("id");
            $(".flAdded"+other_cbglinkage_addmore_minus).remove();
        });
		
		
    })
	
	//9.2
	$(document).ready(function(){
		
		$("#loiDetails").on("change", function(){
			$("#lapplied").hide();
			$("#lobtained").hide();
			if(this.value==156){
				$("#lapplied").show();
			}
			if(this.value==157){
				$("#lobtained").show();
			}
		});
		
		/// LOCATION FO PLANTS
		$("#urban_state").on("change", function(){
			let scode = $(this).val();
			if(scode!=""){
				$.ajax({
					url:"<?=base_url()?>get-districts",
					type:"post",
					data:{scode:scode},
					success:function(res){
						$("#urban_district").html(res);
					}
				});
			}
		});
		
		/* $("#urban_district").on("change", function(){
			let dcode = $(this).val();
			let entityType = $("#gas_output").val();
			if(dcode!="" && entityType!=""){
				$.ajax({
					url:"<?=base_url()?>get-projects",
					type:"post",
					data:{dcode:dcode,entityType:entityType},
					success:function(res){
						$("#urban_project").html(res);
					}
				});
			}
		}); */
		
		
		$("#rural_state").on("change", function(){
			let scode = $(this).val();
			if(scode!=""){
				$.ajax({
					url:"<?=base_url()?>get-districts",
					type:"post",
					data:{scode:scode},
					success:function(res){
						$("#rural_district").html(res);
					}
				});
			}
		});
		
		$("#rural_district").on("change", function(){
			let dcode = $(this).val();
			if(dcode!=""){
				$.ajax({
					url:"<?=base_url()?>get-blocks",
					type:"post",
					data:{dcode:dcode},
					success:function(res){
						$("#rural_block").html(res);
					}
				});
			}
		});
		
		
		$("#rural_block").on("change", function(){
			let bcode = $(this).val();
			if(bcode!=""){
				$.ajax({
					url:"<?=base_url()?>get-grampanchayats",
					type:"post",
					data:{bcode:bcode},
					success:function(res){
						// $("#rural_gp").html(res);
						$(".rural_gp_multiple").html(res);
					}
				});
			}
		});
		
		/* $("#rural_block").on("change", function(){
			let bcode = $(this).val();
			let entityType = $("#gas_output").val();
			if(bcode!="" && entityType!=""){
				$.ajax({
					url:"<?=base_url()?>get-projects",
					type:"post",
					data:{bcode:bcode,entityType:entityType},
					success:function(res){
						$("#rural_project").html(res);
					}
				});
			}
		}); */
		
		
		
		
		// $("#rural_gp").on("change", function(){
			// let gcode = $(this).val();
			// if(gcode!=""){
				// $.ajax({
					// url:"<?=base_url()?>get-villages",
					// type:"post",
					// data:{gcode:gcode},
					// success:function(res){
						// $("#rural_village").html(res);
					// }
				// });
			// }
		// });
		
		
		$("#industrial_state").on("change", function(){
			let scode = $(this).val();
			if(scode!=""){
				$.ajax({
					url:"<?=base_url()?>get-districts",
					type:"post",
					data:{scode:scode},
					success:function(res){
						$("#industrial_district").html(res);
					}
				});
			}
		});
		
		/* $("#industrial_district").on("change", function(){
			let dcode = $(this).val();
			let entityType = $("#gas_output").val();
			if(dcode!="" && entityType!=""){
				$.ajax({
					url:"<?=base_url()?>get-projects",
					type:"post",
					data:{dcode:dcode,entityType:entityType},
					success:function(res){
						$("#industrial_project").html(res);
					}
				});
			}
		}); */
		
		
		
		$(document).on("change",'.rgp', function(){
		//$(".rgp").on("change", function(){
			let gpid = $(this).val();
			let gpdataid = $(this).data("id");
			console.log(gpdataid);
			if(gpid!=""){
				$.ajax({
					url:"<?=base_url()?>get-villages",
					type:"post",
					data:{gcode:gpid},
					success:function(res){
						$("#rural_village"+gpdataid).html(res);
					}
				});
			}
		});
		
		
    })
	
</script>


<script>
$(document).ready(function(){
	$("#preview").on("click", function(){
		// let ss = $("#msform").serializeArray();
		// console.log(ss);
		var postData = {};
		var form = $('#msform').serializeArray();
		for (var i = 0; i < form.length; i++) {
			if (form[i]['name'].endsWith('[]')) {
				var name = form[i]['name'];
				name = name.substring(0, name.length - 2);
				if (!(name in postData)) {
					postData[name] = [];
				}
				postData[name].push(form[i]['value']);
			} else {
				postData[form[i]['name']] = form[i]['value'];
			}
		}
		
		console.log(postData);
		
	})
})
</script>





<script>
	$(document).ready(function() {
		///DEFINE VALIDATION RULES
		function validateFormFieldset(formSet)
		{
			let errcount = [];
			///VALIDATE BENEFITS/ SUPPORT SECTION
			if(formSet=='regPurpose'){
				let regPurposes = ['plant_name'];
				$.each(regPurposes, function (key, val) {
					if($("#"+val).val()==""){
						errcount.push(val);
						$("#"+val).addClass(' customRequired');
					}
				});
				
				let regPurposesCheckbox = ['checkRegPurpose'];
				
				$.each(regPurposesCheckbox, function (key, cName) {
					var checkedValues = $('.'+cName+':checkbox:checked').map(function() {
						//return $(this).data("requiredchild");
						return this.value;
					}).get();
					if(checkedValues.length==0){
						errcount.push(cName);
						$("#"+cName).addClass(' customRequired');
					}else{
						$.each(checkedValues, function(k, v){
							if($("#regPurposeStatus"+v).val()=="" && (v!="255")){
								errcount.push(v);
								$("#regPurposeStatus"+v).addClass(' customRequired');
							}
						});
						
					}
				});
				
				
			}
			
			///VALIDATE PROJECT DETAILS SECTION
			if(formSet=='projectDetails'){
				let projectDetails = ['gas_output','plant_type','plant_status','production_capacity','feedstockSolid_capacity','feedstockLiquid_capacity','design_bioslurry','design_FOM','design_LFOM'];
				let projectDetailsCheckbox = ['checkFeedstock','checkBioslurry_tech'];
				
				if($("#gas_output").val()==17){
					projectDetailsCheckbox.push('checkBiogas');
				}
				
				if($("#gas_output").val()==18){
					projectDetails.push('loiDetails');
					projectDetailsCheckbox.push('checkCBG');
				}
				console.log(projectDetails);
				
				$.each(projectDetails, function (key, val) {
					if($("#"+val).val()==""){
						errcount.push(val);
						$("#"+val).addClass(' customRequired');
					}
				});
				
				
				
				$.each(projectDetailsCheckbox, function (key, cName) {
					var checkedValues = $('.'+cName+':checkbox:checked').map(function() {
						return $(this).data("requiredchild");
						//return this.value;
					}).get();
					if(checkedValues.length==0){
						errcount.push(cName);
						$("#"+cName).addClass(' customRequired');
					}else{
						$.each(checkedValues, function(k, v){
							if($("#"+v).attr('type')=='hidden'){ return true; }
							if($("#"+v).val()==""){
								errcount.push(v);
								$("#"+v).addClass(' customRequired');
							}
						});
						
					}
				});
				
				if($("#feedstockSolid_capacity").val()!=$("#total_feedstock").val()){
					errcount.push('feedstockSolid_capacity');
				}  
				if($("#feedstockLiquid_capacity").val()!=$("#total_feedstockLiquid").val()){
					errcount.push('feedstockLiquid_capacity');
				}
			}
			
			
			///VALIDATE LOCATION DETAILS SECTION
			if(formSet=='locationDetails'){
				let locationDetails = ['plant_location','plant_area','landOwnership'];
				let urbanAddress = ['urban_state','urban_district','urban_city','urban_pin_code','urban_ward_number','urban_street_area'];
				let ruralAddress = ['rural_state','rural_district','rural_block','rural_gp','rural_village','rural_pincode'];
				let industrialAddress = ['industrial_state','industrial_district','industrial_pincode','industrial_address'];
				
				$.each(locationDetails, function (key, val) {
					if($("#"+val).val()==""){
						errcount.push(val);
						$("#"+val).addClass(' customRequired');
					}
					
					if($("#"+val).val()==82){
						$.each(urbanAddress, function (key, val) {
							if($("#"+val).val()==""){
								errcount.push(val);
								$("#"+val).addClass(' customRequired');
							}
						});
					}
					
					if($("#"+val).val()==83){
						$.each(ruralAddress, function (key, val) {
							if($("#"+val).val()==""){
								errcount.push(val);
								$("#"+val).addClass(' customRequired');
							}
						});
					}
					
					if($("#"+val).val()==224){
						$.each(industrialAddress, function (key, val) {
							if($("#"+val).val()==""){
								errcount.push(val);
								$("#"+val).addClass(' customRequired');
							}
						});
					}
					
				});
			}
			
			
			///VALIDATE PHYSICAL AND FINANCIAL PROGRESS SECTION
			if(formSet=='PhysicalProgress'){
				
				let PfPDetails = ['capex_number'];
				$.each(PfPDetails, function (key, val) {
					if($("#"+val).val()==""){
						errcount.push(val);
						$("#"+val).addClass(' customRequired');
					}
					
					let checkFundingSourceCheckbox = ['checkFundingSource'];
					$.each(checkFundingSourceCheckbox, function (key, cName) {
						
						var checkedValues = $('.'+cName+':checkbox:checked').map(function() {
							return $(this).data("requiredchild");
							//return this.value;
						}).get();
						if(checkedValues.length==0){
							errcount.push(cName);
							$("#"+cName).addClass(' customRequired');
						}else{
							$.each(checkedValues, function(k, v){
								if($("#"+v).val()==""){
									errcount.push(v);
									$("#"+v).addClass(' customRequired');
								}
							});
							
						}
					});
					
				});
			}
			
			if(formSet=='finalSubmit'){
				
				var privacyValues = $('#privacy:checkbox:checked').map(function() {
					return this.value;
				}).get();
				var termsValues = $('#terms:checkbox:checked').map(function() {
					return this.value;
				}).get();
				
				if(privacyValues.length==0){
					errcount.push('privacy');
					$("#tc").addClass(' customRequired');
				}
				if(termsValues.length==0){
					errcount.push('terms');
					$("#tc").addClass(' customRequired');
				}
			}
			console.log('errs-'+errcount);
			return errcount;
		}


		$(document).on('click', '.customRequired', function(){
			$(this).removeClass(' customRequired');
		});
		

		/// FIELDSET SECTION
		var current_fs, next_fs, previous_fs; //fieldsets
		var opacity;
		var current = 1;
		var steps = $("fieldset").length;

		setProgressBar(current);

		// $(".next").click(function() {
		$(document).on("click", '.next', function() { 

			current_fs = $(this).parent();
			next_fs = $(this).parent().next();


			//  VALIDATION

			let checkValidation = $(this).data("id");
			let validateRes =  validateFormFieldset(checkValidation);
			let findErr = validateRes.length;
			//console.log(validateRes)
			if(findErr>0){ return false; }
			

			// END  VALIDATION


			//Add Class Active
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

			//show the next fieldset
			next_fs.show();
			//hide the current fieldset with style
			current_fs.animate({
				opacity: 0
			}, {
				step: function(now) {
					// for making fielset appear animation
					opacity = 1 - now;

					current_fs.css({
						'display': 'none',
						'position': 'relative'
					});
					next_fs.css({
						'opacity': opacity
					});
				},
				duration: 500
			});
			setProgressBar(++current);
		});

		// $(".previous").click(function() {
		$(document).on("click", '.previous', function() { 

			current_fs = $(this).parent();
			previous_fs = $(this).parent().prev();

			//Remove class active
			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

			//show the previous fieldset
			previous_fs.show();

			//hide the current fieldset with style
			current_fs.animate({
				opacity: 0
			}, {
				step: function(now) {
					// for making fielset appear animation
					opacity = 1 - now;

					current_fs.css({
						'display': 'none',
						'position': 'relative'
					});
					previous_fs.css({
						'opacity': opacity
					});
				},
				duration: 500
			});
			setProgressBar(--current);
		});

		

		function setProgressBar(curStep) {
			var percent = parseFloat(100 / steps) * curStep;
			percent = percent.toFixed();
			$(".progress-bar") .css("width", percent + "%")
		}

		$(".submit").click(function() {
			return false;
		})
		
		
		
		
		/// SAVE FORM DATA
		/// 1.Benefits/ Support:
		$("#regPurpose").on("click", function(){
			let validateRes =  validateFormFieldset("regPurpose");
			//console.log(validateRes);
			let findErr = validateRes.length;
			//findErr=0;
			if(findErr>0){ 
				console.log('Please fill the all fields properly.');
				return false; 
			}else{
				let fieldDatas={};
				console.log('valid');
				let plant_name = $("#plant_name").val();
				var regPrps = $('.checkRegPurpose:checkbox:checked').map(function() {
					return this.value;
				}).get();
				fieldDatas['organization_id'] = $("#organization_id").val();
				fieldDatas['project_id'] = $("#project_id").val();
				fieldDatas['plant_name'] = plant_name;
				fieldDatas['reg_purposes'] = regPrps;
				
				let purStatus = [];
				$.each(regPrps, function(k, v){
					purStatus.push($("#regPurposeStatus"+v).val());
				});
				fieldDatas['purpose_status'] = purStatus;
				
				var otherPurposes = $('.otherPurpose').map(function() {
					return this.value;
				}).get();
				fieldDatas['otherPurposes'] = otherPurposes;
				//console.log(fieldDatas);
				if(plant_name!=""){
					$.ajax({
						url:"<?=base_url()?>reg-purpose",
						type:"post",
						data:{purposedata:fieldDatas},
						success:function(res){
							let ress = JSON.parse(res);
							//console.log(ress.project_id);
							$("#project_id").val(ress.project_id);
						}
					});
				}
				
				
			}
		});
		
		
		/// 2. Plant/ Project Details:
		$("#projectDetails").on("click", function(){
			
			let validateRes =  validateFormFieldset("projectDetails");
			let findErr = validateRes.length;
			console.log(validateRes);
			//findErr=0;
			if(findErr>0){ 
				console.log('Please fill the all fields properly.');
				return false; 
			}else{
				
				let fieldDatas = {};
				//let solidFss = {};
				//let solidFssOthers = {};
				let projectDetails = ['gas_output','plant_type','plant_status','production_capacity','feedstockSolid_capacity','feedstockLiquid_capacity','design_bioslurry','design_FOM','design_LFOM','loiDetails','distance_grid','loi_obtain_details'];
				$.each(projectDetails, function (key, val) {	
					let fillv = $("#"+val).val();
					fieldDatas[val] = fillv;
				});
				
				
				
				///GET SOLID FEEDSTOCK DETAILS
				var solidfssCheckedValues = $('.solidfs:checkbox:checked').map(function() {
						return this.value;
					}).get();
				fieldDatas['solidFeedStockType'] = solidfssCheckedValues;
				
				fieldDatas['organization_id'] = $("#organization_id").val();
				fieldDatas['project_id'] = $("#project_id").val();
				
				var checkBioslurry_techv = $('.checkBioslurry_tech:checkbox:checked').map(function() {
					return this.value;
				}).get().join();
				
				
				fieldDatas['bioslurry_tech'] = checkBioslurry_techv;
				fieldDatas['other_technologybioSlurry'] = $("#other_technologybioSlurry").val();
				fieldDatas['production_capacity_unit'] = $("#production_capacity_unit").text();
				fieldDatas['feedstockSolid_capacity_unit'] = $("#feedstockSolid_capacity_unit").text();
				fieldDatas['feedstockLiquid_capacity_unit'] = $("#feedstockLiquid_capacity_unit").text();
				fieldDatas['design_bioslurry_unit'] = $("#design_bioslurry_unit").text();
				fieldDatas['design_FOM_unit'] = $("#design_FOM_unit").text();
				fieldDatas['design_LFOM_unit'] = $("#design_LFOM_unit").text();
				fieldDatas['total_feedstock'] = $("#total_feedstock").val();
				fieldDatas['total_feedstock_unit'] = $("#total_feedstock_unit").text();
				fieldDatas['total_feedstockLiquid'] = $("#total_feedstockLiquid").val();
				fieldDatas['total_feedstockLiquid_unit'] = $("#total_feedstockLiquid_unit").text();
				
				//checkBiogas
				//fieldDatas['bioslurry_tech'] = checkBioslurry_techv;
				
				var biogasForwardLinkages = $('.checkBiogas:checkbox:checked').map(function() {
					return this.value;
				}).get();
				
				var biogas_numbers = [];
				$.each(biogasForwardLinkages, function(k, v){
					biogas_numbers.push($('#biogas_linkage_number'+v).val());
				});
				
				var cbgForwardLinkages = $('.checkCBG:checkbox:checked').map(function() {
					return this.value;
				}).get();
				
				var cbg_numbers = [];
				$.each(cbgForwardLinkages, function(k, v){
					cbg_numbers.push($('#cbg_linkage_number'+v).val());
				});
				
				var other_cbglinkages = $('.other_cbglinkage').map(function() {
					return this.value;
				}).get();
				
				
				//console.log(biogas_numbers);
				fieldDatas['biogasForwardLinkages'] = biogasForwardLinkages;
				fieldDatas['biogas_numbers'] = biogas_numbers; 
				fieldDatas['cbgForwardLinkages'] = cbgForwardLinkages; 
				fieldDatas['cbg_numbers'] = cbg_numbers;
				
				fieldDatas['other_cbglinkages'] = other_cbglinkages;
				
				
				let fstNumber = [];
				let solidFsUnit = [];
				let solidFss = [];
				let solidFssOthers = [];
				let solidOtherFsSoDatadd = [];
				$.each(solidfssCheckedValues, function(k, v){
					fstNumber.push($("#feedstock_number"+v).val());
					solidFsUnit.push($("#feedstock_type_unit"+v).text());
					
					let solidFsSource = $('#feedstockSource'+v+' :selected').map(function(i, el) {
						return $(el).val();
					}).get().join();
					solidFss.push(solidFsSource);
					solidFssOthers.push($("#otherSourceSpecify"+v).val());
				});
				var solidOtherFs = $('.solidFsOther').map(function() {
					return this.value;
				}).get();
				var solidFsOtherNo = $('.solidFsOtherNo').map(function() {
					return this.value;
				}).get();
				var feedstock_type_other_unit = $('.feedstock_type_other_unit').map(function() {
					return $(this).text();
				}).get();
				
				
				$.each(solidOtherFs, function(k, v){
					var solidOtherFsSoData = $('.solidOtherFsSoData'+k+' :selected').map(function() {
						return this.value;
					}).get().join();
					solidOtherFsSoDatadd.push(solidOtherFsSoData);
				});
				
				var solidOtherFsSoOther = $('.solidOtherFsSoOther').map(function() {
					return this.value;
				}).get();
				
				
				//console.log(solidOtherFsSoDatadd);
				
				fieldDatas['solidFeedStockType_number'] = fstNumber;
				fieldDatas['solidFeedStockType_unit'] = solidFsUnit;
				fieldDatas['solidFeedStockSourceData'] = solidFss;
				fieldDatas['solidFeedStockOtherSource'] = solidFssOthers;
				
				fieldDatas['solidOtherFs'] = solidOtherFs;
				fieldDatas['solidFsOtherNo'] = solidFsOtherNo;
				fieldDatas['feedstock_type_other_unit'] = feedstock_type_other_unit;
				
				fieldDatas['solidOtherFsSoData'] = solidOtherFsSoDatadd;
				fieldDatas['solidOtherFsSoOther'] = solidOtherFsSoOther;
				
				
				
				///GET LIQUID FEEDSTOCK DETAILS
				var liquidfssCheckedValues = $('.liquidfs:checkbox:checked').map(function() {
					return this.value;
				}).get();
				fieldDatas['liquidFeedStockType'] = liquidfssCheckedValues;
				let lfstNumber = [];
				let liquidFss = [];
				let liquidFsUnit = [];
				let liquidFssOthers = [];
				let liquidOtherFsSoDatadd = [];
				$.each(liquidfssCheckedValues, function(k, v){
					lfstNumber.push($("#feedstock_number"+v).val());
					liquidFsUnit.push($("#feedstock_type_unit"+v).text());
					let liquidFsSource = $('#feedstockSource'+v+' :selected').map(function(i, el) {
						return $(el).val();
					}).get().join();
					liquidFss.push(liquidFsSource);
					liquidFssOthers.push($("#otherSourceSpecify"+v).val());
					
				});
				fieldDatas['liquidFeedStockType_number'] = lfstNumber;
				fieldDatas['liquidFeedStockType_unit'] = liquidFsUnit;
				fieldDatas['liquidFeedStockSourceData'] = liquidFss;
				fieldDatas['liquidFeedStockOtherSource'] = liquidFssOthers;
				
				
				var liquidOtherFs = $('.liquidFsOther').map(function() {
					return this.value;
				}).get();
				var liquidFsOtherNo = $('.liquidFsOtherNo').map(function() {
					return this.value;
				}).get();
				var feedstock_type_other_unit_liquid = $('.lfeedstock_type_other_unit').map(function() {
					return $(this).text();
				}).get();
				
				
				$.each(liquidOtherFs, function(k, v){
					var liquidOtherFsSoData = $('.liquidOtherFsSoData'+k+' :selected').map(function() {
						return this.value;
					}).get().join();
					liquidOtherFsSoDatadd.push(liquidOtherFsSoData);
				});
				
				var liquidOtherFsSoOther = $('.liquidOtherFsSoOther').map(function() {
					return this.value;
				}).get();
				fieldDatas['liquidOtherFs'] = liquidOtherFs;
				fieldDatas['liquidFsOtherNo'] = liquidFsOtherNo;
				fieldDatas['feedstock_type_other_unit_liquid'] = feedstock_type_other_unit_liquid;
				fieldDatas['liquidOtherFsSoData'] = liquidOtherFsSoDatadd;
				fieldDatas['liquidOtherFsSoOther'] = liquidOtherFsSoOther;
				console.log(fieldDatas);
				
				$.ajax({
					url:"<?=base_url()?>project-data",
					type:"post",
					data:{projectData:fieldDatas},
					success:function(res){
						console.log(res);
					}
				});
				
			}
		});
		
		
		/// 3. Location details :
		$("#locationDetails").on("click", function(){
			let validateRes =  validateFormFieldset("locationDetails");
			let findErr = validateRes.length;
			//findErr=0;
			if(findErr>0){ 
				console.log('Please fill the all fields properly.');
				return false; 
			}else{
				let fieldDatas={};
				let urbanAdrsDatas={};
				let industrialAdrsDatas={};
				let ruralAdrsDatas={};
				let locationDetails = ['plant_location','plant_area','landOwnership','latitude','longitude'];
				$.each(locationDetails, function (key, val) {	
					let fillv = $("#"+val).val();
					fieldDatas[val] = fillv;
				});
				fieldDatas['landOwnership_other'] = $("#landOwnership_other").val();
				fieldDatas['organization_id'] = $("#organization_id").val();
				fieldDatas['project_id'] = $("#project_id").val();
				
				let urbanDetailas = ['urban_state','urban_district','urban_city','urban_ward_number','urban_pin_code','urban_street_area','urban_plot_number','urban_project'];
				$.each(urbanDetailas, function (key, val) {	
					let urbnAdrs = $("#"+val).val();
					urbanAdrsDatas[val] = urbnAdrs;
				});
				
				let industrialDetailas = ['industrial_state','industrial_district','industrial_pincode','industrial_address'];
				$.each(industrialDetailas, function (key, val) {	
					let industrialAdrs = $("#"+val).val();
					industrialAdrsDatas[val] = industrialAdrs;
				});
				
				
				//$(document).on("click",'.rgp', function(){  $('option:selected',this).map(function() {
				var rgpValues = $('.rgp option:selected').map(function() {
					return this.value;
				}).get();
				console.log(rgpValues);
				
				var rvillageValues = $('.rvillage option:selected').map(function() {
					return this.value;
				}).get();
				
				var rpincodeValues = $('.rpincode').map(function() {
					return this.value;
				}).get();
				
				ruralAdrsDatas['rural_state'] = $("#rural_state").val();
				ruralAdrsDatas['rural_district'] = $("#rural_district").val();
				ruralAdrsDatas['rural_block'] = $("#rural_block").val();
				ruralAdrsDatas['rural_gp'] = rgpValues;
				ruralAdrsDatas['rural_village'] = rvillageValues;
				ruralAdrsDatas['rural_pincode'] = rpincodeValues;
				
				console.log(ruralAdrsDatas);
				
				$.ajax({
					url:"<?=base_url()?>location-data",
					type:"post",
					data:{locationData:fieldDatas,urbanAddress:urbanAdrsDatas,industrialAddress:industrialAdrsDatas,ruralAdrsDatas:ruralAdrsDatas},
					success:function(res){
						console.log(res);
					}
				});
				
			}
		});
		
		
		/// 4. Physical and financial progress :
		$("#PhysicalProgress").on("click", function(){
			let validateRes =  validateFormFieldset("PhysicalProgress");
			let findErr = validateRes.length;
			//findErr=0;
			if(findErr>0){ 
				console.log('Please fill the all fields properly.');
				return false; 
			}else{
				let fieldDatas={};
				let phyclFinancialDetails = ['capex_number','date_of_commissioning','proposed_date','construction_date'];
				$.each(phyclFinancialDetails, function (key, val) {	
					let fillv = $("#"+val).val();
					fieldDatas[val] = fillv;
				});
				fieldDatas['organization_id'] = $("#organization_id").val();
				fieldDatas['project_id'] = $("#project_id").val();
				
				var checkFundingSourceValues = $('.checkFundingSource:checkbox:checked').map(function() {
					return this.value;
				}).get();
				
				var fundingSource_numbers = [];
				$.each(checkFundingSourceValues, function(k, v){
					fundingSource_numbers.push($('#fundingSource_number'+v).val());
				});
				
				fieldDatas['fundingSources'] = checkFundingSourceValues;
				fieldDatas['fundingSource_numbers'] = fundingSource_numbers;
				
				var fundingSourceOthers = $('.fundingSourceOther').map(function() {
					return this.value;
				}).get();
				
				var fundingSourceOtherNos = $('.fundingSourceOtherNo').map(function() {
					return this.value;
				}).get();
				
				fieldDatas['fundingSourceOthers'] = fundingSourceOthers;
				fieldDatas['fundingSourceOtherNos'] = fundingSourceOtherNos;
				
				console.log(fieldDatas);
				$.ajax({
					url:"<?=base_url()?>physical-data",
					type:"post",
					data:{physicalData:fieldDatas},
					success:function(res){
						console.log(res);
					}
				});
				
			}
		});
		
		
		$("#finalSubmit").on("click", function(){
			let validateRes =  validateFormFieldset("finalSubmit");
			let findErr = validateRes.length;
			//findErr=0;
			if(findErr>0){ 
				console.log('Please fill the all fields properly.');
				return false; 
			}else{
				let pid= $("#project_id").val();
				let curl = "<?=base_url()?>generate-certificate-temp";
				let psid = $("#plant_status").val();
				if(psid==24){
					curl = "<?=base_url()?>generate-certificate";
				}
				$.ajax({
					url:curl,
					type:"get",
					data:{pid:pid},
					success:function(res){
						//console.log(res);
						window.location.href='https://gobardhan.co.in/profile';
					}
				});
			}
		});
		

	});

</script>


<script>
/*
$(".sscertificate").on("click", function(){
	//window.location.href='https://gobardhan.co.in/ss-certificate';
	let pid= $("#project_id").val();
	let curl = "<?=base_url()?>generate-certificate-temp";
	let psid = $("#plant_status").val();
	if(psid==24){
		curl = "<?=base_url()?>generate-certificate";
	}
	$.ajax({
		url:curl,
		type:"get",
		data:{pid:pid},
		success:function(res){
			//console.log(res);
			window.location.href='https://gobardhan.co.in/profile';
		}
	});
});
*/
</script>



<?= $this->endSection(); ?>