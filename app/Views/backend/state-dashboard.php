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
</style>
<?php
// $session = session();
// $role_id = $session->get('role_id');
// $userId = $session->get('user_id');
// $stateId = $session->get('state_id');

?>
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-lg-12" >
			<form>
				<div class="row">
					
					<div class="col-sm-5">
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
					<div class="col-sm-5">
						<div class="form-group">
							<select class="form-control" name="plant_status" id="plant_status" >
								<option value="">Select Status of the Plant</option>
								<option value="" selected >All</option>
								<option value="22" <?php if(@$_REQUEST['plant_status']==22){ echo "selected"; } ?> >Yet to start construction</option>
								<option value="23" <?php if(@$_REQUEST['plant_status']==23){ echo "selected"; } ?> >Under Construction</option>
								<option value="290" <?php if(@$_REQUEST['plant_status']==290){ echo "selected"; } ?> >Completed</option>
								<option value="24" <?php if(@$_REQUEST['plant_status']==24){ echo "selected"; } ?> >Functional</option>
								
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
			<h4 class="htitle">Biogas (Functional)</h4>
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
			<h4 class="htitle">CBG/ Bio CNG (Functional)</h4>
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
	

<?= $this->endSection(); ?>




<?=$this->section('script');?>
<!--
<script src="<?=base_url()?>assets/highcharts/highmaps.js"></script>
<script src="<?=base_url()?>assets/highcharts/exporting.js"></script>
<script src="<?=base_url()?>assets/highcharts/offline-exporting.js"></script>
<script src="<?=base_url()?>assets/highcharts/accessibility.js"></script>
<script src="<?=base_url()?>assets/js/sscharts.js"></script>
-->
<?= $this->endSection(); ?>