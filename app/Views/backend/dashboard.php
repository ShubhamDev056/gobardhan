<?= $this->extend('layouts/layout'); ?>

<?= $this->section('breadcrum'); ?>
<div class="container">
	<div class="page-banner row align-items-center position-relative">

		<!-- Page Title -->
		<div class="col-lg-6 col-12">
			<h1 class="page-title">Welcome
				<?php echo $_SESSION['name']; ?>
			</h1>
		</div>

		<!-- Page Breadcrumb -->
		<div class="col-lg-6 col-12">
			<ul class="page-breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Profile</li>
			</ul>
		</div>

	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<style>
.small-box {
    border-radius: 0.25rem;
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    display: block;
    margin-bottom: 20px;
    position: relative;
	min-height: 100px;
}
.bg-info {
    background-color: #17a2b8!important;
}
.small-box>.inner {
    padding: 10px;
	padding-bottom: 0px;
}
.bg-info, .bg-info>a {
    color: #fff!important;
}

.small-box .icon {
    color: rgba(0,0,0,.15);
    z-index: 0;
}
.small-box>.small-box-footer {
    background-color: rgba(0,0,0,.1);
    color: rgba(255,255,255,.8);
    display: block;
    padding: 3px 0;
    position: relative;
    text-align: center;
    text-decoration: none;
    z-index: 10;
}
.small-box h3 {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0 0 10px;
    padding: 0;
    white-space: nowrap;
	color:white;
}
.small-box>.inner>p {
    color:white;
	font-size: 18px;
}


.icon>i.fa, .small-box .icon>i.fab, .small-box .icon>i.fad, .small-box .icon>i.fal, .small-box .icon>i.far, .small-box .icon>i.fas, .small-box .icon>i.ion {
    font-size: 70px;
    top: 20px;
}
.small-box .icon>i {
    font-size: 50px;
    position: absolute;
    right: 15px;
    top: 15px;
    transition: -webkit-transform .3s linear;
    transition: transform .3s linear;
    transition: transform .3s linear,-webkit-transform .3s linear;
}
.small-box:hover .icon>i, .small-box:hover .icon>i.fa, .small-box:hover .icon>i.fab, .small-box:hover .icon>i.fad, .small-box:hover .icon>i.fal, .small-box:hover .icon>i.far, .small-box:hover .icon>i.fas, .small-box:hover .icon>i.ion {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}


.card-header{
	background-color: #17a2b8;
	color: white;
	font-weight: bold;
	font-size: 15px;
}

.card-body{
	border: 1px solid lightblue;
}

.icon:before {
    content: '';
}





.cssmall-box {
    border-radius: 0.25rem;
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    display: block;
    margin-bottom: 20px;
    position: relative;
    min-height: 141px;
}

.cinner{
	padding: 4px 0px 0px 4px;
}

.cssmall-box>.cinner>p {
    color: black;
    font-size: 16px;
    margin-bottom: 0px;
    font-weight: 500;
    background-color: lightblue;
    padding-left: 2px;
    line-height: 20px;
    min-height: 55px;
    border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
}
.cssmall-box h4 {
    font-weight: 700;
    margin: 0 0 10px;
    padding: 0;
    white-space: nowrap;
    color: white;
}
.capacity-unit{
	font-size: 15px;
    color: #fff;
    font-weight: bold;
}
.cbox1{
	background-color: #28a745;
}

.cbox2{
	background-color: #bd982b;
}
.htitle{
	margin-bottom: 5px;
}
.bg-warning1{
	background-color: #bd982b;
}



#sspre-load {
  /*background-color: rgb(255 255 255 / 95%); */
  background: rgba(0,0,0,.64);
  height: 100%;
  width: 100%;
  position: fixed;
  margin-top: 0px;
  top: 0px;
  z-index: 9999;
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
<?php
// $session = session();
// $role_id = $session->get('role_id');
// $userId = $session->get('user_id');
// $stateId = $session->get('state_id');

?>

<div id="sspre-load" style="display: none;">
   <div id="ssloader" class="ssloader">
	   <div class="ssloader-container">
		   <div class="ssloader-icon"><div>Loading...</div></div>
	   </div>
   </div>              
</div>

