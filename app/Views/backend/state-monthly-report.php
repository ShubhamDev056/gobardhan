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
	text-align: center;
}
.table thead th {
    vertical-align: middle;
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
			State Wise Monthly Report
			<a href="javascript:" style="float:right;" onclick="tableToExcel('state-wise-monthly-report', 'state-wise-monthly-report')"> <i class="fa fa-download float-end"></i> </a>
			
			</h3>
		</div>
		<div class="col-lg-12" >
			<form>
				<div class="row">
					<?php /* ?>
					<div class="col-sm-4">
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
					
					<div class="col-sm-8">
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
					<?php */ ?>
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
				<table class="table table-bordered" id="state-wise-monthly-report">
					<thead>
						<tr class="table-header">
							<th rowspan="2">#SN</th>
							<th rowspan="2">State</th>
							<th colspan="3">Biogas Plants DDWS Till Date <?=date('M-Y',strtotime(date($reporting_month)." -1 month"));?></th>
							<th colspan="3">Reporting <?=date('M-Y',strtotime($reporting_month));?></th>
						</tr>
						<tr class="table-header">
							<th>Temporary Nonfunctional</th>
							<th>Defunct</th>
							<th>Functional</th>
							<th>Temporary Nonfunctional</th>
							<th>Defunct</th>
							<th>Functional</th>
						</tr>
					</thead>
					<tbody>
					<?php $sn=1;
						foreach($allstates as $allstate){ 
							$reporting = $allstatesReportings[$allstate['state_code']];
						?>
							<tr>
								<td class="text-center"><?=$sn++;?></td>
								<td><?=$allstate['state_name'];?></td>
								<td class="text-center nof" ><?=$allstate['nonfunctional'];?></td>
								<td class="text-center dfct" ><?=$allstate['defunct'];?></td>
								<td class="text-center f" ><?=$allstate['functional'];?></td>
								<td class="text-center rnof" ><?=$reporting['nonfunctional'];?></td>
								<td class="text-center rdfct" ><?=$reporting['defunct'];?></td>
								<td class="text-center rf" ><?=$reporting['functional'];?></td>
							</tr>
						<?php	
						}
					?>
					</tbody>
					
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


<?= $this->endSection(); ?>




<?=$this->section('script');?>
 
<script src="<?=base_url();?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/plugins.js"></script>
<script src="<?=base_url();?>assets/js/main.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap-multiselect.js"></script>

<script>

/* $("#state").on("change", function(){
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
}); */

$('#state-wise-monthly-report').each(function () {
	var totalNof = totaldfct = totalf = rtotalNof= rtotaldfct = rtotalf = 0;
	$(this).find('tbody tr').each(function () {
		totalNof+=parseFloat($(this).find("td:nth-child(3)").text());
		totaldfct += parseFloat($(this).find("td:nth-child(4)").text());
		totalf += parseFloat($(this).find("td:nth-child(5)").text());
		rtotalNof += parseFloat($(this).find("td:nth-child(6)").text());
		rtotaldfct += parseFloat($(this).find("td:nth-child(7)").text());
		rtotalf += parseFloat($(this).find("td:nth-child(8)").text());
		
	});
	var totalRows = '<tr><th colspan="2" class="text-center">Total</th> <th class="text-center" >'+totalNof+'</th> <th class="text-center">'+totaldfct+'</th> <th class="text-center">'+totalf+'</th> <th class="text-center" >'+rtotalNof+'</th> <th class="text-center">'+rtotaldfct+'</th> <th class="text-center">'+rtotalf+'</th>  </tr>';
	$("#state-wise-monthly-report").append(totalRows);
	
});


</script>


<script type="text/javascript">
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>

<?= $this->endSection(); ?>