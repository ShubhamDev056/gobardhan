<?= $this->extend('layouts/layout'); ?>
<?= $this->section('content'); ?>

<div class="container">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<a href="javascript:void(0)" onclick="window.history.back()" > <i class="fa fa-arrow-left" ></i> Back </a>
		</div>
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">Grievance Details</h3>
		</div>
		
		<div class="col-lg-3 col-3">
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr class="table-header">
						<td colspan="2" class="text-center" title="Grievance Code" ><b><?=$grievance['grievance_code']?></b></td>
					</tr>
					<tr>
						<td class="table-heading">Name </td>
						<td><?=$grievance['name']?></td>
					</tr>
					<tr>
						<td class="table-heading">Contact No.</td>
						<td><?=$grievance['contact_no']?> </td>
					</tr>
					<tr>
						<td class="table-heading">Submitted at</td>
						<td><?=date("d-M-Y", strtotime($grievance['created_at']))?>  </td>
					</tr>
					
					
				</table>
			</div>
		</div>
		<div class="col-lg-9 col-9">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link tabbutton active" data-toggle="tab" href="#projectBenefits">Details</a>
				</li>
				<!--
				<li class="nav-item">
					<a class="nav-link tabbutton" data-toggle="tab" href="#projectDetails">Project Details</a>
				</li>
				-->
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<!---PLANT/ PROJECT DETAILS-->
				
				<div class="tab-pane container active" id="projectBenefits">
					
					<div class="table-responsive mt-2">
						<div class="col-sm-12">
							<b>Email : </b> <span><?=$grievance['email']?></span> <br/>
							<b>Message : </b> <span><?=$grievance['message']?></span> <br/><br/><br/>
						</div>
						
						<div class="col-sm-12">
							<button type="button" class="btn btn-primary" >In Progress</button>
							<button type="button" class="btn btn-success" >Deadressed</button>
						</div>
						
					</div>
					
				</div>
				
				<!--
				<div class="tab-pane container " id="projectDetails">
					
					<div class="table-responsive mt-2">
						<table class="table table-bordered">
							<tr class="table-header">
								<td colspan="4">2. Plant/ Project Details: </td>
							</tr>
						</table>
					</div>
				</div>
				-->
			</div>
			
		</div>
		
	</div>
	
</div>

<?= $this->endSection(); ?>




<?=$this->section('script');?>


<?= $this->endSection(); ?>