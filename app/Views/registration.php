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
	#email_verified_msg{
		font-weight: bold;
		color: green;
	}
	.login-right:before {
		background: #d0e091;
	}
	.login-right, .login-right h2{
		color: #000;
	}
</style>


<div class="container">
	<div class="row justify-content-center">
		<div class="col-8 col-md-8 mt-3" style="border: 1px solid rgba(0,0,0,.125);">
		<h2 id="heading">One-time registration </h2>
			<div class=" px-0 pb-0 mt-3 mb-3">
				
				
				<?php \Config\Services::validation()->listErrors(); ?>
				<?php if (! empty($errors)): ?>
					<div class="alert alert-danger" role="alert">
						<ul>
						<?php foreach ($errors as $error): ?>
							<li><?= esc($error) ?></li>
						<?php endforeach ?>
						</ul>
					</div>
				<?php endif ?>
				<form method="post" action="<?= base_url(); ?>registration-save">
					<div class="row">
						<div class="col-12 mt-3">
							<!--<label for="name" class="form-label">Name * </label>-->
							<input type="text" class="form-control"   placeholder="Enter Name of Authorised Person *" name="name" id="name" value="<?=set_value('name') ?>">
						</div>
						<div class="col-12 mt-3">
							<input type="text" class="form-control" required placeholder="Enter Designation of the Authorised Person *" name="designation" id="designation"  value="<?=set_value('designation') ?>" >
						</div>

					
						<div class="col-10 mt-3">
							<!--<label for="email" class="form-label">Mail Id * </label>-->
							<input type="email"  class="form-control" placeholder="Enter Email of Authorised Person *" name="email" id="email" value="<?=set_value('email') ?>">
						</div>

						<div class="col-2 mt-3" >
							<button type="button" id="emailOtpBtn" class=" form-control btn btn-primary btn-sm">Send OTP</button>
						</div>
						
						<div class="col-10 mt-3" id="email_otp_sec">
							<input type="password" class="form-control" placeholder="Enter Email OTP" name="email_otp" id="email_otp">
							<span style="color:green;">OTP send to the email id</span>
						</div>
						<div class="col-10 mt-3" id="email_verified_msg">
							
						</div>

						<div class="col-2 mt-3" id="email_verify_sec">
							<button type="button" id="verifyBtn" class=" form-control btn btn-primary btn-sm">Verify</button>
						</div>


					</div>

					<div class="row">
						<div class="col-12 mt-3">
							<input type="text" required class="form-control" value="<?=set_value('contact_number') ?>" onkeypress="return isNumber(event)" data-validation-regexp="^([0-9- ]+)$" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" placeholder="Enter Mobile Number of Authorised Person *" name="contact_number">
						</div>

						<div class="col-2 mt-3" style="display:none">
							<button type="button" id="mobileOtpBtn" class="form-control btn btn-primary btn-sm">Send OTP</button>
						</div>
						
						<div class="col-12 mt-3" id="mobile_otp_sec">
							<input type="number" class="form-control" placeholder="Enter Mobile OTP" name="mobile_otp">
						</div>
						
						<div class="col-12 mt-3">
							<input type="text" class="form-control" required placeholder="Enter Username *" name="username" id="username"  value="<?=set_value('username') ?>" >
						</div>
						<div class="col-6 mt-3">
							<input type="password" required class="form-control" autocomplete="on" placeholder="Enter Password *" name="password" id="password">
							<span class="text-danger" id="password_err"></span>
						</div>
						<div class="col-6 mt-3">
							<input type="password" required class="form-control" autocomplete="on" placeholder="Confirm Password *" name="confirm_password" id="confirm_password">
							<span id="confirm_password_err"></span>
						</div>
					</div>

					<div class="row">
						

						<div class="col-3 mt-3">
							
							<span id="captcha-image">
								<?php echo $captcha; ?>
							</span>
							<a href="javascript:" class="ms-3" id="refreshCaptcha"> <i class="fa fa-refresh"></i></a>
						</div>

						<div class="col-9 mt-3">
							<input type="text" class="form-control" placeholder="Enter captcha" name="captcha">
						</div>
					</div>
                     <br/>
					<button type="submit" class="btn btn-primary float-right">Submit</button>
					 <br/>
					  <br/>
				</form>

			</div>
		</div>
		<div class="col-md-4 mt-3">
			<div class="login-right">
				<div class="login-right-header">
					<h2><strong>Basic Information</strong> </h2>
				</div>
				<ol>
				<li>All fields are mandatory.</li>
					<li>Password must have an uppercase and lowercase character.</li>
					<li>Password should be at least 8 characters.</li>
					<li>Password must have a special character.</li>
					<li>Password must have a number.</li>
					<li>All official communication and registration certificate will be sent to the mobile number and email of the authorised person. </li>
				</ol>
			</div>
			
		</div>
		
	</div>
</div>
<div class="col-12" style="height:100px">
							
							&nbsp;
						</div>
<?= $this->endSection(); ?>


<?= $this->section('script'); ?>

