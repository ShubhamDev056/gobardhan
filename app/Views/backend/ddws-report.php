<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>

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
.table-bordered td{
	padding: 5px;
}

.table.tableFixHead thead {
    background: #296fa1;
	color: #fff;
}
</style>

<div class="container mt-3">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;margin-bottom: 10px;">
				State Wise DDWS Report
			</h3>
			
		</div>
		<div class="col-lg-12" >
			<form>
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<input type="date" name="fdate" id="fdate" max="<?=date('Y-m-d');?>" class="form-control" placeholder="" value="<?=@$_REQUEST['fdate']?>" required />
						</div>
					</div>
					<div class="col-sm-5">
						<div class="form-group">
							<input type="date" name="tdate" id="tdate" class="form-control" placeholder="" value="<?=@$_REQUEST['tdate']?>" required />
						</div>
					</div>
					<div class="col-sm-2">
						<button class="btn btn-success form-control">Search</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-lg-12 col-12">
		
			<div class="table-responsive">
				<table id="ddwsreport" class="table table-bordered" style="background-color:aliceblue;">
					<tr class="table-header">
						<th>State Name</th>
						<th>Yet to start</th>
						<th>Under Construction</th>
						<th>Completed</th>
						<th>Functional</th>
						<th>Total </th>
					</tr>
					
					<?php
						
						$tYetToStart=0;
						$tConstructionInProgress=0;
						$tFunctional=0;
						$tcompleted=0;
						$tTotal=0;
						foreach($ddwsReports as $state){ ?>
							<tr>
								<td>
									<a href="ddws-report-district/<?=$state['state_code'];?>?fdate=<?=@$_REQUEST['fdate']?>&tdate=<?=@$_REQUEST['tdate']?>&s=<?=$state['state_name'];?>" > <?=$state['state_name'];?> </a>
								</td>
								
								<td class="text-center">
									
									<?php
										$yetToStart = $state['yettostarted'];
										$tYetToStart+=$yetToStart;
										if($yetToStart>0){ ?>
											<a href="javascript:void(0)" class="STbiogasPlantDetails" data-state="<?=$state['state_code']?>" data-bgstatus="yettostart" >
												<?=$yetToStart;?>
											</a>
										<?php	
										}else{
											echo $yetToStart;
										}
									?>
									
								</td>
								
								<td class="text-center">
									
									<?php
										$construction = $state['underconstruction'];
										$tConstructionInProgress+=$construction;
										if($construction>0){ ?>
											<a href="javascript:void(0)" class="STbiogasPlantDetails" data-state="<?=$state['state_code']?>" data-bgstatus="underconstct" >
											<?=$construction;?>
											</a>
										<?php	
										}else{
											echo $construction;
										}
									?>
									
								</td>
								<td class="text-center">
									
									<?php
										$completed =$state['completed'];
										$tcompleted+=$completed;
										if($completed>0){ ?>
											<a href="javascript:void(0)" class="STbiogasPlantDetails" data-state="<?=$state['state_code']?>" data-bgstatus="completed" >
												<?=$completed;?>
											</a>
										<?php	
										}else{
											echo $completed;
										}
									?>
									
								</td>
								<td class="text-center">
									
									<?php
										$functional =$state['functional'];
										$tFunctional+=$functional;
										if($functional>0){ ?>
											<a href="javascript:void(0)" class="STbiogasPlantDetails" data-state="<?=$state['state_code']?>" data-bgstatus="functional" >
												<?=$functional;?>
											</a>
										<?php	
										}else{
											echo $functional;
										}
									?>
									
								</td>
								
								<td class="text-center">
									<?php
										echo $total = $yetToStart+$construction+$completed+$functional;
										$tTotal+=$total;
									?>
								</td>
							</tr>
						<?php	
						}
					?>
					<tr class="table-header">
						<td class="text-center">Total</td>
						
						<td class="text-center"><?=$tYetToStart;?></td>
						<td class="text-center"><?=$tConstructionInProgress;?></td>
						<td class="text-center"><?=$tcompleted;?></td>
						<td class="text-center"><?=$tFunctional;?></td>
						<td class="text-center"><?=$tTotal?></td>
					</tr>
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


