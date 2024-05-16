<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>

<style>
.table-header{
	 background-color: #296fa1;
    color: white;
    font-weight: bold;
}

.table-header {
    background-color: #195c10;
    color: white;
    font-weight: bold;
}
.table td > a {
    color: #195c10 !important;
    font-weight: bold;
}

.tblHead{
	font-size: 14px;
	background: green;
	color: white;
}
#pdetails{
	font-size: 15px;
}
#pdetails td, .tblHead th{
	padding: 4px;
	text-align: left;
}
.secoverlay2 .table-bordered td{
	padding: 4px;
}

.secoverlay2 table{
	background-color: aliceblue;
}
</style>


<div class="container mt-2">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<a href="javascript:void(0)" onclick="window.history.back()" > <i class="fa fa-arrow-left" ></i> Back </a>
		</div>
		<div class="col-sm-12">
			<div style="background-color: #d0e091; padding: 7px; font-weight: bold; margin-top: 10px;margin-bottom: 10px;"><?=$list_title;?></div>
		</div>
		<div class="col-lg-12 col-12">
			<div class="table-responsive secoverlay2">
			
			
			<?php
				if($type=='state'){ ?>
					<table class="table table-bordered fixedTable">
						<thead>
							<tr class="table-header">
								<th rowspan="2" >State/ UT Name</th>
								<th colspan="5" class="text-center" >CBG/ Bio CNG Plants Registered</th>
							</tr>
							<tr class="table-header">
								<th class="text-center" >Yet to start construction </th>
								<th class="text-center" >Construction in progress </th>
								<th class="text-center" >Completed </td>
								<th class="text-center" >Functional</th>
								<th class="text-center" >Total</th>
							</tr>
							</thead>
						
						<?php
							$tYetToStart=0;
							$tConstructionInProgress=0;
							$tFunctional=0;
							$tcompleted=0;
							$tTotal=0;
							foreach($states as $state){ ?>
								<tr>
									<td>
										<a href="district-cbg?t=state&s=<?=$state['state_code'];?>" > <?=$state['state_name'];?> </a>
									</td>
									<td class="text-center">
										<a href="javascript:void(0)" class="STcbgPlantDetails" data-toggle="modal" data-target="#cbgPlantsModal" data-state="<?=$state['state_code']?>" data-bgstatus="yettostart" >
										<?php
											echo $yetToStart = $state['yettostarted'];
											$tYetToStart+=$yetToStart;
										?>
										</a>
									</td>
									<td class="text-center">
										<a href="javascript:void(0)" class="STcbgPlantDetails" data-toggle="modal" data-target="#cbgPlantsModal" data-state="<?=$state['state_code']?>" data-bgstatus="underconstct" >
										<?php
											echo $construction = $state['underconstruction'];
											$tConstructionInProgress+=$construction;
										?>
										</a>
									</td>
									<td class="text-center">
										<a href="javascript:void(0)" class="STcbgPlantDetails" data-toggle="modal" data-target="#cbgPlantsModal" data-state="<?=$state['state_code']?>" data-bgstatus="completed" >
										<?php
											echo $completed = $state['completed'];
											$tcompleted+=$completed;
										?>
										</a>
									</td>
									<td class="text-center">
										<a href="javascript:void(0)" class="STcbgPlantDetails" data-toggle="modal" data-target="#cbgPlantsModal" data-state="<?=$state['state_code']?>" data-bgstatus="functional" >
										<?php
											echo $functional = $state['functional'];
											$tFunctional+=$functional;
										?>
										</a>
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
					
				<?php	
				}
			?>
			
			</div>
		</div>
		
	</div>
	
</div>


<div class="modal fade" id="cbgPlantsModal" style="z-index: 1000000;" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title text-center">Plant Details</h4>
				<button type="button" class="btn-close btn" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 text-center mb-5">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead class="tblHead">
									<tr>
										<th>District Name</th>
										<th>Name of the Plant</th>
										<th>Name of the Entity</th>
										<th>Status of the Plant </th>
										<th>Gas Production Capacity</th>
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
	let entTypes = {'':'','0':'','17':'Biogas plant operator','18':'Compressed Bio Gas/ Bio CNG plant operator'};
	let plntStatus = {'':'','0':'','22':'Yet to start construction','23':'Under Construction','24':'Functional','290':'Completed'};
	//console.log(entTypes['17']);
	$(".STcbgPlantDetails").on("click", function(){
		let stateId = $(this).data("state");
		let bgstatus = $(this).data("bgstatus");
		//console.log(bgstatus);
		$.ajax({
            url:"<?=base_url()?>get-plantDetails",
            type:"post",
            data:{stateCode:stateId,bgstatus:bgstatus,etype:18},
            success:function(res){
				console.log(res);
				let resps = JSON.parse(res);
				let pdetailsHtml = '';
				$.each(resps, function (key, val) {
					let unt='';
					if(val.entity_type_id=="17"){ unt= "m³/day"; }else{ unt= "Tons/day"; }
					pdetailsHtml+='<tr>\
						<td>'+val.district_name+'</td>\
						<td>'+val.project_name+'</td>\
						<td>'+val.entity_name+'</td>\
						<td>'+plntStatus[val.plant_status_id]+'</td>\
						<td>'+val.gas_production_capacity+' '+unt+'  </td>\
					</tr>';
				});
				$("#pdetails").html(pdetailsHtml);
            }
        });
	})
});

</script>
<script>
	$('.fixedTable').closest('.table-responsive').css('max-height','600px');
	$('.fixedTable').addClass('tableFixHead');
	$('.modal').each(function(){
		$(this).find('.table').addClass('tableFixHead');
	})
</script>
<?= $this->endSection(); ?>