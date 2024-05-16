<?php 
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ProjectModel;
use App\Models\OrganizationModel;


class PdfController extends BaseController
{
	private $db;
    public function __construct(){

        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session(); 
    }
	
    public function index() 
	{
        return view('final_certificate');
    }
	public function uniqueId($name,$id, $temp=false){
		$str = trim($name);
		$uid = str_pad($id,6,'0',STR_PAD_LEFT);
		$uniquecode = $str . $uid;
		if($temp){
			$uniquecode = $str . $uid."TEMP";
		}
		return $uniquecode;
	}
	
	function htmlToPDF(){
		$session = session();
		$user_id = $session->get('user_id');
		$useremail = $session->get('email');
		
		// $user_id = 19;
		// $useremail = "satyendrasinghbca777@gmail.com";
		
		$projectModel = new ProjectModel();
		$orgModel = new OrganizationModel();
		$org = $orgModel->where('user_id',$user_id)->first();
		$authorised_person = $org['authorised_person'];
		$orgname = $org['entity_name'];
		
		
		$pid = $this->request->getVar('pid');
		// $pid = 852;
		
		
		$projectDetails = [
			'form_completion' => 100
		];
		$projectModel->update($pid,$projectDetails);
		
		$project_registration_no=$project_name='';
		$entity='';
		$states='';
		$districts='';
		$pincode='';
		$address ='';
		$blocks='';
		$villages='';
		$gram_panchayats='';
		if(!empty($pid)){
			$project = $projectModel->where('project_id',$pid)->first();
			$project_registration_no = $project['project_registration_no'];
			$project_name = $project['project_name'];
			$entity = uniquedetails($this->db, 'option_list', 'title', 'id', $project['entity_type_id']);
			$states = uniquedetails($this->db, 'states', 'state_name', 'state_code', $project['state_id']);
			$districts = uniquedetails($this->db, 'districts', 'district_name', 'district_code', $project['district_id']);
			$districts = uniquedetails($this->db, 'districts', 'district_name', 'district_code', $project['district_id']);
			if(!empty($project['block_id'])){
				$blocks = uniquedetails($this->db, 'blocks', 'block_name', 'block_code', $project['block_id']);
				$villageids = uniquedetails($this->db, 'project_rural_address', 'village_id', 'project_id', $pid);
				$villages = uniquedetails($this->db, 'villages', 'village_name', 'village_code', $villageids);
				$gpids = uniquedetails($this->db, 'project_rural_address', 'gp_id', 'project_id', $pid);
				$gram_panchayats = uniquedetails($this->db, 'gram_panchayat', 'gp_name', 'gp_code', $gpids);
			}
			$pincode=$project['pincode'];
			//$city=$project['city']
			
			if(empty($project['entity_type_id']) || empty($project['plant_status_id'])){
				$result = array("status"=>0,"msg"=>"failed.");
				echo json_encode($result);
				exit();
			}
			
			if($project['plot_number']!='')
			{
				$address.=$project['plot_number'].", ";
			}
			if($project['street_area_address']!='')
			{
				$address.=$project['street_area_address'].", ";
			}
			if($villages!='')
			{
				$address.="Village-".$villages.", ";
			}
			if($gram_panchayats!='')
			{
				$address.="GP-".$gram_panchayats.", ";
			}
			if($blocks!='')
			{
				$address.="Block-".$blocks.", ";
			}
			if($project['city']!='')
			{
				$address.=$project['city'].", ";
			}
			
		}
		
		$certName='certficate'.$user_id.$pid.'.pdf';
		
        $dompdf = new \Dompdf\Dompdf(); 
		$html='<!DOCTYPE html>
<html lang="en" >
			<head>
			  <meta charset="UTF-8">
			  <title>Certificate</title>
			  <link rel="stylesheet" href="https://gobardhan.co.in/assets/cert-logo/certificates.css">
			  <link rel="stylesheet" href="https://gobardhan.co.in/assets/cert-logo/style.css">
			</head>
			<body style="">
			  <div class="pm-certificate-container" >
				
				<div class="pm-certificate-border">
				  <div class="pm-certificate-header">
					<div class="pm-certificate-title text-center">
					  <div class="row">
						  <div class="col-xs-1 text-left" >
							<img src="https://gobardhan.co.in/assets/cert-logo/Emblem_of_India.png" style="width: 40px; ">
						  </div>
						  <div class="col-xs-5 text-left">
						  <p style="font-size:12px; margin-left:-40px;  text-align:left; margin-top:10px;">
							  Department of Drinking Water & Sanitation <br/>
							  Ministry of Jal Shakti</p>
						  </div>
						  <div class="col-xs-6 text-right" style="margin-left:-80px;">
						  <img src="https://gobardhan.co.in/assets/cert-logo/1.png" style="width:80px;">

						  <img src="https://gobardhan.co.in/assets/cert-logo/3.png" style="width:80px;">
						  <img src="https://gobardhan.co.in/assets/cert-logo/2.png" style="width:80px;">
						  </div>
						
					  </div>
					  
					</div>
				  </div>

				  <div class="pm-certificate-body">
					<div class="row">
					  <div class="col-md-12">
						<div class="pm-name-text text-right"><span class="bold block " style="font-size: 12px;">Date: '.date('d-M-Y').' </span></div>
					  </div>
					</div>
					
					<div class="row">
					  <div class="col-md-12">
						<div class="pm-certificate-block">
							
							  <div class="row" >
								  <div class="col-md-12" >
									<h4 class="pm-earned-text block bold text-center mt-4 mb-2">Certificate of Registration</h4>
								  </div>
								<div class="col-xs-3"><!-- LEAVE EMPTY --></div>
								<div class="pm-certificate-name underline margin-0 col-xs-6 text-center" style="margin-left:-40px">
								  <span class="pm-name-text bold">Registration Number: '.$project_registration_no.' </span>
								</div>
							  </div>
							  <div class="row" style="padding:5px; width:99%; text-align:center; height: 370px;">

								<div class="pm-earned col-xs-12 text-center">
								  <p class="pm-credits-text block  sans" style="text-align:justify">This is to certify that <span class="bold">'.$project_name.'</span> belonging to <span class="bold">'.$orgname.'</span> located at <span class="bold"> '.$address.',  District-'.$districts.', State-'.$states.', Pincode-'.$pincode.' </span> has registered itself as <span class="bold">'.$entity.' </span> on Unified Registration Portal for GOBARdhan (Galvanizing Organic Bio Agro Resources Dhan). </p>
								</div>

							  </div>
							
						</div>
						
					  </div>
					</div>
					
					<div class="row" style="width:95%;">
						  <div class="col-md-12">
								<div class="row pm-certificate-footer" style="margin-top: 20px!important; margin-bottom: 20px!important;">
									<div class="col-xs-4 pm-certified col-xs-4 text-center">

									</div>
									<div class="col-xs-8 pm-certified col-xs-8 text-right" >
									  <img src="https://gobardhan.co.in/assets/cert-logo/sign.png" style="width:150px;">
									  <br/>
									  <p class="pm-credits-text block sans ">Karanjit Singh Ngangbam <br/><span class="bold">Director (GOBARdhan)</span>
									  <br/>
									  
									  Department of Drinking Water and Sanitation<br/>
									  Ministry of Jal Shakti</p>
									</div>
								</div>
						  </div>

					 </div>
					
					<br/>
					<br/>
					  <div class="row" style="width:99%;">
						<div class="pm-earned col-xs-12 text-center" style="margin:0;">

						  <p class="pm-credits-text1 block  sans " style="text-align:justify">
						  <i><b>Disclaimer:</b> This registration certificate has been issued based on information provided and certified by the applicant, and no independent verification of the same has been carried out by the issuing authority.</i>

						  </p>
						</div>
					  </div>
					 
				  </div>
				</div>
			  </div>
			</body>
			<!-- partial -->
			</html>';
		
        $dompdf->loadHtml($html);
		//$dompdf->loadHtml(view('final_certificate'));
        $dompdf->setPaper('A4', 'portrait');
        
		//$dompdf->set_base_path('https://gobardhan.co.in/assets/cert-logo/certificates.css');
		//$dompdf->set_base_path('https://gobardhan.co.in/assets/cert-logo/style.css');
		$dompdf->render();
		$filefile='public/certificate/'.$certName;
		if(file_exists($filefile)){ unlink($filefile); }
		file_put_contents($filefile, $dompdf->output());
       // $dompdf->stream();
		// echo "send OTP";
        // $message = "Please activate the account ".anchor('user/activate/'.$data['u_link'],'Activate Now','');
        $message = "Dear ".$authorised_person.",<br/>

					Thank you for registering your $project_name ($entity) in the Unified Registration Portal for GOBARdhan. Your registration number is ".$project_registration_no.". The registration certificate is attached with this mail.<br/>

					You can also login in at gobardhan.co.in and download the registration certificate in your profile.  <br/>

					Regards <br/>
					Admin, GOBARdhan <br/>
					Department of Drinking Water and Sanitation <br/>
					Ministry of Jal Shakti <br/>";
					
        $email = \Config\Services::email();
        $email->setFrom('admin@gobardhan.co.in', 'GOBARDhan');
        //$email->setFrom('ss.snm1503@gmail.com', 'GOBARDhan');
        $email->setTo($useremail);
        //$email->setTo('satyendrasinghbca777@gmail.com');
        $email->setSubject('Certificate Generated');
        $email->setMessage($message);//your message here
        $email->attach($filefile);
        //$email->setCC('satyendrasinghbca777@gmail.com');//CC
        // $email->setBCC('thirdEmail@emialHere');// and BCC
        // $filename = '/img/yourPhoto.jpg'; //you can use the App patch 
         //$email->attach($filename);
        
        if($email->send()){
			$result = array("status"=>1,"msg"=>"mail send successfully.");
		}else{
			$result = array("status"=>0,"msg"=>"failed.");
		}
		echo json_encode($result);
        //$email->printDebugger(['headers']);
		
		
    }
	
