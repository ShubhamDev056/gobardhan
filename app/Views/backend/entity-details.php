<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>

<style>
.table-header{
	 background-color: #296fa1;
    color: white;
    font-weight: bold;
}
.table-heading{
	font-size: 13px;
    font-weight: bold;
}
</style>

<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">Entity Details</h3>
		</div>
		
		<div class="col-lg-4 col-4">
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr class="table-header">
						<td colspan="2">Entity Basic Information</td>
					</tr>
					<tr>
						<td class="table-heading">1.1 Name of entity</td>
						<td>Indev</td>
					</tr>
					<tr>
						<td class="table-heading">1.2 Type of entity</td>
						<td>Private</td>
					</tr>
					<tr>
						<td class="table-heading">1.3 Sub-type</td>
						<td>NGO</td>
					</tr>
					<tr>
						<td class="table-heading">1.4 Land No</td>
						<td>1135352925</td>
					</tr>
					<tr>
						<td class="table-heading">1.5 Mobile No</td>
						<td>9554161643</td>
					</tr>
					<tr>
						<td class="table-heading">1.6 Email</td>
						<td>contact@indevconsultancy.com</td>
					</tr>
					<tr>
						<td class="table-heading">1.7 Address</td>
						<td>A-61/1, 1st Floor, Okhla Phase II, Okhla Industrial Estate, New Delhi, Delhi 110020</td>
					</tr>
					<tr>
						<td class="table-heading">1.8 State</td>
						<td>Uttar Pradesh</td>
					</tr>
					<tr>
						<td class="table-heading">1.9 District</td>
						<td>Noida</td>
					</tr>
					<tr>
						<td class="table-heading">1.10 Pin code</td>
						<td>110020</td>
					</tr>
					<tr>
						<td class="table-heading">1.11 CIN / Registration No</td>
						<td>REG8952140751</td>
					</tr>
					<tr>
						<td class="table-heading">1.12 Incorporation/ registration date</td>
						<td>01-01-2009</td>
					</tr>
					<tr>
						<td class="table-heading">1.13 PAN number</td>
						<td>SAT7851SRD</td>
					</tr>
					<tr>
						<td class="table-heading">1.14 GST number</td>
						<td>GST7842155</td>
					</tr>
					<tr>
						<td class="table-heading">1.15 Company registration letter</td>
						<td><i class="fa fa-download"></i></td>
					</tr>
					
				</table>
			</div>
		</div>
		<div class="col-lg-8 col-8">
			
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr class="table-header">
						<td colspan="4">2. Authorized Representative Details</td>
					</tr>
					<tr>
						<td class="table-heading">2.1 Name</td>
						<td>Satyendra Singh</td>
						<td class="table-heading">2.2 Designation</td>
						<td>Developer</td>
					</tr>
					<tr>
						<td class="table-heading">2.3 Contact no</td>
						<td>955416164</td>
						<td class="table-heading">2.4 Email</td>
						<td>satyendrasingh@gmail.com</td>
						
					</tr>
					<tr>
						<td class="table-heading">2.5 Authorization letter</td>
						<td colspan="3"><i class="fa fa-download"></i></td>
					</tr>
				</table>
			</div>
			
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr class="table-header">
						<td colspan="4">3. Director (s) / Partner (s) Detail</td>
					</tr>
					<tr>
						<td class="table-heading">3.1 Number of director (s) / Partner (s)</td>
						<td>2</td>
					</tr>
					<tr>
						<td colspan="2">
							<table class="table table-bordered">
								<tr class="table-header">
									<td>DIN/ DPIN</td>
									<td>Name</td>
									<td>Gender</td>
									<td>Mobile</td>
									<td>Email</td>
								</tr>
								<tr>
									<td>78945</td>
									<td>Naresh Patel</td>
									<td>Male</td>
									<td>7892148521</td>
									<td>nareshpatel23@gmail.com</td>
								</tr>
								<tr>
									<td>78945</td>
									<td>Raju Kumar</td>
									<td>Male</td>
									<td>7894512713</td>
									<td>raju.kumar@gmail.com</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr style="background-color: #52a129; color: white; font-weight: bold;">
						<td colspan="5">All the Projects of the Entity</td>
					</tr>
					<tr style="background-color: #52a129; color: white; font-weight: bold;">
						<td>Type of gas output</td>
						<td>Type of plant</td>
						<td>Status of plant</td>
						<td>Production capacity</td>
						<td>Action</td>
					</tr>
					<tr>
						<td>Biogas</td>
						<td>Commercial</td>
						<td>Under Construction</td>
						<td>120 m³/day</td>
						<td>
							<a href="<?=base_url()?>project-details" ><i class="fa fa-eye badge bg-primary"> View</i></a>
						</td>
					</tr>
					<tr>
						<td>Biogas</td>
						<td>Commercial</td>
						<td>Under Construction</td>
						<td>120 m³/day</td>
						<td>
							<a href="<?=base_url()?>project-details" ><i class="fa fa-eye badge bg-primary"> View</i></a>
						</td>
					</tr>
				</table>
			</div>
		</div>
		
	</div>
	
</div>

<?= $this->endSection(); ?>




<?=$this->section('script');?>


<?= $this->endSection(); ?>