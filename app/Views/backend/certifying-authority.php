<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>

<style>
.required{
	color:red;
}
</style>

<div class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<h3 style="background-color: lightblue; padding: 7px;font-weight: bold;">Certifying Authority Form</h3>
		</div>
		
		<div class="col-lg-12 col-12">
			<form method="post">
				<fieldset class="border p-2 mb-3">
					<legend class="float-none w-auto p-2 text-primary">11.1 Details of the certifying officer </legend>
					<div class="row">
						<div class="col-sm-6 col-6">
							<label class="fieldlabels">Name <span class="required">*</span></label>
							<input type="text" class="form-control" name="entity_name" id="entity_name" placeholder="Entity Name" required="">
						</div>
						
						<div class="col-sm-6 col-6 mt-2">
							<label class="fieldlabels">Designation <span class="required">*</span></label>
							<input type="text" class="form-control" name="entity_name" id="entity_name" placeholder="Entity Name" required="">
						</div>
						<div class="col-sm-6 col-6 mt-2">
							<label class="fieldlabels">Agency/ Ministry <span class="required">*</span></label>
							<input type="text" class="form-control" name="entity_name" id="entity_name" placeholder="Entity Name" required="">
						</div>
						<div class="col-sm-6 col-6 mt-2">
							<label class="fieldlabels">Contact number <span class="required">*</span></label>
							<input type="text" class="form-control" name="entity_name" id="entity_name" placeholder="Entity Name" required="">
						</div>
						<div class="col-sm-12 col-12 mt-2">
							<label class="fieldlabels">Authorization letter <span class="required">*</span></label>
							<input type="file" class="form-control" name="entity_name" id="entity_name" required="">
						</div>
						
					</div>
				</fieldset>
			
				<fieldset class="border p-2 mb-3">
					<legend class="float-none w-auto p-2 text-primary">11.2 Verification details </legend>
					
					<div class="row">
						<div class="col-sm-12 col-12 mb-2">
							<label class="fieldlabels">Verification details <span class="required">*</span></label>
							<textarea class="form-control" placeholder="Verification Details"></textarea>
						</div>
						
						<div class="col-sm-4 col-4 mt-2">
							<label class="fieldlabels">Verification Document <span class="required">(Optional)</span></label>
							<input type="file" class="form-control" name="entity_name" id="entity_name" required="">
						</div>
						
						<div class="col-sm-4 col-4 mt-2">
							<label class="fieldlabels">Date of submission of report <span class="required">*</span></label>
							<input type="date" class="form-control" name="entity_name" id="entity_name" required="">
						</div>
						
						<div class="col-sm-4 col-4 mt-2">
							<label class="fieldlabels">Recommendations <span class="required">*</span></label>
								<select class="form-select">
									<option value="">Select Recommendations</option>
									<option value="">Permanent Registration number to be given</option>
									<option value="">Permanent Registration number not to be given</option>
								</select>
						</div>
						
					</div>
					
				</fieldset>
				
				<div class="row mt-3">
					<div class="col-sm-12">
						<button class="btn btn-primary pull-right">Submit</button>
					</div>
				</div>
				
			</form>
		</div>
		
		
	</div>
	
</div>

<?= $this->endSection(); ?>




<?=$this->section('script');?>


<?= $this->endSection(); ?>