<?= $this->extend('layouts/layout'); ?>


<?= $this->section('content'); ?>


<style type="text/css">
	
	#bDesc, .text-justify{
		text-align: justify;
	}
	
	ol.bullet-list > li:before {
		display:none;
	}
	
	ol.bullet-list > li {
		flex: 0 0 32%;
		font-size: 20px;
		line-height: 33px;
		padding: 30px;
		background: #1e8b0f;
		color: #fff;
	}
	#bDesc a{
		color: blue !important;
	}
	.about-benefits{
		font-family: 'Oswald', sans-serif;
		font-size: 18px;
	}
	.modal-header{
		background: lightgreen;
		border-bottom: 1px solid green;
	}
	
	.modal-title{
		font-weight: bold;
	}
	
</style>


<div class="candidate-section section pt-10 pb-40" style="background: #d0d1d0;opacity: 0.8;">
        <div class="container">
			
            <div class="row">
				<div class="col-sm-12">
					<a href="javascript:void(0)" onclick="window.history.back()" > <i class="fa fa-arrow-left" ></i> Back </a>
				</div>
                <div class="candidate-content col-lg-12 col-12 mb-30">
                    <h1 style="font-size:29px" >Benefits from Ministries/ Departments</h1>
                    
                </div>
			</div>
			
			<div class="row dept">
				<div class="col-sm-4  wow zoomIn" data-wow-delay="300ms" data-wow-duration="2000ms">
					<div class="service-block">
						<div class="service-block-custom">
							<div class="inner-box">
								<div class="static-content">
									<div class="logosec"><img src="assets/images/swach-bharat.png" style="height: 100%; margin-left: 13px;"></div>
									<p><a href="javascript:" class="openModal" data-id="0" target="_blank">Department of Drinking Water & Sanitation </a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4 wow zoomIn"  data-wow-delay="300ms" data-wow-duration="2000ms">
					<div class="service-block">
						<div class="service-block-custom">
							<div class="inner-box">
								<div class="static-content">
									<div class="logosec"><img src="assets/images/dept/1.png"></div>
									<p><a href="javascript:" class="openModal" data-id="1" data-bs-toggle="modal" data-bs-target="#myModal" target="_blank">Ministry of Petroleum and Natural Gas <br> (Sustainable Alternative Towards Affordable Transportation (SATAT) Initiative)</a></p>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				<div class="col-sm-4 wow zoomIn"  data-wow-delay="300ms" data-wow-duration="2000ms">
					<div class="service-block">
						<div class="service-block-custom">
							<div class="inner-box">
								<div class="static-content">
									<div class="logosec"><img src="assets/images/dept/2.png"></div>
									<p><a href="javascript:" class="openModal" data-id="2" target="_blank">Ministry of Housing and Urban Affairs </a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4 wow rollIn"  data-wow-delay="300ms" data-wow-duration="2000ms">
					<div class="service-block">
						<div class="service-block-custom">
							<div class="inner-box">
								<div class="static-content"> 
									<div class="logosec"><img src="assets/images/dept/3.png"></div>
									<p><a href="javascript:" class="openModal" data-id="3" target="_blank"> Ministry of New Renewable Energy<br> (Waste to Energy)</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4  wow rollIn"  data-wow-delay="300ms" data-wow-duration="2000ms">
					<div class="service-block">
						<div class="service-block-custom">
							<div class="inner-box">
								<div class="static-content">
									<div class="logosec"><img src="assets/images/dept/4.png"></div>
									<p><a href="javascript:" class="openModal" data-id="4" target="_blank">Department of Animal Husbandry and Dairying <br>  (Animal Husbandry Infrastructure Fund)</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4  wow rollIn"  data-wow-delay="300ms" data-wow-duration="2000ms">
					<div class="service-block">
						<div class="service-block-custom">
							<div class="inner-box">
								<div class="static-content">
									<div class="logosec"><img src="assets/images/dept/5.png"></div>
									<p><a href="javascript:" class="openModal" data-id="5" target="_blank">The Department of Agriculture, &amp; Farmers Welfare (Agri-Infra Fund)</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4  wow rollIn"  data-wow-delay="300ms" data-wow-duration="2000ms">
					<div class="service-block">
						<div class="service-block-custom">
							<div class="inner-box">
								<div class="static-content">
									<div class="logosec"><img src="assets/images/dept/6.png"></div>
									<p><a href="javascript:" class="openModal" data-id="6" target="_blank">Department of Fertilizers <br> (Market Development Assistance)</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				 
				
			</div>
		
	</div>
</div>


<!--
<div class="clearfix"></div>
<div class="cta1">
	<div class="container">
		<div class="col-md-4">
			<h3>
				Department of Agricultural Research and Education
			</h3>
		</div>
	</div>
</div>
-->

