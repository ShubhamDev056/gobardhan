<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>

<link rel="stylesheet" href="<?= base_url(); ?>assets/css/plugins.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-multiselect.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<style>
.table-header th{
	background-color:lightblue;
}	

</style>


<div class="container mt-2 mb-5">
	<div class="row justify-content-center"> 
		<div class="col-lg-12">
			<h4>Reports</h4>
			 
			<table class="table table-bordered">
				<tr class="table-header">
					<th width="5%">#SN</th>
					<th>Report</th>
				</tr>
				<tr>
					<td>1</td>
					<td>
						<a class="" href="<?=base_url()?>ministry-report" > Ministry Wise CBG Benefits Report</a>
					</td>
				</tr>
				<tr>
					<td>2</td>
					<td>
						<a class="" href="<?=base_url();?>ddws-report"> Year Wise DDWS Report </a>
					</td>
				</tr>
				<tr>
					<td>3</td>
					<td>
						<a class="" href="<?=base_url();?>monthly-update-report"> Details Functionality Assessment Report </a>
					</td>
				</tr>
				<tr>
					<td>4</td>
					<td>
						<a class="" href="<?=base_url();?>state-wise-monthly-report"> State Wise Functionality Assessment Monthly Report  </a>
					</td>
				</tr>
				<tr>
					<td>5</td>
					<td>
						<a class="" href="<?=base_url();?>monthly-update-report-cbg" > Details Functionality Assessment Report CBG </a>
					</td>
				</tr>
				<tr>
					<td>6</td>
					<td>
						<a class="" href="<?=base_url();?>state-wise-monthly-report-cbg" > State Wise Functionality Assessment Monthly Report CBG </a>
					</td>
				</tr>
				<tr>
					<td>7</td>
					<td>
						<a class="" href="<?=base_url();?>mda-issues" > MDA Issues  </a>
					</td>
				</tr>
				<tr>
					<td>8</td>
					<td>
						<a class=""  href="<?=base_url();?>offtake-issues"  > Offtake Issues </a>
					</td>
				</tr>  
				
			</table>
			
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

<?= $this->endSection(); ?>