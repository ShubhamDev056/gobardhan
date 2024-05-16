<?= $this->extend('layouts/layout'); ?>
<?=$this->section('breadcrum');?>
	<div class="container">
		<div class="page-banner row align-items-center position-relative">
			
			<!-- Page Title -->
			<div class="col-lg-6 col-12">
				<h1 class="page-title">Add Project</h1>
			</div>
			
			<!-- Page Breadcrumb -->
			<div class="col-lg-6 col-12">
				<ul class="page-breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Add Project</li>
				</ul>
			</div>
			
		</div>
	</div>
<?=$this->endSection(); ?>

<?= $this->section('content'); ?>
<style>
	.customRequired{
		border-color: red !important;
	}
</style>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-12">
			<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
				<!-- <h2 id="heading">This is the blank page </h2> -->
				<!-- <p>Fill all form field to go to next step</p> -->
				<form id="msform">
					<!-- progressbar -->
					<ul id="progressbar">
						<li class="active" id="confirm"><strong>Entity Details</strong></li>
						<li id="confirm"><strong>Authorized Representative Details</strong></li>
						<li id="confirm"><strong>Director (s) / Partner (s) Detail</strong></li>
						<li id="confirm"><strong>Plant/ Project Details</strong></li>
						<li id="confirm"><strong>Location Details</strong></li>
						<li id="confirm"><strong>Technical Details</strong></li>
						<li id="confirm"><strong>Financial Details</strong></li>
						<li id="confirm"><strong>Physical and Financial Progress</strong></li>
						<li id="confirm"><strong>Certifying Authority</strong></li>
						
					</ul>
					<div class="progress">
						<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
							aria-valuemin="0" aria-valuemax="100"></div>
					</div> <br> <!-- fieldsets -->
					<fieldset>
						<div class="form-card">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">1. Entity details:</h2>
								</div>
								<div class="col-5">
									<h2 class="steps">Step 1 - 11</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.1 Name of entity: *</label>
									<input type="text" name="" class="form-control" name="entity_name" id="entity_name" placeholder="Number of HHs in the village" />
								</div>
								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.2 Type of entity: *</label>
									<select class="form-select" name="entity_type" id="entity_type" onchange="showEntity()" >
										<option value="">Select entity</option>
										<option value="Government">Government</option>
										<option value="Private">Private</option>
									</select>
								</div>
								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.3 Sub-type: *</label>
									<select class="form-select" name="govt_entity" id="sub_entity" onchange='hideShow("#sub_entity","#pvt_others")' >
										<option value="">Select entity</option>
										<optgroup label="Government" id="govt_entity">
										<option value="Panchayat">Panchayat</option>
										<option value="Block">Block</option>
										<option value="ULB">ULB</option>
										<option value="District Administration">District Administration</option>
										<option value="Govt Companies">Govt Companies/PSU</option>
										<option value="Govt agency">Govt agency</option>
										<option value="Autonomous bodies">Autonomous bodies</option>
										<option value="Co-operative organizations">Co-operative organizations</option>
										<option value="Others">Others</option>
										</optgroup>
										<optgroup label="Private" id="pvt_entity">
										<option value="Private Ltd. Company">Private Ltd. Company</option>
										<option value="Limited Company">Limited Company</option>
										<option value="Limited Liability Partner">Limited Liability Partner</option>
										<option value="Societies">Societies</option>
										<option value='Other'>Others (please specify)</option>
										</optgroup>
									</select>
								</div>

								<div class="col-sm-6 col-12" id="pvt_others">
									<label class="fieldlabels">1.3.1 Please specify other private entity: *</label>
									<input type="text" name="pvt_others" class="form-control">
								</div>
								<br>
								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.4 Contact no: *</label>
									<input type="number" name="entity_contactno" id="entity_contactno" class="form-control" placeholder="Please Enter Your Contact Number" />
								</div>
								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.5 Fax: </label>
									<input type="number" name="entity_fax" id="entity_fax" class="form-control" placeholder="Please Enter Your Fax Number" />
								</div>
								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.6 Email: *</label>
									<input type="email" name="email" id="entity_email" class="form-control" placeholder="Please Enter Your Email Id" />
								</div>
								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.7 Address: *</label>
									<textarea name="entity_address" class="form-control" id="entity_address" placeholder="Please Enter Your Address " rows="1"></textarea>
								</div>

								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.8 State: *</label>
									<select class="form-select" name="entity_state" id="entity_state" >
										<option value="">Select State</option>
										<option value="">ARUNACHAL PRADESH</option>
										<option value="">ASSAM</option>
										<option>Bihar</option>
										<option>Uttar Pradesh</option>
									</select>
								</div>

								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.9 District: *</label>
									<select class="form-select" name="entity_district" id="entity_district" >
										<option value="">Select State</option>
										<option value="">ANANTNAG</option>
										<option value="">BUDGAM</option>
										<option>KUPWARA</option>
										<option>Siwan</option>
									</select>
								</div>

								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.10 Pin code: *</label>
									<input type="number" name="entity_pincode" id="entity_pincode" class="form-control" placeholder="Please Enter Your Pin Code" />
								</div>

								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.11 CIN / Registration no: *</label>
									<input type="number" name="entity_reg_no" id="entity_reg_no" class="form-control" placeholder="Please Enter Your Registration no" />
								</div>

								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.12 Incorporation/ registration date: *</label>
									<input type="date" name="entity_reg_date" id="entity_reg_date" class="form-control" placeholder="Please Enter Your Registration no" />
								</div>

								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.13 PAN number: *</label>
									<input type="text" name="entity_pan_no" id="entity_pan_no" class="form-control" placeholder="Please Enter Your PAN number" />
								</div>

								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.14 GST number: *</label>
									<input type="text" name="entity_gst_no" id="entity_gst_no" class="form-control" placeholder="Please Enter Your GST number" />
								</div>

								<div class="col-sm-6 col-12">
									<label class="fieldlabels">1.15 Company registration letter: *</label>
									<input type="file" name="entity_reg_letter" id="entity_reg_letter" class="form-control" />
								</div>
							</div>
						</div>
						<input type="button" name="next" class="next action-button btn btn-primary" data-id="entity_details"  value="Next" />
					</fieldset>

					<fieldset>
						<div class="form-card">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">2. Authorized Representative details:</h2>
								</div>
								<div class="col-5">
									<h2 class="steps">Step 2 - 11</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 col-12">
									<label class="fieldlabels">2.1 Name: *</label>
									<input type="text" name="name" class="form-control" placeholder="Please Enter Your Contact Number" />
								</div>
								<div class="col-sm-6 col-12">
									<label class="fieldlabels">2.2 Designation: *</label>
									<input type="text" name="Designation" class="form-control" placeholder="Please Enter Your Designation" />
								</div>
								<div class="col-sm-6 col-12">
									<label class="fieldlabels">2.3 Contact no: *</label>
									<input type="number" name="" class="form-control" placeholder="Please Enter Your Contact Number" />
								</div>
								<div class="col-sm-6 col-12">
									<label class="fieldlabels">2.4 Email: *</label>
									<input type="email" name="email" class="form-control" placeholder="Please Enter Your email Id" />
								</div>
								<div class="col-sm-6 col-12">
									<label class="fieldlabels">2.5 Authorization letter: *</label>
									<input type="file" name="authorization_letter" class="form-control" />
								</div>
								
							</div>
						</div>

						<input type="button" name="next" class="next action-button btn btn-primary" value="Next" />
						<input type="button" name="previous" class="previous action-button btn btn-dark"
							value="Previous" />
					</fieldset>

					<fieldset>
						<div class="form-card">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">3. Director (s) / Partner (s) detail:</h2>
								</div>
								<div class="col-5">
									<h2 class="steps">Step 3 - 11</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-6">
									<label class="fieldlabels">3.1 Number of director (s) / Partner (s) : *</label>
									<select class="form-select" name="nof_director" id="nof_director" >
										<option></option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
									</select>
								</div>
							</div>
							<label class="fieldlabels">3.1 Number of director (s) / Partner (s) : *</label>
							<div class="table-responsive">
								<table class="table table-bordered table-hover text-white">
									<thead>
										<tr>
											<th>S No.</th>
											<th>DIN/ DPIN</th>
											<th>Name</th>
											<th>Gender</th>
											<th>Mobile number</th>
											<th>Email </th>
										</tr>
									</thead>
									<tbody id="nof_director_details">
										
									</tbody>


								</table>
							</div>

						</div>
						<input type="button" name="next" class="next action-button btn btn-primary" value="Next" />
						<input type="button" name="previous" class="previous action-button btn btn-dark"
							value="Previous" />
					</fieldset>


					<fieldset>
						<div class="form-card">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">4. Plant/ Project Details:</h2>
								</div>
								<div class="col-5">
									<h2 class="steps">Step 4 - 11</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-6">
									<label class="fieldlabels">4.1 Type of gas output : *</label>
									<select class="form-select" name="gas_output" id="gas_output" onchange="gasOutput(); gasLinkage()">
										<option> Select type of gas output</option>
										<option value='1'>Biogas</option>
										<option value='2'>Compressed Biogas (CBG) </option>

									</select>
								</div>

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">4.2 Type of plant : *</label>
									<select class="form-select" name="state">
										<option value="" >Select type of plant</option>
										<optgroup label="Biogas" id="biogas">
											<option value="Community-based">Community-based</option>
											<option value="Cluster based">Cluster based </option>
										</optgroup>
										<optgroup label="Compressed Biogas (CBG)" id="cbg">
											<option value="Commercial">Commercial </option>
										</optgroup>


									</select>
								</div>

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">4.3 Status of plant : *</label>
									<select class="form-select" name="plant_status" id="plant_status" onchange="hideShow('#plant_status','#under-construction-phy-pro','Under Construction')">
										<option>Select Plant Status</option>
										<option value="New">New</option>
										<option value="Under Construction">Under Construction </option>
										<option value="Functional">Functional </option>
										<option value="Expansion">Expansion </option>
									</select>
								</div>

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">4.4 Production capacity : *</label>
									<input type="text" name="" class="form-control">
								</div>

								<div class="col-12 col-sm-12">
									<label class="fieldlabels">4.5 Biogas/ CBG forward linkage : *</label>

									
									<div class="check-inline" id="sub_gaslinkage">

										<!--In the case of biogas plant   -->
										<div id="sub_biogas">
										<label class="form-check-label" for="oncheck1">
											<input class="form-check-input" value='Option A' type="checkbox" value="" id="oncheck1" /> Supply to -------- nos of Household through pipeline
										</label>
										<label class="form-check-label" for="oncheck2">
											<input class="form-check-input" value='Option B' type="checkbox" value="" id="oncheck2" /> Supply to -------- nos of AWC through pipeline
										</label>
										<label class="form-check-label" for="oncheck3">
											<input class="form-check-input" value='Option C' type="checkbox" value="" id="oncheck3" /> Supply to -------- nos of GP buildings through pipeline
										</label>
										<label class="form-check-label" for="oncheck4">
											<input class="form-check-input" value='Option D' type="checkbox" value="" id="oncheck4" /> Electricity generation ----------KV
										</label>
										<label class="form-check-label" for="oncheck5">
											<input class="form-check-input" value='Option E' type="checkbox" value="" id="oncheck5" /> Others (specify)
										</label>
										</div>

										<input type="text" name="" id="other_subBiogas" class="form-control w-50" placeholder="Please specify">

										<!-- In the case of the CBG plant  -->
										<div id="sub_cbg">
										<label class="form-check-label" for="oncheck6">
											<input class="form-check-input" value='Option F' type="checkbox" value="" id="oncheck6" /> Supply to OGMC through cascades under SATAT
										</label>

										<label class="form-check-label" for="oncheck7">
											<input class="form-check-input" value='Option G' type="checkbox" value="" id="oncheck7" /> Supply to OGMC through the pipeline under SATAT
										</label>
										<label class="form-check-label" for="oncheck8">
											<input class="form-check-input" value='Option H' type="checkbox" value="" id="oncheck8" /> Supply to the industry through cascades
										</label>
										<label class="form-check-label" for="oncheck9">
											<input class="form-check-input" value='Option I' type="checkbox" value="" id="oncheck9" /> Retail outlet
										</label>
										<label class="form-check-label" for="oncheck10">
											<input class="form-check-input" value='Option J' type="checkbox" value="" id="oncheck10" /> Others (specify)
										</label>
										</div>
										
										<input type="text" name="" id="other_subcbg" class="form-control w-50" placeholder="Please specify">

									</div>
								</div>

								<div class="col-12 col-sm-12">
									<label class="fieldlabels">4.6 If the pipeline is required  under SATAT : *</label>
									<input type="text" name="" class="form-control" placeholder="Distance from the nearest grid">
								</div>

								<div class="col-12 col-sm-12">
									<label class="fieldlabels">4.7 Type of Feedstock : *</label>
									<div class="check-inline">
										<label class="form-check-label" for="toFeedstock1">
											<input class="form-check-input" value='Option A' type="checkbox" value="" id="toFeedstock1" /> Cattle dung
										</label>
										<label class="form-check-label" for="toFeedstock2">
											<input class="form-check-input" value='Option B' type="checkbox" value="" id="toFeedstock2" /> Agri waste
										</label>
										<label class="form-check-label" for="toFeedstock3">
											<input class="form-check-input" value='Option C' type="checkbox" value="" id="toFeedstock3" /> Press mud
										</label>
										<label class="form-check-label" for="toFeedstock4">
											<input class="form-check-input" value='Option D' type="checkbox" value="" id="toFeedstock4" /> MSW
										</label>
										<label class="form-check-label" for="toFeedstock5">
											<input class="form-check-input" value='Option E' type="checkbox" value="" id="toFeedstock5" /> Industrial organic waste
										</label>
										<label class="form-check-label" for="toFeedstock6">
											<input class="form-check-input" value='Option F' type="checkbox" value="" id="toFeedstock6" /> other(specify)
										</label>
										<input type="text" name="" id="other_feedstock" class="form-control w-50" placeholder="Please specify">

									</div>
								</div>

								<div class="col-12 col-sm-12">
									<label class="fieldlabels">4.7.1 Quantity of feedstock : *</label>
									<input type="text" name="" class="form-control" placeholder="kg/ day or Tons per day">
								</div>

								<div class="col-12 col-sm-12">
									<label class="fieldlabels">4.8 Source of feedstock : *</label>
									<div class="check-inline">
										<label class="form-check-label" for="sourceofFeedbk1">
											<input class="form-check-input" value='Option A' type="checkbox" value="" id="toFeedstock1" /> Gaushala
										</label>
										<label class="form-check-label" for="sourceofFeedbk2">
											<input class="form-check-input" value='Option B' type="checkbox" value="" id="sourceofFeedbk2" /> Urban households
										</label>
										<label class="form-check-label" for="sourceofFeedbk3">
											<input class="form-check-input" value='Option C' type="checkbox" value="" id="sourceofFeedbk3" /> Markets
										</label>
										<label class="form-check-label" for="sourceofFeedbk4">
											<input class="form-check-input" value='Option D' type="checkbox" value="" id="sourceofFeedbk4" /> Mandi
										</label>
										<label class="form-check-label" for="sourceofFeedbk5">
											<input class="form-check-input" value='Option E' type="checkbox" value="" id="sourceofFeedbk5" /> Rural Households
										</label>
										<label class="form-check-label" for="sourceofFeedbk6">
											<input class="form-check-input" value='Option F' type="checkbox" value="" id="sourceofFeedbk6" /> Form Field
										</label>
										<label class="form-check-label" for="sourceofFeedbk7">
											<input class="form-check-input" value='Option G' type="checkbox" value="" id="sourceofFeedbk7" /> Industries
										</label>
										<label class="form-check-label" for="sourceofFeedbk8">
											<input class="form-check-input" value='Option H' type="checkbox" value="" id="sourceofFeedbk8" /> Others (specify)
										</label>

										<input type="text" name="" id="other_source_feedstock" class="form-control w-50" placeholder="Please specify">


									</div>
								</div>

								<div class="col-12 col-sm-12">
									<label class="fieldlabels">4.9 Type of bio-slurry output : *</label>
									<div class="check-inline">
										<label class="form-check-label" for="bioSlurry1">
											<input class="form-check-input" value='Option A' type="checkbox" value="" id="bioSlurry1" /> FOM
										</label>
										<label class="form-check-label" for="bioSlurry2">
											<input class="form-check-input" value='Option B' type="checkbox" value="" id="bioSlurry2" /> LFOM
										</label>
										<label class="form-check-label" for="bioSlurry3">
											<input class="form-check-input" value='Option C' type="checkbox" value="" id="bioSlurry3" /> Raw bio-slurry
										</label>
										<label class="form-check-label" for="bioSlurry4">
											<input class="form-check-input" value='Option D' type="checkbox" value="" id="bioSlurry4" /> Others (specify) 
										</label>

										<input type="text" name="" id="other_bioSlurry" class="form-control w-50" placeholder="Please specify">

										
									</div>
								</div>

								<div class="col-12 col-sm-12">
									<label class="fieldlabels">4.9.1 Quantity of bio-slurry : *</label>
									<input type="text" name="" class="form-control" placeholder="kg/day or KLD">
								</div>

								<div class="col-12 col-sm-12">
									<label class="fieldlabels">4.12 FOM/LFOM/ bio slurry utilization </label>
									<div class="check-inline">
										<label class="form-check-label" for="FOMbioSlurry1">
											<input class="form-check-input" value='Option A' type="checkbox" value="" id="FOMbioSlurry1" /> Give free to farmers (enter the quantity) 
										</label>
										<label class="form-check-label" for="FOMbioSlurry2">
											<input class="form-check-input" value='Option B' type="checkbox" value="" id="FOMbioSlurry2" /> Sale of FOM (enter the quantity) 
										</label>
										<label class="form-check-label" for="FOMbioSlurry3">
											<input class="form-check-input" value='Option C' type="checkbox" value="" id="FOMbioSlurry3" /> Sale of LFOM (enter the quantity) 
										</label>
										<label class="form-check-label" for="FOMbioSlurry4">
											<input class="form-check-input" value='Option D' type="checkbox" value="" id="FOMbioSlurry4" /> Sale of raw bio-slurry (enter the quantity) 
										</label>
										<label class="form-check-label" for="FOMbioSlurry5">
											<input class="form-check-input" value='Option E' type="checkbox" value="" id="FOMbioSlurry5" /> Others (specify) 
										</label>

										<input type="text" name="" id="other_fombioSlurry" class="form-control w-50" placeholder="Please specify">

										
									</div>
								</div>

								<div class="col-12 col-sm-12">
									<label class="fieldlabels">4.13 Other by-products : *</label>
									<select class="form-select" name="otherByProducts" id="otherByProducts" onchange="hideShow('#otherByProducts','#other_otherByProducts')">
										<option>Select other by-products</option>
										<option>CO2</option>
										<option>H2S </option>
										<option>None </option>
										<option value="Other">Other (specify) </option>
									</select>
									<input type="text" name="other_otherByProducts" id="other_otherByProducts" class="form-control w-50" placeholder="Please specify">

								</div>

								<div class="col-12 col-sm-12">
									<label class="fieldlabels">4.14 Use of by-products : *</label>
									<input class="form-control" type="text" value="" id="by-products" />

								</div>



							</div>

						</div>
						<input type="button" name="next" class="next action-button btn btn-primary" value="Next" />
						<input type="button" name="previous" class="previous action-button btn btn-dark"
							value="Previous" />
					</fieldset>


					<fieldset>
						<div class="form-card">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">5. Location details : </h2>
								</div>
								<div class="col-5">
									<h2 class="steps">Step 5 - 11</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-6">
									<label class="fieldlabels">5.1 Location of Plant : *</label>
									<select class="form-select" name="plant_location" id="plant_location" onchange="locationAddress()">
										<option>Select Location</option>
										<option value="1">Urban</option>
										<option value="2">Rural </option>
									</select><br>
								</div>

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">5.2 Address : *</label>
									<select class="form-select" name="location_address" id="location_address" >
										<option value="">Select Address</option>
										<optgroup label="Urban" id="urban_address">
										<option value="Plot Number">Plot Number</option>
										<option value="Street/ Area">Street/ Area </option>
										<option value="Ward No">Ward No </option>
										<option value="City">City </option>
										<option value="Pin Code">Pin Code </option>
										<option value="State">State </option>
										<optgroup>
										<optgroup label="Rural" id="rural_address">
										<option value="Khasra number, Area">Khasra number, Area </option>
										<option value="Village">Village </option>
										<option value="GP">GP </option>
										<option value="Block">Block </option>
										<option value="District">District </option>
										<option value="State">State </option>
										<option value="Pin code">Pin code </option>
										<optgroup>

									</select><br>
								</div>

								<div class="row col-12 col-sm-12" id="location_address_urban">
									<div class="col-6 col-sm-2">
										<input type="text" name="" class="form-control" placeholder="Plot Number">
									</div>

									<div class="col-6 col-sm-2">
										<input type="text" name="" class="form-control" placeholder="Street">
									</div>

									<div class="col-6 col-sm-2">
										<input type="text" name="" class="form-control" placeholder="Ward No">
									</div>

									<div class="col-6 col-sm-2">
										<input type="text" name="" class="form-control" placeholder="City">
									</div>

									<div class="col-6 col-sm-2">
										<input type="text" name="" class="form-control" placeholder="Pin Code">
									</div>

									<div class="col-6 col-sm-2">
										<input type="text" name="" class="form-control" placeholder="State">
									</div>
								</div> 


								<div class="row col-12 col-sm-12" id="location_address_rural">
									<div class="col-6 col-sm-2">
										<input type="text" name="" class="form-control" placeholder="Khasra number">
									</div>

									<div class="col-6 col-sm-2">
										<input type="text" name="" class="form-control" placeholder="Village">
									</div>

									<div class="col-6 col-sm-2">
										<input type="text" name="" class="form-control" placeholder="GP">
									</div>

									<div class="col-6 col-sm-2">
										<input type="text" name="" class="form-control" placeholder="Block">
									</div>

									<div class="col-6 col-sm-2">
										<input type="text" name="" class="form-control" placeholder="District">
									</div>

									<div class="col-6 col-sm-2">
										<input type="text" name="" class="form-control" placeholder="State">
									</div>

									<div class="col-6 col-sm-2">
										<input type="text" name="" class="form-control" placeholder="Pin code">
									</div>
								</div>

							</div>
							<div class="row">

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">5.3 Project/ Plant Area : *</label>
									<input type="text" class="form-control" name="">
								</div>

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">5.4 Land ownership : *</label>
									<select class="form-select" name="land_ownership" id="land_ownership" onchange="hideShow('#land_ownership','#other_land_ownership')">
										<option value="">Select land ownership</option>
										<option>Lease</option>
										<option>Government</option>
										<option>Own</option>
										<option value="Other">Other (specify)</option>
									</select>
								<input type="text" name="other_land_ownership" id="other_land_ownership" class="form-control" placeholder="Please specify">

									
								</div>
								


								<div class="col-12 col-sm-6">
									<label class="fieldlabels">5.5 Land deed (Patta) : *</label>
									<input type="file" name="" class="form-control">
								</div>

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">5.6 Statuary clearances (required/ applied/ availed) :
										*</label>
									<select class="form-select" name="statuary_clearance" id="statuary_clearance" onchange="hideShow('#statuary_clearance','#other_statuary_clearance')">
										<option>PESO</option>
										<option>CTE</option>
										<option>CTO</option>
										<option>EC</option>
										<option>Fire</option>
										<option>Health and safety</option>
										<option>None</option>
										<option value="Other">Others (specify)</option>

									</select>
								<input type="text" name="other_statuary_clearance" id="other_statuary_clearance" class="form-control" placeholder="Please specify">

								</div>



							</div>
						</div>
						<input type="button" name="next" class="next action-button btn btn-primary" value="Next" />
						<input type="button" name="previous" class="previous action-button btn btn-dark"
							value="Previous" />
					</fieldset>


					<fieldset>
						<div class="form-card">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">6. Technical details : </h2>
								</div>
								<div class="col-5">
									<h2 class="steps">Step 6 - 11</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-6">
									<label class="fieldlabels">6.1 Technology for gas production : *</label>
									<select class="form-select" name="gas_production" id="gas_production" onchange='hideShow("#gas_production","#other_gas_production")'>
										<option></option>
										<option>Floating drum</option>
										<option>Fixed dome </option>
										<option>Dry anaerobic digestion </option>
										<option>Wet anaerobic digestion </option>
										<option value="Other">Others (specify) </option>

									</select>
									<input type="text" name="other_gas_production" id="other_gas_production" class="form-control" placeholder="Please specify"><br>
								</div>
								


								<div class="col-12 col-sm-6">
									<label class="fieldlabels">6.2 Technology for CBG purification : *</label>
									<select class="form-select" name="cbg_purification" id="cbg_purification" onchange="hideShow('#cbg_purification','#other_cbg_purification')">
										<option></option>
										<option>Pressure Swing Adsorption (PSA)</option>
										<option>Vacuum Swing Adsorption (VSA)</option>
										<option value="">Water scrubbing</option>
										<option value="">Membrane Separation  </option>
										<option value="">Chemical scrubbing – Monomethylamine (MEA) system.</option>
										<option value="Other">Others (specify)</option>
									</select><br>
									<input type="text" name="other_cbg_purification" id="other_cbg_purification" class="form-control" placeholder="Please specify"><br>
								</div>

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">6.3 Technology for bio slurry management : *</label>

									<div class="check-inline">
										<label class="form-check-label" for="TechnologybioSlurry1">
											<input class="form-check-input" value='Option A' type="checkbox" value="" id="TechnologybioSlurry1" /> No treatment
										</label>
										<label class="form-check-label" for="TechnologybioSlurry2">
											<input class="form-check-input" value='Option B' type="checkbox" value="" id="TechnologybioSlurry2" /> No treatment
										</label>
										<label class="form-check-label" for="TechnologybioSlurry3">
											<input class="form-check-input" value='Option C' type="checkbox" value="" id="TechnologybioSlurry3" /> Drying
										</label>
										<label class="form-check-label" for="TechnologybioSlurry4">
											<input class="form-check-input" value='Option D' type="checkbox" value="" id="TechnologybioSlurry4" /> Solid- Liquid Separator
										</label>
										<label class="form-check-label" for="TechnologybioSlurry5">
											<input class="form-check-input" value='Option D' type="checkbox" value="" id="TechnologybioSlurry5" /> PROM
										</label>
										<label class="form-check-label" for="TechnologybioSlurry6">
											<input class="form-check-input" value='Option E' type="checkbox" value="" id="TechnologybioSlurry6" /> Others (specify) 
										</label>
										
									</div>
									<input type="text" name="other_technologybioSlurry" id="other_technologybioSlurry" class="form-control " placeholder="Please specify">
								</div>
								

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">6.4 Upload technical documents (Pre-feasibility report, DPR with plant layout etc.) : *</label>
									<input type="file" name="pic" accept="image/*">
								</div>
							</div>
						</div>
						<input type="button" name="next" class="next action-button btn btn-primary" value="Next" />
						<input type="button" name="previous" class="previous action-button btn btn-dark"
							value="Previous" />
					</fieldset>


					<fieldset>
						<div class="form-card">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">7. Financial details : </h2>
								</div>
								<div class="col-5">
									<h2 class="steps">Step 7 - 11</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-12">
									<label class="fieldlabels">7.1 CAPEX : *</label> <br></br>
								</div>

								<div class="col-6 col-sm-2">
									<input type="number" name="" class="form-control" placeholder="DPR Cost(inlakhs)">
								</div>

								<div class="col-6 col-sm-2">
									<input type="number" name="" class="form-control" placeholder="Land Cost(in lakhs)">
								</div>

								<div class="col-6 col-sm-2">
									<input type="number" name="" class="form-control" placeholder="Civil(in lakhs)">
								</div>

								<div class="col-6 col-sm-3">
									<input type="number" name="" class="form-control" placeholder="Machinery(in lakhs)">
								</div>

								<div class="col-6 col-sm-3">
									<input type="number" name="" class="form-control" placeholder="Other (Specify)">
								</div>

								<div class="col-12 col-sm-12">
									<label class="fieldlabels">7.2 OPEX (annual) : *</label> <br></br>
								</div>

								<div class="col-6 col-sm-2">
									<input type="number" name="" class="form-control" placeholder="Cost of raw material(in lakhs)">
								</div>

								<div class="col-6 col-sm-2">
									<input type="number" name="" class="form-control" placeholder="Human Resources(in lakhs)">
								</div>

								<div class="col-6 col-sm-2">
									<input type="number" name="" class="form-control" placeholder="Transportation(in lakhs)">
								</div>

								<div class="col-6 col-sm-2">
									<input type="number" name="" class="form-control" placeholder="Electricity(in lakhs)">
								</div>

								<div class="col-6 col-sm-2">
									<input type="number" name="" class="form-control" placeholder="Water (Specify)">
								</div>

								<div class="col-6 col-sm-2">
									<input type="number" name="" class="form-control" placeholder="Misc (Specify)">
								</div>

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">7.3 Status of financial closure : *</label>

									<select class="form-select" name="state">
										<option></option>
										<option>Achieved </option>
										<option>Not achieved </option>

									</select><br>
								</div>

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">7.4.a Funding source : *</label> <br>
									<select class="form-select" name="state">
										<option>Select Funding Source</option>
										<option value="">Self-finance (Rs. In lakhs)</option>
										<option value="">Bank Loans (details of bank and Rs. In lakhs)</option>
										<option value="">Govt. schemes</option>
										<option value="">CSR </option>
										<option value="">Any others </option>

									</select><br>


								</div>

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">7.4.b Funding source : *</label> <br>
									<select class="form-select" name="state">
										<option>Select Funding Source</option>
										<option value="">Funds obtained (Rs. in Lakhs)</option>
										<option value="">Self-finance (Rs. In lakhs)</option>
										<option value="">Bank Loans (details of bank and Rs. In lakhs)</option>
										<option value="">Govt. schemes </option>
										<option value="">CSR </option>
										<option value="">Any others </option>
										<option value="">Shortfall </option>

									</select><br>


								</div>

		

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">7.5 Revenue (annual) : *</label> <br>
									<select class="form-select" name="state">
										<option>Select Revenue</option>
										<!-- In the case of biogas plant  -->
										<optgroup label="Biogas" id="revenue_biogas">
										<option>Sale price of biogas </option>
										<option>Sale price of bio-slurry </option>
										</optgroup>

										<!-- In the case of CBG plant  -->
										<optgroup label="CBG" id="revenue_cbg">
										<option value="">Sale price of CNG</option>
										<option value="">Sale price of biofertilizer (FOM)</option>
										<option value="">Sale price of biofertilizer (LFOM)</option>
										<option value="">Sale of other by-products (specify)</option>
										</optgroup>

									</select><br>


								</div>



								<!-- <div class="col-12 col-sm-12">
									<label class="fieldlabels">7.5 Funding source : *</label> <br>
									<div class="check-inline">
										<label class="form-check-label" for="oncheck1">
											<input class="form-check-input" value='Option A' type="checkbox" value="" id="oncheck1" /> Self-finance (Rs. In lakhs)
										</label>
										<label class="form-check-label" for="oncheck2">
											<input class="form-check-input" value='Option B' type="checkbox" value="" id="oncheck2" /> Bank Loans (details of bank and Rs. In lakhs)
										</label>
										<label class="form-check-label" for="oncheck3">
											<input class="form-check-input" value='Option C' type="checkbox" value="" id="oncheck3" /> Govt. schemes (specify in section 8.2)
										</label>
										<label class="form-check-label" for="oncheck4">
											<input class="form-check-input" value='Option D' type="checkbox" value="" id="oncheck4" /> CSR (Specify and Rs. In lakhs)
										</label>
										<label class="form-check-label" for="oncheck5">
											<input class="form-check-input" value='Option E' type="checkbox" value="" id="oncheck5" /> Any others
										</label>
									</div>

								</div> -->
							</div>
						</div>
						<input type="button" name="next" class="next action-button btn btn-primary" value="Next" />
						<input type="button" name="previous" class="previous action-button btn btn-dark"
							value="Previous" />
					</fieldset>


					<fieldset>
						<div class="form-card">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">8. Physical and financial progress : </h2>
								</div>
								<div class="col-5">
									<h2 class="steps">Step 8 - 11</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<label class="fieldlabels">8.1 Status of physical progress : *</label>
									<div class="check-inline">
										<label class="form-check-label" for="twcheck1">
											<input class="form-check-input" value='Option A' type="checkbox" value="" id="twcheck1" /> Land clearance completed
										</label>
										<label class="form-check-label" for="twcheck2">
											<input class="form-check-input" value='Option B' type="checkbox" value="" id="twcheck2" /> All Statutory clearance obtained
										</label>
										<!-- In case of under construction -->
										<span id="under-construction-phy-pro">
											<label class="form-check-label" for="twcheck3">
												<input class="form-check-input" value='Option C' type="checkbox" value="" id="twcheck3" /> Site mobilization
											</label>
											<label class="form-check-label" for="twcheck4">
												<input class="form-check-input" value='Option D' type="checkbox" value="" id="twcheck4" /> Completed raw material storage building
											</label>
											<label class="form-check-label" for="twcheck5">
												<input class="form-check-input" value='Option E' type="checkbox" value="" id="twcheck5" /> Completed biodigester erection
											</label>
											<label class="form-check-label" for="twcheck6">
												<input class="form-check-input" value='Option F' type="checkbox" value="" id="twcheck6" /> Completed gas purification unit
											</label>
											<label class="form-check-label" for="twcheck7">
												<input class="form-check-input" value='Option F' type="checkbox" value="" id="twcheck7" /> Completed cascading unit
											</label>
											<label class="form-check-label" for="twcheck8">
												<input class="form-check-input" value='Option F' type="checkbox" value="" id="twcheck8" /> Completed bio-slurry management unit
											</label>
											<label class="form-check-label" for="twcheck9">
												<input class="form-check-input" value='Option F' type="checkbox" value="" id="twcheck9" /> Completed pipeline connection to grid
											</label>
											<label class="form-check-label" for="twcheck10">
												<input class="form-check-input" value='Option F' type="checkbox" value="" id="twcheck10" /> Trail run completed
											</label>
										</span>

									</div>





								</div>

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">8.2 Status of financial expenditure : *</label>
									<input type="text" name="" class="form-control" placeholder="Total expenditure as on date (in lakhs) ">
								</div>

								<div class="col-12 col-sm-6">
									<label class="fieldlabels">8.3 Date of commissioning : *</label>
									<input type="date" name="" class="form-control" placeholder="Total expenditure as on date (in lakhs) ">
								</div>

								<div class="row col-12 col-sm-6">
									<label class="fieldlabels">8.4 Geo tag of location : *</label>
									<div class="col-6 col-sm-6">
										<input type="number" name="" class="form-control" placeholder="Latitude">
									</div>
									<div class="col-6 col-sm-6">
										<input type="number" name="" class="form-control" placeholder="Longitude">
									</div>
								</div>
							</div>
						</div>
						<input type="button" name="next" class="next action-button btn btn-primary" value="Next" />
						<input type="button" name="previous" class="previous action-button btn btn-dark"
							value="Previous" />
					</fieldset>

					<fieldset>
						<div class="form-card">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">9. LoI and Benefits (API Sharing with relevant ministry) : </h2>
								</div>
								<div class="col-5">
									<h2 class="steps">Step 9 - 11</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<label class="fieldlabels">9.1 Lol details : *</label>
									<div class="check-inline">
										<select class="form-select w-50" name="lol_details" id="lol_details">
											<option>Select Lol details</option>

											<option value="">Required</option>
											<option value="">Applied (enter the reference number and OMC details)</option>
											<option value="">Obtained (upload the details)</option>
											<option value="">Not required</option>
	
										</select>

									</div>

									<label class="fieldlabels">9.2 Benefits : *</label>

									<div class="check-inline">
										<div class="col-6 col-sm-3">
											<input class="form-check-input" value='Wanted' type="checkbox" value="" id="benefits1" /> 
											A. Wanted

										</div>
										<div class="col-6 col-sm-3">
											<input class="form-check-input" value='Applied' type="checkbox" value="" id="benefits2" /> B. Applied

										</div>
										<div class="col-6 col-sm-3">
											<input class="form-check-input" value='Availed' type="checkbox" value="" id="benefits3" /> C. Availed 

										</div>
										<div class="col-6 col-sm-3">
											<input class="form-check-input" value='No benefits required' type="checkbox" value="" id="benefits4" /> D. No benefits required

										</div>
									</div>


								</div>

								
							</div>
						</div>
						<input type="button" name="next" class="next action-button btn btn-primary" value="Next" />
						<input type="button" name="previous" class="previous action-button btn btn-dark"
							value="Previous" />
					</fieldset>
					<fieldset>
						<div class="form-card">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">10. Self-Certification (attach affidavit) : </h2>
								</div>
								<div class="col-5">
									<h2 class="steps">Step 10 - 11</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									
								</div>

								
							</div>
						</div>
						<input type="button" name="next" class="next action-button btn btn-primary" value="Next" />
						<input type="button" name="previous" class="previous action-button btn btn-dark"
							value="Previous" />
					</fieldset>

					<fieldset>
						<div class="form-card">
							<div class="row">
								<div class="col-7">
									<h2 class="fs-title">11.	Certifying authority (for official use):</h2>
								</div>
								<div class="col-5">
									<h2 class="steps">Step 11 - 11</h2>
								</div>
							</div>
							<div class="row col-12 col-sm-12">
								<label class="fieldlabels">11.1 Details: *</label>
								<div class="col-6 col-sm-3">
									<input type="text" class="form-control" name="name" placeholder="Name">
								</div>
								<div class="col-6 col-sm-3">
									<input type="text" class="form-control" name="designation" placeholder="Designation">
								</div>
								<div class="col-6 col-sm-3">
									<input type="text" class="form-control" name="agency" placeholder="Agency/Ministry">
								</div>
								<div class="col-6 col-sm-3">
									<input type="text" class="form-control" name="contact_number" placeholder="Contact Number">
								</div>
								<div class="col-6 col-sm-3">
									<input type="file" class="form-control" name="auth_letter" placeholder="Authorization Letter">
								</div>
								
							</div>

							<div class="row col-12 col-sm-12">
								<label class="fieldlabels">11.2.a Verification Details</label>
								<div class="col-6 col-sm-3">
									<label class="fieldlabels">Date of receive of request</label>
									<input type="datetime" class="form-control" value="<?=date('Y-m-d h:i:s');?>" name="receive_date" disabled>
								</div>
								<div class="col-6 col-sm-3">
									<label class="fieldlabels">Date of submission of report</label>
									<input type="date" class="form-control" value="" name="submission_date">
								</div>
							</div>
							<div class="row col-12 col-sm-12">
								<label class="fieldlabels">11.2.b Verification Details</label>
								<div class="col-6 col-sm-3">
									<label class="fieldlabels">Verification Details</label>
									<input type="text" class="form-control" value="" name="receive_date" >
								</div>
								<div class="col-6 col-sm-3">
									<label class="fieldlabels">Location Details</label>
									<input type="file" class="form-control" name="">
								</div>
								<div class="col-6 col-sm-3">
									<label class="fieldlabels">Technical Details</label>
									<input type="file" class="form-control" name="" >
								</div>
								<div class="col-6 col-sm-3">
									<label class="fieldlabels">Financial Details</label>
									<input type="file" class="form-control" name="">
								</div>
							</div>


							<div class="row col-12 col-sm-12">
								<label class="fieldlabels">11.3 Recommendations</label>
								<div class="col-8 col-sm-6">
									<label class="fieldlabels">Permanent Registration Number</label>
									<select class="form-select" name="recommendations" id="recommendations">
										<option>Select Recommendations</option>

										<option value="">Permanent Registration number to be given</option>
										<option value="">Permanent Registration number not to be given</option>
									

									</select>
								</div>
								
							</div>

							<div class="row col-12 col-sm-12">
								<label class="fieldlabels">Note</label>
								<label class="fieldlabels">1. Depending on the plant capacity and benefits required, DDWS will share the details with the concerned ministry to verify. The concerned ministry can send their consent back after verification to DDWS.</label>
								<label class="fieldlabels">2. Final registration will be given once the trial run is completed.</label>
								<div class="check-inline">
									<label class="form-check-label" for="tc">
										<input class="form-check-input" value='Option A' type="checkbox" required="" value="" id="tc" /> Accepted T&C
									</label>
								</div>
							</div>

						</div>
						<input type="button" style="background-color:red;" name="next" class="next action-button " value="Submit" />
						<input type="button" name="previous" class="previous action-button btn btn-dark" value="Previous" />
					</fieldset>
					
					
					<fieldset>
						<div class="form-card form-submitted mt-4">
							<h3 class="text-center"><strong>Form Submitted !</strong></h3> <br>
							<div class="row justify-content-center">
								<div class="col-3"> <i class="fa fa-check subbmited-sign"></i> </div>
							</div> <br><br>
							<div class="row justify-content-center">
								<div class="col-7 text-center">
									<h3 class="text-center">You Have Successfully Signed Up</h3>
								</div>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>


