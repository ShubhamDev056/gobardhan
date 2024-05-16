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
					Add Bank Details
				</h3>
			</div>
			<form method="post" enctype="multipart/form-data">
				<div class="form-check d-flex gap-5 ps-0 mb-3">
					<label class="form-check-label text-capitalize text-muted" for="#">Have you applied for Bank Loan</label>
					<div>
						<input class="form-check-input" id="flexRadioDefault1" type="radio" value="Yes" name="bankloan_applied" required />
						<label class="form-check-label text-capitalize text-muted" for="flexRadioDefault1" id="showForm" >Yes</label>
					</div>
					<div>

						<input class="form-check-input" id="flexRadioDefault2" type="radio" name="bankloan_applied" value="No" required />
						<label class="form-check-label text-capitalize text-muted" for="flexRadioDefault2" id="hideForm"  >No</label>
					</div>
				</div>
				
				<div class="form-content" id="form_content">
					<div class="form-check  gap-5 ps-0 mb-3">
						<label class="form-check-label text-capitalize text-muted" for="#">Loan Availed From</label>
						<div>
							<input class="form-check-input ml-1 availedFrom" id="availedbank" type="radio" value="bank" name="availed_from" required />
							<label class="form-check-label text-capitalize text-muted ml-4" for="availedbank" id="avldfrombank" >Public/Private Sector Banks</label>
						</div>
						<div>

							<input class="form-check-input m-1 availedFrom" id="availedIreda" type="radio" name="availed_from" value="ireda" required />
							<label class="form-check-label text-capitalize text-muted ml-4" for="availedIreda" id="avldireda"  >Others (IREDA/Financial Institution etc.)</label>
						</div>
					</div>
				
					<label class="text-muted">IFSC Code <span class="require">*</span> </label> <br>
					<div class="input-group">
						<input type="text" name="ifsc_code" id="ifsc_code" class="form-control text-uppercase" maxlength="11" >
						<button type="button" id="searchBank" class="input-group-text bg-primary text-white" style="height: 40px; margin-top: -1px;">Search</button>
					</div>
					<span class="text-danger" id="ifsc_code_err"></span>
					
					<div class="form-group d-none" id="bankInfo">
						<div class="mb-3">
							<label class="form-label text-muted" >Bank Name </label>
							<input type="text" name="bank_name" id="bank_name" class="form-control"  readonly >
						</div>
						<div class="mb-3">
							<label class="form-label text-muted" >Location State</label>
							<input type="text" name="bank_state" id="bank_state" class="form-control" readonly >
						</div>
						<div class="mb-3">
							<label class="form-label text-muted" >District Name</label>
							<input type="text" name="bank_district" id="bank_district" class="form-control"  readonly >
						</div>
						<div class="mb-3 form-group">
							<label class="form-label text-capitalize text-muted" >City</label>
							<input type="text" name="bank_city" id="bank_city" class="form-control"  readonly >
						</div>
						<div class="mb-3 form-group">
							<label class="form-label text-muted" >Branch</label>
							<input type="text" name="bank_branch" id="bank_branch" class="form-control"  readonly >
						</div>
					</div>
					
					<div class="mb-3">
						<label class="form-label text-muted" for="basic-url">Status of loan application <span class="require">*</span></label>
						<select class="form-select form-select-md" name="loan_status" id="loan_status" aria-label=".form-select-lg example">
							<option selected hidden value=""></option>
							<option value="1">Sanctioned </option>
							<option value="3">Pending with bank</option>
							<option value="4">Rejected</option>
						</select>
					</div>
					
					<div class="mb-3">
						<label class="form-label text-muted" >Loan account ID <span></span> </label>
						<input class="form-control text-muted" type="number" name="loan_account_id" id="loan_account_id"  />
					</div>

					<div class="mb-3">
						<label class="form-label text-muted" >Branch contact number </label>
						<input class="form-control text-muted"  type="number" name="branch_contact"  />
					</div>

					<div class="mb-3">
						<label class="form-label text-muted" >Loan amount (in Crores) <span class="require">*</span></label>
						<input class="form-control" type="number" min="0" max="99999" name="loan_ammount" />
					</div>

					<div class="mb-3 d-none">
						<label class="form-label text-muted" for="basic-url">Documents submitted</label>
						<select class="form-select form-select-md" name="document_submitted" aria-label=".form-select-lg example">
							<option selected hidden value="">Select Documents</option>
						</select>
					</div>

					<div class="mb-3">
						<label class="form-label  text-muted" for="exampleFormControlInput1">Application submission date  </label>
						<input class="form-control" name="loan_apply_date" type="date" placeholder="Loan amount" />
					</div>
					
					<div class="d-none" id="sanctioned_sec">
						<div class="mb-3" >
							<label class="form-label text-muted"  >Sanctioned amount  (in Crores) * </label>
							<input class="form-control" name="sanctioned_amount" id="sanctioned_amount" type="number"  />
						</div>
						<div class="mb-3" >
							<label class="form-label text-muted"  >Sanctioned Date * </label>
							<input class="form-control" name="sanctioned_date" id="sanctioned_date" type="date"  />
						</div>
						<div class="mb-3" >
							<label class="form-label text-muted"  >Upload sanctioned letter (Max: 10MB) </label>
							<input class="form-control" name="sanctioned_doc" id="sanctioned_doc" type="file" accept=".pdf" />
							<span class="text-danger" id="sanctioned_doc_err"></span>
						</div>
					</div>
					
					<div class="d-none" id="rejected_sec">
						<div class="mb-3">
							<label class="form-label text-muted" >Date of rejection </label>
							<input type="date" name="reject_date" class="form-control" />
						</div>
						<div class="mb-3">
							<label class="form-label text-muted" >Reason for rejection </label>
							<textarea class="form-control" name="reason" id="reason" rows="3" placeholder="Reason"></textarea>
						</div>
						
					</div>
				</div>
				<div class="d-none" id="pending_sec">
					<div class="mb-3">
						<label class="form-label text-muted" >Remarks</label>
						<textarea class="form-control" name="remarks" rows="3" placeholder="Description"></textarea>
					</div>
				</div>
				<div class="mb-3">
					<div class="check-inline" id="tc" >
						<label class="form-check-label" for="a">
							<input class="form-check-input " name="privacy" type="checkbox" value="108" required data-requiredchild="privacy" id="privacy"> 
							<label class="form-check-label ms-2" > I hereby declare that the above particulars of facts and information stated are true, correct and complete to the best of my belief and knowledge. </label>
						</label>
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
		$(".availedFrom").on("click", function(){
			var avdFrom = $(this).val();
			$("#searchBank").show();
			$("#bankInfo").addClass('d-none');
			$("#bank_name").attr('readonly', true);
			$("#bank_state").attr('readonly', true);
			$("#bank_district").attr('readonly', true);
			$("#bank_city").attr('readonly', true);
			$("#bank_branch").attr('readonly', true);
			if(avdFrom=="ireda"){
				$("#searchBank").hide();
				$("#bankInfo").removeClass('d-none');
				$("#bank_name").attr('readonly', false);
				$("#bank_state").attr('readonly', false);
				$("#bank_district").attr('readonly', false);
				$("#bank_city").attr('readonly', false);
				$("#bank_branch").attr('readonly', false);
			}
			
		});
		
		
		$("#flexRadioDefault1").on('click', function() {
			$("#form_content").show(1000);
		});

		$("#flexRadioDefault2").on('click', function() {
			$("#form_content").hide(1000);
		});
		
		$("#loan_status").on("change",function(){
			$("#sanctioned_sec").addClass("d-none");
			$("#rejected_sec").addClass("d-none");
			$("#pending_sec").addClass("d-none");
			$("#sanctioned_amount").val("");
			$("#sanctioned_amount").attr('required', false);
			$("#sanctioned_date").attr('required', false);
			// $("#loan_account_id").attr('required', true);
			// $("#loanAccId").show();
			
			if($(this).val()==1){
				$("#sanctioned_sec").removeClass("d-none");
				$("#sanctioned_amount").attr('required', true);
				$("#sanctioned_date").attr('required', true);
			}
			
			if($(this).val()==4){
				$("#rejected_sec").removeClass("d-none");
				$("#reason").attr('required', true);
				$("#reject_date").attr('required', true);
			}
			if($(this).val()==2 || $(this).val()==3){
				$("#pending_sec").removeClass("d-none");
			}
			
			// if($(this).val()==6){
				// $("#loan_account_id").attr('required', false);
				// $("#loanAccId").hide();
			// }
			
		})
		
		$("#sanctioned_doc").on("change", function () {
			$("#sanctioned_doc_err").html('');
			var extension = $(this).val().split('.').pop().toLowerCase();
			var validFileExtensions = ['pdf', 'doc'];
			
			var sizebyte = this.files[0].size;
			var sizekb = Math.round((sizebyte / 1024));
			if ($.inArray(extension, validFileExtensions) == -1) {
				$("#sanctioned_doc_err").html('Failed!! Please upload pdf file only.!!');
				$(this).val('');
			}else{
				if( sizekb > 10240) { // 10MB
				   $("#sanctioned_doc_err").html('Please upload file less than 10MB. Thanks!!');
				   $(this).val('');
				}
			}
		});
		
		$("#searchBank").on("click", function(){
			$("#bankInfo").addClass(' d-none');
			let ifsccode = $("#ifsc_code").val();
			$("#bank_name").val('');
			$("#bank_state").val('');
			$("#bank_district").val('');
			$("#bank_city").val('');
			$("#bank_branch").val('');
			if(ifsccode!=""){
				let ifscUrl = "https://ifsc.razorpay.com/"+ifsccode;
				$.ajax({
					url:ifscUrl,
					success:function(res){
						console.log(res);
						if(res.BRANCH!=""){
							$("#bankInfo").removeClass('d-none');
							$("#bank_name").val(res.BANK);
							$("#bank_state").val(res.STATE);
							$("#bank_district").val(res.DISTRICT);
							$("#bank_city").val(res.CITY);
							$("#bank_branch").val(res.BRANCH);
						}else{
							$("#ifsc_code_err").html('Invalid IFSC Code.');
						}
					}
				}).fail(function (jqXHR, textStatus, error) {
					console.log(error);
					$("#ifsc_code_err").html('Invalid IFSC Code.');
				})
			}else{
				$("#ifsc_code_err").html('Please Enter IFSC Code.');
			}
		})
	});
</script>


<?= $this->endSection(); ?>