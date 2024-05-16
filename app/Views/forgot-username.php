<?=$this->extend('layouts/layout');?>
<?=$this->section('content');?>
	
	<div id="loader"></div>
	
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-12">
				<h2 id="heading">Forgot Username</h2>
				
				<form method="post" id="fuser">
					<div class="row">
					    <div class="col-sm-12">
							<div class="mt-3">
								<input type="email" class="form-control" id="email" autocomplete="off"  placeholder="Enter registered email Id" name="email">
								<span class="text-danger" id="emailId_err"></span>
							</div>
						</div>
						<div class="col-sm-8">
							<div class="mt-3">
								<input type="text" class="form-control" id="fcaptcha" autocomplete="off"  placeholder="Enter captcha" name="fcaptcha">
								<span class="text-danger" id="fcaptcha_err"></span>
							</div>
						</div>
						
						<div class="col-sm-2">
							<div class="form-group mt-3">
    							<span id="captcha-image">
    								<?php echo $captchaImg; ?>
    							</span>
    							<a href="javascript:" class="ms-3 refreshCaptcha" id="refreshCaptcha"> <i class="fa fa-refresh"></i></a>
    						</div>
						</div>
						
						
						
						<div class="col-sm-2">
							<div class="mt-3">
								<button type="button" class="btn btn-primary form-control" id="sendOtpBtn">Send OTP</button>
							</div>
						</div>
					</div>
					<div class="row" id="uotp">
						<div class="col-sm-10">
							<div class="mt-3">
								<input type="password" class="form-control" id="forgotOTP"  autocomplete="off" placeholder="Enter OTP" name="forgotOTP">
								<span class="text-danger" id="forgotOTP_err"></span>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="mt-3">
								<button type="button" class="btn btn-primary form-control"  id="otpVerifyBtn" >Verify OTP </button>
							</div>
						</div>
					</div>
				</form>
				
			</div>
		</div>
   </div>
	
<?=$this->endSection(); ?>

<?=$this->section('script');?>

<script>
$(document).ready(function(){
    
    $(".refreshCaptcha").on("click", function () {
		$.ajax({
			url: "<?= base_url() ?>refresh-captcha",
			type: "get",
			data: {},
			success: function (res) {
				$("#captcha-image").html(res);
			}
		});
	});
	
	
	$("#uotp").hide();
	$("#udetails").hide();
	
	$("#sendOtpBtn").on("click", function(){
		$("#emailId_err").html('');
		
		let emailId = btoa($("#email").val());
		let fcaptcha = $("#fcaptcha").val();
		
		if(emailId!=""){
			$.ajax({
				url:"<?=base_url()?>send-forget-otp",
				type:"post",
				data:{emailId:emailId,fcaptcha:fcaptcha},
				success:function(res){
					let ress = JSON.parse(res);
					console.log(ress);
					if(ress.status==200){
						$("#uotp").show();
					}else if(ress.status==404){
						$("#emailId_err").html('Invalid Email Id.')
					}else if(ress.status==403){
					    $("#fcaptcha_err").html('Invalid captcha.')
					}else{
						$("#emailId_err").html('Internal server error.')
					}
				}
			});
		}else{
			$("#emailId_err").html('Please enter email id.')
		}
		
	});
	
	$("#otpVerifyBtn").on("click", function(){
		
		$("#forgotOTP_err").html('');
		let enteredOTP = $("#forgotOTP").val();
		let process="username";
		if(enteredOTP!=""){
			$.ajax({
				url:"<?=base_url()?>verify-forget-otp-username",
				type:"post",
				data:{enteredOTP:enteredOTP,process:process},
				success:function(res){
					let ress = JSON.parse(res);
					console.log(ress);
					if(ress.status==1){
						//$("#fuser").html('<h2>Please check your email id.</h2>');
						window.location.href='success?s=username';
					}else{
						$("#forgotOTP_err").html('Internal OTP.')
					}
				}
			});
		}else{
			$("#forgotOTP_err").html('Please enter OTP.');
		}
		
	});
	
})
</script>

<?=$this->endSection(); ?>