<!doctype html>
<html class="no-js" lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>GOBARdhan Unified Registration Portal</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icon-font.min.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>

<style>
#captcha-image img{
	width: 50%;
    height: 50px;
}
</style>

<body>

<!-- Main Wrapper Start -->
<div class="main-wrapper login-wrapper">

    <!-- Hero Section Start -->
    

   <section class="pt-50 pb-50">
   	   <div class="container">
			<div class="row justify-content-center">
				<div class="col-9 col-md-9">
					<a href="index.php" class="logo mb-15"><img src="assets/images/logo.png" alt="Logo"> Unified Registration Portal for GOBARdhan </a>
					<div class="login-container mb-3">
						<div class="row">
							<div class="col-md-5 me-md-0 pe-md-0">
							
								<div class="login-left">
									<form action="<?=base_url()?>auth" method="post" autocomplete="off" >
										<div class="form-header mb-40">
											<h2><strong>Sign In</strong></h2>
											<p>To access your dashboard and apply for approvals.</p>
										</div>
										<div id="loginError"></div>
										<?php if(session()->getFlashdata('msg')):?>
											
										<?php endif;?>
										<div class="form-group">
											<input type="text" placeholder="Username" class="form-control input-element" autocomplete="off" maxLength="20" name="username" id="username" />
										</div>
										<div class="form-group password-div">
											<input type="password" placeholder="Password" class="form-control input-element " autocomplete="off" maxLength="20" name="password" id="password" />
											<span><i class="fa fa-eye"></i></span>
										</div>
										<div class="form-group">
											<span id="captcha-image">
												<?php echo $logincaptcha; ?>
											</span>
											<a href="javascript:" class="ms-3 refreshCaptcha" id="refreshCaptcha"> <i class="fa fa-refresh"></i></a>
										</div>
										<div class="form-group">
											<input type="text" placeholder="Enter Captcha" class="form-control input-element" name="captcha" id="captcha" />
										</div>

										<button type="button" class="button-login button-fill fill userLogin" ><span>Submit</span></button>
										<div class="text-center">
											<a href="<?=base_url()?>forgot-username" >Forgot Username?</a>
										    <br>
										    <a href="<?=base_url()?>forgot-password" >Forgot Password?</a>
										</div>
										
									</form>
								</div>
								<div class="signup-text-btn">
									<span>Don't have an account? <a class="text-btn" href="<?=base_url()?>registration">Sign Up Now</a></span>
								</div>
							</div>
							<div class="col-md-7 ms-md-0 ps-md-0">
								<img src="<?=base_url();?>/assets/images/loginbg1.jpg" style="height: 688px;" class="img-fluid" >
							</div>
						</div>
					</div>
				</div>
			</div>
	   </div>
   </section>

    
   
</div><!-- Main Wrapper End -->

<!-- JS
============================================ -->

<!-- jQuery JS -->
<script src="assets/assets/js/jquery.min.js"></script>
<script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
<script>
$(document).ready(function() {
   $(".refreshCaptcha").on("click", function () {
		$.ajax({
			url: "<?= base_url() ?>refresh-captcha",
			type: "get",
			data: {},
			success: function (res) {
				$("#captcha-image").html(res);
			}
		});
	})
	
	$(".userLogin").on("click", function(event){
	    event.preventDefault();
	    $("#loginError").html('');
	    console.log('clicked');
	    let uname = $("#username").val();
	    let upass = $("#password").val();
	    let captcha = $("#captcha").val();
	    let key = "<?=uniqid(rand());?>";
	    if(uname!="" & upass!="" & captcha!=""){
	        var encPass = btoa(upass+key);
	        $.ajax({
    			url: "<?=base_url()?>auth",
    			type: "post",
    			data: {username:uname,password:encPass,passKey:key,captcha:captcha},
    			dataType:"json",
    			success: function (res) {
    				console.log(res);
    				if(res.status==200){
    				    window.location.href=res.redirect_url;
    				}else{
    				    $("#loginError").html('<div class="alert alert-danger">'+res.error+'</div>');
    				}
    				$(".refreshCaptcha").trigger("click");
    			}
    	    });
	    }else{
	        $("#loginError").html('<div class="alert alert-danger">All fields are required.</div>');
	    }
	    
	});
	
	$('#username').keydown(function (e) {
		var k = e.which;
		var ok = k >= 65 && k <= 90 || // A-Z
			k >= 96 && k <= 105 || // a-z
			k >= 35 && k <= 40 || // arrows
			k == 8 || // Backspaces
			(!e.shiftKey && k >= 48 && k <= 57); // 0-9
		if (!ok){
			e.preventDefault();
		}
	});
	
	
});
</script>


</body>
</html>