<div class="modal fade" id="myModal" style="z-index: 1000000;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Benefits Details</h4>
				<button type="button" class="btn-close" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" >
				<h3 id="bTitle"></h3>
				<p id="bDesc"></p>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal2" style="z-index: 1000000;position: absolute;
    margin-top: 588px;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="btn-close" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" >
				
				<h3 class="bTitle"> Fertilizer Control Order</h3> 
				<p>Fertilizer (Control) Order, 1985 which is administered by Deptt. of Agriculture Cooperation, Govt. of India has been issued under the Essential Commodities Act, 1955. The FCO lays ,down as to what substances qualify for use as fertilizers in the soil, product-wise specifications, methods for sampling and analysis of fertilizers, procedure for obtaining license/registration as manufacture/dealer in fertilizers and conditions to be fulfilled for trading thereof, etc.
				<br> A.) For more details on <a href="assets/guidelines/Notification-FCO-2020.07.13.pdf" target="_blank" > FCO Second Amendement Order, 2020 (Fermented Organic Manure) </a>  <br>
				B.) For more details on <a href="assets/guidelines/FCO-2021.pdf" target="_blank" > FCO Third Amendment Order, 2021 (Liquid Fermented Organic Manure) </a> <br>
				C.) For more details on <a href="assets/guidelines/Amendment_in_Fertilizer_Control_Order_dated_17th_May_2023.pdf" target="_blank" >  FCO Fourth Amendment Order, 2023 (One Nation One License) </a> <br>
				D.) For more details on <a href="assets/guidelines/FCO_29th_May_2023-MC_Content.pdf" target="_blank" >FCO Fifth Amendment Order, 2023( Moisture Content)</a> <br>
				E.) For more details on <a href="assets/guidelines/FCO_amendment_19-07-2023.pdf" target="_blank" >FCO Sixth Amendment Order, 2023</a>
				</p>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal3" style="z-index: 1000000;position: absolute; margin-top: 730px;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="btn-close" data-dismiss="modal">X</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" >
				
				<h3 class="bTitle">Crop Residue Management Guidelines 2023-24</h3> 
				<p>Crop Residue Management Options can be classified as in-situ and ex-situ management options. Retaining, incorporating or mulching the crop residues in the field and decomposing using consortia of microbes are the two possible in-situ crop residue management options. Baling and transporting straw from the field is another feasible ex-situ option when alternate, effective and economically viable usage methods are identified and facilities and infrastructure are created. It is envisaged that appropriate mix of in-situ and ex-situ crop residue management options through a holistic approach of providing appropriate solutions, optimally utilizing the existing resources and establishing appropriate supply chain through a cluster based approach in the vicinity of various industries utilizing the crop residue will help containing the burning of crop residues in the open fields.  In view of the above, it is proposed to continue to support the efforts of the States of Punjab, Haryana, Uttar Pradesh, Madhya Pradesh and NCT of Delhi in addressing the problems of crop residue burning through the interventions.
					For more details on click <a href="assets/guidelines/Crop_Residue_Management_Guidelines_2023-24.pdf" target="_blank" > here </a>  <br>
				
				</p>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>




<?=$this->section('script');?>