	function plantExitMail($to,$message="")
	{
		//$message = "This is the testing mail";
        $email = \Config\Services::email();
        $email->setFrom('admin@gobardhan.co.in', 'Plant already exist');
        //$email->setFrom('ss.snm1503@gmail.com', 'your Title Here');
        $email->setTo($to);
        $email->setSubject('Plant already registered');
        $email->setMessage($message);//your message here
		//$email->setCC('satyendrasinghbca777@gmail.com');//CC
		$email->send();
	}
	
	function htmlToPDFTemp(){
		$session = session();
		$user_id = $session->get('user_id');
		$useremail = $session->get('email');
		
		$projectModel = new ProjectModel();
		$orgModel = new OrganizationModel();
		$org = $orgModel->where('user_id',$user_id)->first();
		$authorised_person = $org['authorised_person'];
		$orgname = $org['entity_name'];
		
		$pid = $this->request->getVar('pid');
		if(!empty($pid)){
			$project = $projectModel->where('project_id',$pid)->first();
			if(empty($project['state_id']) || empty($project['district_id']) ){
				$result = array("status"=>0,"msg"=>"failed.");
				echo json_encode($result);
				exit();
			}
			
			$projectDetails = [
				'form_completion' => 100
			];
			$projectModel->update($pid,$projectDetails);
			
			if(empty($project['entity_type_id'])){
				$result = array("status"=>0,"msg"=>"failed.");
				echo json_encode($result);
				exit();
			}
			
			
			$prjts=[]; 
			if($project['entity_type_id']=="17")
			{
				$prjts = $projectModel->select("count(project_id) as totProjects")->where('entity_type_id','17')->where('gp_id',$project['gp_id'])->first();
				if($prjts['totProjects']>2){
					$mailMsg='Dear '.$authorised_person.', <br><br>'.'This plant is already regitered, Please wait to admin approval for certificate.';
					$this->plantExitMail($useremail,$mailMsg);
					$result = array("status"=>0,"msg"=>"failed.");
					echo json_encode($result);
					exit();
				}
			} 
			
			if($project['entity_type_id']=="18")
			{
				$prjts = $projectModel->select("count(project_id) as totProjects")->where('entity_type_id','18')->where('district_id',$project['district_id'])->first();
				if($prjts['totProjects']>2){
					$mailMsg='Dear '.$authorised_person.', <br><br>'.'This plant is already regitered, Please wait to admin approval for certificate.';
					$this->plantExitMail($useremail,$mailMsg);
					$result = array("status"=>0,"msg"=>"failed.");
					echo json_encode($result);
					exit();
				}
			}
			
			
			$project_registration_no=$project_name='';
			$entity='';
			$states='';
			$districts='';
			$pincode='';
			$address ='';
			$blocks='';
			$villages='';
			$gram_panchayats='';
		
			$project_registration_no = $project['project_registration_no'];
			$project_name = $project['project_name'];
			$entity = uniquedetails($this->db, 'option_list', 'title', 'id', $project['entity_type_id']);
			$states = uniquedetails($this->db, 'states', 'state_name', 'state_code', $project['state_id']);
			$districts = uniquedetails($this->db, 'districts', 'district_name', 'district_code', $project['district_id']);
			if(!empty($project['block_id'])){
				$blocks = uniquedetails($this->db, 'blocks', 'block_name', 'block_code', $project['block_id']);
				$villageids = uniquedetails($this->db, 'project_rural_address', 'village_id', 'project_id', $pid);
				$villages = uniquedetails($this->db, 'villages', 'village_name', 'village_code', $villageids);
				$gpids = uniquedetails($this->db, 'project_rural_address', 'gp_id', 'project_id', $pid);
				$gram_panchayats = uniquedetails($this->db, 'gram_panchayat', 'gp_name', 'gp_code', $gpids);
			}
			
			
			
			$pincode=$project['pincode'];
			//$city=$project['city']
			
			
			if($project['plot_number']!='')
			{
				$address.=$project['plot_number'].", ";
			}
			if($project['street_area_address']!='')
			{
				$address.=$project['street_area_address'].", ";
			}
			if($villages!='')
			{
				$address.="Village-".$villages.", ";
			}
			if($gram_panchayats!='')
			{
				$address.="GP-".$gram_panchayats.", ";
			}
			if($blocks!='')
			{
				$address.="Block-".$blocks.", ";
			}
			if($project['city']!='')
			{
				$address.=$project['city'].", ";
			}
			
			
			
			
		}
		
		$certName='certficate'.$user_id.$pid.'.pdf';
		
        $dompdf = new \Dompdf\Dompdf(); 
		$html='<html lang="en" >
				<head>
				  <meta charset="UTF-8">
				  <title>Certificate</title>
				  <link rel="stylesheet" href="https://gobardhan.co.in/assets/cert-logo/certificates.css">
				  <link rel="stylesheet" href="https://gobardhan.co.in/assets/cert-logo/style.css">
				</head>
				<body>
				  <div class="pm-certificate-container" >
					
					<div class="pm-certificate-border">
					  <div class="pm-certificate-header">
						<div class="pm-certificate-title text-center">
						  <div class="row">
							  <div class="col-xs-1 text-left" >
								<img src="https://gobardhan.co.in/assets/cert-logo/Emblem_of_India.png" style="width: 40px; ">
							  </div>
							  <div class="col-xs-5 text-left">
							  <p style="font-size:12px; margin-left:-40px;  text-align:left; margin-top:10px;">
					  Department of Drinking Water & Sanitation <br/>
					  Ministry of Jal Shakti</p>
							  </div>
							  <div class="col-xs-6 text-right" style="margin-left:-80px;">
							  <img src="https://gobardhan.co.in/assets/cert-logo/1.png" style="width:80px;">
							  <img src="https://gobardhan.co.in/assets/cert-logo/3.png" style="width:80px;">
							  <img src="https://gobardhan.co.in/assets/cert-logo/2.png" style="width:80px;">
							  </div>
							
						  </div>
						  
						</div>
					  </div>
					  <div class="pm-certificate-body">
						<div class="row">
						  <div class="col-md-12">
						  
							<div class="pm-name-text text-right"><span class="bold block " style="font-size: 12px;">Date: '.date('d-M-Y').' </span></div>
						  </div>
						</div>
						
						<div class="row">
						  <div class="col-md-12">
							<div class="pm-certificate-block">
								
								  <div class="row" >
									  <div class="col-md-12" >
										<h4 class="pm-earned-text block bold text-center">Certificate of Registration</h4>
									  </div>
									<div class="col-xs-3"><!-- LEAVE EMPTY --></div>
									<div class="pm-certificate-name underline margin-0 col-xs-6 text-center" style="margin-left:-40px">
									  <span class="pm-name-text bold">Registration Number: '.$project_registration_no.' </span>
									</div>
								  </div>
										
								
								  <div class="row" style="padding:5px; width:99%; text-align:center; height: 360px;">
									<div class="pm-earned col-xs-12 text-center">
									  <p class="pm-credits-text block  sans" style="text-align:justify">This is to certify that <span class="bold">'.$project_name.'</span> belonging to <span class="bold">'.$orgname.'</span> located at<span class="bold"> '.$address.', District-'.$districts.', State-'.$states.', Pincode-'.$pincode.' </span> has temporarily registered itself as <span class="bold">'.$entity.' Plant</span> on Unified Registration Portal for GOBARdhan (Galvanizing Organic Bio Agro Resources Dhan).</p>
									</div>
								  </div>
								
							</div>
							
						  </div>
						</div>
						
						<div class="row" style="width:95%;">
							  <div class="col-md-12">
									<div class="row pm-certificate-footer" style="margin-top: 20px!important; margin-bottom: 20px!important;">
										<div class="col-xs-4 pm-certified col-xs-4 text-center">
										</div>
										<div class="col-xs-8 pm-certified col-xs-8 text-right" >
										  <img src="https://gobardhan.co.in/assets/cert-logo/sign.png" style="width:150px;">
										  <br/>
										  <p class="pm-credits-text block sans ">Karanjit Singh Ngangbam <br/><span class="bold">Director (GOBARdhan)</span>
									      <br/>								  
										  Department of Drinking Water and Sanitation<br/>
									      Ministry of Jal Shakti</p>
										</div>
									</div>
							  </div>
						 </div>
						
						  <div class="row" style="width:99%;">
							<div class="pm-earned col-xs-12 text-center">
							  <p class="pm-credits-text1 block  sans " style="text-align:justify">
							  <i><b>Note:</b> Once the Biogas plant is functional, kindly update the status of the plant and other particulars as required in the Unified Registration Portal for GOBARdhan. After updating the status of the Biogas plant, click submit. A permanent registration number will be sent to your registered email.</i></p>
							
							  <p class="pm-credits-text1 block  sans " style="text-align:justify">
							  <i><b>Disclaimer:</b> This registration certificate has been issued based on information provided and certified by the applicant, and no independent verification of the same has been carried out by the issuing authority.</i></p>
							</div>
						  </div>
						  
					  </div>
					</div>
				  </div>
				</body>
				<!-- partial -->
				</html>';
		
				$dompdf->loadHtml($html);
				//$dompdf->loadHtml(view('final_certificate'));
				$dompdf->setPaper('A4', 'portrait');
				
				//$dompdf->set_base_path('https://gobardhan.co.in/assets/cert-logo/certificates.css');
				//$dompdf->set_base_path('https://gobardhan.co.in/assets/cert-logo/style.css');
				$dompdf->render();
				$filefile='public/certificate/'.$certName;
				file_put_contents($filefile, $dompdf->output());
			   // $dompdf->stream();
				// echo "send OTP";
				// $message = "Please activate the account ".anchor('user/activate/'.$data['u_link'],'Activate Now','');
				$message = "Dear ".$authorised_person.",<br/>

					Thank you for registering your $project_name ($entity) plant in the Unified Registration Portal for GOBARdhan. Your temporary registration number is ".$project_registration_no.". The temporary registration certificate is attached with this mail.<br/>

					You can also login in at gobardhan.co.in and download the registration certificate in your profile.  <br/>

					Regards <br/>
					Admin, GOBARdhan <br/>
					Department of Drinking Water and Sanitation <br/>
					Ministry of Jal Shakti <br/>";
					
				$email = \Config\Services::email();
				$email->setFrom('admin@gobardhan.co.in', 'GOBARDhan');
				//$email->setFrom('ss.snm1503@gmail.com', 'GOBARDhan');
				$email->setTo($useremail);
				//$email->setTo('satyendrasinghbca777@gmail.com');
				$email->setSubject('Certificate Generated');
				$email->setMessage($message);//your message here
				$email->attach($filefile);
				//$email->setCC('satyendrasinghbca777@gmail.com');//CC
				// $email->setBCC('thirdEmail@emialHere');// and BCC
				// $filename = '/img/yourPhoto.jpg'; //you can use the App patch 
				 //$email->attach($filename);
				
				if($email->send()){
					$result = array("status"=>1,"msg"=>"mail send successfully.");
				}else{
					$result = array("status"=>0,"msg"=>"failed.");
				}
				echo json_encode($result);
				//$email->printDebugger(['headers']);
		
    }
	
	
	public function createCertificate($pid)
	{
		$session = session();
		$user_id = $session->get('user_id');
		$useremail = $session->get('email');
		
		$certName='certficate'.$user_id.$pid.'.pdf';
		
		$projectModel = new ProjectModel();
		$orgModel = new OrganizationModel();
		$org = $orgModel->where('user_id',$user_id)->first();
		$authorised_person = $org['authorised_person'];
		$orgname = $org['entity_name'];
		
		
		$pid =$pid; //$this->request->getVar('pid');
		if(!empty($pid)){
			$project = $projectModel->where('project_id',$pid)->first();
			if(empty($project['state_id']) || empty($project['district_id']) ){
				$result = array("status"=>0,"msg"=>"failed.");
				echo json_encode($result);
				exit();
			}
			
			$projectDetails = [
				'form_completion' => 100
			];
			$projectModel->update($pid,$projectDetails);
			
			if(empty($project['entity_type_id'])){
				$result = array("status"=>0,"msg"=>"failed.");
				echo json_encode($result);
				exit();
			}
			
			$prjts=[];
			if($project['entity_type_id']=="17")
			{
				$prjts = $projectModel->where('gp_id',$project['gp_id'])->findAll();
				if(count($prjts)>2){
					$mailMsg='Dear '.$authorised_person.', <br><br>'.'This plant is already regitered, Please wait to admin approval for certificate.';
					$this->plantExitMail($useremail,$mailMsg);
					$result = array("status"=>0,"msg"=>"failed.");
					echo json_encode($result);
					exit();
				}
			}
			
			if($project['entity_type_id']=="18")
			{
				$prjts = $projectModel->where('district_id',$project['district_id'])->findAll();
				if(count($prjts)>2){
					$mailMsg='Dear '.$authorised_person.', <br><br>'.'This plant is already regitered, Please wait to admin approval for certificate.';
					$this->plantExitMail($useremail,$mailMsg);
					$result = array("status"=>0,"msg"=>"failed.");
					echo json_encode($result);
					exit();
				}
			}
			
			
		
			$project_registration_no=$project_name='';
			$entity='';
			$states='';
			$districts='';
			$pincode='';
			$address ='';
			$blocks='';
			$villages='';
			$gram_panchayats='';
		
			$project_registration_no = $project['project_registration_no'];
			$project_name = $project['project_name'];
			$entity = uniquedetails($this->db, 'option_list', 'title', 'id', $project['entity_type_id']);
			$states = uniquedetails($this->db, 'states', 'state_name', 'state_code', $project['state_id']);
			$districts = uniquedetails($this->db, 'districts', 'district_name', 'district_code', $project['district_id']);
			$districts = uniquedetails($this->db, 'districts', 'district_name', 'district_code', $project['district_id']);
			if(!empty($project['block_id'])){
				$blocks = uniquedetails($this->db, 'blocks', 'block_name', 'block_code', $project['block_id']);
				$villageids = uniquedetails($this->db, 'project_rural_address', 'village_id', 'project_id', $pid);
				$villages = uniquedetails($this->db, 'villages', 'village_name', 'village_code', $villageids);
				$gpids = uniquedetails($this->db, 'project_rural_address', 'gp_id', 'project_id', $pid);
				$gram_panchayats = uniquedetails($this->db, 'gram_panchayat', 'gp_name', 'gp_code', $gpids);
			}
			$pincode=$project['pincode'];
			//$city=$project['city']
			
			
			if($project['plot_number']!='')
			{
				$address.=$project['plot_number'].", ";
			}
			if($project['street_area_address']!='')
			{
				$address.=$project['street_area_address'].", ";
			}
			if($villages!='')
			{
				$address.="Village-".$villages.", ";
			}
			if($gram_panchayats!='')
			{
				$address.="GP-".$gram_panchayats.", ";
			}
			if($blocks!='')
			{
				$address.="Block-".$blocks.", ";
			}
			if($project['city']!='')
			{
				$address.=$project['city'].", ";
			}
			
		}
		
		
		// return view('create_certificate');
		// die;
		// $session = session();
		// $user_id = $session->get('user_id');
		// $useremail = $session->get('email');
		// $certName='certficate'.$user_id.$pid.'.pdf';
		
        $dompdf = new \Dompdf\Dompdf(); 
		$html='<html lang="en" >
				<head>
				  <meta charset="UTF-8">
				  <title>Certificate</title>
				  <link rel="stylesheet" href="https://gobardhan.co.in/assets/cert-logo/certificates.css">
				  <link rel="stylesheet" href="https://gobardhan.co.in/assets/cert-logo/style.css">
				</head>
				<body>
				  <div class="pm-certificate-container" >
					
					<div class="pm-certificate-border">
					  <div class="pm-certificate-header">
						<div class="pm-certificate-title text-center">
						  <div class="row">
							  <div class="col-xs-1 text-left" >
								<img src="https://gobardhan.co.in/assets/cert-logo/Emblem_of_India.png" style="width: 40px; ">
							  </div>
							  <div class="col-xs-5 text-left">
							  <p style="font-size:12px; margin-left:-40px;  text-align:left; margin-top:10px;">
					  Department of Drinking Water & Sanitation <br/>
					  Ministry of Jal Shakti</p>
							  </div>
							  <div class="col-xs-6 text-right" style="margin-left:-80px;">
							  <img src="https://gobardhan.co.in/assets/cert-logo/1.png" style="width:80px;">
							  <img src="https://gobardhan.co.in/assets/cert-logo/3.png" style="width:80px;">
							  <img src="https://gobardhan.co.in/assets/cert-logo/2.png" style="width:80px;">
							  </div>
							
						  </div>
						  
						</div>
					  </div>
					  <div class="pm-certificate-body">
						<div class="row">
						  <div class="col-md-12">
						  
							<div class="pm-name-text text-right"><span class="bold block " style="font-size: 12px;">Date: '.date('d-M-Y').' </span></div>
						  </div>
						</div>
						
						<div class="row">
						  <div class="col-md-12">
							<div class="pm-certificate-block">
								
								  <div class="row" >
									  <div class="col-md-12" >
										<h4 class="pm-earned-text block bold text-center">Certificate of Registration</h4>
									  </div>
									<div class="col-xs-3"><!-- LEAVE EMPTY --></div>
									<div class="pm-certificate-name underline margin-0 col-xs-6 text-center" style="margin-left:-40px">
									  <span class="pm-name-text bold">Registration Number: '.$project_registration_no.' </span>
									</div>
								  </div>
										
								
								  <div class="row" style="padding:5px; width:99%; text-align:center; height: 360px;">
									<div class="pm-earned col-xs-12 text-center">
									  <p class="pm-credits-text block  sans" style="text-align:justify">This is to certify that <span class="bold">'.$project_name.'</span> belonging to <span class="bold">'.$orgname.'</span> located at<span class="bold"> '.$address.', District-'.$districts.', State-'.$states.', Pincode-'.$pincode.' </span> has temporarily registered itself as <span class="bold">'.$entity.' Plant</span> on Unified Registration Portal for GOBARdhan (Galvanizing Organic Bio Agro Resources Dhan).</p>
									</div>
								  </div>
								
							</div>
							
						  </div>
						</div>
						
						<div class="row" style="width:95%;">
							  <div class="col-md-12">
									<div class="row pm-certificate-footer" style="margin-top: 20px!important; margin-bottom: 20px!important;">
										<div class="col-xs-4 pm-certified col-xs-4 text-center">
										</div>
										<div class="col-xs-8 pm-certified col-xs-8 text-right" >
										  <img src="https://gobardhan.co.in/assets/cert-logo/sign.png" style="width:150px;">
										  <br/>
										  <p class="pm-credits-text block sans ">Karanjit Singh Ngangbam <br/><span class="bold">Director (GOBARdhan)</span>
									      <br/>								  
										  Department of Drinking Water and Sanitation<br/>
									      Ministry of Jal Shakti</p>
										</div>
									</div>
							  </div>
						 </div>
						
						  <div class="row" style="width:99%;">
							<div class="pm-earned col-xs-12 text-center">
							  <p class="pm-credits-text1 block  sans " style="text-align:justify">
							  <i><b>Note:</b> Once the Biogas plant is functional, kindly update the status of the plant and other particulars as required in the Unified Registration Portal for GOBARdhan. After updating the status of the Biogas plant, click submit. A permanent registration number will be sent to your registered email.</i></p>
							
							  <p class="pm-credits-text1 block  sans " style="text-align:justify">
							  <i><b>Disclaimer:</b> This registration certificate has been issued based on information provided and certified by the applicant, and no independent verification of the same has been carried out by the issuing authority.</i></p>
							</div>
						  </div>
						  
					  </div>
					</div>
				  </div>
				</body>
				<!-- partial -->
				</html>';
		
		
		$dompdf->loadHtml($html);
		//$dompdf->loadHtml(view('final_certificate'));
        $dompdf->setPaper('A4', 'portrait');
        
		//$dompdf->set_base_path('https://gobardhan.co.in/assets/cert-logo/certificates.css');
		//$dompdf->set_base_path('https://gobardhan.co.in/assets/cert-logo/style.css');
		$dompdf->render();
		$filefile='public/certificate/'.$certName;
		file_put_contents($filefile, $dompdf->output());
       // $dompdf->stream();
	   
	}
	
	
	
	
	public function makeCertificate($pid)
	{
		$session = session();
		// $user_id = $session->get('user_id');
		// $useremail = $session->get('email');
		$projectModel = new ProjectModel();
		$orgModel = new OrganizationModel();
		$userModel = new UserModel();
		
		$project = $projectModel->where('project_id',$pid)->first();
		$user_id = $project['user_id'];
		
		$userDetails = $userModel->where('user_id',$user_id)->first();
		$useremail = $userDetails['email']; //"satyendrasinghbca777@gmail.com";
		
		
		$org = $orgModel->where('user_id',$user_id)->first();
		$authorised_person = $org['authorised_person'];
		$orgname = $org['entity_name'];
		
		//$pid = $this->request->getVar('pid');
		
		
		$project_registration_no=$project_name='';
		$entity='';
		$states='';
		$districts='';
		$pincode='';
		$address ='';
		$blocks='';
		$villages='';
		$gram_panchayats='';
		if(!empty($pid)){
			$projectDetails = [
				'form_completion' => 100,
				'project_status' => 'approve'
			];
			$projectModel->update($pid,$projectDetails);
		
			//$project = $projectModel->where('project_id',$pid)->first();
			$project_registration_no = $project['project_registration_no'];
			$plant_status_id = $project['plant_status_id'];
			$project_name = $project['project_name'];
			$entity = uniquedetails($this->db, 'option_list', 'title', 'id', $project['entity_type_id']);
			$states = uniquedetails($this->db, 'states', 'state_name', 'state_code', $project['state_id']);
			$districts = uniquedetails($this->db, 'districts', 'district_name', 'district_code', $project['district_id']);
			$districts = uniquedetails($this->db, 'districts', 'district_name', 'district_code', $project['district_id']);
			if(!empty($project['block_id'])){
				$blocks = uniquedetails($this->db, 'blocks', 'block_name', 'block_code', $project['block_id']);
				$villageids = uniquedetails($this->db, 'project_rural_address', 'village_id', 'project_id', $pid);
				$villages = uniquedetails($this->db, 'villages', 'village_name', 'village_code', $villageids);
				$gpids = uniquedetails($this->db, 'project_rural_address', 'gp_id', 'project_id', $pid);
				$gram_panchayats = uniquedetails($this->db, 'gram_panchayat', 'gp_name', 'gp_code', $gpids);
			}
			$pincode=$project['pincode'];
			//$city=$project['city']
			
			if($project['plot_number']!='')
			{
				$address.=$project['plot_number'].", ";
			}
			if($project['street_area_address']!='')
			{
				$address.=$project['street_area_address'].", ";
			}
			if($villages!='')
			{
				$address.="Village-".$villages.", ";
			}
			if($gram_panchayats!='')
			{
				$address.="GP-".$gram_panchayats.", ";
			}
			if($blocks!='')
			{
				$address.="Block-".$blocks.", ";
			}
			if($project['city']!='')
			{
				$address.=$project['city'].", ";
			}
			
		}
		
		$cert_title='Certificate of Temporary Registration';
		if($plant_status_id=="24" || $plant_status_id=="290"){
			$cert_title='Certificate of Registration';
		}
		
		$certName='certficate'.$user_id.$pid.'.pdf';
		
        $dompdf = new \Dompdf\Dompdf(); 
		$html='<html lang="en" >
				<head>
				  <meta charset="UTF-8">
				  <title>Certificate</title>
				  <link rel="stylesheet" href="https://gobardhan.co.in/assets/cert-logo/certificates.css">
				  <link rel="stylesheet" href="https://gobardhan.co.in/assets/cert-logo/style.css">
				</head>
				<body>
				  <div class="pm-certificate-container" >
					
					<div class="pm-certificate-border">
					  <div class="pm-certificate-header">
						<div class="pm-certificate-title text-center">
						  <div class="row">
							  <div class="col-xs-1 text-left" >
								<img src="https://gobardhan.co.in/assets/cert-logo/Emblem_of_India.png" style="width: 40px; ">
							  </div>
							  <div class="col-xs-5 text-left">
							  <p style="font-size:12px; margin-left:-40px;  text-align:left; margin-top:10px;">
					  Department of Drinking Water & Sanitation <br/>
					  Ministry of Jal Shakti</p>
							  </div>
							  <div class="col-xs-6 text-right" style="margin-left:-80px;">
							  <img src="https://gobardhan.co.in/assets/cert-logo/1.png" style="width:80px;">
							  <img src="https://gobardhan.co.in/assets/cert-logo/3.png" style="width:80px;">
							  <img src="https://gobardhan.co.in/assets/cert-logo/2.png" style="width:80px;">
							  </div>
							
						  </div>
						  
						</div>
					  </div>
					  <div class="pm-certificate-body">
						<div class="row">
						  <div class="col-md-12">
						  
							<div class="pm-name-text text-right"><span class="bold block " style="font-size: 12px;">Date: '.date('d-M-Y').' </span></div>
						  </div>
						</div>
						
						<div class="row">
						  <div class="col-md-12">
							<div class="pm-certificate-block">
								
								  <div class="row" >
									  <div class="col-md-12" >
										<h4 class="pm-earned-text block bold text-center">'.$cert_title.'</h4>
									  </div>
									<div class="col-xs-3"><!-- LEAVE EMPTY --></div>
									<div class="pm-certificate-name underline margin-0 col-xs-6 text-center" style="margin-left:-40px">
									  <span class="pm-name-text bold">Registration Number: '.$project_registration_no.' </span>
									</div>
								  </div>
										
								
								  <div class="row" style="padding:5px; width:99%; text-align:center; height: 360px;">
									<div class="pm-earned col-xs-12 text-center">
									  <p class="pm-credits-text block  sans" style="text-align:justify">This is to certify that <span class="bold">'.$project_name.'</span> belonging to <span class="bold">'.$orgname.'</span> located at<span class="bold"> '.$address.', District-'.$districts.', State-'.$states.', Pincode-'.$pincode.' </span> has registered itself as <span class="bold">'.$entity.' Plant</span> on Unified Registration Portal for GOBARdhan (Galvanizing Organic Bio Agro Resources Dhan).</p>
									</div>
								  </div>
								
							</div>
							
						  </div>
						</div>
						
						<div class="row" style="width:95%;">
							  <div class="col-md-12">
									<div class="row pm-certificate-footer" style="margin-top: 20px!important; margin-bottom: 20px!important;">
										<div class="col-xs-4 pm-certified col-xs-4 text-center">
										</div>
										<div class="col-xs-8 pm-certified col-xs-8 text-right" >
										  <img src="https://gobardhan.co.in/assets/cert-logo/sign.png" style="width:150px;">
										  <br/>
										  <p class="pm-credits-text block sans ">Karanjit Singh Ngangbam <br/><span class="bold">Director (GOBARdhan)</span>
									      <br/>								  
										  Department of Drinking Water and Sanitation<br/>
									      Ministry of Jal Shakti</p>
										</div>
									</div>
							  </div>
						 </div>
						
						  <div class="row" style="width:99%;">
							<div class="pm-earned col-xs-12 text-center">
							  <p class="pm-credits-text1 block  sans " style="text-align:justify">
							  <i><b>Note:</b> Once the Biogas plant is functional, kindly update the status of the plant and other particulars as required in the Unified Registration Portal for GOBARdhan. After updating the status of the Biogas plant, click submit. A permanent registration number will be sent to your registered email.</i></p>
							
							  <p class="pm-credits-text1 block  sans " style="text-align:justify">
							  <i><b>Disclaimer:</b> This registration certificate has been issued based on information provided and certified by the applicant, and no independent verification of the same has been carried out by the issuing authority.</i></p>
							</div>
						  </div>
						  
					  </div>
					</div>
				  </div>
				</body>
				<!-- partial -->
				</html>';
		
			$dompdf->loadHtml($html);
			//$dompdf->loadHtml(view('final_certificate'));
			$dompdf->setPaper('A4', 'portrait');
			
			//$dompdf->set_base_path('https://gobardhan.co.in/assets/cert-logo/certificates.css');
			//$dompdf->set_base_path('https://gobardhan.co.in/assets/cert-logo/style.css');
			$dompdf->render();
			$filefile='public/certificate/'.$certName;
			if(file_exists($filefile)){ unlink($filefile); }
			file_put_contents($filefile, $dompdf->output());
			
			// $dompdf->stream();
			// $message = "Please activate the account ".anchor('user/activate/'.$data['u_link'],'Activate Now','');
			$message = "Dear ".$authorised_person.",<br/><br/>
					Thank you for registering your $project_name ($entity) plant in the Unified Registration Portal for GOBARdhan. Your temporary registration number is ".$project_registration_no.". The temporary registration certificate is attached with this mail.<br/>
					You can also login in at gobardhan.co.in and download the registration certificate in your profile.  <br/>
					Regards <br/><br/>
					Admin, GOBARdhan <br/>
					Department of Drinking Water and Sanitation <br/>
					Ministry of Jal Shakti <br/>";
			
			if($plant_status_id=="24" || $plant_status_id=="290"){
				
				$message = "Dear ".$authorised_person.",<br/><br/>
					Thank you for registering your $project_name ($entity) in the Unified Registration Portal for GOBARdhan. Your registration number is ".$project_registration_no.". The registration certificate is attached with this mail.<br/>
					You can also login in at gobardhan.co.in and download the registration certificate in your profile.  <br/>
					Regards <br/><br/>
					Admin, GOBARdhan <br/>
					Department of Drinking Water and Sanitation <br/>
					Ministry of Jal Shakti <br/>";
			}
			
			$email = \Config\Services::email();
			$email->setFrom('admin@gobardhan.co.in', 'GOBARDhan');
			//$email->setFrom('ss.snm1503@gmail.com', 'GOBARDhan');
			$email->setTo($useremail);
			//$email->setTo('satyendrasinghbca777@gmail.com');
			$email->setSubject('Certificate Generated');
			$email->setMessage($message);//your message here
			$email->attach($filefile);
			//$email->setCC('satyendrasinghbca777@gmail.com');//CC
			// $email->setBCC('thirdEmail@emialHere');// and BCC
			// $filename = '/img/yourPhoto.jpg'; //you can use the App patch 
			 //$email->attach($filename); 
			if($email->send()){
				$result = array("status"=>1,"msg"=>"mail send successfully.");
			}else{
				$result = array("status"=>0,"msg"=>"failed.");
			}
			echo json_encode($result);
			//$email->printDebugger(['headers']); 
			
	}
	
}