<div class="container mt-5">
	<?php if(session()->get('role_id')==1){ ?>
	<a href="javascript:void(0)" id="downloadRawData">Download raw data <i class="fa fa-download"></i> </a>
	<?php } ?>
	<div class="row justify-content-center">
		<div class="col-lg-12" >
			<form>
				<div class="row">
					<?php 
					$slogin="4";
					if(session()->get('role_id')==1 || session()->get('role_id')==4){ $slogin="3"; ?> 
					<div class="col-sm-3">
						<div class="form-group">
							<select class="form-control" name="state" id="state"  >
								<option value="">Select State </option>
								<?php
									foreach($states as $state){ ?>
										<option value="<?=$state['state_code'];?>" <?php if(@$_REQUEST['state']==$state['state_code']){ echo "selected"; } ?> ><?=$state['state_name'];?></option>
									<?php	
									}
								?>
							</select>
						</div>
					</div>
					<?php } ?>
					<div class="col-sm-<?=$slogin?>">
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
					
					<div class="col-sm-4">
						<div class="form-group">
							<select class="form-control" name="plant_status" id="plant_status" >
								<option value="">Select Status of the Plant</option>
								<option value="" selected >All</option>
								<option value="22" <?php if(@$_REQUEST['plant_status']==22){ echo "selected"; } ?> >Yet to start construction</option>
								<option value="23" <?php if(@$_REQUEST['plant_status']==23){ echo "selected"; } ?> >Under Construction</option>
								<option value="290" <?php if(@$_REQUEST['plant_status']==290){ echo "selected"; } ?> >Completed</option>
								<option value="24" <?php if(@$_REQUEST['plant_status']==24){ echo "selected"; } ?> >Functional</option>
								<option value="292" <?php if(@$_REQUEST['plant_status']==292){ echo "selected"; } ?> >Temporary Nonfunctional</option>
								<option value="293" <?php if(@$_REQUEST['plant_status']==293){ echo "selected"; } ?> >Defunct</option>
								
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<button class="btn btn-success form-control">Search</button>
					</div>
				</div>
			</form>
		</div>
		
		<div class="col-lg-3 col-6">
			<div class="small-box bg-info">
				<div class="inner">
					<h3><?=$org['totOrg'];?></h3>
					<p>Organization</p>
				</div>
				<div class="icon">
					<i class="fa fa-building-o"></i>
				</div>
				
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-success">
				<div class="inner">
					<h3><?=$totBiogas['totBiogasProjects'];?></h3>
					<p>Biogas</p>
				</div>
				<div class="icon">
					<i class="fa fa-check-square-o"></i>
				</div>
				
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-warning1">
				<div class="inner">
					<h3><?=$totCBG['totCBGProjects'];?></h3>
					<p>CBG/ Bio CNG </p>
				</div>
				<div class="icon">
					<i class="fa fa-clock-o"></i>
				</div>
				
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-danger">
				<div class="inner">
					<h3><?=$totBiogas['totBiogasProjects']+$totCBG['totCBGProjects'];?></h3>
					<p>Projects</p>
				</div>
				<div class="icon">
					<i class="fa fa-cubes"></i>
				</div>
				
			</div>
		</div>
	</div>
	
	<div class="row justify-content-center">
		
		<div class="col-lg-22 col-12">
			<h4 class="htitle">Biogas</h4>
		</div>
		<div class="col-lg-2 col-6">
			<div class="cssmall-box cbox1">
				<div class="cinner">
					<h4><?=round($capacities['gas_production_capacity'],2);?> </h4>
					<span class="capacity-unit"> m³/day </span>
					<p>Gas Production Capacity</p>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-6">
			<div class="cssmall-box cbox1">
				<div class="cinner">
					<h4><?=round($capacities['solid_feedstock_capacity'],2);?>  </h4>
					<span class="capacity-unit">Kg/day</span>
					<p>Solid Feedstock Capacity </p>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-6">
			<div class="cssmall-box cbox1">
				<div class="cinner">
					<h4><?=round($capacities['liquid_feedstock_capacity'],2);?> </h4>
					<span class="capacity-unit">Liters/day</span>
					<p>Liquid Feedstock Capacity</p>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-6">
			<div class="cssmall-box cbox1">
				<div class="cinner">
					<h4><?=round($capacities['bio_slurry_output'],2);?> </h4>
					<span class="capacity-unit">Liters/day</span>
					<p>Bio-slurry output </p>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-6">
			<div class="cssmall-box cbox1">
				<div class="cinner">
					<h4><?=round($capacities['FOM_output'],2);?> </h4>
					<span class="capacity-unit">Kg/day</span>
					<p>FOM output <br><br> </p>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-6">
			<div class="cssmall-box cbox1">
				<div class="cinner">
					<h4><?=round($capacities['LFOM_output'],2);?> </h4>
					<span class="capacity-unit">Liters/day</span>
					<p>LFOM output <br><br> </p>
				</div>
			</div>
		</div>
		
	</div>
	
	<div class="row justify-content-center">
		<div class="col-lg-22 col-12">
			<h4 class="htitle">CBG/ Bio CNG</h4>
		</div>
		<div class="col-lg-2 col-6">
			<div class="cssmall-box cbox2">
				<div class="cinner">
					<h4><?=round($capacitiescbg['gas_production_capacity'],2);?> </h4>
					<span class="capacity-unit">Tons/day</span>
					<p>Gas Production Capacity </p>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-6">
			<div class="cssmall-box cbox2">
				<div class="cinner">
					<h4><?=round($capacitiescbg['solid_feedstock_capacity'],2);?>  </h4>
					<span class="capacity-unit">Tons/day</span>
					<p>Solid Feedstock Capacity</p>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-6">
			<div class="cssmall-box cbox2">
				<div class="cinner">
					<h4><?=round($capacitiescbg['liquid_feedstock_capacity'],2);?> </h4>
					<span class="capacity-unit">KLD</span>
					<p>Liquid Feedstock Capacity</p>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-6">
			<div class="cssmall-box cbox2">
				<div class="cinner">
					<h4><?=round($capacitiescbg['bio_slurry_output'],2);?> </h4>
					<span class="capacity-unit">KLD</span>
					<p>Bio-slurry output</p>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-6">
			<div class="cssmall-box cbox2">
				<div class="cinner">
					<h4><?=round($capacitiescbg['FOM_output'],2);?> </h4>
					<span class="capacity-unit">Tons/day</span>
					<p>FOM output  <br><br> </p>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-6">
			<div class="cssmall-box cbox2">
				<div class="cinner">
					<h4><?=round($capacitiescbg['LFOM_output'],2);?> </h4>
					<span class="capacity-unit">KLD</span>
					<p>LFOM output  <br><br> </p>
				</div>
			</div>
		</div>
		
	</div>
	
	
	<div class="row justify-content-center">
		
		<div class="col-lg-4 col-4">
			<div class="card">
				<div class="card-header">Organization Wise Projects</div>
				<div class="card-body">
					<div id="typeWiseEntity"></div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-4 col-4">
			<div class="card">
				<div class="card-header">Location Wise Projects</div>
				<div class="card-body">
					<div id="LocationWiseProject"></div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-4 col-4">
			<div class="card">
				<div class="card-header">Functionality of Projects</div>
				<div class="card-body">
					<div id="statusWisePlant"></div>
				</div>
			</div>
		</div>
		
	</div>
	
	<div class="row justify-content-center mt-4">
		
		<div class="col-lg-4 col-4 mb-4">
			<div class="card">
				<div class="card-header">Type of Biogas Projects</div>
				<div class="card-body">
					<div id="entityWiseProject"></div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-8 col-8 mb-4">
			<div class="card">
				<div class="card-header">Ministry Wise Benefits</div>
				<div class="card-body">
					<div id="ministrywise"></div>
				</div>
			</div>
		</div>
		
	</div>
