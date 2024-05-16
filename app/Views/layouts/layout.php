<?php
$session = \Config\Services::session();
//$session=session();


?>

<!DOCTYPE html>
<html lang="en">  
<head>
        <!-- meta tag -->
        <meta charset="utf-8">
        <title>GOBARdhan Unified Registration Portal</title>
        <meta name="description" content="">
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.html">
        <link rel="shortcut icon" type="image/x-icon" href="<?=base_url();?>assets/assets/images/favicon.ico">
        <!-- Bootstrap v4.4.1 css -->
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/assets/css/bootstrap.min.css">
        <!-- font-awesome css -->
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/assets/css/font-awesome.min.css">
        <!-- flaticon css -->
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/assets/fonts/flaticon.css">
        <!-- animate css -->
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/assets/css/animate.css">
        <!-- owl.carousel css -->
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/assets/css/owl.carousel.css">
        <!-- slick css -->
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/assets/css/slick.css">
        <!-- off canvas css -->
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/assets/css/off-canvas.css">
        <!-- magnific popup css -->
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/assets/css/magnific-popup.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/table-fixed-header.css">
        <!-- Main Menu css -->
        <link rel="stylesheet" href="<?=base_url();?>assets/assets/css/rsmenu-main.css">
        <!-- spacing css -->
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/assets/css/rs-spacing.css">
        <!-- style css -->
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/assets/css/style.css"> <!-- This stylesheet dynamically changed from style.less -->
        <!-- responsive css -->
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/assets/css/responsive.css">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
	
	<style>
		.loginModal {
			min-height: 450px;
			background-image: url(https://gobardhan.indevconsultancy.in/assets/images/banner/sld4.jpg);
			background-size: cover;
		}
		.loginModal:before {
			content: "";
			position: absolute;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 0;
			background: linear-gradient(45deg, #205818ab, #1e8b0f87);
		}
		.loginSection{
			background: #fbf9f9ba;
			opacity: 1.5;
			padding-left: 45px;
			padding-right: 45px;
			border-radius: 5px;
			height: 408px;
		}
		.main-content{
			min-height: 850px;
		}
		
		.blink {
		  animation: blink 1s steps(1, end) infinite;
		}

		@keyframes blink {
		  0% {
			opacity: 1;
		  }
		  50% {
			opacity: 0;
		  }
		  100% {
			opacity: 1;
		  }
		}
	.right-logo img {
		max-height: 95px;
	}
	</style>
	
    <body class="defult-home">
        
        <!--Preloader area start here-->
        <div id="loader" class="loader">
            <div class="loader-container"></div>
        </div>
        <!--Preloader area End here--> 
     
		<!-- Main content Start -->
        <div class="main-content">
            
            <!--Full width header Start-->
            <div class="full-width-header">
                <!--Header Start-->
                <header id="rs-header" class="rs-header style2">
                    <!-- Topbar Area Start -->
                    <div class="topbar-area style2">
                       <div class="container">
                           <div class="row y-middle">
                               <div class="col-lg-8">
                                   <ul class="topbar-contact">
                                        <li>
                                           <a href="mailto:support@rstheme.com">भारत सरकार  |  </a>
                                        </li>
                                        <li>
                                           <a href="tel:++1(990)999–5554"> GOVERNMENT OF INDIA</a>
                                        </li>
                                        
                                   </ul>
                               </div>
                               <div class="col-lg-4 text-right">
                                   <div class="toolbar-sl-share">
                                       <ul>
                                            <li class="opening"> <em> SKIP TO MAIN CONTENT</em> </li>
                                            <li><a href="#">-A</a></li>
                                            <li><a href="#">+A</a></li>
                                            <li><a href="#">A</a></li>
                                            <li><a href="#" class="" ><i class="fa fa-globe"></i> EN</a></li>
                                       </ul>
                                   </div>
                               </div>
							   
                           </div>
                       </div>
                   </div>
                    <!-- Topbar Area End -->
                    <!-- Menu Start -->
                    <div class="menu-area menu-sticky">
					
						<div class="container">
                            <div class="row align-items-center" style="margin-top: 5px;">
                                <div class="col-lg-4">
                                    <div class="logo-part">
                                        
										<a href="<?=base_url();?>" role="link">
											<img class="national_emblem" src="<?=base_url();?>assets/img/logos/national_emblem.svg" alt="national emblem">
											<p><span>जल शक्ति मंत्रालय  </span>
												<span>पेयजल और स्‍वच्‍छता विभाग</span>
												<span> Ministry of Jal Shakti </span>
												<span> Department of Drinking Water &amp; Sanitation</span>
											</p>
										</a>
                                    </div>
                                    <div class="mobile-menu">
                                        <a href="#" class="rs-menu-toggle rs-menu-toggle-close secondary">
                                            <i class="fa fa-bars"></i>
                                        </a>
                                    </div>
                                </div>
                                
								<div class="col-md-4 col-3">
									<div class="right-logo">
										<a href="#"><img src="<?=base_url();?>assets/img/logos/gbrdhan-logo.png" class="img-fluid"></a>
										<a href="#"><img src="<?=base_url();?>assets/img/swach-bharat.png" class="img-fluid"></a>
									</div>
								</div>
								<div class="col-lg-4 text-center col-9">                                    
									<h4 style="line-height: 26px;">
										<span style="font-size:22px;">GOBARdhan</span><br>(Galvanizing Organic Bio-Agro Resources Dhan)<br> <span style="font-size:13px">Unified Registration Portal For Biogas/ CBG/ Bio CNG plants</span>
									</h4>
                                </div>
                            </div>
                        </div>
						
                      
						<nav class="navbar navbar-expand-sm custom-nav rs-menu">
							<div class="container justify-content-end">
							  <!-- Links -->
								<ul class="navbar-nav">
									<?php
									   
										if((isset($_SESSION['role']) && $_SESSION['role']=='admin')){ ?>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>dashboard">Dashboard</a>
											</li>
											<!--
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>entity-list">Entity List</a>
											</li>
											--> 
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>plants-list">Plant List (Ministry) </a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>plant-list">Plant List</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>circular">Circular</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>applied-loan">Loan Status</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>all-reports">Reports</a>
											</li>
											<!--
											<li class="ml-auto menu-item-has-children">
												<a class="nav-link" href="javascript:">
													Reports
												</a>
												<ul class="sub-menu">
													<li class="nav-item" >
														<a class="nav-link" href="<?=base_url()?>ministry-report">
															Ministry Wise CBG Benefits Report
														</a>
													</li>
													<li class="nav-item" >
														<a class="nav-link" href="<?=base_url();?>ddws-report">
															Year Wise DDWS Report
														</a>
													</li>
													<li class="nav-item" >
														<a class="nav-link" href="<?=base_url();?>monthly-update-report">
															Details Functionality Assessment Report
														</a>
													</li>
													<li class="nav-item" >
														<a class="nav-link" href="<?=base_url();?>state-wise-monthly-report">
															State Wise Functionality Assessment Monthly Report 
														</a>
													</li>
													
													<li class="nav-item" >
														<a class="nav-link" href="<?=base_url();?>monthly-update-report-cbg">
															Details Functionality Assessment Report CBG
														</a>
													</li>
													<li class="nav-item" >
														<a class="nav-link" href="<?=base_url();?>state-wise-monthly-report-cbg">
															State Wise Functionality Assessment Monthly Report CBG
														</a>
													</li>
													<li class="nav-item" >
														<a class="nav-link" href="<?=base_url();?>mda-issues">
															MDA Issues
														</a>
													</li>
													
												</ul>
											</li>
											-->
											
											<li class="ml-auto menu-item-has-children">
												<a class="nav-link" href="javascript:">
													Duplicate Entry 
													<div class="badge badge-warning">
														<span class="blink">New</span>
													</div>
												</a>
												<ul class="sub-menu">
													<li class="nav-item" >
														<a class="nav-link" href="<?=base_url()?>duplicate-biogas">
															Biogas
															<div class="badge badge-warning">
																<span class="blink">New</span>
															</div>
														</a>
													</li>
													<li class="nav-item" >
														<a class="nav-link" href="<?=base_url()?>duplicate-cbg">
															CBG
															<div class="badge badge-warning">
																<span class="blink">New</span>
															</div>
														</a>
													</li>
												</ul>
											</li>
										<?php	
										}else if(isset($_SESSION['role']) && $_SESSION['role']=='state'){ ?>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>state-dashboard">Dashboard</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>state-plant">State Plant</a>
											</li>
											
											<li class="ml-auto menu-item-has-children">
												<a class="nav-link" href="javascript:">
													Reports
												</a>
												<ul class="sub-menu">
													<li class="nav-item">
														<a class="nav-link" href="<?=base_url();?>ddws-report">DDWS Report</a>
													</li>
													<li class="nav-item" >
														<a class="nav-link" href="<?=base_url();?>monthly-report">
															Monthly Report
														</a>
													</li>
												</ul>
											</li>
											
											
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url();?>monthly-update">Monthly Update</a>
											</li>
											
											<!--<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>state-report">Report</a>
											</li>
											-->
										<?php	
										}else if((isset($_SESSION['role']) && $_SESSION['role']=='ministry')){ ?>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>dashboard">Dashboard</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>plants-list">Plant List</a>
											</li>
											<!--
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>grievance-list">Grievance List</a>
											</li>
											-->
										<?php	
										}else if((isset($_SESSION['role']) && ($_SESSION['role']=='bank' || $_SESSION['role']=='bankAdmin'))){ ?>
											
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>plants-list">Plant List</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>applied-loan">Loan Status</a>
											</li>
										<?php
										}else if((isset($_SESSION['role']) && $_SESSION['role']=='cbgLogin')){ ?>
										
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>cbg-plants">Plant List</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>offtake-issues">Offtake Issues</a>
											</li>
											<li class="ml-auto menu-item-has-children">
												<a class="nav-link" href="javascript:">
													Reports
												</a>
												<ul class="sub-menu">
													
													
													<li class="nav-item" >
														<a class="nav-link" href="<?=base_url();?>monthly-update-report-cbg">
															Details Functionality Assessment Report CBG
														</a>
													</li>
													
												</ul>
											</li>
											
										<?php }else if((isset($_SESSION['role']) && $_SESSION['role']=='DoFAdmin')){ ?>
										
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url()?>mda-issues">MDA Issues</a>
											</li>
											
										<?php } ?>
								
									<?php 
                                        if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){ ?>
											<?php if($_SESSION['role']=='organization'){ ?>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url();?>monthly-cbg-report">Functionality Module Report</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url();?>monthly-update-cbg">Functionality Module</a>
											</li>
											<?php } ?>
											
											<li class="ml-auto menu-item-has-children"><a class="nav-link" href="javascript:"><?php echo $_SESSION['username']; ?></a>
												<ul class="sub-menu">
													<?php //if($_SESSION['role']=='organization'){ ?> 
														<li class="nav-item" >
															<a class="nav-link" href="<?=base_url()?>profile">Profile</a>
														</li> 
													<?php //} ?>
													<li class="nav-item" >
														<a  class="nav-link" href="<?=base_url()?>logout">Logout</a>
													</li>
												</ul>
											</li>
										<?php	
										}else{ ?>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url();?>">Home</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url();?>important-circular">Important Circular</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url();?>about-us">About Us</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="<?=base_url();?>benefits">Benefits</a>
											</li>
											
											<li class="ml-auto menu-item-has-children">
												<a class="nav-link" href="javascript:">
													Contact Us
												</a>
												<ul class="sub-menu">
													<li class="nav-item" >
														<a class="nav-link" href="<?=base_url();?>contact">
															Department
														</a>
													</li>
													
													<li class="nav-item" >
														<a class="nav-link" href="<?=base_url();?>satat-nodal-officer">
															SATAT Nodal Officer
														</a>
													</li>
													<li class="nav-item" >
														<a class="nav-link" href="<?=base_url();?>state-nodal-officer">
															State Nodal Officer
														</a>
													</li>
												</ul>
											</li>
											
											<li class="nav-item">
												<a class="nav-link" href="javascript:void(0)"  data-toggle="modal" data-target="#myModalLogin" >Login</a>
											</li>
											<li class="nav-item">
												<a class="nav-link text-warning" href="<?=base_url();?>registration-overview"><b>Register</b></a>
											</li>
										<?php
										}
									?>
								
									<!--
									<li class="nav-item">
										<a class="nav-link" href="<?=base_url();?>login">Login</a>
									</li>
									-->
									
								</ul>
							 </div>
						</nav>
                    </div>
                    <!-- Menu End --> 
				
					</header>
                <!--Header End-->
                
            </div>
            <!--Full width header End-->
			
			<?= $this->renderSection('content'); ?>
            
        </div> 
        <!-- Main content End -->
		
		
		<!-- Login Modal -->
		<div class="modal fade" id="myModalLogin" style="z-index: 1000000;" data-keyboard="false" data-backdrop="static">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title text-center">GOBARdhan Unified Registration Portal</h4>
						<button type="button" class="btn-close btn" data-dismiss="modal">X</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body loginModal">
						<form action="<?=base_url()?>auth" method="post" autocomplete="off" >
							<div class="row">
								<div class="col-sm-12 text-center">
									
								</div>
								<div class="col-sm-2"></div>
								<div class="col-sm-8 loginSection">
									<div class="form-group text-center mt-5">
										<h3>Login</h3>
									</div>
									<div id="loginError"></div>
									<div class="form-group">
										<input type="text" placeholder="Username" class="form-control input-element" maxLength="20" autocomplete="off" name="username" id="username" />
									</div>
									<div class="form-group password-div">
										<input type="password" placeholder="Password" class="form-control input-element" maxLength="20" autocomplete="off" name="password" id="password" />
									</div>
									
									<div class="form-group">
										<span id="LoginCaptchaImage">
											
										</span>
										<a href="javascript:" class="ms-3 refreshCaptcha" id="refreshCaptcha"> <i class="fa fa-refresh"></i></a>
										<input type="text" placeholder="Enter Captcha" class="form-control input-element pull-right" name="captcha" id="captcha" style="width:70%;"  maxLength="6" />
									</div>
									
									<div class="form-group">
										<button type="button" class="btn btn-success userLogin">Submit</button>
										<a href="<?=base_url()?>forgot-username" class="pull-right">Forgot Username?</a>
										<br>
										<a href="<?=base_url()?>forgot-password" class="pull-right">Forgot Password?</a>
									</div>
								</div>
								<div class="col-sm-2"></div>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
		<!-- Login Modal END-->
		
		
		
		
     
        <!-- Footer Start -->
        <footer id="rs-footer" class="rs-footer">
            <!--<div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-12 col-sm-12 footer-widget">
                            <div class="footer-logo mb-30">
                                <a href="index.html"><img src="assets/images/logo-dark.png" alt=""></a>
                            </div>
                              <div class="textwidget pb-30"><p>Sedut perspiciatis unde omnis iste natus error sitlutem acc usantium doloremque denounce with illo inventore veritatis</p>
                              </div>
                              <ul class="footer-social md-mb-30">  
                                  <li> 
                                      <a href="#" target="_blank"><span><i class="fa fa-facebook"></i></span></a> 
                                  </li>
                                  <li> 
                                      <a href="# " target="_blank"><span><i class="fa fa-twitter"></i></span></a> 
                                  </li>

                                  <li> 
                                      <a href="# " target="_blank"><span><i class="fa fa-pinterest-p"></i></span></a> 
                                  </li>
                                  <li> 
                                      <a href="# " target="_blank"><span><i class="fa fa-instagram"></i></span></a> 
                                  </li>
                                                                           
                              </ul>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 pl-45 md-pl-15 md-mb-30">
                            <h3 class="widget-title">IT Services</h3>
                            <ul class="site-map">
                                <li><a href="software-development.html">Software Development</a></li>
                                <li><a href="web-development.html">Web Development</a></li>
                                <li><a href="analytic-solutions.html">Analytic Solutions</a></li>
                                <li><a href="web-development.html">Cloud and DevOps</a></li>
                                <li><a href="web-development.html">Product Design</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 md-mb-30">
                            <h3 class="widget-title">Contact Info</h3>
                            <ul class="address-widget">
                                <li>
                                    <i class="flaticon-location"></i>
                                    <div class="desc">374 FA Tower, William S Blvd 2721, IL, USA</div>
                                </li>
                                <li>
                                    <i class="flaticon-call"></i>
                                    <div class="desc">
                                       <a href="tel:(+880)155-69569">(+880)155-69569</a>
                                    </div>
                                </li>
                                <li>
                                    <i class="flaticon-email"></i>
                                    <div class="desc">
                                        <a href="mailto:support@rstheme.com">support@rstheme.com</a>
                                    </div>
                                </li>
                                <li>
                                    <i class="flaticon-clock-1"></i>
                                    <div class="desc">
                                        Opening Hours: 10:00 - 18:00   
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <h3 class="widget-title">Newsletter</h3>
                            <p class="widget-desc">We denounce with righteous and in and dislike men who are so beguiled and demo realized.</p>
                            <p>
                                <input type="email" name="EMAIL" placeholder="Your email address" required="">
                                <em class="paper-plane"><input type="submit" value="Sign up"></em>
                                <i class="flaticon-send"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="footer-bottom">
                <div class="container">                    
                    <div class="row y-middle">
                       
                        <div class="col-lg-12">
                            <div class="copyright">
                                <p> Content entered by Stakeholders (State/ UT Governments and Individuals operating or intending to setup Biogas/ CBG/ Bio CNG plant)</br>
                                Website hosted & maintained by Department of Drinking Water & Sanitation, Ministry of Jal Shakti.</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer End -->

        <!-- start scrollUp  -->
        <div id="scrollUp" class="orange-color">
            <i class="fa fa-angle-up"></i>
        </div>
        <!-- End scrollUp  -->

        <!-- Search Modal Start -->
        <div aria-hidden="true" class="modal fade search-modal" role="dialog" tabindex="-1">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="flaticon-cross"></span>
            </button>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="search-block clearfix">
                        <form>
                            <div class="form-group">
                                <input class="form-control" placeholder="Search Here..." type="text">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search Modal End -->

         <!-- modernizr js -->
        <script src="<?=base_url();?>assets/assets/js/modernizr-2.8.3.min.js"></script>
        <!-- jquery latest version -->
        <script src="<?=base_url();?>assets/assets/js/jquery.min.js"></script>
        <!-- Bootstrap v4.4.1 js -->
        <script src="<?=base_url();?>assets/assets/js/bootstrap.min.js"></script>
        <!-- Menu js -->
        <script src="<?=base_url();?>assets/assets/js/rsmenu-main.js"></script> 
        <!-- op nav js -->
        <script src="<?=base_url();?>assets/assets/js/jquery.nav.js"></script>
        <!-- owl.carousel js -->
        <script src="<?=base_url();?>assets/assets/js/owl.carousel.min.js"></script>
        <!-- wow js -->
        <script src="<?=base_url();?>assets/assets/js/wow.min.js"></script>
        <!-- Skill bar js -->
        <script src="<?=base_url();?>assets/assets/js/skill.bars.jquery.js"></script>
        <script src="<?=base_url();?>assets/assets/js/jquery.counterup.min.js"></script> 
         <!-- counter top js -->
        <script src="<?=base_url();?>assets/assets/js/waypoints.min.js"></script>
        <!-- swiper js -->
        <script src="<?=base_url();?>assets/assets/js/swiper.min.js"></script>   
        <!-- particles js -->
        <script src="<?=base_url();?>assets/assets/js/particles.min.js"></script>  
        <!-- magnific popup js -->
        <script src="<?=base_url();?>assets/assets/js/jquery.magnific-popup.min.js"></script>      
        <!-- plugins js -->
        <script src="<?=base_url();?>assets/assets/js/plugins.js"></script>
        <!-- pointer js -->
        <script src="<?=base_url();?>assets/assets/js/pointer.js"></script>
	    <script src="<?=base_url();?>assets/js/jquery.fixedheadertable.min.js"></script>
        <!-- contact form js -->
        <script src="<?=base_url();?>assets/assets/js/contact.form.js"></script>
        <!-- main js -->
        <script src="<?=base_url();?>assets/assets/js/main.js"></script>
        <script src="<?=base_url();?>assets/assets/js/aes.js"></script>
		
		<script>
			$('.modal').find('.table').addClass('tableFixHead');
			
			function captchaRefresh(){
			    $.ajax({
					url: "<?=base_url();?>refresh-captcha",
					type: "get",
					data: {},
					success: function (res) {
						$("#LoginCaptchaImage").html(res);
					}
				});
			}
			$(document).ready(function(){
				
				captchaRefresh();
				
				$(".refreshCaptcha").on("click", function () {
					$.ajax({
						url: "<?=base_url();?>refresh-captcha",
						type: "get",
						data: {},
						success: function (res) {
							$("#LoginCaptchaImage").html(res);
						}
					});
				});
				
			});
		</script>
		<script>
			/*$('.fixedTable').fixedHeaderTable({ 
				footer: true,
				cloneHeadToFoot: false,
				altClass: 'odd',
				autoShow: true,
				height:'600px',
			});*/
			$('.fixedTable').closest('.table-responsive').css('max-height','600px');
			$('.fixedTable').addClass('tableFixHead');
			$('.modal').each(function(){
				$(this).find('.table').addClass('tableFixHead');
			})
			
			
			
			$(".userLogin").on("click", function(event){
        	    event.preventDefault();
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
				
        	    $("#loginError").html('');
        	    let uname = $("#username").val();
        	    let upass = $("#password").val();
        	    let captcha = $("#captcha").val();
        	    if(uname!="" & upass!="" & captcha!=""){
        	        var encPass = upass;
					var encrypted = CryptoJS.AES.encrypt(JSON.stringify(encPass), "<?=ENC_KEY;?>", {format: CryptoJSAesJson}).toString();
        	        $.ajax({
            			url: "<?=base_url()?>auth",
            			type: "post",
            			data: {username:uname,password:encrypted,captcha:captcha},
            			dataType:"json",
            			success: function (res) {
            				console.log(res);
            				if(res.status==200){
            				    window.location.href=res.redirect_url;
            				}else{
            				    $("#loginError").html('<div class="alert alert-danger">'+res.error+'</div>');
            				}
            				captchaRefresh();
            			}
            	    });
        	    }else{
        	        $("#loginError").html('<div class="alert alert-danger">All fields are required.</div>');
        	    }
        	    
        	});
        	
        	$('#username, #searchtxt').keydown(function (e) {
        	    
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
		</script>
		
		<?= $this->renderSection('script'); ?>
		
    </body>

</html>