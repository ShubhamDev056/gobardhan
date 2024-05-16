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

</style>

<div id="sspre-load" style="display: none;">
	<div id="ssloader" class="ssloader">
		<div class="ssloader-container">
		   <div class="ssloader-icon"><div>Generate Certificate</div></div>
		</div>
	</div>              
</div>

<?php
$month_ini = new DateTime("first day of last month"); 
?>

<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">
				Monthly Report for the Functionality Status of Biogas Plants
				<a href="<?=base_url();?>monthly-update-report-export?<?=$_SERVER['QUERY_STRING'];?>" style="float:right;"> <i class="fa fa-download float-end"></i> </a>
			</h3>
		</div>
		<div class="col-lg-12" >
			<form>
				<div class="row">
					<div class="col-sm-2">
						<div class="form-group">
							<select class="form-control" name="state" id="state" >
								<option value="" selected hidden >State</option>
								<option value="" >All</option>
								<?php
									foreach($states as $state){ ?>
										<option value="<?=$state['state_code'];?>" <?php if(@$_REQUEST['state']==$state['state_code']){ echo "selected"; } ?> ><?=$state['state_name'];?></option>
									<?php	
									}
								?>
							</select>
						</div>
					</div>
					
					<div class="col-sm-2">
						<div class="form-group">
							<select class="form-control" name="district" id="district" >
								<option value="" selected hidden >District</option>
								<option value="" >All</option>
								<?php
									foreach($districts as $district){ ?>
										<option value="<?=$district['district_code'];?>" <?php if(@$_REQUEST['district']==$district['district_code']){ echo "selected"; } ?> ><?=$district['district_name'];?></option>
									<?php	
									}
								?>
							</select>
						</div>
					</div>
					
					
					<div class="col-sm-4">
						<div class="form-group">
							<select class="form-control" name="plant_status" >
								<option value="" selected hidden >Select Status</option>
								<option value="" >All</option>
								<option value="24" >Functional</option>
								<option value="292" >Temporary Nonfunctional</option>
								<option value="293" >Defunct</option>
							</select>
						</div>
					</div>
					
					<div class="col-sm-3">
						<div class="form-group">
							<input type="month" class="form-control" max="<?=$month_ini->format('Y-m')?>" name="reporting_month" value="<?=$reporting_month;?>" title="Reporting Month" />
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
				<table class="table table-bordered fixedTable">
					<thead>
						<tr class="table-header">
							<th>#SN</th>
							<th>State</th>
							<th>District</th>
							<th>Plant Name</th>
							<th>Production Capacity</th>
							<th>Previous Status</th>
							<th>Current Status</th>
							<th width="10%">Reporting Date</th>
							<th>No. of Days</th>
							<th>Avg. Feedstock</th>
							<th>Avg. Biogas</th>
							<th>Avg. Slurry</th>
							<th>Doc</th> 
							
							<td>Action</td>
						</tr>
					</thead>
					<?php 
						$cstatus = ['24'=>'Functional','292'=>'Temporary Nonfunctional','293'=>'Defunct',''=>'','0'=>'',];
						foreach($reports as $key=>$report){ 
							$avgFeedstock=$avgBiogas_generation=$avgBioslurry_generation=0;
							if($report['nofunctional_days']>0 && $report['current_status']==24){
								if($report['feedstock']>0){
									$avgFeedstock = $report['feedstock']/$report['nofunctional_days'];
								}
								
								if($report['biogas_generation']>0){
									$avgBiogas_generation = $report['biogas_generation']/$report['nofunctional_days'];
								}
								if($report['bioslurry_generation']>0){
									$avgBioslurry_generation = $report['bioslurry_generation']/$report['nofunctional_days'];
								}
								
							}
						
						?>
							<tr>
								<td><?=$key+1;?></td>
								<td><?=$report['state_name'];?></td>
								<td><?=$report['district_name'];?></td>
								<td><?=$report['project_name'];?></td>
								<td><?=$report['gas_production_capacity'];?> m³/day</td>
								<td><?=$cstatus[$report['pre_status']];?></td>
								<td><?=$cstatus[$report['current_status']];?></td>
								<td style="white-space: nowrap;"><?=date('d-m-Y', strtotime($report['reporting_date']));?></td>
								<td><?=$report['nofunctional_days'];?></td>
								<td><?=round($avgFeedstock,2);?></td>
								<td><?=round($avgBiogas_generation,2);?></td>
								<td><?=round($avgBioslurry_generation,2);?></td>
								<td>
									<?php 
										$dec_doc_path = $_SERVER['DOCUMENT_ROOT'].'/fuctional_docs/'.$report['fuctional_doc'];
										if(file_exists($dec_doc_path) && is_file($dec_doc_path)){ ?>
											<a href="<?=base_url();?>fuctional_docs/<?=$report['fuctional_doc'];?>" target="_blank">
												<i class="fa fa-file-pdf-o"></i>
											</a>
									<?php } ?>
								</td> 
								
								<td>
									<a href="javascript:" class="viewReport" data-id="<?=$report['monthly_monitoring_id'];?>"  ><i class="fa fa-eye badge bg-primary text-white"> </i></a>
									
									<?php 
										if(file_exists($dec_doc_path)  && is_file($dec_doc_path) && $report['verify_doc']=="0"){ ?>
											<a href="javascript:" data-id="<?=$report['monthly_monitoring_id'];?>" class="badge badge-success text-white p-1 aprv">Approve</a>
									<?php } ?>
									
									<?php
										if(file_exists($dec_doc_path)  && is_file($dec_doc_path) && $report['verify_doc']=="1"){ ?>
										<span class="badge badge-primary p-1">Approved</span>
									<?php } ?>
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
					<?php //if($pager!=""){ echo $pager->links(); } ?>
				</div>
			</div>
		</div>
		
	</div>
	
</div>

<div class="modal fade" id="pmrdetails" style="z-index: 1000000;">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Report Details</h4>
				<button type="button" class="btn-close" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" >
				
				<div class="row">
					<div class="col-sm-5">
						<ul class="list-group ">
							<li class="list-group-item bg-success text-white"><strong>Basic Details</strong> </li>
							<li class="list-group-item"><strong>Reporting Month :</strong> <span id="rmonth"></span> </li>
							<li class="list-group-item"><strong>State :</strong> <span id="pstate"></span> </li>
							<li class="list-group-item"><strong>District :</strong> <span id="pdistrict"></span> </li>
							<li class="list-group-item"><strong>Project Name :</strong> <span id="pname" ></span> </li>
							<li class="list-group-item"><strong>Designed Gas Production Capacity :</strong> <span id="gas_production_capacity" ></span> </li>
							<li class="list-group-item"><strong>Designed Solid Feedstock Capacity :</strong> <span id="solid_feedstock_capacity" ></span> </li>
							<li class="list-group-item"><strong>Designed bio-slurry output :</strong> <span id="bio_slurry_output" ></span> </li>
							 
						</ul>
					</div>
					<div class="col-sm-7">
						<ul class="list-group mminfo">
							
						</ul>
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
 
$(".btn-close").on("click",function(){
	$("#pmrdetails").modal('hide');
	$("#pmrdetailsedit").modal('hide');
});
//var statuss = ['24':'Functional', '292':'Temporary Nonfunctional','s293':'Defunct'];
$(".viewReport").on("click", function(){
	$("#pmrdetails").modal('show');
	var prid = $(this).data("id");
	var rurl = "<?=base_url();?>monthly-report-details/"+prid;
	
	//console.log(statuss.24);
	$.ajax({
		url:rurl,
		dataType:'json',
		success:function(res){
			console.log(res);
			$("#rmonth").text(res.reporting_month);
			$("#pstate").text(res.state_name);
			$("#pdistrict").text(res.district_name);
			$("#pname").text(res.project_name);
			$("#gas_production_capacity").text(res.gas_production_capacity);
			$("#solid_feedstock_capacity").text(res.solid_feedstock_capacity);
			$("#bio_slurry_output").text(res.bio_slurry_output);
			if(res.current_status=="24"){ 
				var abc = '<li class="list-group-item bg-success text-white "><strong> Functional</strong> </li>\
				<li class="list-group-item"><strong>Updated status :</strong> <span>Functional</span> </li>\
				<li class="list-group-item"><strong>No. of functional days :</strong> <span>'+ res.nofunctional_days +'</span> </li>\
				<li class="list-group-item"><strong>Total feedstock utilized (in Kgs) :</strong> <span>'+ res.feedstock +'</span> </li>\
				<li class="list-group-item"><strong>Total biogas generated (in Cum) :</strong> <span>'+ res.biogas_generation +'</span> </li>\
				<li class="list-group-item"><strong>Total bio slurry generated (in L) :</strong> <span>'+ res.bioslurry_generation +'</span> </li>';
				
				if(res.pre_status!="24"){
					abc+='<li class="list-group-item"><strong>Date of functionality :</strong> <span>'+ res.functionality_date +'</span> </li>\
					<li class="list-group-item"><strong>Amount spent to make it functional :</strong> <span>'+ res.functional_amount +'</span> </li>\
					<li class="list-group-item"><strong>Source of funding to make it functional :</strong> <span>'+ res.functional_source +'</span> </li>';
				}
				
			}else{
				if(res.current_status=="292"){
					$("#pcstatus").text('Temporary Nonfunctional');
				}else{
					$("#pcstatus").text('Defunct');
				}
				var abc = '<li class="list-group-item bg-success text-white "><strong> Temporary Nonfunctional/ Defunct</strong> </li>\
						<li class="list-group-item"><strong>Since :</strong> <span>'+ res.defunct_date +'</span> </li>\
						<li class="list-group-item"><strong>Reason :</strong> <span>'+ res.reason +'</span> </li>\
						<li class="list-group-item"><strong>Other Reason :</strong> <span>'+ res.other_reason +'</span> </li>\
						<li class="list-group-item"><strong>Expected date of functionality :</strong> <span>'+ res.functionality_date +'</span> </li>\
						<li class="list-group-item"><strong>Estimated funds required to make it functional (in Lakhs) :</strong> <span>'+ res.functional_amount +'</span> </li>\
						<li class="list-group-item"><strong>Source of funds required to make it functional :</strong> <span>'+ res.functional_source +'</span> </li>';
			}
			
			$(".mminfo").html(abc);
		}
	})
});



$(".aprv").on("click", function(){
	var mmid = $(this).data("id");
	var $this = $(this);
	if(confirm('Are you sure to approve.')){
		if(mmid!=""){
			$.ajax({
				url:"<?=base_url();?>temp-to-functional",
				type:"post",
				dataType:"json",
				data:{mmid:mmid},
				beforeSend: function() {
					$('#sspre-load').show();
				},
				success:function(res){
					console.log(res);
					if(res.status==200){
						$this.html('<span class="badge badge-primary p-1">Approved</span>');
						$('#sspre-load').hide('slow');
					}
				}
			})
		}
	}
});

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
	}else{
		$("#district").html('<option value="">Select District</option>');
	}
});

</script>


<?= $this->endSection(); ?>