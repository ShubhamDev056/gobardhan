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
.fa-download {
    border-radius: 50%;
    border: 1px solid;
    padding: 4px;
    font-size: 16px;
    color: black;
}
.SumoSelect > .CaptionCont > span.placeholder {
    color: #524a4a;
}

.mupdate li{
	border:0px!important;
}
</style>

<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">
				Functionality Status of Biogas Plants - <?=$_SESSION['name'];?>
			</h3>
		</div>
		
		<div class="col-lg-12 col-12">
		
			
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr class="table-header">
						<th>#SN</th>
						<th>Plant Details</th>  
						<th width="45%">Functionality Status</th> 
						<input type="hidden" value="<?=$prmid;?>" id="prmmId" />
						<input type="hidden" value="<?=$project_id;?>" id="projectId" />
					</tr>
					
					<?php
						//$entTypes = [''=>'','17'=>'Biogas plant operator','18'=>'Compressed Bio Gas/ Bio CNG plant operator'];
						//$entityTypes = [''=>'','0'=>'','1'=>'Government including Co-operatives','2'=>'Private'];
						$plntStatus = [''=>'','22'=>'Yet to start construction','23'=>'Under Construction','24'=>'Functional','290'=>'Completed','292'=>'Temporary Nonfunctional','293'=>'Defunct'];
						foreach($projects as $key=>$project){ 
						?>
							<tr>
								<td><?php if(isset($_GET['page']) && $_GET['page']>1){ echo ($per_page*$_GET['page']-$per_page)+$key+1;}else{ echo $key+1;};?></td>
								<td> 
									<ul class="list-group ">
									  <!--<li class="list-group-item p-1"><b>State :</b> <?php //$project['state_name'];?></li>-->
									  <li class="list-group-item p-1"><b>District :</b> <?=$project['district_name'];?></li>
									  
									  <li class="list-group-item p-1"><b>Plant Name :</b> <?=$project['project_name'];?></li>
									  <li class="list-group-item p-1"><b>Last reported status of the plant:</b> <?=$plntStatus[$project['plant_status_id']];?></li>
									  
									  <li class="list-group-item p-1"><b>Designed Gas Production Capacity :</b> <?=$project['gas_production_capacity'];?> <?php if($project['entity_type_id']=="17"){ echo "m³/day"; }else{  echo "Tons/day"; } ?></li>
									  
									  <li class="list-group-item p-1"><b>Designed Solid Feedstock Capacity :</b> <?=$project['solid_feedstock_capacity'];?> Tons/day</li>
									  <li class="list-group-item p-1"><b>Designed bio-slurry output :</b>  <?=$project['bio_slurry_output'];?> KLD</li>
									 <!-- <li class="list-group-item p-1"><b>Last reported functionality status in the month:</b>  </li> -->
									</ul> 
								</td>
								
								<td>
									<ul class="list-group mupdate ">
										<li class="list-group-item p-1">
											<label class="mb-0">
												Reporting Month
												<?php  	
													$month_ini = new DateTime("first day of last month"); 
													$month_end = new DateTime("last day of last month");
												?>
												
												<b><?php echo $month_ini->format('M-Y'); ?></b>
												
											</label>
											<input type="hidden" value="<?=$project['plant_status_id'];?>" id="pre_status<?=$project['project_id'];?>" />
											<input type="hidden" value="<?php echo $month_ini->format('Y-m'); ?>" id="reporting_month<?=$project['project_id'];?>" />
											<input type="date" class="form-control" id="rdate<?=$project['project_id'];?>" value="<?=date('Y-m-d')?>" placeholder="Date" readonly />
										</li>
										<li class="list-group-item p-1"> 
											<label class="mb-0">Select Current Status</label>
											<select class="form-control cstatus" id="cstatus<?=$project['project_id'];?>" data-id="<?=$project['project_id'];?>">
												<option value="" selected hidden >Select Current Status</option>
												<option value="24" <?php if($mmdetails['current_status']=="24"){ echo "selected"; } ?> >Functional</option>
												<option value="292" <?php if($mmdetails['current_status']=="292"){ echo "selected"; } ?> >Temporary Nonfunctional</option>
												<option value="293" <?php if($mmdetails['current_status']=="293"){ echo "selected"; } ?> >Defunct</option>
											</select>
										</li>
										
										<li class="list-group-item p-1 d-none" id="f<?=$project['project_id'];?>">
											
											<?php if($project['plant_status_id']!=24){ ?>
												<label class="mb-0">Date of functionality</label>
												<input type="date" max="<?php echo $month_end->format('Y-m-d'); ?>" value="<?=$mmdetails['functionality_date'];?>" id="fnltydate<?=$project['project_id'];?>" class="form-control mb-2" />
												<label class="mb-0">Amount spent to make it functional</label>
												<input type="text" class="form-control mb-2" value="<?=$mmdetails['functional_amount'];?>" id="spentAmt<?=$project['project_id'];?>" placeholder="Amount spent to make it functional" />
												<label class="mb-0">Source of funding to make it functional</label>
												<input type="text" class="form-control mb-2" value="<?=$mmdetails['functional_source'];?>" id="fndSource<?=$project['project_id'];?>" placeholder="Source of funding to make it functional" />
												<label>Upload Document (<b>MAX: 2MB</b>) <a href="<?=base_url()?>fuctional_docs/Declaration-revised.pdf" target="_blank" download > <i class="fa fa-download pull-right"></i> Download Sample </a> </label>
												<input type="file" class="form-control validdoc mb-2" data-id="<?=$project['project_id'];?>" accept=".pdf" id="doc<?=$project['project_id'];?>" />
												<span class="text-danger" id="doc_err<?=$project['project_id'];?>"></span>
											<?php }else{ ?>
													<input type="file" class="form-control validdoc d-none " data-id="<?=$project['project_id'];?>" accept=".pdf" id="doc<?=$project['project_id'];?>" />
											<?php } ?>
										
											<label class="mb-0">Number of functional Days in <?php echo $month_ini->format('M-Y'); ?></label>
											<input type="number" class="form-control mb-2 fdays" min="0" maxlength="2" value="<?=$mmdetails['nofunctional_days'];?>" data-id="<?=$month_end->format('d');?>" id="workingDay<?=$project['project_id'];?>" placeholder="Number of functional Days in <?php echo $month_ini->format('M-Y'); ?>" />
											<label class="mb-0">Total feedstock utilized (in Tons) in <?php echo $month_ini->format('M-Y'); ?></label>
											<input type="number" class="form-control mb-2" min="0" maxlength="5" value="<?=$mmdetails['feedstock'];?>" id="feedstock<?=$project['project_id'];?>" placeholder="Total feedstock utilized (in Tons) in <?php echo $month_ini->format('M-Y'); ?>" />
											<label class="mb-0">Total biogas generated (in Tons) in <?php echo $month_ini->format('M-Y'); ?></label>
											<input type="number" class="form-control mb-2" min="0" maxlength="5" value="<?=$mmdetails['biogas_generation'];?>" id="monthlyBiogasGen<?=$project['project_id'];?>" placeholder="Total biogas generated (in Tons) in <?php echo $month_ini->format('M-Y'); ?>" />
											<label class="mb-0">Total bio slurry generated (in KL) in <?php echo $month_ini->format('M-Y'); ?></label>
											<input type="number" class="form-control mb-2" min="0" maxlength="5" value="<?=$mmdetails['bioslurry_generation'];?>" id="monthlyBioSlurry<?=$project['project_id'];?>" placeholder="Total bio slurry generated (in KL) in <?php echo $month_ini->format('M-Y'); ?>" />
											
										</li>
										
										<li class="list-group-item p-1 d-none" id="nonf<?=$project['project_id'];?>" >
											<label class="mb-0">Since</label> 
											<input type="date" class="form-control mb-2" max="<?php echo $month_end->format('Y-m'); ?>" value="<?=$mmdetails['defunct_date'];?>" id="sinceDate<?=$project['project_id'];?>" />
											
											<input type="text" class="form-control mb-2" value="<?=$mmdetails['other_reason'];?>" id="otherReason<?=$project['project_id'];?>" placeholder="Enter Reason (50 Words only)" />
											
											<label class="mb-0">Expected date of functionality</label>
											<input type="date" class="form-control mb-2" min="<?=date('Y-m')?>" value="<?php if($mmdetails['functionality_date']!="0000-00-00"){ echo $mmdetails['functionality_date']; };?>" id="expDate<?=$project['project_id'];?>"  />
											<label class="mb-0">Estimated funds required to make it functional (in Lakhs)</label>
											<input type="number" class="form-control mb-2" id="reqFunds<?=$project['project_id'];?>" value="<?=$mmdetails['functional_amount'];?>" placeholder="Estimated funds required to make it functional (in Crs.)" />
											
										</li>
										
										<li class="list-group-item p-1">
											<span class="text-danger" id="err<?=$project['project_id'];?>"></span>
											<button type="button" class="btn btn-primary btn-sm pull-right reporting" data-id="<?=$project['project_id'];?>" >Submit</button>
										</li>
									</ul>
								</td> 
								<?php /* ?>
								<td>
									<a href="<?=base_url()?>project-details/<?=$project['project_id'];?>" ><i class="fa fa-eye badge bg-primary text-white"> </i></a>
									<?php 
										if(session()->get('role_id')==1){ ?>
											<a href="<?=base_url()?>project-delete/<?=$project['project_id'];?>" onclick=" return confirm('Are you sure to delete?') " ><i class="fa fa-trash badge bg-danger text-white"> </i></a>
										<?php	
										}
									?>
								</td>
								
								<?php */ ?>
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
 
 $(document).ready(function(){
	
	var cstatus = $('.cstatus option:selected').val();
	var projectId = $('#projectId').val();
	changeplantStatus(projectId,cstatus);
	function changeplantStatus(pid,cstatus){
		$("#f"+pid).addClass('d-none');
		$("#nonf"+pid).addClass('d-none');
		if(cstatus==24){
			$("#f"+pid).removeClass('d-none');
		}else{
			$("#nonf"+pid).removeClass('d-none');
		}
	}
 })
 
 
 
$(".cstatus").on("change", function(){
	var pid = $(this).data("id");
	var cstatus = $(this).val();
	$("#f"+pid).addClass('d-none');
	$("#nonf"+pid).addClass('d-none');
	if(cstatus==24){
		$("#f"+pid).removeClass('d-none');
	}else{
		$("#nonf"+pid).removeClass('d-none');
	}
});

$(".check_multiselect").on("change", function(){
	var pid = $(this).data("id");
	var reasonId = "#reason"+pid;
	// var allReason = $(reasonId+' option:selected').toArray().map(item => item.value);
	
	// if($.inArray("16", allReason) != -1) {
		// $("#otherReason"+pid).removeClass('d-none');
	// } else {
		// $("#otherReason"+pid).addClass('d-none');
	// }
});
	
$(".fdays").on("keyup", function(){
	var mx = $(this).data("id");
	if(this.value>mx){this.value=mx;}else if(this.value<0){this.value=mx;}
});

$(".validdoc").on("change", function () {
	var pid = $(this).data("id");
	$("#doc_err"+pid).html('');
	var extension = $(this).val().split('.').pop().toLowerCase();
	var validFileExtensions = ['pdf', 'doc'];
	
	var sizebyte = this.files[0].size;
	var sizekb = Math.round((sizebyte / 1024));
	if ($.inArray(extension, validFileExtensions) == -1) {
		$("#doc_err"+pid).html('Failed!! Please upload pdf file only.!!');
		$(this).val('');
	}else{
		if( sizekb > 2048) { // 2MB
		   $("#doc_err"+pid).html('Please upload file less than 2MB.');
		   $(this).val('');
		}
	}
});

$(".reporting").on("click", function(){
	
	var reportingData = new FormData();
	
	
	var pid = $(this).data("id");
	var prmmId = $("#prmmId").val();
	var rdate = $("#rdate"+pid).val();
	var cstatus = $("#cstatus"+pid).val();
	var feedstock = $("#feedstock"+pid).val();
	var monthlyBiogasGen = $("#monthlyBiogasGen"+pid).val();
	var monthlyBioSlurry = $("#monthlyBioSlurry"+pid).val();
	
	var sinceDate = $("#sinceDate"+pid).val();
	var reporting_month = $("#reporting_month"+pid).val();
	var workingDay = $("#workingDay"+pid).val();
	var pre_status = $("#pre_status"+pid).val();
	var reasonId = "#reason"+pid;
	var otherReason = $("#otherReason"+pid).val();
	var sendRequest=false;
	otherReason  = otherReason.replace(/'/g, "\\'");
	// var allReason1 = $(reasonId+' option:selected').toArray().map(item => item.value);
	var allReason = "";  //$(reasonId+' option:selected').toArray().map(item => item.value).join();
	
	//console.log(allReason);
	var oreason = true;
	// if ($.inArray("16", allReason1) != -1) {
		// if(otherReason==""){
			// oreason=false;
		// }
	// }
	
	//console.log(oreason);
	
	var file = $( '#doc'+pid )[0].files[0]; 
	reportingData.append('doc',file);
	reportingData.append('prmmId',prmmId);
	
	$("#err"+pid).html(''); 
	if(prmmId!="" && pid!="" && cstatus!=""){
		//var reportingData = {};
		if(cstatus==24){
			var fnltydate = $("#fnltydate"+pid).val();
			var spentAmt = $("#spentAmt"+pid).val();
			var fndSource = $("#fndSource"+pid).val();
			if(fndSource==undefined){
				fndSource='';
			}
			if(feedstock!="" && monthlyBiogasGen!="" && monthlyBioSlurry!="" && rdate!=""){
				reportingData.append('pid',pid);
				reportingData.append('cstatus',cstatus);
				reportingData.append('rdate',rdate);
				reportingData.append('feedstock',feedstock);
				reportingData.append('monthlyBiogasGen',monthlyBiogasGen);
				reportingData.append('monthlyBioSlurry',monthlyBioSlurry);
				reportingData.append('reporting_month',reporting_month);
				reportingData.append('workingDay',workingDay);
				reportingData.append('pre_status',pre_status);
				reportingData.append('functionality_date',fnltydate);
				reportingData.append('functional_amount',spentAmt);
				reportingData.append('functional_source',fndSource);
				sendRequest=true;
				//console.log(reportingData);
				$(this).attr('disabled', true);
			}else{
				$("#err"+pid).html('All fields are required.');
				//console.log('All fields are required.');
			}
		}else{
			
			
			var expectedDateofFunctional = $("#expDate"+pid).val();
			var reqFunds = $("#reqFunds"+pid).val();
			var reqSource = $("#reqSource"+pid).val();
			
			if(sinceDate!="" && oreason!=false){
				reportingData.append('pid',pid);
				reportingData.append('cstatus',cstatus);
				reportingData.append('rdate',rdate);
				reportingData.append('sinceDate',sinceDate);
				reportingData.append('other_reason',otherReason);
				reportingData.append('reporting_month',reporting_month);
				reportingData.append('allReason',allReason);
				reportingData.append('pre_status',pre_status);
				reportingData.append('functionality_date',expectedDateofFunctional);
				reportingData.append('functional_amount',reqFunds);
				reportingData.append('functional_source',reqSource);
				sendRequest=true;
				//console.log(reportingData);
				$(this).attr('disabled', true);
			}else{
				$("#err"+pid).html('All fields are required.');
				//console.log('All fields are required.');
			}
		}
		
		if(sendRequest){
			//console.log(reportingData);
			$.ajax({
				url:"<?=base_url()?>monthly-reported",
				type:"post",
				data:reportingData,
				dataType:"json",
				contentType: false,
				cache: false,
				processData:false,
				success:function(res){
					console.log(res);
					if(res.status==200){
						$("#err"+pid).html(res.message);
					}
				}
			});  
		}
		
		
	}else{
		console.log('Current status are required.');
	}
	
	
});


$('input[type=number]').on('input, keypress', function(ev) {
	var $this = $(this);
	var maxlength = 5; //$this.attr('max').length;
	var value = $this.val();
	if (value && value.length >= maxlength) {
		$this.val(value.substr(0, maxlength));
	}

	//return (((ev.which > 47) && (ev.which < 58)) || (ev.which == 13));
});
</script>


<?= $this->endSection(); ?>