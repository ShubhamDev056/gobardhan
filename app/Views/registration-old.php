<?= $this->extend('layouts/layout'); ?>
<?= $this->section('breadcrum'); ?>
<div class="container">
	<div class="page-banner row align-items-center position-relative">

		<!-- Page Title -->
		<div class="col-lg-6 col-12">
			<h1 class="page-title">Registration</h1>
		</div>

		<!-- Page Breadcrumb -->
		<div class="col-lg-6 col-12">
			<ul class="page-breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Registration</li>
			</ul>
		</div>

	</div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>

<style>
	.tooltextleft {
		text-align: left;
	}
</style>


<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-12">
			<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
				<h2 id="heading">One-time registration </h2>

				<form method="get" action="<?= base_url(); ?>login">
					<div class="row">
						<div class="col-6 mb-3 mt-3">
							<label for="name" class="form-label">Name * </label>
							<input type="text" class="form-control" onkeypress="return lettersOnly(event)" placeholder="Enter Name" name="name" id="name">
						</div>

					
						<div class="col-5 mb-3 mt-3">
							<label for="email" class="form-label">Mail Id * </label>
							<input type="email" class="form-control" placeholder="Enter Email" name="email">
							
						</div>

						<div class="col-1" style="line-height:9;">
							<button class="btn btn-primary btn-sm">Send</button>
						</div>


					</div>

					<div class="row">
						<div class="col-5 mb-3 mt-3">
							<label for="contact_number" class="form-label">Contact number * </label>
							<input type="number" class="form-control" onkeypress="return isNumber(event)" data-validation-regexp="^([0-9- ]+)$" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" placeholder="Enter Contact Number" name="contact_number">
						</div>
						<div class="col-1" style="line-height:9;">
							<button class="btn btn-primary btn-sm">Send</button>
						</div>

						<div class="col-6 mb-3 mt-3">
							<label for="password" class="form-label">Password * <i
									class="fa fa-info-circle tooltip-test" data-bs-toggle="tooltip"
									data-bs-placement="top" title="<div class='tooltextleft'>
										<p>1. Password must have an Uppercase and lowercase character </p>
										<p>2. Password should be at least 8 characters. </p>
										<p>3. Password must have a special character </p>
										<p>4. Password must have a number </p>
								</div>
								"></i> </label>
							<input type="password" class="form-control" autocomplete="on" placeholder="Enter Password"
								name="password" id="password">
							<span class="text-danger" id="password_err"></span>
						</div>
					</div>

					<div class="row">
						<div class="col-6 mb-3 mt-3">
							<label for="confirm_password" class="form-label">Confirm Password * </label>
							<input type="password" class="form-control" autocomplete="on" placeholder="Enter Confirm Password" name="confirm_password" id="confirm_password">
							<span id="confirm_password_err"></span>
						</div>

						<div class="col-2 mb-3 mt-3">
							<label for="captcha" class="form-label">Verify Captcha </label>
							<br>
							<span id="captcha-image">
								<?php echo $captcha; ?>
							</span>
							<a href="javascript:" class="ms-3" id="refreshCaptcha"> <i class="fa fa-refresh"></i></a>
						</div>

						<div class="col-4 mb-3 mt-3">
							<label for="captcha" class="form-label">Captcha * </label>
							<input type="text" class="form-control" placeholder="Enter captcha" name="captcha">
						</div>



					</div>

					<button type="submit" class="btn btn-primary float-end">Submit</button>
				</form>

			</div>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<script type="text/javascript">
	$(document).ready(function () {
		$("#refreshCaptcha").on("click", function () {
			$.ajax({
				url: "<?= base_url() ?>reg-captcha",
				type: "get",
				data: {},
				success: function (res) {
					$("#captcha-image").html(res);
				}
			});
		})
	});

	/*
	==============================================  
	FORM VALIDATION ==============================
	==============================================
	*/

	$("#password").on("keyup", function () {
		validatePassword($(this).val());
	});

	function validatePassword(password) {

		// Do not show anything when the length of password is zero.
		if (password.length === 0) {
			document.getElementById("msg").innerHTML = "";
			return;
		}
		// Create an array and push all possible values that you want in password
		var matchedCase = new Array();
		matchedCase.push("[$@$!%*#?&]"); // Special Charector
		matchedCase.push("[A-Z]");      // Uppercase Alpabates
		matchedCase.push("[0-9]");      // Numbers
		matchedCase.push("[a-z]");     // Lowercase Alphabates

		// Check the conditions
		var ctr = 0;
		for (var i = 0; i < matchedCase.length; i++) {
			if (new RegExp(matchedCase[i]).test(password)) {
				ctr++;
			}
		}
		// Display it
		var color = "";
		var strength = "";
		switch (ctr) {
			case 0:
			case 1:
			case 2:
				// strength = "Very Weak";
				strength = "❎ Please Enter Strong Password.";
				color = "red";
				break;
			case 3:
				// strength = "Medium";
				strength = "❎ Please Enter Strong Password.";
				color = "orange";
				break;
			case 4:
				// strength = "Strong";
				strength = "✅ Now you can set password.";
				color = "green";
				break;
		}
		document.getElementById("password_err").innerHTML = strength;
		//document.getElementById("strngmsg").style.color = color;

		//   var element = document.getElementById("password_err");
		//   element.classList.add("mystyle");
	}

	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}

	function lettersOnly(evt) {
		evt = (evt) ? evt : event;
		var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
			((evt.which) ? evt.which : 0));
		if (charCode > 31 && (charCode < 65 || charCode > 90) &&
			(charCode < 97 || charCode > 122)) {
			//alert("Enter letters only.");
			return false;
		}
		return true;
	}

	$('#password, #confirm_password').on('keyup', function () {
		if ($('#password').val() == $('#confirm_password').val()) {
			$('#confirm_password_err').html('').css('color', 'green');
		} else
			$('#confirm_password_err').html('Password and confirm password are not matching').css('color', 'red');
	});

	$(function () {
		$('.tooltip-test').tooltip({ html: true, placement: 'right' });
	});

	/**
	 * END FORM VALIDATION
	*/

</script>

<?= $this->endSection(); ?>