<div class="modal fade" id="biogasPlantsModal" style="z-index: 1000000;" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title text-center">
					Plant Details
					<a href="javascript:" id="export"> <i class="fa fa-download"></i> </a>
				</h4>
				
				<button type="button" class="btn-close btn" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 text-center mb-5">
						<div class="table-responsive">
							<table class="table table-bordered" id="project-details">
								<thead class="tblHead">
									<tr>
										<th>#SN.</th>
										<th>District</th>
										<th>Block</th>
										<th>GP</th>
										<th>Village</th>
										<th>Name of the Plant</th>
										<th>Name of the Entity</th>
										<th width="13.2%" >Status of the Plant </th>
										<th>Gas Production Capacity</th>
										<th>Action</th>
									</tr>
								</thead>	
								
								<tbody id="pdetails">
								
								</tbody>
								
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<?= $this->endSection(); ?>




<?=$this->section('script');?>

<script>
$(document).ready(function(){
	
	$("#fdate").on("change", function(){
		let fd = $(this).val();
		$("#tdate").attr('min',fd);
	})
	
	let entTypes = {'':'','0':'','17':'Biogas plant operator','18':'Compressed Bio Gas/ Bio CNG plant operator'};
	let plntStatus = {'':'','0':'','22':'Yet to start construction','23':'Under Construction','24':'Functional','290':'Completed'};
	//console.log(entTypes['17']);
	$(".STbiogasPlantDetails").on("click", function(){
		let stateId = $(this).data("state");
		let bgstatus = $(this).data("bgstatus");
		let mn = "ddws"; //$("#ministry").val();
		let fdate = "<?=@$_REQUEST['fdate']?>";
		let tdate = "<?=@$_REQUEST['tdate']?>";
		//console.log(bgstatus);
		$("#pdetails").html('');
		$.ajax({
            url:"<?=base_url()?>get-plantDetails",
            type:"post",
			beforeSend: function() {
			  $('#sspre-load').show();
			},
            data:{stateCode:stateId,bgstatus:bgstatus,etype:17,m:mn,fdate:fdate,tdate:tdate},
            success:function(res){
				//console.log(res);
				let resps = JSON.parse(res);
				let pdetailsHtml = '';
				let i=0;
				$.each(resps, function (key, val) {
					i++;
					let unt='';
					let bname = val.block_name;
					let gname = val.gp_name;
					let vname = val.village_name;
					if(val.entity_type_id=="17"){ unt= "m³/day"; }else{ unt= "Tons/day"; }
					if(val.block_name==null){ bname = "NA"; }
					if(val.gp_name==null){ gname = "NA"; }
					if(val.village_name==null){ vname = "NA"; }
					let pdetails = '';
					pdetailsHtml+='<tr>\
						<td>'+i+'</td>\
						<td>'+val.district_name+'</td>\
						<td>'+bname+'</td>\
						<td>'+gname+'</td>\
						<td>'+vname+'</td>\
						<td>'+val.project_name+'</td>\
						<td>'+val.entity_name+'</td>\
						<td>'+plntStatus[val.plant_status_id]+'</td>\
						<td>'+val.gas_production_capacity+' '+unt+'  </td>\
						<td>\
							<a href="<?=base_url();?>p-details/'+val.project_id+'" class="btn btn-secondary btn-sm mt-1" style="color: white!important;font-weight: 400;" >View</a>\
						</td>\
					</tr>';
				});
				$('#sspre-load').hide('slow');
				$('#biogasPlantsModal').modal('show');
				$("#pdetails").html(pdetailsHtml);
			
            }
        });
	})
});





$('#export').click(function() {
  
	var titles = [];
	var data = [];
	const csvContents = [].map.call(document.getElementById('project-details').rows,
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