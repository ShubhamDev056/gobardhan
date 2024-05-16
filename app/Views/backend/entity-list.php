<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>

<style>
.table-header{
	 background-color: #296fa1;
    color: white;
    font-weight: bold;
}
</style>

<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">Entity List</h3>
		</div>
		<div class="col-lg-12 col-12">
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr class="table-header">
						<td>Entity Name</td>
						<td>Entity Type</td>
						<td>Email</td>
						<td>Mobile No</td>
						<td>State</td>
						<td>Action</td>
					</tr>
					<?php if($_SESSION['state_id']==35){?>  
						<tr>
							<td>Entity -1</td>
							<td>Private</td>
							<td>contact@ety.com</td>
							<td>8745102489</td>
							<td>Uttar Pradesh</td>
							<td>
								<a href="<?=base_url()?>entity-details" ><i class="fa fa-eye badge bg-primary"> View</i></a>
							</td>
						</tr>
					<?php }else{ ?>
						<tr>
							<td>Entity -1</td>
							<td>Private</td>
							<td>contact@ety.com</td>
							<td>8745102489</td>
							<td>Uttar Pradesh</td>
							<td>
								<a href="<?=base_url()?>entity-details" ><i class="fa fa-eye badge bg-primary text-white"> View</i></a>
							</td>
						</tr>
						<tr>
							<td>Indev</td>
							<td>Private</td>
							<td>contact@indevconsultancy.com</td>
							<td>1135352925</td>
							<td>Delhi</td>
							<td>
								<a href="<?=base_url()?>entity-details" ><i class="fa fa-eye badge bg-primary  text-white"> View</i></a>
							</td>
						</tr>
						<tr>
							<td>Entity -2</td>
							<td>Private</td>
							<td>ss@dd.com</td>
							<td>8954125872</td>
							<td>Madhya Pradesh</td>
							<td>
								<a href="<?=base_url()?>entity-details" ><i class="fa fa-eye badge bg-primary  text-white"> View</i></a>
							</td>
						</tr>
					<?php	
					} ?>
					
				</table>
			</div>
		</div>
		
	</div>
	
</div>

<?= $this->endSection(); ?>




<?=$this->section('script');?>


<?= $this->endSection(); ?>