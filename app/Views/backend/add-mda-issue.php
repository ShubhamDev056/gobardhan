<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>

<link rel="stylesheet" href="<?= base_url(); ?>assets/css/plugins.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-multiselect.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<style>
	.table-header {
		background-color: #296fa1;
		color: white;
		font-weight: bold;
	}

	.pagination {
		margin: 10px 0;
		margin-bottom: 15px;
	}

	.pagination li {}

	.pagination li a {
		display: inline-block;
		background: #919191;
		padding: 8px 15px;
		margin: 1px;
		color: white;
		border-radius: 5px;
		transition: all .3s ease-in-out;
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

	.fa-download {
		border-radius: 50%;
		border: 1px solid;
		padding: 5px;
		font-size: 20px;
		color: black;
	}

	label {
		font-weight: bold;
		font-family: sans-serif;
	}
</style>


<div class="container mt-5 mb-5">
	<div class="row justify-content-center">
		<div class="col-lg-3"></div>
		<div class="col-lg-6">
			<div class="text-muted">
				<h3 style="background-color: lightblue; padding: 7px;font-weight: bold; ">
					MDA Issues
				</h3>
			</div>
			<form method="post" enctype="multipart/form-data">
				
				<div class="mb-3">
					<label class="form-label text-muted" >Issues related to <span class="require">*</span></label>
					<select class="form-select form-select-md check_multiselect" multiple name="issue_related[]" required id="issue_related" aria-label=".form-select-lg example">
						
						<?php
							$issues_related = allOptions('issues_related');
							foreach($issues_related as $ky=>$issuesrelated){ 
							?>
							<option value="<?=$ky;?>"><?=$issuesrelated;?> </option>
						<?php } ?>
					</select>
				</div>
				
				<div class="mb-3 d-none rq" id="related_question1">
					<label class="form-label text-muted" >Issues with iFMS <span class="require">*</span></label>
					<select class="form-select form-select-md check_multiselect actq" placeholder="iFMS" multiple name="ifms[]" id="ifms" aria-label=".form-select-lg example">
						<?php
							$ifms_issues = allOptions('ifms_issues');
							foreach($ifms_issues as $ky=>$ifmsissues){
						?>
							<option value="<?=$ky;?>"><?=$ifmsissues;?> </option>
						<?php } ?>
					</select>
				</div>
				
				<div class="mb-3 d-none" id="otheriFMS" >
					<label class="form-label text-muted" >Other Issues with iFMS<span class="require">*</span></label>
					<input type="text" class="form-control" name="other_ifms" id="other_ifms" />
				</div>
				
				<div class="mb-3 d-none rq" id="related_question2" >
					<label class="form-label text-muted" >Issues with MoU <span class="require">*</span></label>
					<select class="form-select form-select-md check_multiselect actq" placeholder="MoU Signing" name="mous[]" multiple id="mous" aria-label=".form-select-lg example">
						<?php
							$mou_issues = allOptions('mou_issues');
							foreach($mou_issues as $key=>$mouissues){
						?>
							<option value="<?=$key;?>"><?=$mouissues;?> </option>
						<?php } ?>
					</select>
				</div>
				
				<div class="mb-3 d-none" id="otherMoU" >
					<label class="form-label text-muted" >Other Issues with MoU Signing<span class="require">*</span></label>
					<input type="text" class="form-control" name="other_mou" id="other_mou" />
				</div>
				
				<div class="mb-3 d-none rq" id="related_question3" >
					<label class="form-label text-muted" >Issues with PoS Machine <span class="require">*</span></label>
					<select class="form-select form-select-md check_multiselect actq" placeholder="PoS Machine" name="pos_machines[]" multiple id="pos_machines" aria-label=".form-select-lg example">
						<?php
							$pos_machine_issues = allOptions('pos_machine_issues');
							foreach($pos_machine_issues as $key=>$posmachine_issues){
						?>
							<option value="<?=$key;?>"><?=$posmachine_issues;?> </option>
						<?php } ?>
					</select>
				</div>
				
				<div class="mb-3 d-none" id="otherPoS" >
					<label class="form-label text-muted" >Other Issues with PoS Machine<span class="require">*</span></label>
					<input type="text" class="form-control" name="other_pos" id="other_pos" />
				</div>
				
				<div class="mb-3 d-none rq" id="related_question4" >
					<label class="form-label text-muted" >Issues with Testing of FOM/LFOM <span class="require">*</span></label>
					<select class="form-select form-select-md check_multiselect actq" placeholder="Testing of FOM/LFOM" name="testingIssues[]" multiple id="testingIssues" aria-label=".form-select-lg example">
						<?php
							$testing_issues = allOptions('testing_issues');
							foreach($testing_issues as $key=>$testingissues){
						?>
							<option value="<?=$key;?>"><?=$testingissues;?> </option>
						<?php } ?>
					</select>
				</div>
				
				<div class="mb-3 d-none" id="otherTesting" >
					<label class="form-label text-muted" >Other Issues with Testing of FOM/LFOM<span class="require">*</span></label>
					<input type="text" class="form-control" name="other_testing" id="other_testing" />
				</div>
				
				<div class="" >
					<div class="mb-3">
						<label class="form-label text-muted" >Details (50 words only) <span class="require">*</span> </label>
						<textarea class="form-control" name="remarks" required rows="3" placeholder="Description"></textarea>
					</div>
				</div>
				
				<div class="">
					<button type="submit" class="btn btn-primary w-25 float-end">Submit</button>
				</div>
			</form>
		</div>
		<div class="col-lg-3">
		<?php \Config\Services::validation()->listErrors(); ?>
		<?php if (! empty($errors)): ?>
			<div class="alert alert-danger" role="alert">
				<ol>
				<?php foreach ($errors as $error): ?>
					<li class="liErr"><?= esc($error) ?></li>
				<?php endforeach ?>
				</ol>
			</div>
		<?php endif ?>
		</div>
		
	</div>

</div>

</div>

<?= $this->endSection(); ?>




<?= $this->section('script'); ?>

<script src="<?= base_url(); ?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins.js"></script>
<script src="<?= base_url(); ?>assets/js/main.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap-multiselect.js"></script>


<script>
	$(document).ready(function() {
		$("#issue_related").on("change", function(){
			//var rtissues = $(this).val();
			var rtissues = $("#issue_related :selected").map(function(i, el) {
				return $(el).val();
			}).get();
			$(".rq").addClass("d-none");
			$(".actq").attr("required",false);
			var rqrd = {1:'ifms',2:'mous',3:'pos_machines',4:'testingIssues'};
			$.each(rtissues, function(k,v){
				$("#related_question"+v).removeClass("d-none");
				$("#"+rqrd[v]).attr("required",true);
			});
			
			
			if(rtissues.length>0 && $.inArray("1",rtissues)!==-1){
				var ifmsIssues = $("#ifms :selected").map(function(i, el) {
					return $(el).val();
				}).get();
				if(($.inArray("3",ifmsIssues)!==-1) && ($.inArray("1",rtissues)!==-1)){
					$("#otheriFMS").removeClass('d-none');
					$("#other_ifms").attr('required', true);
				}
			}else{
				$("#related_question1.rq div.SumoSelect.sumo_ifms div.optWrapper.selall.multiple ul.options li.opt.selected").trigger('click');
				$("#otheriFMS").addClass('d-none');
				$("#other_ifms").attr('required', false);
			}
			
			///mous
			if(rtissues.length>0 && $.inArray("2",rtissues)!==-1){
				var v1 = $("#mous :selected").map(function(i, el) {
					return $(el).val();
				}).get();
				if(($.inArray("3",v1)!==-1) && ($.inArray("1",rtissues)!==-1)){
					$("#otherMoU").removeClass('d-none');
					$("#other_mou").attr('required', true);
				}
			}else{
				$("#related_question2.rq div.SumoSelect.sumo_ifms div.optWrapper.selall.multiple ul.options li.opt.selected").trigger('click');
				$("#otherMoU").addClass('d-none');
				$("#other_mou").attr('required', false);
			}
			
			///pos_machines
			if(rtissues.length>0 && $.inArray("2",rtissues)!==-1){
				var v1 = $("#pos_machines :selected").map(function(i, el) {
					return $(el).val();
				}).get();
				if(($.inArray("6",v1)!==-1) && ($.inArray("1",rtissues)!==-1)){
					$("#otherPoS").removeClass('d-none');
					$("#other_pos").attr('required', true);
				}
			}else{
				$("#related_question3.rq div.SumoSelect.sumo_ifms div.optWrapper.selall.multiple ul.options li.opt.selected").trigger('click');
				$("#otherPoS").addClass('d-none');
				$("#other_pos").attr('required', false);
			}
			
			///testingIssues
			if(rtissues.length>0 && $.inArray("2",rtissues)!==-1){
				var v1 = $("#testingIssues :selected").map(function(i, el) {
					return $(el).val();
				}).get();
				if(($.inArray("6",v1)!==-1) && ($.inArray("1",rtissues)!==-1)){
					$("#otherTesting").removeClass('d-none');
					$("#other_testing").attr('required', true);
				}
			}else{
				$("#related_question4.rq div.SumoSelect.sumo_ifms div.optWrapper.selall.multiple ul.options li.opt.selected").trigger('click');
				$("#otherTesting").addClass('d-none');
				$("#other_testing").attr('required', false);
			}
			
			
			
		});
		
		
		$("#ifms").on("change", function(){
			let ifmsIssues = $(this).val();
			console.log(ifmsIssues);
			$("#otheriFMS").addClass('d-none');
			$("#other_ifms").attr('required', false);
			var issue_relateds = $("#issue_related :selected").map(function(i, el) {
				return $(el).val();
			}).get();
			if(($.inArray("3",ifmsIssues)!==-1) && ($.inArray("1",issue_relateds)!==-1)){
				$("#otheriFMS").removeClass('d-none');
				$("#other_ifms").attr('required', true);
			}
		});
		
		$("#mous").on("change", function(){
			let mouIssues = $(this).val();
			console.log(mouIssues);
			$("#otherMoU").addClass('d-none');
			$("#other_mou").attr('required', false);
			if($.inArray("3",mouIssues)!==-1){
				$("#otherMoU").removeClass('d-none');
				$("#other_mou").attr('required', true);
			}
		});
		
		$("#pos_machines").on("change", function(){
			let pos_machinesIssues = $(this).val();
			console.log(pos_machinesIssues);
			$("#otherPoS").addClass('d-none');
			$("#other_pos").attr('required', false);
			if($.inArray("6",pos_machinesIssues)!==-1){
				$("#otherPoS").removeClass('d-none');
				$("#other_pos").attr('required', true);
			}
		});
		
		$("#testingIssues").on("change", function(){
			let testingIssuesIssues = $(this).val();
			console.log(testingIssuesIssues);
			$("#otherTesting").addClass('d-none');
			$("#other_testing").attr('required', false);
			if($.inArray("4",testingIssuesIssues)!==-1){
				$("#otherTesting").removeClass('d-none');
				$("#other_testing").attr('required', true);
			}
		});
		
	});
</script>


<?= $this->endSection(); ?>