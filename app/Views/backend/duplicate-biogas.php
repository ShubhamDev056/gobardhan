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

/*
.secoverlay{
	margin-top: -440px !important;
	background: transparent;
	z-index: 4;
}
.secoverlay2{
	margin-top: -366px  !important;
	background: transparent;
	z-index: 4;
}

.table-header-c {
    background-color: #195c10;
    color: white;
    font-weight: bold;
}

.secoverlay3 tr{
	
}
*/

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

</style>


<div class="container mt-5">
	
	<div class="row justify-content-center ">
		<div class="col-sm-12">
			<a href="javascript:void(0)" onclick="window.history.back()" > <i class="fa fa-arrow-left" ></i> Back </a>
		</div>
		<div class="col-sm-12 secoverlay">
			<h3 style="background-color: #d0e091; padding: 7px; font-weight: bold; margin-top: 30px;">GP Wise Biogas Plants Duplicate </h3>
		</div>
		<div class="col-lg-12 col-12 secoverlay2">
			<div class="table-responsive">
				<table class="table table-bordered secoverlay3">
					<tr class="table-header">
						<td class="text-center" >State Name</td>
						<td class="text-center" >District Name</td>
						<td class="text-center" >Gram Panchayat</td>
						<td class="text-center" >Number of Plants</td>
					</tr>
					<?php
						foreach($gpWiseDuplicateBiogass as $gpWiseDuplicateBiogas){ ?>
							<tr>
								<td><?=$gpWiseDuplicateBiogas->state_name?></td>
								<td><?=$gpWiseDuplicateBiogas->district_name?></td>
								<td><?=$gpWiseDuplicateBiogas->gp_name?></td>
								<td>
									<a href="javascript:void(0)" class="STbiogasPlantDetails" data-toggle="modal" data-target="#biogasPlantsModal" data-gp="<?=$gpWiseDuplicateBiogas->gp?>" >
										<?=$gpWiseDuplicateBiogas->noofPlants?>
									</a>
									<?php
										if($gpWiseDuplicateBiogas->pending>0){ ?>
											<div class="badge badge-warning">
												<span class="blink">New</span>
											</div>
										<?php	
										}
									?>
									
								</td>
							</tr>
						<?php	
						}
					?>
					
				</table>
			</div>
		</div>
		
	</div>
	
</div>


<div class="modal fade" id="biogasPlantsModal" style="z-index: 1000000;" data-keyboard="false" data-backdrop="static">
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
										<th>Name of the Plant</th>
										<th>Name of the Entity</th>
										<th>Type of the Plant </th>
										<th>Status of the Plant </th>
										<th>Gas Production Capacity</th>
										<th>Status</th>
										<th width="14%" >Action</th>
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
	$(".STbiogasPlantDetails").on("click", function(){
		let gpId = $(this).data("gp");
		//let bgstatus = $(this).data("bgstatus");
		//console.log(bgstatus);
		$.ajax({
            url:"<?=base_url()?>get-plantDetails",
            type:"post",
            data:{gpCode:gpId,etype:17},
            success:function(res){
				console.log(res);
				let resps = JSON.parse(res);
				let pdetailsHtml = '';
				$.each(resps, function (key, val) {
					let unt='';
					if(val.entity_type_id=="17"){ unt= "m³/day"; }else{ unt= "Tons/day"; }
					if(val.project_status=="approve"){ pstatus= '<span class="badge badge-success">Approved</span> '; }else{ pstatus= '<span class="badge badge-warning">Pending</span> '; }
					pdetailsHtml+='<tr>\
						<td>'+val.project_name+'</td>\
						<td>'+val.entity_name+'</td>\
						<td>'+entTypes[val.entity_type_id]+'</td>\
						<td>'+plntStatus[val.plant_status_id]+'</td>\
						<td>'+val.gas_production_capacity+' '+unt+'  </td>\
						<td>'+pstatus+' </td>\
						<td>\
							<a href="javascript:" class="btn btn-primary btn-sm approvebtn" data-id="'+val.project_id+'" style="color: white!important;" >Approve</a>\
							<a href="javascript:" class="btn btn-danger btn-sm deletebtn" data-id="'+val.project_id+'" style="color: white!important;" >Delete</a>\
							<a href="<?=base_url();?>/project-details/'+val.project_id+'" class="btn btn-secondary btn-sm mt-1" style="color: white!important;font-weight: 400;" >View</a>\
						</td>\
					</tr>';
				});
				$("#pdetails").html(pdetailsHtml);
            }
        });
	});
	
	$(document).on("click",".approvebtn", function(){
		if (confirm('Are you sure to approve?')) {
			//alert('Thanks for confirming');
			let pid = $(this).data("id");
			if(pid!=""){
				$.ajax({
					url:"<?=base_url()?>make-certificate/"+pid,
					type:"get",
					//data:{pid:pid},
					success:function(res){
						//console.log(res);
						window.location.href="<?=base_url()?>/duplicate-biogas";
					}
				});
			}
		}
	});
	
	$(document).on("click",".deletebtn", function(){
		if (confirm('Are you sure to delete?')) {
			let pid = $(this).data("id");
			if(pid!=""){
				$.ajax({
					url:"<?=base_url()?>project-delete/"+pid,
					type:"get",
					//data:{pid:pid},
					success:function(res){
						//console.log(res);
						window.location.href="<?=base_url()?>/duplicate-biogas";
					}
				});
			}
		}
	});
	
});

</script>
<?= $this->endSection(); ?>