<script>
$(document).ready(function(){
	let benefitsDetails = [
						{
							title:'Swachh Bharat Mission - Gramin 2.0',
							desc: 'Financial support of up to Rs. 50 lakh per district is available for setting up at least one model community biogas plants at the village/ block/district level to achieve safe management of cattle and biodegradable waste. For more details, click  <a href="https://sbm.gov.in/gbdw20/images/Framework/Gobardhan.pdf" target="_blank">here</a>\
							<br> A.) For more details on <a href="assets/guidelines/GobardhanFramework.pdf" target="_blank" >  Framework on Gobardhan </a>\
							<br> B.) For more details on <a href="assets/guidelines/Implementation-of-GOBARDHAN-Projects-1.pdf" target="_blank" >  Implementation advisory for GOBAR-DHAN </a>\
							<br> C.) For more details on <a href="assets/guidelines/Gobardhan-Technical-Manual14-Feb-22.pdf" target="_blank" >  Technical Manual of Gobardhan </a>'
						},
						{
							title:'Brief On Sustainable Alternative Towards Affordable Transportation for GOBARdhan portal',
							desc: 'The Government of India has notified the National Policy on Biofuels, 2018 (NPB) which aims to increase usage of biofuels in the energy and transportation sectors. The NPB mentions adoption of multi-pronged approach to promote and encourage use of biofuels including bio-CNG/Compressed Bio Gas (CBG). ‘bio-CNG’: Purified form of bio-Gas whose composition & energy potential is similar to that of fossil based natural gas and is produced from agricultural residues, animal dung, food waste, MSW and Sewage water. In line with NPB-2018, MoPNG has launched Sustainable Alternative Towards Affordable Transportation (SATAT) initiative with the aim to establish an ecosystem for production of CBG from various waste/ biomass sources in the country and its uses. Under this initiative Oil and gas Marketing Companies invite expression of interest from entrepreneurs to procure CBG for further marketing on long term agreement basis.\
								Various enablers have been introduced for development of CBG Sector. MoPNG has issued policy guidelines for comingling of CBG with Natural Gas in CGD network. During this years’ budget speech, it was announced that a 5 per cent CBG mandate will be introduced for all organizations marketing natural and bio gas in due course. Further, appropriate fiscal support for collection of bio-mass and distribution of bio-manure will be provided.\
								For more details please visit: <a href="https://satat.co.in/satat" target="_blank" > https://satat.co.in/satat </a> '
						},
						{
							title:'Swachh Bharat Mission - Urban 2.0',
							desc: 'Under the Scheme of Swachh Bharat Mission Urban 2.0, additional Central Assistance is provided to States and Union Territories for solid waste management by Ministry of Housing and Urban Affairs, as per scheme guidelines. Additional Central Assistance of 25% /33%/50% (based on ULB population) for MSW based CBG plants (subject to max. cost of Rs.18 crore per 100 TPD)  Click <a href="assets/guidelines/SBM_Urban_2.0.pdf" target="_blank" >here</a> for Guidelines. For more details, click <a href="https://sbmurban.org"  target="_blank" >here</a>.'
						},
						{
							title:'Waste to Energy',
							desc: 'Waste to Energy Programme: The programme’s objective is to support the setting up of Waste to Energy projects for the generation of Biogas/ BioCNG/ Power/ producer or syngas from urban, industrial and agricultural wastes/residues. The programme provides Central Financial Assistance (CFA) to project developers and service charges to implementing/inspection agencies regarding the successful commissioning of Waste to Energy plants for the generation of Biogas, Bio-CNG/enriched Biogas/Compressed Biogas, Power/ generation of producer or syngas. Click <a href="assets/guidelines/Waste_to_Energy_Program.pdf" target="_blank" >here</a> for Guidelines. For more details, click <a  target="_blank" href="https://biourja.mnre.gov.in/">here</a>'
						},
						{
							title:'Animal Husbandry Infrastructure Fund',
							desc: 'The Animal Husbandry Infrastructure Development Fund (AHIDF) is a central sector scheme with package of Rs.15,000 crore. The project under the AHIDF is eligible for a loan up to 90% of the estimated/ actual project cost from the Scheduled Banks based on the submission of viable projects by eligible beneficiaries. All eligible entities under AHIDF will be provided interest subvention of 3%.  Production of Bio-CNG & production of Phosphate Rich Organic Manure (PROM) was included as eligible activities under Animal Waste to Wealth Management (including Agri waste management) component of AHIDF on April 2022.  Click <a href="assets/guidelines/ANIMAL-HUSBANDRY-INFRASTRUCTURE-DEVELOPMENT-FUND.pdf" target="_blank" >here</a> for Guidelines. For more details, click <a href="https://dahd.nic.in/schemes/programmes/ahidf"  target="_blank" >here</a>.'
						},
						{
							title:'Agri-Infra Fund',
							desc: 'The Department of Agriculture& Farmers Welfare has introduced a new Scheme under the National Agriculture Infra Financing Facility called Agriculture Infrastructure Fund (AIF). AIF scheme aims to provide medium – long-term debt financing facility for investment in viable projects for post-harvest management Infrastructure and community farming assets through interest subvention and financial support. Click <a href="assets/guidelines/AIF_FINAL_Scheme_Guidelines.pdf" target="_blank" >here</a> for Guidelines. For more details, click  <a href="https://agriinfra.dac.gov.in/"  target="_blank" >here</a>.'
						},
						{
							title:'Department of Fertilizers',
							desc: 'The main objective of Department of Fertilizers is to ensure adequate and timely availability of fertilizers at affordable prices for maximizing agricultural production in the country. The main functions of the Department include planning, promotion and development of the fertilizers industry, planning and monitoring of production, import and distribution of fertilizers and management of financial assistance by way of subsidy / concession for indigenous and imported fertilizers. For more details, click  <a href="https://www.fert.nic.in/node/2434"  target="_blank" >here</a>.\
							<br> A.) For more details on <a href="<?= base_url();?>whats-new/DOC-20230920-WA0005.pdf" target="_blank" >  Market Development Assistance (MDA) Guidelines for promotion of Organic Fertilizers</a>\
							<br> B.) For more details on <a href="<?= base_url();?>whats-new/DoF-on-PoS-27-Sep-2023.pdf" target="_blank" >  Notification on obtaining Point of Sale (PoS) machine under MDA</a> '
						}
						];
	
	$(".openModal").on("click", function(){
		let i = $(this).data("id");
		//console.log(benefitsDetails[i].title);
		
		$("#bTitle").html(benefitsDetails[i].title);
		$("#bDesc").html(benefitsDetails[i].desc);
		$('#myModal').modal('show'); 
		//$('#myModal2').modal('show'); 
		if(i==5){
			setTimeout(function(){
			   $('#myModal2').modal('show');
			}, 1000);
			
			setTimeout(function(){
			   $('#myModal3').modal('show');
			}, 2000);
		}
		
	})
});
</script>

<?= $this->endSection(); ?>