<script src="<?=base_url();?>assets/assets/js/aes.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#email_otp_sec").hide();
		$("#mobile_otp_sec").hide();
		$("#email_verify_sec").hide();
		$("#email_verified_msg").hide();
		
		$("#email_otp").on("keypress keyup blur",function (event) {    
		   $(this).val($(this).val().replace(/[^\d].+/, ""));
			if ((event.which < 48 || event.which > 57)) {
				event.preventDefault();
			}
		});
		
		function showsendbtn(){
			$("#emailOtpBtn").attr('disabled', false);
		}
		
		var nofTimeSendOTP = 0;
		$("#emailOtpBtn").on("click", function(){
			
		    nofTimeSendOTP++;
		    console.log(nofTimeSendOTP);
		    if(nofTimeSendOTP>3){
		        setCookie('OTPREQUESTEXPIRE','YES',1);
		    }
		    //setCookie('OTP','satyendra',1);
		    var OTPREQUESTEXPIRE = getCookie('OTPREQUESTEXPIRE');
		    //console.log(OTPREQUESTEXPIRE);
		    
			let email = btoa($("#email").val());
			$(this).html('Resend OTP');
			$(this).attr('disabled', true);
			setTimeout(showsendbtn, 1000*60*2);
			if(email!=""){
				$.ajax({
					url:"<?=base_url()?>send-otp",
					type:"post",
					data:{email:email},
					dataType:"json",
					success:function(res){
						console.log(res);
						if(res.status){
							$("#email_otp_sec").show();
							$("#email_verify_sec").show();
						}else{
							alert(res.message);
						}
						
					}
				})
			}else{
				console.log('Email address are required. ');
			}
		});
		
		$("#verifyBtn").on("click", function(){
			
			let emailOTP = $("#email_otp").val();
			if(emailOTP!=""){
			    emailOTP = btoa(emailOTP);
				$.ajax({
					url:"<?=base_url()?>verify-otp",
					type:"post",
					data:{emailOTP:emailOTP},
					success:function(res){
						let ress = JSON.parse(res);
						if(ress.status==1){
							$("#email_otp_sec").hide();
							$("#email_verify_sec").show();
							$("#email_verified_msg").show();
							$("#email_verified_msg").html('<i class="fa fa-check " style="border: 1px solid lightgreen; padding: 9px; border-radius: 50%;"></i> Email Verified');
						}else{
							$("#email_verified_msg").show();
							$("#email_verified_msg").html('<i class="fa fa-close" style="color: red; border: 1px solid red; border-radius: 50%; padding: 7px;"></i> Invalid OTP');
						}
					}
				})
			}else{
				console.log('Please enter OTP from your email.');
			}
			
		})
		
		$("#mobileOtpBtn").on("click", function(){
			$("#mobile_otp_sec").show();
		});
		
		$("#refreshCaptcha").on("click", function () {
			$.ajax({
				url: "<?= base_url() ?>reg-captcha",
				type: "get",
				data: {},
				success: function (res) {
					$("#captcha-image").html(res);
				}
			});
		});
		

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

	
	var CryptoJSAesJson = {
		stringify: function (cipherParams) {
			var j = {ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)};
			if (cipherParams.iv) j.iv = cipherParams.iv.toString();
			if (cipherParams.salt) j.s = cipherParams.salt.toString();
			return JSON.stringify(j);
		},
		parse: function (jsonStr) {
			var j = JSON.parse(jsonStr);
			var cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Base64.parse(j.ct)});
			if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv)
			if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s)
			return cipherParams;
		}
	}
	// $('#password, #confirm_password').on('keyup', function () {
		
		// if ($('#password').val() == $('#confirm_password').val()) {
			// $('#confirm_password_err').html('').css('color', 'green');
		// } else
			// $('#confirm_password_err').html('Password and confirm password are not matching').css('color', 'red');
	// });

	$(function () {
		$('.tooltip-test').tooltip({ html: true, placement: 'right' });
	});

	/**
	 * END FORM VALIDATION
	*/


    function setCookie(key, value, expiry) {
        var expires = new Date();
        // expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000)); // one day
        expires.setTime(expires.getTime() + (expiry * 60 * 1000));
        document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
    }
    
    function getCookie(key) {
        var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
        return keyValue ? keyValue[2] : null;
    }

    function eraseCookie(key) {
        var keyValue = getCookie(key);
        setCookie(key, keyValue, '-1');
    }
	
	
	
	$('#password').on('blur', function () {
		var encryptedPass = CryptoJS.AES.encrypt(JSON.stringify($(this).val()), "<?=ENC_KEY;?>", {format: CryptoJSAesJson}).toString();
		$(this).val(encryptedPass);
		
	});
	
	$('#confirm_password').on('blur', function () {
		var encryptedConfPass = CryptoJS.AES.encrypt(JSON.stringify($(this).val()), "<?=ENC_KEY;?>", {format: CryptoJSAesJson}).toString();
		$(this).val(encryptedConfPass);
	});
</script>

<?= $this->endSection(); ?>