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
.notfound-center{
	text-align: center;
	padding: 120px;
	min-height: 613px;
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
					
					<div class="login-container mb-3">
						<div class="row">
							<div class="col-md-12 me-md-0 pe-md-0">
							
								<div class="notfound-center">
									<h1 class="mt-50">Oops!</h1>
									<h2>404 - Page Not Found</h2>
									<a class="btn btn-primary" href="<?=base_url();?>">GO TO HOMEPAGE</a>
								</div>
								
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
<script src="assets/js/vendor/jquery-3.2.1.min.js"></script>
<script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
<script>
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
    </script>


</body>
</html>