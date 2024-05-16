<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>

<style>
.table-header{
	color:white;
}
</style>

<div class="container mt-2">
	<div class="row justify-content-center ">
		<div class="col-sm-12">
			<a href="javascript:void(0)" onclick="window.history.back()" > <i class="fa fa-arrow-left" ></i> Back </a>
		</div>
		
		<div class="col-lg-12" >
			<form>
				<div class="row">
					<div class="col-sm-11">
						<div class="form-group">
							<select class="form-control" name="ministry_id">
								<option value="" selected hidden >Select Ministry</option>
								<option value="" >All</option>
								<?php 
									$ministries = allOptions('ministry');
									foreach($ministries as $key=>$mnstry){ if(empty($mnstry)){ continue; }?>
										<option value="<?=$key;?>" <?php if($key==@$_GET['ministry_id']){ echo "selected"; } ?> ><?=$mnstry;?></option>
									<?php }
								?>
							</select>
						</div>
					</div>
					
					<div class="col-sm-1">
						<button class="btn btn-primary " style="padding:5px;">Search</button>
					</div>
				</div>
			</form>
		</div>
		
		<div class="col-lg-12 col-12 secoverlay2">
			<table class="table table-bordered secoverlay3 fixedTable">
				<thead>
					<tr class="table-header">
						<th>#SN.</th>
						<th>Date</th>
						<th>Ministry</th>
						<th class="" >Circular/Notification </th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($circulars as $sn=>$circular){ ?>
					<tr>
						<td><?=$sn+1;?></td>
						<td><?=date('d-M-Y',strtotime($circular['circular_date']))?></td>
						<td><?=$ministries[$circular['ministry_id']]?></td>
						<td class=""><a href="<?= base_url(); ?>whats-new/<?=$circular['file_path'];?>" target="_blank" ><?=$circular['title'];?></a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<?= $this->endSection(); ?>