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
				MDA Issues List
				<a href="javascript:" style="float:right;" onclick="tableToExcel('MDA-Issue-List', 'MDA-Issue-List')"> <i class="fa fa-download float-end"></i> </a>
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
				<table class="table table-bordered" id="MDA-Issue-List">
					<tr class="table-header">
						<th>#SN</th>
						<th>State Name</th>
						<th>Plant Name</th>
						<th>Related Issues</th>
						<th>Remarks</th>
						<th>DoF Remarks</th>
						<th width="10%">Post Issue</th>
						<th width="12%">Action</th>
					</tr>
					
					<?php $sn=1 ; foreach($mdaissues as $mdaissue){ ?>
						<tr>
							<td><?=$sn++;?></td>
							<td><?=$mdaissue['state_name'];?></td>
							<td><?=$mdaissue['project_name'];?></td>
							<td>
								<?php 
									$reissues = explode(",",$mdaissue['related_issues']);
									foreach($reissues as $reissue){
										echo getNameFromId('issues_related', $reissue).", ";
									}
								?>
							</td>
							<td><?=$mdaissue['remarks'];?></td>
							<td><?=$mdaissue['dof_remarks'];?></td>
							<td><?=date('d-m-Y',strtotime($mdaissue['created_at']));?></td>
							<td>
								<a href="javascript:" class="show-details" data-id="<?=$mdaissue['id'];?>" ><i class="fa fa-eye badge bg-primary text-white"> </i></a>
								<?php if($_SESSION['role']=="DoFAdmin"){ ?>
									<a href="javascript:" class="add-remarks" data-id="<?=$mdaissue['id'];?>" ><i class="fa fa-plus badge bg-primary text-white"> Remarks </i></a>
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


<div class="modal fade" id="mdadetails" style="z-index: 1000000;">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-lightblue">
				<h4 class="modal-title">MDA Issue Details</h4>
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

<div class="modal fade" id="mdaRemarks" style="z-index: 1000000;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-lightblue">
				<h4 class="modal-title">MDA Issue Remarks</h4>
				<button type="button" class="btn-close" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" >
				
				<div class="row">
					<div class="col-sm-12" >
						
						<div class="form-group">
							<input type="hidden" id="mdaIssueRemarksId" />
							<textarea class="form-control" rows="5" name="remarks" id="remarks" required placeholder="Remarks" ></textarea>
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
$(".show-details").on("click", function(){
	var mdaIssueId = $(this).data("id");
	$("#mdadetails").modal("show");
	getMdaDetails(mdaIssueId);
})
$(".add-remarks").on("click", function(){
	var mdaIssueId = $(this).data("id");
	$("#mdaIssueRemarksId").val(mdaIssueId);
	$("#mdaRemarks").modal("show");
})

$(".btn-close").on("click",function(){
	$("#mdadetails").modal('hide');
	$("#mdaRemarks").modal('hide');
});

async function getMdaDetails(mdaId) {
	const mdagetUrl = "<?=base_url();?>"+"mda-issues-details/"+mdaId;
	const response = await fetch(mdagetUrl);
	const mdaIssue = await response.json();
	console.log(mdagetUrl);
	var issue_logs = mdaIssue.issue_log;
	var mdaIssueHtml = '<table class="table table-bordered ctable">\
							<tr><th width="25%" >State Name</th><td>'+mdaIssue.state_name+'</td></tr>\
							<tr><th>Project Name</th><td>'+mdaIssue.project_name+'</td></tr>\
							<tr><th>Related Issue</th><td>'+mdaIssue.related_issues+'</td></tr>\
							<tr><th>Issue with iFMS</th><td>'+mdaIssue.ifms+'</td> </tr>\
							<tr><th>Issues with MoU Signing</th><td>'+mdaIssue.mous+'</td></tr>\
							<tr><th>Issues with PoS Machine</th><td>'+mdaIssue.pos_machines+'</td></tr>\
							<tr><th>Issues with Testing of FOM/LFOM</th><td>'+mdaIssue.testingIssues+'</td></tr>\
							<tr><th>Remarks</th><td>'+mdaIssue.remarks+'</td></tr>\
							<tr><th>DoF Remarks</th><td>'+mdaIssue.dof_remarks+'</td></tr>\
							<tr><th>Issue Post Date </th><td>'+mdaIssue.created_at+'</td></tr>\
						</table>';
		$("#mdaIssuDetails").html(mdaIssueHtml);
		
		var logHtml = '<h5>Remarks Log</h5><table class="table table-bordered ctable"> <tr> <th>Remarks Date</th> <th>CBG Remarks</th> <th>DoF Remarks</th> </tr>';
		
		$.each(issue_logs,function(k,log){
			console.log(log);
			logHtml+='<tr><td>'+log.created_at+'</td><td>'+log.remarks+'</td><td>'+log.dof_remarks+'</td></tr>';
		})
		logHtml+='</table>';
		$("#mdaIssuDetails").append(logHtml);
		
}

$("#saveremarks").on("click", function(){
	var mdaIssueRemarksId = $("#mdaIssueRemarksId").val();
	var remarks = $("#remarks").val();
	if(remarks!=""){
		remarks = addslashes(remarks);
		var remarksdata = {};
		remarksdata['mda_issue_id'] = mdaIssueRemarksId;
		remarksdata['remarks'] = remarks;
		remarksdata['updated_by'] = 'dof';
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
	var postRemarksUrl = "<?=base_url();?>mda-issues-remarks";
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
			$("#mdaRemarks").modal("hide");
			$("#remarks").val('');
			$("#c-alert").removeClass("d-none");
			window.setTimeout(function(){
				$("#c-alert").addClass('d-none');
			}, 3000);
		}else{
			console.log(result);
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