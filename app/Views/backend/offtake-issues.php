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
.bg-lightblue{
	background-color: lightblue;
}

.custom-alert{
    position: absolute;
    z-index: 1;
    margin-left: 31%;
    margin-top: -82px;
    min-height: 60px;
    background-color: rgb(76 175 80);
    opacity: 0.8;
    color: white;
}

.ctable th, .ctable td{
	padding-top:3px;
	padding-bottom:3px;
}

</style>


<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">
				Offtake Issues List
				<a href="javascript:" style="float:right;" onclick="tableToExcel('Offtake-Issue-List', 'Offtake-Issue-List')"> <i class="fa fa-download float-end"></i> </a>
			</h3>
		</div>
		<div class="col-lg-12" >
			
			<div class="alert alert-success alert-dismissible custom-alert d-none" id="c-alert">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Success!</strong> Remarks added successfully.
			</div>
		
			<form>
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<select class="form-control" name="ministry_id">
								<option value="" selected hidden >Select State</option>
								<?php 
									foreach($states as $state){ ?>
										<option value="<?=$state['state_code'];?>"><?=$state['state_name'];?></option>
									<?php
									}
								?>
							</select>
						</div>
					</div>
					<!--
					<div class="col-sm-6">
						<div class="form-group">
							<input type="text" name="title" class="form-control" placeholder="Circular Title" value="<?=@$_REQUEST['title'];?>" />
						</div>
					</div>
					-->
					<div class="col-sm-1">
						<button class="btn btn-primary " style="padding:5px;">Search</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-lg-12 col-12">
		
			
		
			<div class="table-responsive">
				<table class="table table-bordered" id="Offtake-Issue-List">
					<tr class="table-header">
						<th>#SN</th>
						<th>State Name</th>
						<th>Plant Name</th>
						<th>OGMC</th>
						<th>Remarks</th>
						<th width="10%">Post Issue</th>
						<th width="12%">Action</th>
					</tr>
					
					<?php $sn=1 ; foreach($offtakeissues as $offtakeissue){ ?>
						<tr>
							<td><?=$sn++;?></td>
							<td><?=$offtakeissue['state_name'];?></td>
							<td><?=$offtakeissue['project_name'];?></td>
							<td>
								<?php 
									echo getNameFromId('satat_ogmc', $offtakeissue['ogmc']);
									
									if($offtakeissue['gail']=="Yes"){
										echo " & GAIL";
									}
									
								?>
							</td>
							<td><?=$offtakeissue['remarks'];?></td>
							<td><?=date('d-m-Y',strtotime($offtakeissue['created_at']));?></td>
							<td>
								<a href="javascript:" class="show-offtake-details" data-id="<?=$offtakeissue['id'];?>" ><i class="fa fa-eye badge bg-primary text-white"> </i></a>
								<?php if($_SESSION['role']=="cbgLogin"){ ?>
									<a href="javascript:" class="add-offtake-remarks" data-id="<?=$offtakeissue['id'];?>" ><i class="fa fa-plus badge bg-primary text-white"> Remarks </i></a>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
					
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


<div class="modal fade" id="offtakedetails" style="z-index: 1000000;">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-lightblue">
				<h4 class="modal-title">Offtake Issue Details</h4>
				<button type="button" class="btn-close" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" >
				
				<div class="row">
					<div class="col-sm-12" id="mdaIssuDetails">
						
					</div>
					
				</div>
				
				
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="offtakeRemarks" style="z-index: 1000000;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-lightblue">
				<h4 class="modal-title">Offtake Issue Remarks</h4>
				<button type="button" class="btn-close" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" >
				
				<div class="row">
					<div class="col-sm-12" >
						
						<div class="form-group">
							<input type="hidden" id="offtakeIssueRemarksId" />
							<textarea class="form-control" rows="5" name="offtakeremarks" id="offtakeremarks" required placeholder="Remarks" ></textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-sm pull-right" id="saveremarks">Submit</button>
						</div>
						
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
$(".show-offtake-details").on("click", function(){
	var offtakeIssueId = $(this).data("id");
	$("#offtakedetails").modal("show");
	getOfftakeDetails(offtakeIssueId);
})
$(".add-offtake-remarks").on("click", function(){
	var offtakeIssueId = $(this).data("id");
	$("#offtakeIssueRemarksId").val(offtakeIssueId);
	$("#offtakeRemarks").modal("show");
})

$(".btn-close").on("click",function(){
	$("#offtakedetails").modal('hide');
	$("#offtakeRemarks").modal('hide');
});

async function getOfftakeDetails(offtakeIssueId) {
	const mdagetUrl = "<?=base_url();?>"+"offtake-issues-details/"+offtakeIssueId;
	const response = await fetch(mdagetUrl);
	const oftkIssue = await response.json();
	
	var issue_logs = oftkIssue.issue_log;
	var gailRemarks=ogmc=ogmcRmk=signedGAIL=signedSATAT=""; 
	if(oftkIssue.gail=="Yes"){
		gailRemarks='<tr><th>GAIL Remarks</th><td>'+oftkIssue.gail_remarks+'</td></tr>';
		signedGAIL='<tr><th>Quantity for which commercial agreement signed under CBG-CGD synchronization scheme (in TPD) </th><td>'+oftkIssue.com_agre_signed_cbg_cdg+'</td></tr>';
	}
	if(oftkIssue.satat_scheme=="Yes"){
		ogmc='<tr><th>OGMC</th><td>'+oftkIssue.ogmc+'</td></tr>';
		ogmcRmk='<tr><th>CBG OGMC '+oftkIssue.ogmc+' Remarks</th><td>'+oftkIssue.cbg_ogmc_remarks+'</td></tr>';
		signedSATAT='<tr><th>Quantity for which commercial agreement signed with OGMCs for CBG offtake (in TPD) </th><td>'+oftkIssue.com_agre_signed+'</td></tr>';
	}
	var mdaIssueHtml = '<table class="table table-bordered ctable">\
							<tr><th width="65%" >State Name</th><td>'+oftkIssue.state_name+'</td></tr>\
							<tr><th>Project Name</th><td>'+oftkIssue.project_name+'</td></tr>\
							<tr><th>MoU Signed Under SATAT Scheme With OGMCs</th><td>'+oftkIssue.satat_scheme+'</td></tr> '+ogmc+' \
							<tr><th>MoU Signed Under CBG-CGD Synchronization Scheme (GAIL)</th><td>'+oftkIssue.gail+'</td> </tr>\
							<tr><th>Designed CBG production Capacity (in TPD) </th><td>'+oftkIssue.prod_capacity+'</td></tr>\
							'+signedSATAT+' '+signedGAIL+' \
							<tr><th>Average CBG production in last 30 days (in Tons)</th><td>'+oftkIssue.avg_actual_prod+'</td></tr>\
							<tr><th>Actual CBG offtake by OGMCs (SATAT) in last 30 days (in Tons)</th><td>'+oftkIssue.actual_offtake+'</td></tr>\
							<tr><th>CBG supplied under CBG-CGD Synchronization scheme in last 30 days (Tons)</th><td>'+oftkIssue.cbg_supplied_sync+'</td></tr>\
							<tr><th>Other sale (Industrial/Own RO) in last 30 days (Tons)</th><td>'+oftkIssue.other_sale+'</td></tr>\
							<tr><th>Own Consumption in last 30 days (Tons)</th><td>'+oftkIssue.internal_consumption+'</td></tr>\
							<tr><th>Flaring/ wastages in last 30 days (Tons)</th><td>'+oftkIssue.flaring_wastage+'</td></tr>\
							<tr><th>Operator Remarks</th><td>'+oftkIssue.remarks+'</td></tr>\
							 '+ogmcRmk+' '+gailRemarks+'\
							<tr><th>Issue Post Date </th><td>'+oftkIssue.created_at+'</td></tr>\
						</table>';
		$("#mdaIssuDetails").html(mdaIssueHtml);
		
		var logHtml = '<h5>Remarks Log</h5><table class="table table-bordered ctable"> <tr> <th>Remarks Date</th> <th>Operator Remarks</th> <th>'+oftkIssue.ogmc+' Remarks</th> <th>GAIL Remarks</th> </tr>';
		
		$.each(issue_logs,function(k,log){
			//console.log(log);
			logHtml+='<tr><td>'+log.created_at+'</td><td>'+log.remarks+'</td><td>'+log.cbg_ogmc_remarks+'</td><td>'+log.gail_remarks+'</td></tr>';
		})
		logHtml+='</table>';
		$("#mdaIssuDetails").append(logHtml);
		
}

$("#saveremarks").on("click", function(){
	var offtakeIssueRemarksId = $("#offtakeIssueRemarksId").val();
	var remarks = $("#offtakeremarks").val();
	if(remarks!=""){
		remarks = addslashes(remarks);
		var remarksdata = {};
		remarksdata['offtake_issue_id'] = offtakeIssueRemarksId;
		remarksdata['remarks'] = remarks;
		remarksdata['updated_by'] = 'CBG_OGMC';
		console.log(remarksdata);
		postRemarks(remarksdata);
	}else{
		console.log('Please enter remarks');
	}
	
	
})

function addslashes(string) {
    return string.replace(/\\/g, '\\\\').
        replace(/\u0008/g, '\\b').
        replace(/\t/g, '\\t').
        replace(/\n/g, '\\n').
        replace(/\f/g, '\\f').
        replace(/\r/g, '\\r').
        replace(/'/g, '\\\'').
        replace(/"/g, '\\"');
}

async function postRemarks(data) {
	var postRemarksUrl = "<?=base_url();?>offtake-issues-remarks";
	try {
		const response = await fetch(postRemarksUrl, {
		  method: "POST", // or 'PUT'
		  headers: {
			"Content-Type": "application/json",
		  },
		  body: JSON.stringify(data),
		});
		const result = await response.json();
		if(result.status===200){
			$("#offtakeRemarks").modal("hide");
			$("#offtakeremarks").val('');
			$("#c-alert").removeClass("d-none");
			window.setTimeout(function(){
				$("#c-alert").addClass('d-none');
			}, 3000);
		}else{
			console.log(res);
		}
	} catch (error) {
		console.error("Error:", error);
	}
}



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