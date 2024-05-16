<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>

<style>
	.rs-slider .slider-content .banner-data {
		margin-top: -50px;
	}

	.blink {
		animation: blink .5s infinite;
	}

	@keyframes blink {

		0% {
			color: #000;
		}

		50% {
			color: red;
		}

		100% {
			color: #000;
		}

	}

	.blink2 {
		animation: blink2 .8s infinite;
	}

	.blink2:before,
	.blink2:after {
		animation: blink3 .8s infinite;
	}


	@keyframes blink2 {

		0% {
			color: #fff;
			background: #ff9800;
		}

		50% {
			color: #FF9800;
			background: red;
		}

		100% {
			color: #fff;
			background: #ff9800;
		}

	}

	@keyframes blink3 {

		0% {
			color: #fff;
			background: #ff9800;
		}

		50% {
			color: #FF9800;
			background: red;
		}

		100% {
			color: #fff;
			background: #ff9800;
		}

	}


	.legend_box-6 {
		background-color: #006400;
		height: 6px;
	}

	.legend {
		text-align: center;
	}

	.legend p {
		margin-top: 5px;
		font-weight: bold;
	}


	.marquee-scroll-section {
		margin: 15px 0;
		background: transparent;
		position: absolute;
		top: 0;
		left: 0;
		z-index: 10;
		width: 100%;
	}

	.marquee-scroll-inner {
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.marquee-heading {
		position: relative;
		z-index: 1;
		min-width: 143px;
	}

	.marquee-heading h2 {
		background: #d3ffcd;
		float: left;
		font-size: 20px;
		line-height: 20px;
		margin-bottom: 0;
		padding: 15px 10px 15px 14px;
		position: relative;
		color: #4caf50;
		font-family: 'Open Sans', sans-serif;
		font-weight: bold;
	}

	.marquee-heading h2::after {
		border-bottom: 25px solid rgba(0, 0, 0, 0);
		border-left: 15px solid #d3ffcd;
		border-top: 25px solid rgba(0, 0, 0, 0);
		content: "";
		height: 0;
		position: absolute;
		right: -15px;
		top: 0;
		width: 0;
	}

	.marquee-wrapper {
		height: 50px;
		width: 100%;
		overflow: hidden;
		box-sizing: border-box;
		position: relative;
		background: rgb(0 0 0 / 14%);
		line-height: 47px;
	}

	.marquee-wrapper marquee>a {
		color: #fff;
		position: relative;
		display: inline-flex;
		margin-right: 15px;
	}

	.marquee-wrapper marquee>a:after {
		content: '';
		display: inline-block;
		clear: both;

	}

	.marquee-wrapper marquee>a>i {
		font-size: 22px;
	}

	.marquee--inner {
		display: block;
		width: 200%;
		position: absolute;
		padding-left: 40px;
		animation: marquee 20s linear infinite;
	}

	.marquee--inner a {
		color: #231c1c;
		font-size: 15px;
		font-weight: 600;
	}

	.marquee--inner:hover {
		animation-play-state: paused;
	}


	.marquee-wrapper span {
		float: left;
	}

	@keyframes marquee {
		0% {
			left: 0;
		}

		100% {
			left: -100%;
		}
	}

	.orb {
		display: inline-block;
		margin: 0 0px;
		float: left;
		transition: all .2s ease-out;
	}

	.marquee--inner a:hover {
		color: #333;
	}


	.burst {
		background: #ff9800;
		width: 23px;
		height: 23px;
		position: relative;
		text-align: center;
		z-index: 0;
		line-height: 23px;
		font-size: 11px;
		display: inline-block;
		margin-top: 11px;
		margin-right: 11px;
	}

	.burst:before,
	.burst:after {
		content: "";
		position: absolute;
		top: 0;
		left: 0;
		height: 23px;
		width: 23px;
		background: #ff9800;
		z-index: -1;
	}

	.burst:before {
		transform: rotate(30deg);
	}

	.burst:after {
		transform: rotate(60deg);
	}

	.fa-star {
		color: #FFD700;
	}

	.map-sub-title {
		display: block;
		color: #1c1c1c;
		font-weight: bold;
		font-size: 12px;
	}
</style>

<!-- Slider Section Start -->
<div class="rs-slider style1" style="position:relative;">
	<div class="marquee-scroll-section">
		<div class="container">
			<div class="marquee-scroll-inner">
				<div class="marquee-heading">
					<h2>
						<span>What's New</span>
					</h2>
				</div>
				<div class="marquee-wrapper">
					<marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
						<!--<a href="<?= base_url(); ?>whats-new/DoF-on-PoS-27-Sep-2023.pdf" target="_blank"> <span class="burst blink2">New</span> Notification on obtaining Point of Sale (PoS) machine under MDA </a>
								<a href="<?= base_url(); ?>whats-new/DOC-20230920-WA0005.pdf" target="_blank"> <span class="burst blink2">New</span> Market Development Assistance (MDA) Guidelines for promotion of Organic Fertilizers </a>-->
								<a href="<?= base_url(); ?>whats-new/State Co-ordinator for iFMS Issues.pdf" target="_blank"> <span class="burst blink2">New</span>State Co-ordinator for iFMS Issues</a>
								<a href="<?= base_url(); ?>whats-new/FOM_DEMO.pdf" target="_blank"> <span class="burst blink2">New</span>Manual for iFMS Portal</a>
								<a href="<?= base_url(); ?>whats-new/Scheme guideline for collection of biomass.pdf" target="_blank"> <span class="burst blink2">New</span>Scheme Guideline for Collection of Biomass</a> 
								<!--<a href="https://pib.gov.in/PressReleasePage.aspx?PRID=1998924" target="_blank"> <span class="burst blink2">New</span>Year End Review of GOBARdhan: “Waste to Wealth” initiative</a> -->
								<a href="<?= base_url(); ?>whats-new/Step by Step guide for adding  Bank loan details in GOBARdhan Unified Registration Portal.pdf" target="_blank"> <span class="burst blink2">New</span>Step by Step guide of Bank Loan Module for CBG Plant</a>
								<!--<a href="<?= base_url(); ?>whats-new/Press_Information_Bureau.pdf" target="_blank"> <span class="burst blink2">New</span>Blending of CBG in CNG( Transport) and PNG (Domestic) segments of CGD Sector</a> -->
								<!--
								<a href="<?= base_url(); ?>whats-new/250080.pdf" target="_blank"> <span class="burst blink2">New</span>Bulk Sale Notification</a>
								<a href="<?= base_url(); ?>whats-new/CFA_released_for_BioCNG_projects_FY_2023-24.pdf" target="_blank"> <span class="burst blink2">New</span> Central Finance Assistance (CFA) released in FY 2023-24 </a>
								-->
						
						<!--<a href="<?= base_url(); ?>whats-new/FCO amendment 19-07-2023.pdf" target="_blank"> <span class="burst blink2">New</span> Amendment in FCO Order, 2023 </a>
								<a href="<?= base_url(); ?>whats-new/Policy on Promotion of Organic Fertilizers- Regarding (Letter dated 18th July, 2023).pdf" target="_blank"> <span class="burst blink2">New</span> Policy on Promotion of Organic fertilizers</a>
								<a href="https://pib.gov.in/PressReleasePage.aspx?PRID=1935893" target="_blank"> <span class="burst blink2">New</span> GOBARdhan Initiative- Approval of Market Development Assistance for FOM/LFOM</a>
								<a href="<?= base_url(); ?>whats-new/Crop Residue Management Guidelines 2023-24.pdf" target="_blank"> <span class="burst blink2">New</span> Crop Residue Management Guidelines 2023-24 </a>
								-->
					</marquee>
				</div>
			</div>
		</div>
	</div>
	<div class="rs-carousel owl-carousel" data-loop="true" data-items="1" data-margin="0" data-autoplay="false" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="1" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="1" data-md-device-nav="true" data-md-device-dots="false">
		<!--
			<div class="slider-content">
				<img src="assets/images/banner/sld4.jpg" class="img-fluid"/>
				<div class="banner-data pb-0 pm-ji align-items-start">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-md-6">
								<div class="banner-contents">
									<blockquote>
										<p>"भारत में मवेशियों की आबादी पूरे विश्व में सबसे ज़्यादा है। मवेशियों के गोबर, कृषि से निकले कचरे, आदि से बायोगैस बनाने की दिशा में ‘GOBAR-Dhan’ योजना अहम् है। यह सिर्फ एक योजना नहीं, बल्कि गाँवों को स्वच्छ रखने, किसानों एवं पशुपालकों की आमदनी बढ़ाने और बायोगैस के माध्यम से waste to wealth और waste to energy पाने का सशक्त माध्यम है।"</p>
										
									</blockquote>											
								</div>
							</div>
							<div class="col-md-6">
								<img src="assets/images/narendra_modi_ji.png" class="img-fluid"/>
							</div>
						</div>
					</div>
				</div>
			</div>
			-->
		<div class="slider-content">
			<img src="assets/images/banner/sld1.jpg" class="img-fluid" />
			<div class="banner-data">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="banner-contents">
								<h1>Unified Registration Portal for GOBARdhan Plants </h1>
								<!--<h4 class="text-white">Welcome to</h4>
									<h1>GOBARdhan </h1>
									<h4>Unified Registration Portal For Biogas/ CBG/ Bio CNG plants</h4>
									-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Slider Section End -->

<!-- Services Section Start -->
<div class="rs-services main-home style1 pt-40 pb-40">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6 md-mb-30">
				<div class="services-item">
					<div class="services-icon">
						<div class="image-part">
							<img src="assets/images/icons/1.png" />
						</div>
					</div>
					<div class="services-content">
						<div class="services-text">
							<h3 class="services-title"><a href="<?= base_url(); ?>registration-overview"> Register Your Biogas/ CBG/ Bio CNG plant </a> </h3>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 md-mb-30">
				<div class="services-item">
					<div class="services-icon">
						<div class="image-part">
							<img src="assets/images/icons/2.png" />
						</div>
					</div>
					<div class="services-content">
						<div class="services-text">
							<h3 class="services-title"><a href="<?= base_url() ?>locate-plants">Locate Registered Biogas/ CBG/ Bio CNG plants </a> </h3>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 sm-mb-30">
				<div class="services-item">
					<div class="services-icon">
						<div class="image-part">
							<img src="assets/images/icons/3.png" />
						</div>
					</div>
					<div class="services-content">
						<div class="services-text">
							<h3 class="services-title"><a href="<?= base_url() ?>registration-certificate"> View Registration Certificate </a> </h3>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="services-item">
					<div class="services-icon">
						<div class="image-part">
							<img src="assets/images/icons/handshek.png" />
						</div>
					</div>
					<div class="services-content">
						<div class="services-text">
							<h3 class="services-title"><a href="<?= base_url() ?>benefits">Benefits from Ministries/ Departments</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Services Section End -->

<section class="pb-40">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<div class="custom-card biogas1" style="min-height: 685px;">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link  active" id="nav-one" data-toggle="tab" href="#tab-one" role="tab" aria-controls="tab-one" aria-selected="true">Biogas</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="nav-two" data-toggle="tab" href="#tab-two" role="tab" aria-controls="tab-two" aria-selected="false">CBG/ Bio CNG</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="nav-one">
							<div id="indiaMap" style="height:505px;"></div>
							<div class="legend">
								<div class="row legend-text">
									<div class="col text-center">0 - 10 %</div>
									<div class="col text-center">10 - 25 %</div>
									<div class="col text-center">25 - 50 %</div>
									<div class="col text-center"> 50 - 75 %</div>
									<div class="col text-center"> >75 %</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="legend_box-1"></div>
									</div>
									<div class="col">
										<div class="legend_box-2"></div>
									</div>
									<div class="col">
										<div class="legend_box-3"></div>
									</div>
									<div class="col">
										<div class="legend_box-4"></div>
									</div>
									<div class="col">
										<div class="legend_box-5"></div>
									</div>
								</div>
							</div>

							<div class="row mt-3">
								<div class="col">
									<span class="map-sub-title">%age of districts in States/UTs with functional Biogas Plants. </span>
									<span class="map-sub-title"> <i class="fa fa-star"></i> Each District in a State/UT is having a Functional Biogas Plant. </span>
								</div>
							</div>

						</div>
						<div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="nav-two">
							<div id="indiaMap31march" style="height:505px;"></div>
							<div class="legend">
								<div class="row legend-text">
									<div class="col text-center">0 - 5</div>
									<div class="col text-center">6 - 10</div>
									<div class="col text-center">11 - 15</div>
									<div class="col text-center">16 - 20 </div>
									<div class="col text-center"> >20 </div>
								</div>
								<div class="row">
									<div class="col">
										<div class="legend_box-1"></div>
									</div>
									<div class="col">
										<div class="legend_box-2"></div>
									</div>
									<div class="col">
										<div class="legend_box-3"></div>
									</div>
									<div class="col">
										<div class="legend_box-4"></div>
									</div>
									<div class="col">
										<div class="legend_box-5"></div>
									</div>
								</div>
								<div class="row mt-3">
									<div class="col">
										<p class="">Number indicates total functional CBG/ Bio-CNG plant coverage in States/UTs </p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<section class="rs-services pb-20">
					<div class="">
						<div class="row statics" id="biogas_plants">
							<div class="col-md-12">
								<div class="statics-box" style="background-color: #008ad2;">
									<div>
										<div class="statics-data">
											<h4>Biogas Plants Registered</h4>
											<h3><?= $functional->totfunctional + $underconstruction->totunderconstruction + $yettostart->totyettostart + $completed->totcompleted; ?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="statics-box" style="background-color: #f39c12">
									<div>
										<div class="statics-data">
											<h4>Biogas Plants Functional</h4>
											<h3><?= $functional->totfunctional ?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="statics-box" style="background-color: #f1392e">
									<div>
										<div class="statics-data">
											<h4>Biogas Plants – Completed</h4>
											<h3><?= $completed->totcompleted ?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="statics-box" style="background-color: #cb707f;">
									<div>
										<div class="statics-data">
											<h4>Biogas Plants – Construction in progress</h4>
											<h3><?= $underconstruction->totunderconstruction ?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="statics-box" style="background-color: #e11738db;">
									<div>
										<div class="statics-data">
											<h4>Biogas Plants – Yet to start construction</h4>
											<h3><?= $yettostart->totyettostart ?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="statics-box" style="background-color: #006400;">
									<div>
										<div class="statics-data">
											<h4>Number of Districts covered with Biogas Plants <br> <span style="font-size: 13px;"> (Functional/ Completed/ Construction in progress) </span> </h4>
											<h3><?= $districtCovered->totdistrictCovered ?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="statics-box" style="background-color: #4caf50;">
									<a class="text-white" href="<?= base_url() ?>state-biogas?t=state">
										<h5 class="text-white mb-0">Status of States/ UTs <i class="fa fa-arrow-right ml-10"></i></h5>
									</a>
								</div>
							</div>
						</div>

						<div class="row statics" id="cbg_plants" style="display:none;">
							<div class="col-md-12">
								<div class="statics-box" style="background-color: #008ad2;">
									<div>
										<div class="statics-data">
											<h4>CBG/ Bio CNG Plants Registered</h4>
											<h3><?= $cbgfunctional->totfunctional + $cbgunderconstruction->totunderconstruction + $cbgyettostart->totyettostart + $cbgcompleted->totcompleted; ?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="statics-box" style="background-color: #f39c12">
									<div>
										<div class="statics-data">
											<h4>CBG/ Bio CNG Plants Functional</h4>
											<h3><?= $cbgfunctional->totfunctional ?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="statics-box" style="background-color: #f1392e">
									<div>
										<div class="statics-data">
											<h4>CBG/ Bio CNG Plants – Completed</h4>
											<h3><?= $cbgcompleted->totcompleted ?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="statics-box" style="background-color: #cb707f;">
									<div>
										<div class="statics-data">
											<h4>CBG/ Bio CNG Plants – Construction in progress</h4>
											<h3><?= $cbgunderconstruction->totunderconstruction ?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="statics-box" style="background-color: #e11738db;">
									<div>
										<div class="statics-data">
											<h4>CBG/ Bio CNG Plants – Yet to start construction</h4>
											<h3><?= $cbgyettostart->totyettostart ?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="statics-box" style="background-color: #006400;">
									<div>
										<div class="statics-data">
											<h4>Number of Districts covered with CBG/ Bio CNG Plants <br> <span style="font-size: 13px;"> (Functional/ Completed/ Construction in progress) </span> </h4>
											<h3><?= $cbgdistrictCovered->totdistrictCovered ?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="statics-box" style="background-color: #4caf50;">
									<a class="text-white" href="<?= base_url() ?>state-cbg?t=state">
										<h5 class="text-white mb-0">Status of States/ UTs <i class="fa fa-arrow-right ml-10"></i></h5>
									</a>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

			<div class="col-md-12">
				<div id="biogasMsg">
					<p class="blink">
						* All biogas plants are of minimum 5 CuM capacity
					</p>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="objectives">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="title text-center mb-50">
					<h2 class="page-title text-white">Partnering Ministries/ Departments</h2>
				</div>
			</div>
		</div>
		<div class="row dept">
			<div class="col-sm-4">
				<div class="service-block">
					<div class="service-block-custom">
						<div class="inner-box">
							<div class="static-content">
								<div class="logosec"><img src="assets/images/dept/1.png"></div>
								<p><a href="https://satat.co.in/satat/index.jsp" target="_blank">Ministry of Petroleum and Natural Gas (Sustainable Alternative Towards Affordable Transportation (SATAT) Initiative)</a></p>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="service-block">
					<div class="service-block-custom">
						<div class="inner-box">
							<div class="static-content">
								<div class="logosec"><img src="assets/images/dept/2.png"></div>
								<p><a href="https://sbmurban.org" target="_blank">Ministry of Housing and Urban Affairs </a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="service-block">
					<div class="service-block-custom">
						<div class="inner-box">
							<div class="static-content">
								<div class="logosec"><img src="assets/images/dept/3.png"></div>
								<p><a href="https://biourja.mnre.gov.in/" target="_blank"> Ministry of New Renewable Energy<br> (Waste to Energy)</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="service-block">
					<div class="service-block-custom">
						<div class="inner-box">
							<div class="static-content">
								<div class="logosec"><img src="assets/images/dept/4.png"></div>
								<p><a href="https://dahd.nic.in/schemes/programmes/ahidf" target="_blank">Department of Animal Husbandry and Dairying (Animal Husbandry Infrastructure Development Fund)</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="service-block">
					<div class="service-block-custom">
						<div class="inner-box">
							<div class="static-content">
								<div class="logosec"><img src="assets/images/dept/5.png"></div>
								<p><a href="https://agriinfra.dac.gov.in" target="_blank">The Department of Agriculture, &amp; Farmers Welfare (Agri-Infra Fund)</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="service-block">
					<div class="service-block-custom">
						<div class="inner-box">
							<div class="static-content">
								<div class="logosec"><img src="assets/images/dept/6.png"></div>
								<p><a href="https://www.fert.nic.in" target="_blank">Department of Fertilizers <br> (Market Development Assistance)</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<!--
			<div class="row">
				<div class="col-md-12">
					<div style="padding:30px 15px; background: rgba(0 0 0 /45%); border-radius: 10px;">
						<h4 class="text-white mb-0 text-center">Click here for  <a href="https://sbm.gov.in/gbdw20/" target="_blank" class="btn btn-warning blink">Gobardhan Portal</a></h4>						
					</div>
					
				</div>
			</div> 
			-->
	</div>
</section>

<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<script>
	$("#nav-one").on("click", function() {
		$("#biogas_plants").show();
		$("#biogasMsg").show();
		$("#cbg_plants").hide();
	})

	$(document).ready(function() {

		$("#nav-two").on("click", function() {
			$("#biogas_plants").hide();
			$("#biogasMsg").hide();
			$("#cbg_plants").show();
		})
	})
</script>
<script src="https://gobardhan.co.in/assets/highcharts/highmaps.js"></script>
<script src="https://gobardhan.co.in/assets/highcharts/exporting.js"></script>
<script src="https://gobardhan.co.in/assets/highcharts/offline-exporting.js"></script>
<script src="https://gobardhan.co.in/assets/highcharts/accessibility.js"></script>

<?php
$mapdata1 = '';
$ratingStarArr = [];
$starStatesArr = [16, 34, 24];
foreach ($stateWiseBiogass as $stateWiseBiogas) {
	$state_code = $stateWiseBiogas->state_code;
	$noofdistricts = $stateWiseBiogas->noofdistricts;
	$totdCovered = $stateWiseBiogas->totdCovered;

	$totYetToStart = $stateWiseBiogas->totYetToStart;
	$totUnderConstruction = $stateWiseBiogas->totUnderConstruction;
	$totFunctional = $stateWiseBiogas->totFunctional;

	$districtCovered = round(($totdCovered / $noofdistricts) * 100, 1);

	$ratingStar = '';
	// if($districtCovered=="100" && $totYetToStart=="0" && $totUnderConstruction=="0"){
	// echo $ratingStar = '<i class="fa fa-star"></i>';
	// }

	if (in_array($state_code, $starStatesArr)) {
		$ratingStar = '<i class="fa fa-star"></i>';
	}

	$ratingStarArr['s' . $state_code] = $ratingStar;

	$color = '';
	if ($districtCovered <= 10) {
		$color = '#FCAE91';
	}

	if ($districtCovered > 10 && $districtCovered <= 25) {
		$color = '#FEE5D9';
	}
	if ($districtCovered > 25 && $districtCovered <= 50) {
		$color = '#C5E0B4';
	}
	if ($districtCovered > 50 && $districtCovered <= 75) {
		$color = '#A9D18E';
	}
	if ($districtCovered > 75) {
		$color = '#00B050';
	}

	$mapdata1 .= "['" . $state_code . "', $districtCovered,'" . $totYetToStart . "','" . $totUnderConstruction . "','" . $totFunctional . "','" . $color . "'],";
}

$ratingStarJson = json_encode($ratingStarArr);
?>


<script>
	// Prepare random data
	var data = [<?= $mapdata1; ?>];
	var str = <?= $ratingStarJson; ?>;
	let baseUrl = 'https://gobardhan.co.in/assets/indiass.json';
	//console.log(str.s16);
	Highcharts.getJSON(baseUrl, function(geojson) {

		// Initialize the chart
		Highcharts.mapChart('indiaMap', {
			chart: {
				map: geojson,
				height: '450px',
				//backgroundColor:'#eee'
			},

			title: {
				text: ''
			},

			accessibility: {
				typeDescription: ''
			},

			mapNavigation: {
				enabled: false,
				buttonOptions: {
					verticalAlign: 'top'
				}
			},

			// colorAxis: {
			//   min: 1,
			//   minColor: '#FCAE91',
			//   maxColor: '#00B050',
			//   // stops: [
			//   //   [0, '#edfaef'],
			//   //   [0.67, '#1ed14b'],
			//   //   [1, '#00450c']
			//   // ]
			// },

			plotOptions: {
				series: {
					dataLabels: {
						formatter: function() {
							let point = this.point.State_LGD;
							let star = '';
							let hasStar = str['s' + point];
							if (hasStar != '' && hasStar != undefined) {
								star = hasStar;
							}
							return star;
						},
						enabled: true,
						useHTML: true,
					},

					point: {
						events: {
							click: function() {

							}
						}
					}
				}
			},

			tooltip: {
				enabled: true,
				formatter: function() {
					let point = this.point;
					return '<br><b>' + point.properties.STNAME + '</b><br> Yet to start: <b>' + point.options.yettostart + '</b> <br> Under Construction: <b>' + point.options.underconstruction + '</b> <br> Functional: <b>' + point.options.functional + '</b> <br>'
				}
			},
			credits: {
				enabled: false
			},
			legend: {
				enabled: false
			},

			series: [{
				data: data,
				keys: ['State_LGD', 'value', 'yettostart', 'underconstruction', 'functional', 'color'],
				joinBy: 'State_LGD',
				name: 'Total Plant',
				colorByPoint: false,
				states: {
					name: "Yes",
					hover: {
						enabled: false,
						color: '#000'
					}
				},
				// dataLabels: {
				// enabled: true,
				// useHTML: true,
				// format: ''
				// }

			}]
		});
	});
</script>



<?php
$mapdata2 = '';
foreach ($stateWiseCBGs as $stateWiseCBG) {
	$statecode = $stateWiseCBG->state_code;
	$totProject = $stateWiseCBG->totProjects;
	$totYetToStart = $stateWiseCBG->totYetToStart;
	$totUnderConstruction = $stateWiseCBG->totUnderConstruction;
	$totFunctional = $stateWiseCBG->totFunctional;
	$color = '';
	// if($totProject<=5){
	// $color='#FCAE91';
	// }

	if ($totProject <= 5) {
		$color = '#FCAE91';
	}
	if ($totProject > 5 && $totProject <= 10) {
		$color = '#FEE5D9';
	}
	if ($totProject > 10 && $totProject <= 15) {
		$color = '#C5E0B4';
	}
	if ($totProject > 15  && $totProject <= 20) {
		$color = '#A9D18E';
	}

	if ($totProject > 20) {
		$color = '#00B050';
	}

	$mapdata2 .= "['" . $statecode . "', $totProject,'" . $totYetToStart . "','" . $totUnderConstruction . "','" . $totFunctional . "','" . $color . "'],";
}
?>
<script>
	// Prepare random data
	var data1 = [<?= $mapdata2; ?>];
	//let baseUrl='http://v2-gobardhan.indevconsultancy.com/';

	Highcharts.getJSON('https://gobardhan.co.in/assets/indiass.json', function(geojson) {

		// Initialize the chart
		Highcharts.mapChart('indiaMap31march', {
			chart: {
				map: geojson,
				height: '450px',
			},

			title: {
				text: ''
			},

			accessibility: {
				typeDescription: ''
			},

			mapNavigation: {
				enabled: false,
				buttonOptions: {
					verticalAlign: 'top'
				}
			},

			// colorAxis: {
			//   min: 1,
			//   minColor: '#FCAE91',
			//   maxColor: '#00B050',
			//   // stops: [
			//   //   [0, '#edfaef'],
			//   //   [0.67, '#1ed14b'],
			//   //   [1, '#00450c']
			//   // ]
			// },

			plotOptions: {
				series: {
					point: {
						events: {
							click: function() {

							}
						}
					}
				}
			},

			tooltip: {
				enabled: true,
				formatter: function() {
					let point = this.point;
					return '<br><b>' + point.properties.STNAME + '</b><br> Yet to start: <b>' + point.options.yettostart + '</b> <br> Under Construction: <b>' + point.options.underconstruction + '</b> <br> Functional: <b>' + point.options.functional + '</b> <br>'
				}
			},
			credits: {
				enabled: false
			},
			legend: {
				enabled: false
			},

			series: [{
				data: data1,
				keys: ['State_LGD', 'value', 'yettostart', 'underconstruction', 'functional', 'color'],
				joinBy: 'State_LGD',
				name: 'Total Plant',
				colorByPoint: false,
				states: {
					name: "Yes",
					hover: {
						enabled: false,
						//color: '#a4edba'
					}
				},
				dataLabels: {
					enabled: false,
					format: '{point.properties.STNAME}'
				}
			}]
		});
	});
</script>

<?= $this->endSection(); ?>