</div>

<?= $this->endSection(); ?>




<?=$this->section('script');?>

<script src="<?=base_url()?>assets/highcharts/highmaps.js"></script>
<script src="<?=base_url()?>assets/highcharts/exporting.js"></script>
<script src="<?=base_url()?>assets/highcharts/offline-exporting.js"></script>
<script src="<?=base_url()?>assets/highcharts/accessibility.js"></script>
<script src="<?=base_url()?>assets/js/sscharts.js"></script>

<?php
///Type Wise Entity
$orgTypes = [''=>'','1'=>'Government including Co-operatives','2'=>'Private'];
$orgdatas=[];
foreach($orgWiseProjects as $orgWiseProject){
	$entity_type = $orgWiseProject['entity_type'];
	$totOrg = $orgWiseProject['totOrg'];
	
	$orgdata['name'] = $orgTypes[$entity_type];
	$orgdata['y'] = (int)$totOrg;
	$orgdatas[] = $orgdata;
}
$orgSeriesData = json_encode($orgdatas);


///Status Wise Projects
$plntStatus = [''=>'','22'=>'Yet to start construction','23'=>'Under Construction','24'=>'Functional','290'=>'Completed','292'=>'Temporary Nonfunctional','293'=>'Defunct'];
$pstatusdatas=[];
foreach($statusWiseProjects as $statusWiseProject){
	$plant_status_id = $statusWiseProject['plant_status_id'];
	$totProjects = $statusWiseProject['totProjects'];
	
	$pstatusdata['name'] = $plntStatus[$plant_status_id];
	$pstatusdata['y'] = (int)$totProjects;
	$pstatusdatas[] = $pstatusdata;
}
$pStatusSeriesDatas = json_encode($pstatusdatas);

