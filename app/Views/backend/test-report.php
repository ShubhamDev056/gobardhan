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
.SumoSelect > .CaptionCont > span.placeholder {
    color: #524a4a;
}
</style>
<?php
if(!isset($_REQUEST['ministry']) || empty($_REQUEST['ministry'])){
	$_REQUEST['ministry']=array();
}


?>

<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">
				DDWS Biogas Report Government Orgnizations
				<a href="javascript:" id="exportddwsbiogasreport" style="float:right;"> <i class="fa fa-download float-end"></i> </a>
			</h3>
		</div>
		<div class="col-lg-12" >
			
		</div>
		<div class="col-lg-12 col-12">
		
			
		
			<div class="table-responsive">
				<table class="" id="ddws-report">
					<tr class="table-header">
						<th>#SN</th>
						<th>State</th>
						<th>District</th>
						<th>Block</th>
						<th>GP Name</th>
						<th>Village</th>
						<th>Name of the Plant</th>
						<th>Name of the Entity</th>
						<th>Type of the Entity </th>
						<th>Type of the Plant </th>
						<th>Status of the Plant </th>
						<th>Plant Status Date </th>
						<th>Gas Production Capacity</th>
						<th>Feedstock Capacity</th>
						<th>Bioslurry Production Capacity</th>
						<th>FOM Production Capacity</th>
						<th>LFOM Production Capacity</th>
						<td>Plant Location</td>
						<td>Plant Area</td>
						<td>Land Ownership</td>
						<td>Other Ownership</td>
						<td>Total Capex</td>
					</tr>
					
					<?php
						$per_page=10;
						$entTypes = [''=>'','17'=>'Biogas plant operator','18'=>'Compressed Bio Gas/ Bio CNG plant operator'];
						$entityTypes = [''=>'','0'=>'','1'=>'Government including Co-operatives','2'=>'Private'];
						$plntStatus = [''=>'','22'=>'Yet to start construction','23'=>'Under Construction','24'=>'Functional','290'=>'Completed'];
						$plantlocations = [''=>'','82'=>'Urban','83'=>'Rural','224'=>'Industrial Area'];
						$landownerships = [''=>'','84'=>'On Lease/ agreement','85'=>'Government','86'=>'Government allotted land','87'=>'Own','88'=>'Other (specify)'];
						foreach($ddwsbiogasreports as $key=>$project){ 
							$solidUnit = 'Tons/day';
							$liquidUnit = 'KLD';
							if($project['entity_type_id']=="17"){
								$solidUnit='Kg/day';
								$liquidUnit='Liters/day';
							} 
						?>
							<tr>
								<td><?php if(isset($_GET['page']) && $_GET['page']>1){ echo ($per_page*$_GET['page']-$per_page)+$key+1;}else{ echo $key+1;};?></td>
								<td><?=$project['state_name'];?></td>
								<td><?=$project['district_name'];?></td>
								<td><?=$project['block_name'];?></td>
								<td><?=$project['gp_name'];?></td>
								<td><?=$project['village_name'];?></td>
								<td><?=$project['project_name'];?></td>
								<td><?=ucfirst($project['entity_name']);?></td>
								<td><?=$entityTypes[$project['entity_type']];?></td>
								<td><?=$entTypes[$project['entity_type_id']];?></td>
								<td><?=$plntStatus[$project['plant_status_id']];?></td>
								<td><?=$project['plant_status_date'];?></td>
								<td><?=$project['gas_production_capacity'];?> <?php if($project['entity_type_id']=="17"){ echo "m³/day"; }else{  echo "Tons/day"; } ?>  </td>
								<td><?=$project['solid_feedstock_capacity']?>  <?=$solidUnit;?> </td>
								<td><?=$project['bio_slurry_output'];?> <?=$liquidUnit;?> </td>
								<td><?=$project['FOM_output'];?> <?=$solidUnit;?> </td>
								<td><?=$project['LFOM_output'];?> <?=$liquidUnit;?> </td>
								<td> <?=$plantlocations[$project['plant_location_id']];?> </td>
								<td> <?=$project['plant_area'];?> </td>
								<td> <?=$landownerships[$project['land_ownership_id']];?> </td>
								<td> <?=$project['other_ownership'];?> </td>
								<td> <?=$project['total_capex'];?> </td>
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
$('#exportddwsbiogasreport').click(function() {
  
	var titles = [];
	var data = [];
	const csvContents = [].map.call(document.getElementById('ddws-report').rows,
        tr => [].map.call(tr.cells, td => td.textContent.replace(/,/g, "")).join(',')
    ).join('\n');

    csv_data = csvContents;

	data.forEach(function(item,index){
	td = item[0].children
	for(i=0;i<td.length;i++){
	 
	  csv_data.push(td[i].innerText)
	}

	csv_data.push('\r\n')
	})
	
	var downloadLink = document.createElement("a");
	var blob = new Blob(["\ufeff", csv_data]);
	var url = URL.createObjectURL(blob);
	downloadLink.href = url;
	downloadLink.download = "DDWS-Report.csv";
	document.body.appendChild(downloadLink);
	downloadLink.click();
	document.body.removeChild(downloadLink);
  
});
</script>


<?= $this->endSection(); ?>