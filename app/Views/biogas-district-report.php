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
.secoverlay3 table{
	background-color: aliceblue;
}

.secoverlay3 .table-bordered td{
	padding: 4px;
}
</style>
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

.secoverlay3{
	background-color: aliceblue;
}

.tblHead{
	font-size: 14px;
	background: green;
	color: white;
}

#pdetails{
	font-size: 12px;
    font-weight: 600;
    background-color: aliceblue;
}
#pdetails td, .tblHead th{
	padding: 4px;
	text-align: left;
}

.secoverlay2 .table-bordered td{
	padding: 4px;
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

<div id="sspre-load" style="display: none;">
   <div id="ssloader" class="ssloader">
	   <div class="ssloader-container">
		   <div class="ssloader-icon"><div>Loading...</div></div>
	   </div>
   </div>              
</div>


<div class="container mt-2">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<a href="javascript:void(0)" onclick="window.history.back()" > <i class="fa fa-arrow-left" ></i> Back </a>
		</div>
		<div class="col-sm-12">
			<div style="background-color: #d0e091; padding: 7px; font-weight: bold; margin-top: 10px;margin-bottom: 10px;">
				<?=$state['state_name'];?> - <?=$list_title;?>
				<select class="pull-right" id="ministry"> 
					<option value="all">All</option>
					<option value="ddws" <?php if(@$_REQUEST['m']=='ddws'){ echo "selected"; } ?> >DDWS</option>
				</select>
				
			</div>
		</div>
		<div class="col-lg-12 col-12">
			<div class="table-responsive secoverlay3">
				
				
				<?php
					if($type=='state'){ ?>
						<table class="table table-bordered fixedTable">
							<thead>
								<tr class="table-header">
									<th rowspan="2" class="text-center">District Name</th>
									<th colspan="5" class="text-center" >Biogas Plants Registered</th>
								</tr>
								<tr class="table-header">
									<th class="text-center" >Yet to start construction </th>
									<th class="text-center" >Construction in progress </th>
									<th class="text-center" >Completed</th>
									<th class="text-center" >Functional</th>
									<th class="text-center" >Total</th>
								</tr>
							</thead>
							
							<?php
								$tYetToStart=0;
								$tConstructionInProgress=0;
								$tFunctional=0;
								$tCompleteds=0;
								$tTotal=0;
								foreach($districts as $district){ ?>
									<tr>
										<td>
											<?=$district['district_name'];?>
										</td>
										<td class="text-center">
											<?php
												$yetToStart = $district['yettostarted'];
												$tYetToStart+=$yetToStart;
												if($yetToStart>0){ ?>
													<a href="javascript:void(0)" class="STbiogasPlantDetails" data-dist="<?=$district['district_code']?>" data-bgstatus="yettostart" >
														<?=$yetToStart;?>
													</a>
												<?php	
												}else{ echo $yetToStart; }
											?>
										</td>
										<td class="text-center">
											<?php
												$construction = $district['underconstruction'];
												$tConstructionInProgress+=$construction;
												if($construction>0){?>
													<a href="javascript:void(0)" class="STbiogasPlantDetails" data-dist="<?=$district['district_code']?>" data-bgstatus="underconstct" >
														<?=$construction;?>
													</a>
												<?php	
												}else{ echo $construction; }
											?>
										</td>
										<td class="text-center">
											<?php
												$completed = $district['completed'];
												$tCompleteds+=$completed;
												if($completed>0){ ?>
													<a href="javascript:void(0)" class="STbiogasPlantDetails" data-dist="<?=$district['district_code']?>" data-bgstatus="completed" >
														<?=$completed;?>
													</a>
												<?php
												}else{ echo $completed; }
											?>
										</td>
										<td class="text-center">
											<?php
												$functional = $district['functional'];
												$tFunctional+=$functional;
												if($functional>0){?>
													<a href="javascript:void(0)" class="STbiogasPlantDetails" data-dist="<?=$district['district_code']?>" data-bgstatus="functional" >
														<?=$functional;?>
													</a>
												<?php	
												}else{ echo $functional; }
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
								<td class="text-center"><?=$tCompleteds;?></td>
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

	
	$('.fixedTable').closest('.table-responsive').css('max-height','600px');
	$('.fixedTable').addClass('tableFixHead');
	$('.modal').each(function(){
		$(this).find('.table').addClass('tableFixHead');
	})
	
	
	$(document).ready(function(){
		
		$("#ministry").on("change", function(){
			let m = $(this).val();
			let sid = "<?=@$_GET['s'];?>";
			if(m!=""){
				let url = 'https://gobardhan.co.in/district-biogas?t=state&s='+sid+'&m='+m;
				window.location.href = url;
			}
		});
	
	
		let entTypes = {'':'','0':'','17':'Biogas plant operator','18':'Compressed Bio Gas/ Bio CNG plant operator'};
		let plntStatus = {'':'','0':'','22':'Yet to start construction','23':'Under Construction','24':'Functional','290':'Completed'};
		//console.log(entTypes['17']);
		$(".STbiogasPlantDetails").on("click", function(){
			let districtCode = $(this).data("dist");
			let bgstatus = $(this).data("bgstatus");
			let mn = $("#ministry").val();
			//console.log(bgstatus);
			$("#pdetails").html('');
			$.ajax({
				url:"<?=base_url()?>get-plantDetails",
				type:"post",
				beforeSend: function() {
				  $('#sspre-load').show();
				},
				data:{districtCode:districtCode,bgstatus:bgstatus,etype:17,m:mn},
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
	})
	
</script>

<?= $this->endSection(); ?>