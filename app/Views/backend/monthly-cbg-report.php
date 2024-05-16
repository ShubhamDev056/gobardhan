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
<?php
$month_ini = new DateTime("first day of last month"); 
?>

<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">
				Monthly Report for the Functionality Status of Biogas Plants - <?=$_SESSION['name'];?>
			</h3>
		</div>
		<div class="col-lg-12" >
			<form>
				<div class="row">
					
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
				<table class="table table-bordered">
					<tr class="table-header">
						<th>#SN</th>
						<th>District</th>
						<th>Plant Name</th>
						<th>Current Status</th> 
						<th>Doc</th> 
						<th>Reporting Date</th> 
						<td>Action</td>
					</tr>
					
					<?php 
						$cstatus = ['24'=>'Functional','292'=>'Temporary Nonfunctional','293'=>'Defunct',''=>'','0'=>'',];
						foreach($reports as $key=>$report){ ?>
							<tr>
								<td><?=$key+1;?> </td>
								<td><?=$report['district_name'];?></td>
								<td><?=$report['project_name'];?></td>
								<td><?=$cstatus[$report['current_status']];?></td> 
								<td><?=$report['fuctional_doc'];?></td> 
								<td><?=$report['reporting_date'];?></td>
								<td>
									<a href="javascript:" class="viewReport" data-id="<?=$report['monthly_monitoring_id'];?>"  ><i class="fa fa-eye badge bg-primary text-white"> </i></a>
									<?php if($_SESSION['role']=="organization" && empty($report['updated_at'])){ ?>
										<a href="<?=base_url()?>monthly-update-cbg-report/<?=$report['monthly_monitoring_id'];?>" class="editReport"  ><i class="fa fa-pencil badge bg-primary text-white"> </i> </a>
									<?php
									} ?>
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
					<div class="col-sm-4">
						<ul class="list-group ">
							<li class="list-group-item bg-success text-white"><strong>Basic Details</strong> </li>
							<li class="list-group-item"><strong>Reporting Month :</strong> <span id="rmonth"></span> </li>
							<li class="list-group-item"><strong>State :</strong> <span id="pstate"></span> </li>
							<li class="list-group-item"><strong>District :</strong> <span id="pdistrict"></span> </li>
							<li class="list-group-item"><strong>Project Name :</strong> <span id="pname" ></span> </li>
							 
						</ul>
					</div>
					<div class="col-sm-8">
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
			if(res.current_status=="24"){ 
				var abc = '<li class="list-group-item bg-success text-white "><strong> Functional</strong> </li>\
				<li class="list-group-item"><strong>Updated status :</strong> <span>Functional</span> </li>\
				<li class="list-group-item"><strong>No. of functional days :</strong> <span>'+ res.nofunctional_days +'</span> </li>\
				<li class="list-group-item"><strong>Total feedstock utilized (in Tons) :</strong> <span>'+ res.feedstock +'</span> </li>\
				<li class="list-group-item"><strong>Total CBG generated (in Tons) :</strong> <span>'+ res.biogas_generation +'</span> </li>\
				<li class="list-group-item"><strong>Total bio slurry generated (in KLD) :</strong> <span>'+ res.bioslurry_generation +'</span> </li>';
				
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


</script>


<?= $this->endSection(); ?>