<?=$this->section('script');?>

<script>
	$(document).ready(function(){
		$("#nof_director").on("change", function(){
			let nof_director = $(this).val();
			let director_details='';
			for(let i=1;i<=nof_director;i++){
				director_details+='<tr>\
					<td class="text-dark">'+i+'</td>\
					<td> <input type="number" class="form-control" placeholder="DIN" > </td>\
					<td> <input type="text" class="form-control" placeholder="Name"> </td>\
					<td> <input type="text" class="form-control" placeholder="Gender"> </td>\
					<td> <input type="number" class="form-control" placeholder="Mobile Number"> </td>\
					<td> <input type="email" class="form-control" placeholder="Email"> </td>\
				</tr>';
			}
			$("#nof_director_details").html(director_details);
		});


		///5.1 EVENTS
		$("#location_address_urban").hide();
		$("#location_address_rural").hide();
		$("#location_address").on("change", function(){
			let locationAddress = $(this).val();
			if(locationAddress=="urban"){
				$("#location_address_urban").show();
				$("#location_address_rural").hide();
			}
			
			if(locationAddress=="rural"){
				$("#location_address_urban").hide();
				$("#location_address_rural").show();
			}
			
			

		})

	})
</script>


<script>
	$(document).ready(function() {

		function validateFormFieldset(formSet)
		{
			let errcount = [];
			let entityDetails = ['entity_name','entity_type','entity_contactno','entity_email','entity_address','entity_state','entity_district','entity_pincode','entity_reg_no','entity_reg_date','entity_pan_no','entity_gst_no','entity_reg_letter'];
			$.each(entityDetails, function (key, val) {
				if($("#"+val).val()==""){
					errcount.push(val);
					$("#"+val).addClass(' customRequired');
				}
			});
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

		$(".next").click(function() {

			current_fs = $(this).parent();
			next_fs = $(this).parent().next();


			//  VALIDATION

			// let checkValidation = $(this).data("id");
			// let validateRes =  validateFormFieldset(checkValidation);
			// let findErr = validateRes.length;
			// if(findErr>0){ return false; }
			

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

		$(".previous").click(function() {

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
			$(".progress-bar")
				.css("width", percent + "%")
		}

		$(".submit").click(function() {
			return false;
		})

	});
</script>

<!-- Hide/Display Section Start-->
<script>
	// input text field hidden
	$("#other_gas_production").hide();
	$("#other_cbg_purification").hide();
	$("#other_technologybioSlurry").hide();
	$("#under-construction-phy-pro").hide();
	$("#govt_entity").hide();
	$("#pvt_entity").hide();
	$("#pvt_others").hide();
	$("#biogas").hide();
	$("#cbg").hide();
	$("#revenue_biogas").hide();
	$("#revenue_cbg").hide();
	$("#sub_biogas").hide();
	$("#sub_cbg").hide();
	$("#other_subBiogas").hide();
	$("#other_subcbg").hide();
	$("#other_feedstock").hide();
	$("#other_source_feedstock").hide();
	$("#other_bioSlurry").hide();
	$("#other_fombioSlurry").hide();
	$("#urban_address").hide();
	$("#rural_address").hide();
	$("#other_land_ownership").hide();
	$("#other_statuary_clearance").hide();
	$("#other_otherByProducts").hide();



	// Select Box Hide and Show
	function hideShow(id, input_id, id_value="Other"){
		var sid = $(id).val();

		if(sid==id_value){
			$(input_id).show();
		}else{
			$(input_id).hide();
		}
	}

	// Checkbox Hide and Show
	function isCheckedHideShow(id, input_id){
		$(id).change(function(){
		if(this.checked){
			$(input_id).show();
			}else{
				$(input_id).hide();
			}
		
	})
	}

// Entity

	function showEntity(){

		var entity_type = $("#entity_type").val();
		// alert(entity_type);

		

		if(entity_type=="Government"){
			$("#govt_entity").show();
			$("#pvt_entity").hide();
		}

		if(entity_type=="Private"){
			$("#govt_entity").hide();
			$("#pvt_entity").show();
		}

	}


// Gas Ouptut
	

	function gasOutput(){

		var gastype = $("#gas_output").val();
		// alert(gastype);


		if(gastype=="1"){
			$("#biogas").show();
			$("#revenue_biogas").show()
			$("#cbg").hide();
			$("#revenue_cbg").hide();

		}

		if(gastype=="2"){
			$("#biogas").hide();
			$("#revenue_biogas").hide();

			$("#cbg").show();
			$("#revenue_cbg").show();
		}

	}

// Gas Linkage


	function gasLinkage(){

		var gastypelinkage = $("#gas_output").val();
		
		if(gastypelinkage=="1"){
			$("#sub_biogas").show();
			$("#sub_cbg").hide();
		}

		if(gastypelinkage=="2"){
			$("#sub_biogas").hide();
			$("#sub_cbg").show();
		}
			
	}

	function locationAddress(){
		var laddress = $("#plant_location").val();
		// alert(laddress);
		if(laddress=="1"){
			$("#urban_address").show();
			$("#rural_address").hide();
		}

		if(laddress=="2"){
			$("#urban_address").hide();
			$("#rural_address").show();
		}
	}

	isCheckedHideShow('#oncheck5','#other_subBiogas');
	isCheckedHideShow('#oncheck10','#other_subcbg');
	isCheckedHideShow('#toFeedstock6','#other_feedstock');
	isCheckedHideShow('#sourceofFeedbk8','#other_source_feedstock');
	isCheckedHideShow('#bioSlurry4','#other_bioSlurry');
	isCheckedHideShow('#FOMbioSlurry5','#other_fombioSlurry');
	isCheckedHideShow("#TechnologybioSlurry6","#other_technologybioSlurry");


	// Other specify for Private Entoty
	

	// function showOthers(){
	// 	var pvt_entity = $("#sub_entity").val();

	// 	if(pvt_entity=="Others Private"){
			
	// 		$("#pvt_others").show();

	// 	}else{

	// 		$("#pvt_others").hide();
	// 	}

	// }

	// $('#oncheck5').change(function(){
	// 	if(this.checked){
	// 		$("#other_subBiogas").show();
	// 	}else{
	// 		$("#other_subBiogas").hide();
	// 	}
	// })

	// $('#oncheck10').change(function(){
	// 	if(this.checked){
	// 		$("#other_subcbg").show();
	// 		}else{
	// 			$("#other_subcbg").hide();
	// 		}
		
	// })

	// Feedstock



	// $('#toFeedstock6').change(function(){
	// 	if(this.checked){
	// 		$("#other_feedstock").show();
	// 		}else{
	// 			$("#other_feedstock").hide();
	// 		}
		
	// })

	// $('#sourceofFeedbk8').change(function(){
	// 	if(this.checked){
	// 		$("#other_source_feedstock").show();
	// 		}else{
	// 			$("#other_source_feedstock").hide();
	// 		}
		
	// })

	// Bio-slurry


	

	// $('#bioSlurry4').change(function(){
	// 	if(this.checked){
	// 		$("#other_bioSlurry").show();
	// 		}else{
	// 			$("#other_bioSlurry").hide();
	// 		}
		
	// })

	// $('#FOMbioSlurry5').change(function(){
	// 	if(this.checked){
	// 		$("#other_fombioSlurry").show();
	// 		}else{
	// 			$("#other_fombioSlurry").hide();
	// 		}
		
	// })

	// By products

	// function otherByProductsShow(){
	// 	var otherbp = $("#otherByProducts").val();
	// 	// alert(otherbp);
	// 	if(otherbp=="Other"){
	// 		$("#other_otherByProducts").show();
	// 	}else{
	// 		$("#other_otherByProducts").hide();
	// 	}

	// }

	// Location Address





	// Land ownership

	

	// function landOwnership(){

	// 	var lowner = $("#land_ownership").val();
	// 	// alert(lowner);
	// 	if(lowner=="Other"){
	// 		$("#other_land_ownership").show();
	// 	}else{
	// 		$("#other_land_ownership").hide();
	// 	}

	// }

	// Statuary Clearance

	

	// function statuaryClearance(){
	// 	var sclean = $("#statuary_clearance").val();
	// 	// alert(lowner);
	// 	if(sclean=="Other"){
	// 		$("#other_statuary_clearance").show();
	// 	}else{
	// 		$("#other_statuary_clearance").hide();
	// 	}
	// }




	

	


</script>

<?=$this->endSection(); ?>