///Location Wise Projects
$plntLocations = [''=>'','82'=>'Urban','83'=>'Rural','224'=>'Industrial Area'];
$pLocationsdatas=[];
foreach($locationWiseProjects as $locationWiseProject){
	$plant_location_id = $locationWiseProject['plant_location_id'];
	$totProjects = $locationWiseProject['totProjects'];
	
	$pLocationdata['name'] = $plntLocations[$plant_location_id];
	$pLocationdata['y'] = (int)$totProjects;
	$pLocationsdatas[] = $pLocationdata;
}
$pLocationSeriesDatas = json_encode($pLocationsdatas);



///Biogas Type Wise Projects
$biogasProjectTypes = [''=>'','0'=>'','19'=>'Community-based','20'=>'Cluster based','218'=>'Commercial'];
$pBiogasTypedatas=[];
foreach($biogasTypeWiseProjects as $biogasTypeWiseProject){
	$plant_type_id = $biogasTypeWiseProject['plant_type_id'];
	$totProjects = $biogasTypeWiseProject['totProjects'];
	
	$pBiogasTypedata['name'] = $biogasProjectTypes[$plant_type_id];
	$pBiogasTypedata['y'] = (int)$totProjects;
	$pBiogasTypedatas[] = $pBiogasTypedata;
}
$pBiogasTypeSeriesDatas = json_encode($pBiogasTypedatas);
?>


<script>
	$("#downloadRawData").on("click", function(){
		$.ajax({
            url:"<?=base_url()?>excel-export",
            type:"get",
			beforeSend: function() {
			  $('#sspre-load').show();
			},
            data:{},
            success:function(res){
				//console.log(res);
				let resps = JSON.parse(res);
				var link=document.createElement('a');
				link.href=resps.path;
				//link.download="Dossier_" + new Date() + ".pdf";
				link.click();
				$('#sspre-load').hide('slow');
			
            }
        });
	})


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
	$(document).ready(function(){
		
		$(document).sschart({
			chartId:'typeWiseEntity',
		    chartType:'pie',
		    colors:['#17a2b8','#52a129'],
		    dataLabelsEnabled:false,
		    legend:true,
		    seriesData:<?=$orgSeriesData;?>,
		});
		
		
		$(document).sschart({
			chartId:'statusWisePlant',
		    chartType:'pie',
		    colors:['#17a2b8','#52a129','#6391a3','#273b42'],
		    dataLabelsEnabled:false,
		    legend:true,
		    seriesData:<?=$pStatusSeriesDatas;?>,
		});
		
		$(document).sschart({
			chartId:'LocationWiseProject',
		    chartType:'pie',
		    colors:['#17a2b8','#52a129','#6391a3','#273b42'],
		    dataLabelsEnabled:false,
		    legend:true,
		    seriesData:<?=$pLocationSeriesDatas;?>,
		});
		
		
		$(document).sschart({
			chartId:'entityWiseProject',
		    chartType:'column',
		    colors:['#6c50fb'],
			yAxisTitle:'No. of Projects',
		    dataLabelsEnabled:false,
		    legend:false,
		    seriesData:<?=$pBiogasTypeSeriesDatas;?>,
		});
		
	});
	
</script>


<script type="text/javascript">
	Highcharts.chart('ministrywise', {
		colors:  ['#906125','#4e70f8','#bd982b'],
		chart: {
			//type: 'column' //spline, line, bar, column, area
			type: 'column', 
		},
		title: {
			text: ''
		},
		subtitle: {
			text: ''
		},
		xAxis: {
			categories: ['AHIDF','DA&FW','MNRE','MoHUA','SATAT','MDA','DDWS','Others'],
			crosshair: true,
			title: {
				text: 'Ministries'
			},
			labels: {
					rotation: -45,
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Number of plants'
			}
		},
		
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
			'<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},

		plotOptions: {
			column: {
			  stacking: 'normal', //normal, percent
			  dataLabels: {
				enabled: true
			  }
			}
		  },
		series: [ <?=$seriesData;?>
			// { name: 'Applied',  data: [ 15,17,32,21,30,43,0,0] },
			// { name: 'Availed',  data: [ 12,17,7,17,12,17,15,5] },
			// { name: 'Required',  data: [ 21,30,43,15,27,30,0,0] }
		]		
	});
</script>
<?= $this->endSection(); ?>