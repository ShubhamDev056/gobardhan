<?=$this->extend('layouts/layout');?>

<?=$this->section('breadcrum');?>
	<div class="container">
		<div class="page-banner row align-items-center position-relative">
			
			<!-- Page Title -->
			<div class="col-lg-6 col-12">
				<h1 class="page-title">Verification</h1>
			</div>
			
			<!-- Page Breadcrumb -->
			<div class="col-lg-6 col-12">
				<ul class="page-breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Verification</li>
				</ul>
			</div>
			
		</div>
	</div>
<?=$this->endSection(); ?>

<?=$this->section('content');?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-6 col-md-6">
				<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
					<h2 id="heading">OTP Verification</h2>

					<form method="get" action="<?=base_url()?>add-project">
						<div class="mb-3 mt-3">
						    <label for="mobileOtp" class="form-label"> OTP sent on mobile number <b>xxxxxxx643</b></label>
						    <input type="number" class="form-control"  placeholder="Enter Mobile OTP" autocomplete="off" name="reg_number">
						</div>

						<div class="mb-3">
						    <label for="emailOtp" class="form-label">OTP sent on mail <b>xxxxxxxxxxx@gmail.com</b></label>
						    <input type="number" class="form-control"  placeholder="Enter Email OTP" name="login_password">
						</div>
						<button type="submit" class="btn btn-primary float-end">Verify</button>
					</form>

				</div>
			</div>
		</div>
   </div>
	
<?=$this->endSection(); ?>