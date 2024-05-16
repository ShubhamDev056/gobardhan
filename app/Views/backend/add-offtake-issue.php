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
					CBG Offtake Issues
				</h3>
			</div>
			<form method="post" enctype="multipart/form-data">
				
				<div class="form-check gap-5 ps-0 mb-3">
					<label class="form-check-label text-capitalize text-muted" for="#">MoU signed under SATAT Scheme with OGMCs</label>
					
					<div class="d-flex gap-5 ps-0 ml-4">
						<div>
							<input class="form-check-input satat_scheme" id="ss1" type="radio" value="Yes" name="satat_scheme" required />
							<label class="form-check-label text-capitalize text-muted  for="ss1" >Yes</label>
						</div>
						
						<div>
							<input class="form-check-input satat_scheme" id="ss2" type="radio" name="satat_scheme" value="No" required />
							<label class="form-check-label text-capitalize text-muted" for="ss2"  >No</label>
						</div>
					</div>
					
				</div>
				
				<div class="mb-3 d-none" id="satat_ogmc_sec">
					<label class="form-label text-muted" >OGMC  <span class="require">*</span></label>
					<select class="form-select form-select-md" placeholder="Select OGMC" name="ogmc" id="issue_related" aria-label=".form-select-lg example">
						<option value="" hidden >Select OGMC </option>
						<?php 
							$satat_ogmc = allOptions('satat_ogmc');
							foreach($satat_ogmc as $key=>$satatogmc){ if($key==0){ continue; }
						?>
							<option value="<?=$key;?>"><?=$satatogmc;?></option>
						<?php } ?>
					</select>
				</div>
				
				<div class="form-check gap-5 ps-0 mb-3">
					<label class="form-check-label text-capitalize text-muted" for="#">MoU signed under CBG-CGD Synchronization scheme (GAIL)</label>
					
					<div class="d-flex gap-5 ps-0 ml-4">
						<div>
							<input class="form-check-input gailsec" id="flexRadioDefault1" type="radio" value="Yes" name="gail" required />
							<label class="form-check-label text-capitalize text-muted" for="flexRadioDefault1" >Yes</label>
						</div>
						
						<div>
							<input class="form-check-input gailsec" id="flexRadioDefault2" type="radio" name="gail" value="No" required />
							<label class="form-check-label text-capitalize text-muted" for="flexRadioDefault2" >No</label>
						</div>
					</div>
					
				</div>
				
				<div class="mb-3">
					<label class="form-label text-muted" >Designed CBG production Capacity (in TPD)  <span class="require">*</span></label>
					<input type="number" class="form-control"  name="prod_capacity" id="prod_capacity" required />
				</div>
				
				<div class="mb-3 d-none" id="signedwithsatat_sec">
					<label class="form-label text-muted" >Quantity for which commercial agreement signed with OGMCs for CBG offtake (in TPD)  <span class="require">*</span></label>
					<input type="number" class="form-control"  name="com_agre_signed" id="com_agre_signed" />
					<span class="text-danger" id="com_agre_signed_err"></span>
				</div>
				
				<div class="mb-3 d-none" id="gail_sec">
					<label class="form-label text-muted" >Quantity for which commercial agreement signed under CBG-CGD synchronization scheme (in TPD)  <span class="require">*</span></label>
					<input type="number" class="form-control"  name="com_agre_signed_cbg_cdg" id="com_agre_signed_cbg_cdg" />
					<span class="text-danger" id="com_agre_signed_cbg_cdg_err"></span>
				</div>
				
				<div class="mb-3">
					<label class="form-label text-muted" >Total CBG production in last 30 days (in Tons)  <span class="require">*</span></label>
					<input type="number" class="form-control"  name="avg_actual_prod" id="avg_actual_prod" required />
					<span class="text-danger" id="avg_actual_prod_err"></span>
				</div>
				
				<div class="mb-3 d-none" id="satat_sec">
					<label class="form-label text-muted" >Actual CBG offtake by OGMCs (SATAT) in last 30 days (in Tons)  <span class="require">*</span></label>
					<input type="number" class="form-control"  name="actual_offtake" id="actual_offtake" required />
					<span class="text-danger" id="actual_offtake_err"></span>
				</div>
				
				<div class="mb-3 d-none" id="cbggail_sec">
					<label class="form-label text-muted" >CBG supplied under CBG-CGD Synchronization scheme in last 30 days (Tons) <span class="require">*</span></label>
					<input type="number" class="form-control"  name="cbg_supplied_sync" id="cbg_supplied_sync" required />
					<span class="text-danger" id="cbg_supplied_sync_err"></span>
				</div>
				
				<div class="mb-3">
					<label class="form-label text-muted" >Other sale  (Industrial/Own RO) in last 30 days (Tons) <span class="require">*</span></label>
					<input type="number" class="form-control"  name="other_sale" id="other_sale" required />
					<span class="text-danger" id="other_sale_err"></span>
				</div>
				<div class="mb-3">
					<label class="form-label text-muted" >Own Consumption in last 30 days (Tons) <span class="require">*</span></label>
					<input type="number" class="form-control"  name="internal_consumption" id="internal_consumption" required />
					<span class="text-danger" id="internal_consumption_err"></span>
				</div>
				<div class="mb-3">
					<label class="form-label text-muted" >Flaring/ wastages in last 30 days (Tons) <span class="require">*</span></label>
					<input type="number" class="form-control"  name="flaring_wastage" id="flaring_wastage" required />
					<span class="text-danger" id="flaring_wastage_err"></span>
				</div>
				
				
				
				
				<div class="" >
					<div class="mb-3">
						<label class="form-label text-muted" >Remarks (50 words only) <span class="require">*</span> </label>
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
		
		$(".satat_scheme").on("change", function(){
			$("#satat_ogmc_sec").addClass("d-none");
			$("#signedwithsatat_sec").addClass("d-none");
			$("#satat_sec").addClass("d-none");
			if($(this).val()=="Yes"){
				$("#satat_ogmc_sec").removeClass("d-none");
				$("#signedwithsatat_sec").removeClass("d-none");
				$("#satat_sec").removeClass("d-none");
			}
		});
		
		$(".gailsec").on("change", function(){
			$("#gail_sec").addClass("d-none");
			$("#cbggail_sec").addClass("d-none");
			if($(this).val()=="Yes"){
				$("#gail_sec").removeClass("d-none");
				$("#cbggail_sec").removeClass("d-none");
			}
		});
		
		
		
		$("#issue_related").on("change", function(){
			var rtissue = $(this).val();
			$("#tech_issue").addClass("d-none");
			$("#opr_issue").addClass("d-none");
			
			if($.inArray("1", rtissue) != -1) {
				$("#tech_issue").removeClass("d-none");
			}
			
			if($.inArray("2", rtissue) != -1) {
				$("#opr_issue").removeClass("d-none");
			}
		});
		
		$("")
		
		$("#com_agre_signed").on("keyup", function(){
			var mx = $("#prod_capacity").val();
			$(this).parent().find("#com_agre_signed_err").html('');
			$("#com_agre_signed").attr("min",1);
			if(parseInt(this.value)>parseInt(mx)){
				this.value=0;
				$(this).parent().find("#com_agre_signed_err").html('Value Exceeded the designed capacity');
			}else if(this.value<0){this.value=mx;}
		});
		
		$("#com_agre_signed_cbg_cdg").on("keyup", function(){
			var mx = $("#prod_capacity").val();
			$("#com_agre_signed_cbg_cdg").attr("min",1);
			$(this).parent().find("#com_agre_signed_cbg_cdg_err").html('');
			if(parseInt(this.value)>parseInt(mx)){
				this.value=0;
				$(this).parent().find("#com_agre_signed_cbg_cdg_err").html('Value Exceeded the designed capacity');
			}else if(this.value<0){this.value=mx;}
		});
		
		
		
		$("#actual_offtake").on("keyup", function(){
			var mx = $("#avg_actual_prod").val();
			$(this).parent().find("#actual_offtake_err").html('');
			$("#actual_offtake").attr("min",1);
			if(parseInt(this.value)>parseInt(mx)){
				this.value=0;
				$(this).parent().find("#actual_offtake_err").html('Value Exceeded the production capacity');
			}else if(this.value<0){this.value=mx;}
		});
		
		$("#cbg_supplied_sync").on("keyup", function(){
			var mx = $("#avg_actual_prod").val();
			$("#cbg_supplied_sync").attr("min",1);
			$(this).parent().find("#cbg_supplied_sync_err").html('');
			if(parseInt(this.value)>parseInt(mx)){
				this.value=0;
				$(this).parent().find("#cbg_supplied_sync_err").html('Value Exceeded the production capacity');
			}else if(this.value<0){this.value=mx;}
		});
		
		$("#other_sale").on("keyup", function(){
			var mx = $("#avg_actual_prod").val();
			$("#other_sale").attr("min",1);
			$(this).parent().find("#other_sale_err").html('');
			if(parseInt(this.value)>parseInt(mx)){
				this.value=0;
				$(this).parent().find("#other_sale_err").html('Value Exceeded the production capacity');
			}else if(this.value<0){this.value=mx;}
		});
		
		$("#internal_consumption").on("keyup", function(){
			var mx = $("#avg_actual_prod").val();
			$("#internal_consumption").attr("min",1);
			$(this).parent().find("#internal_consumption_err").html('');
			if(parseInt(this.value)>parseInt(mx)){
				this.value=0;
				$(this).parent().find("#internal_consumption_err").html('Value Exceeded the production capacity');
			}else if(this.value<0){this.value=mx;}
		});
		
		$("#flaring_wastage").on("keyup", function(){
			var mx = $("#avg_actual_prod").val();
			$("#flaring_wastage").attr("min",1);
			$(this).parent().find("#flaring_wastage_err").html('');
			if(parseInt(this.value)>parseInt(mx)){
				this.value=0;
				$(this).parent().find("#flaring_wastage_err").html('Value Exceeded the production capacity');
			}else if(this.value<0){this.value=mx;}
		});
		
	});
</script>


<?= $this->endSection(); ?>