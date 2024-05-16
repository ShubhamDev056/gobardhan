<?php

namespace App\Controllers;
use App\Models\State;
use App\Models\District;
use App\Models\MinistryModel;
use App\Models\OrganizationModel;
use App\Models\ProjectModel;
use App\Models\User;
use App\Models\ProjectBenefitsModel;

class MinistryController extends BaseController
{
    private $db;
    public $per_page;

    public function __construct(){

        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session(); 
        $this->per_page = 10;
    }
	
    public function getAIFdata()
    {
		$session = session(); 
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		if($role!="admin"){
			return redirect()->to(base_url());
		}
		
        $ministryModel = new MinistryModel();
        // echo "call aif data function.."; /// AIF
        $url="https://agriinfra.dac.gov.in//api/govardhan/get";
        $curl = curl_init($url);
        // $data = [
        //     'name'=>'John Doe', 
        //     'email'=>'johndoe@yahoo.com'
        // ];
        /* Set JSON data to POST */
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','apiKey:9655bf77-abdb-428e-b5b2-c5d26d110502','UserName:GobarDhanAdmin','Password:cd4189558ff763018c38c0e63bf676bb'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        
        $result = json_decode($response);
        $aifdatas = $result->Data;
        
        // $aifCollectedData = $ministryModel->select('count(id) as totalAifData')->where('ministry','2')->first();
        // $totalAifData = $aifCollectedData['totalAifData'];
		$ministryModel->where('ministry', '2')->delete();
        foreach($aifdatas as $aifdata){
            $system_id = $aifdata->Beneficiary_Id;
            $unique_id = $aifdata->Loan_Application_Number;
            $contact_person_name = $aifdata->Beneficiary_Name;
            $org_name = $aifdata->Company_Name;
            $contact_number = $aifdata->Mobile_Number;
            $org_state_code = $aifdata->Beneficiary_Address_State_Code;
            $org_district_code = $aifdata->Beneficiary_Address_District_Code;
            $project_name = $aifdata->Project_Name;
            $email = $aifdata->Email_Id;

            $aifdataArr = (array) $aifdata; 
            $json_data = json_encode($aifdataArr);
            $ministryData = [
                'ministry' => '2',
                'system_id' => $system_id,
                'unique_id' => $unique_id,
                'org_name' => $org_name,
                'org_state_code' => $org_state_code,
                'org_district_code' => $org_district_code,
                'project_name' => $project_name,
                'contact_person_name' => $contact_person_name,
                'contact_number' => $contact_number,
                'email' => $email,
                'json_data' => $json_data
            ];

            $ministryModel->insert($ministryData);
        }
		echo "success AIF";
    }
	
	/// GET DATA FROM MoPNG MINISTRY
    public function getMoPNGdata()
    {
        $ministryModel = new MinistryModel();
        // echo "call aif data function..";
        $url="https://fnogwlazcl2v6gv-crmatp.adb.ap-mumbai-1.oraclecloudapps.com/ords/satat_prod/satat/Excel_Master_Download";
        $curl = curl_init($url);
		// curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: Basic bW9iaWxpdHlfdXNlcjpNMGIxbDF0eUBJMGNsIQ=='));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        
        $result = json_decode($response);
		// print_r($result);
		// die;
        $mopngdatas = $result->items;
		$ministryModel->where('ministry', '5')->delete();
        foreach($mopngdatas as $mopngdata){
            $system_id = $mopngdata->loi_system_id;
            $unique_id = $mopngdata->loi_reference_number;
            
            $contact_person_name = $mopngdata->fpr_name;
            $org_name = $mopngdata->organisation_name;
            $contact_number = $mopngdata->mobile_no;
            $org_state_code = "";
            $org_district_code = "";
            $project_name = $mopngdata->organisation_name;
            $email = $mopngdata->email_id;

            $mopngdataArr = (array) $mopngdata; 
            $json_data = json_encode($mopngdataArr);
            $ministryData = [
                'ministry' => '5',
                'system_id' => $system_id,
                'unique_id' => $unique_id,
                'org_name' => $org_name,
                'org_state_code' => $org_state_code,
                'org_district_code' => $org_district_code,
                'project_name' => $project_name,
                'contact_person_name' => $contact_person_name,
                'contact_number' => $contact_number,
                'email' => $email,
                'json_data' => $json_data
            ];
            $ministryModel->insert($ministryData);
        }
        echo "success MoPNG";
    }
	
	
	/// GET DATA FROM MNRE MINISTRY
    public function getMNREdata()
    {
        $ministryModel = new MinistryModel();
        // echo "call aif data function..";
        
		// ini_set('display_errors', 1);
		// ini_set('display_startup_errors', 1);
		// error_reporting(E_ALL);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://biourja.mnre.gov.in/api/v1/getapplications',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_SSL_VERIFYPEER=>0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_HTTPHEADER => array(
			'Authorization: Basic QmlvdXJqYTpCaW91cmphQDEyMzQ1Njc4OTA='
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$res = json_decode($response);
		//echo "<pre>";
		$datas = $res->data;
		$ministryModel->where('ministry', '3')->delete();
		foreach($datas as $appdata){
			$Application_Id = $appdata->Application_Id;
			$Application_Data = json_decode($appdata->Application_Data);
			$generals = $Application_Data->general;
			$projects = $Application_Data->project;
			
			$biofertilizerdata = $Application_Data->technical->outputType->biofertilizerdata;
			
			$project_name = $projects->project_name;
			$latitude_project = $projects->latitude_project;
			$longitude_project = $projects->longitude_project;
			$project_state = $projects->project_state;
			$project_district = $projects->project_district;
			$project_pin_code = $projects->project_pin_code;
			$solidFeedStockCapacity = $projects->waste_quantity;
			$solidFeedStockCapacityUnit = $projects->waste_quantity_unit;
			$construction_area = $projects->construction_area;
			$date_commissioning = $projects->date_commissioning;
			// if($construction_area>0){
				// $construction_area = $construction_area/4047;
			// }
			
			$designGasProductionCapacity=0;
			
			if(isset($Application_Data->technical->outputType->biocngdata)){
				$biocngdatas = $Application_Data->technical->outputType->biocngdata;
				$gpc = $biocngdatas->proposedbiocnggeneration;
				$designGasProductionCapacity = $gpc;
			}
			
			
			$fom = $biofertilizerdata->dryproduction;
			$lfom = $biofertilizerdata->liquidproduction;
			
			$capex='0';
			if(isset($Application_Data->cost)){
				if(isset($Application_Data->cost->cost)){
					$costs = $Application_Data->cost->cost;
					if(isset($costs->total_cost)){
						$capex = $costs->total_cost;
					}
				}
				
			}
			
			
			$name = $generals->name;
			$contact = $generals->contact;
			$email = $generals->email;
			$state = $generals->state;
			$district = $generals->district;
			$name_contactperson = $generals->name_contactperson;
			$contact_contactperson = $generals->contact_contactperson;
			
			$mnredataArr = [
				'Application_Id'=> $Application_Id,
				'project_name'=> $project_name,
				'latitude_project'=> $latitude_project,
				'longitude_project'=> $longitude_project,
				'project_state'=> $project_state,
				'project_district'=> $project_district,
				'project_pin_code'=> $project_pin_code,
				'solidFeedStockCapacity'=> $solidFeedStockCapacity,
				'solidFeedStockCapacityUnit'=> $solidFeedStockCapacityUnit,
				'construction_area'=> $construction_area,
				'date_commissioning'=> $date_commissioning,
				'designGasProductionCapacity'=> $designGasProductionCapacity,
				'fom'=> $fom,
				'lfom'=> $lfom,
				'capex'=> $capex,
				'name'=> $name,
				'contact'=> $contact,
				'email'=> $email,
				'state'=> $state,
				'district'=> $district,
				'name_contactperson'=> $name_contactperson,
				'contact_contactperson'=> $contact_contactperson,
			];
			
			$json_data = json_encode($mnredataArr);
            $ministryData = [
                'ministry' => '3',
                'system_id' => $Application_Id,
                'unique_id' => $Application_Id,
                'org_name' => $name,
                'org_state_code' => $state,
                'org_district_code' => $district,
                'project_name' => $project_name,
                'contact_person_name' => $name_contactperson,
                'contact_number' => $contact_contactperson,
                'email' => $email,
                'json_data' => $json_data
            ];
			//print_r($ministryData);
			
            $ministryModel->insert($ministryData);
		}
		echo "success";
    }
	
	
	
	
	
	
	function ministry_data()
	{
		$session = session(); 
		$role = $session->get('role');
		if($role!="admin"){
			return redirect()->to(base_url());
		}
		$stateModel = new State();
		$districtModel = new District();
		$ministryModel = new MinistryModel();
		
		$stateId = $this->request->getVar('state');
		$district = $this->request->getVar('district');
		
		$ministryModel->select("id, ministry,system_id,unique_id,org_name,org_state_code,org_district_code,project_name,contact_person_name,contact_number,email,mail_status,mail_on");
		if(!empty($stateId)){
			$ministryModel->where('project_details.state_id', $stateId);
		}
		if(!empty($district)){
			$ministryModel->where('project_details.district_id', $district);
		}
		
		/* if(!empty($project_name)){
			$projectModel->like('project_details.project_name', $project_name,'both');
		} */
		
		$projects = $ministryModel->paginate($this->per_page);
		$data['pager'] = $ministryModel->pager;
		$data['per_page'] = $ministryModel->per_page;
		$data['mdatas'] = $projects;
		
		//$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		//$data['districts'] = $districtModel->where('state_code',$stateId)->findAll();
		
		return view('backend/ministry-data-list',$data);
	}
	
	function sendmailtoAll()
	{
		$beneficiaries = $this->request->getVar('beneficiary');
		$ministryModel = new MinistryModel();
		$orgModel = new OrganizationModel();
		$projectModel = new ProjectModel();
		$userModel = new User();
		if($beneficiaries!="")
		{
			$bnfrys = $ministryModel->select("id, ministry,org_name,project_name,contact_person_name,contact_number,email, org_state_code, org_district_code 
			JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.Project_Cost')) as Project_Cost,
			JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.Project_Address_District_Code')) as Project_Address_District_Code,
			JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.Project_Address_State_Code')) as Project_Address_State_Code,
			JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.Project_Address_Geo_Longitude')) as Project_Address_Geo_Longitude,
			JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.Project_Address_Geo_Latitude')) as Project_Address_Geo_Latitude")->where('mail_status','Pending')->where('ministry','2')->whereIn('id',$beneficiaries)->findAll();
			foreach($bnfrys as $bnfry)
			{
				$id = $bnfry['id'];
				$emailId = $bnfry['email'];
				$contact_person_name = $bnfry['contact_person_name'];
				$org_name = $bnfry['org_name'];
				$project_name = $bnfry['project_name'];
				$contact_number = $bnfry['contact_number'];
				$Project_Cost = $bnfry['Project_Cost'];
				$org_state_code = $bnfry['org_state_code'];
				$org_district_code = $bnfry['org_district_code'];
				$Project_Address_District_Code = $bnfry['Project_Address_District_Code'];
				$Project_Address_State_Code = $bnfry['Project_Address_State_Code'];
				$Project_Address_Geo_Latitude = $bnfry['Project_Address_Geo_Latitude'];
				$Project_Address_Geo_Longitude = $bnfry['Project_Address_Geo_Longitude'];
				
				if(!empty($emailId)){
					$password = 'Gbrdhan#'.$id;
					$password = password_hash($password, PASSWORD_DEFAULT);
					$userInfo = [
						'name'=>$contact_person_name,
						'contact_no'=>$contact_number,
						'email'=>$emailId,
						'username'=>$emailId,
						'username'=>$password,
						'role_id'=>3,
						'designation'=>'NA'
					];
					
					
					$user = $userModel->select('user_id,name')->where('email',$emailId)->first();
					if($user){
						$user_id = $user['user_id'];
						$org =$orgModel->select('id,entity_name')->where('user_id',$user_id)->first();
						if($org){
							$org_id = $org['id'];
							$projectInfo = [
								'organization_id'=>$org_id,
								'project_name'=>$project_name,
								'total_capex'=>$Project_Cost,
								'state_id'=>$Project_Address_State_Code,
								'district_id'=>$Project_Address_District_Code,
								'latitude'=>$Project_Address_Geo_Latitude,
								'longitude'=>$Project_Address_Geo_Longitude,
							];
							$result=$projectModel->insert($projectInfo);
							//$user_id = $User->insertID;
							
						}else{
							$orgInfo = [
								'entity_name'=>$org_name,
								'authorised_person'=>$contact_person_name,
								'mobile_no'=>$contact_number,
								'email'=>$emailId,
								'state_id'=>$org_state_code,
								'district_id'=>$org_district_code,
								'user_id'=>$user_id,
							];
							$result=$orgModel->insert($orgInfo);
							$orgid = $orgModel->insertID;
							
						}
					}
					
					$message = "Dear $contact_person_name, <br><br> Please find the below the login details for GOBARdhan Portal. Please log in and update your organization details and project details. <br><br> URL: <a href='https://gobardhan.co.in/'> https://gobardhan.co.in/ </a> <br> Username: test <br> Password: test@123 <br><br> Regards <br> Admin, GOBARdhan <br> Department of Drinking Water and Sanitation <br> Ministry of Jal Shakti";
					$email = \Config\Services::email();
					$email->setFrom('admin@gobardhan.co.in', 'Update Project Details');
					$email->setTo($emailId);
					$email->setSubject('Update Project Details');
					$email->setMessage($message);
					$response = $email->send();
					if($response){
						$bnfArr = [
							'mail_status'=> 'mailsent',
							'mail_on'=> date("Y-m-d H:i:s")
						];
						$ministryModel->update($id,$bnfArr);
					}
					$res = array("status"=>1,"msg"=>"success");
				}
				else{
					$res = array("status"=>0,"msg"=>"Email Id is missing.");
				}
				
			}
		}else{
			$res = array("status"=>0,"msg"=>"all fields are required.");
		}
		echo json_encode($res);
	}
	
	
	
	function checkmProject()
	{
		$session = session(); 
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		
		$ministryModel = new MinistryModel();
		$mcode = $this->request->getVar('mcode');
		$ucode = $this->request->getVar('ucode');
		if($mcode!="" && $ucode!=""){
			if($mcode==2){       /// AIF
				$query = $this->db->query("select id, unique_id, ministry,org_name,project_name,contact_person_name,contact_number,email, org_state_code, org_district_code, JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.Project_Cost')) as Project_Cost,	JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.Project_Address_District_Code')) as Project_Address_District_Code, JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.Project_Address_State_Code')) as Project_Address_State_Code, JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.Project_Address_Geo_Longitude')) as Project_Address_Geo_Longitude, JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.Project_Address_Geo_Latitude')) as Project_Address_Geo_Latitude, JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.Land_Status')) as Land_Status from ministry_data where ministry='2' and unique_id='".$ucode."'  ");
				$bnf_details = $query->getRow();
				if($bnf_details){
					$orgModel = new OrganizationModel();
					$projectModel = new ProjectModel();
					$projectBenefitsModel = new ProjectBenefitsModel();
					$org = $orgModel->where('user_id',$userId)->first();
					$org_id = $org['id'];
					$capex = $bnf_details->Project_Cost/100000;
					
					$Land_Status = $bnf_details->Land_Status;
					$land_ownership_id='0';
					if($Land_Status=="Owned"){
						$land_ownership_id=87;
					}
					if($Land_Status=="Leased"){
						$land_ownership_id=84;
					}
					
					
					$projectInfo = [
						'ministry' => 'AIF',
						'munique_id' => $bnf_details->unique_id,
						'organization_id'=> $org_id,
						'project_name'=> $bnf_details->project_name,
						'latitude'=> $bnf_details->Project_Address_Geo_Latitude,
						'longitude'=> $bnf_details->Project_Address_Geo_Longitude,
						'land_ownership_id'=> $land_ownership_id,
						'total_capex'=> $capex,
						'state_id'=> $bnf_details->Project_Address_State_Code,
						'district_id'=> $bnf_details->Project_Address_District_Code,
						'entity_type_id'=> 18,
						'plant_type_id'=> 21,
						'user_id'=> $userId,
						'form_completion'=> 20
					];
					$insertProject = $projectModel->insert($projectInfo);
					$pid = $projectModel->insertID;
					if($pid){
						$prBenefits = [
							'option_list_id'=> 254,
							'status'=> 'availed',
							'project_id'=> $pid,
							'organization_id'=> $org_id
						];
						$result=$projectBenefitsModel->insert($prBenefits);
						$resultArr = array("status"=>1,"message"=>"Project added successfully.","project_id"=>$pid);
					}
					else{
						$resultArr = array("status"=>0,"message"=>"Project added successfully.");
					}
				}else{
					$resultArr = array("status"=>0,"message"=>"Record not found.");
				}
				
			}else if($mcode==5){
				///MoPNG
				$query = $this->db->query("select id,unique_id, ministry,org_name,project_name,contact_person_name,contact_number,email, org_state_code, org_district_code, JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.operation_commenced')) as operation_commenced,	JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.plant_commission_date')) as plant_commission_date, JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.latitude')) as latitude, JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.longitude')) as longitude, JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.capital_investment_for_plant')) as capital_investment_for_plant, JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.operation_commenced')) as operation_commenced, JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.plant_commission_date')) as plant_commission_date from ministry_data where ministry='5' and unique_id='".$ucode."' ");
				$bnf_details = $query->getRow();
				if($bnf_details){
					$orgModel = new OrganizationModel();
					$projectModel = new ProjectModel();
					$projectBenefitsModel = new ProjectBenefitsModel();
					$org = $orgModel->where('user_id',$userId)->first();
					$org_id = $org['id'];
					
					$cpx = $bnf_details->capital_investment_for_plant*100;
					
					
					$projectInfo = [
						'ministry' => 'MoPNG',
						'munique_id' => $bnf_details->unique_id,
						'organization_id'=> $org_id,
						'project_name'=> $bnf_details->project_name,
						'latitude'=> $bnf_details->latitude,
						'longitude'=> $bnf_details->longitude,
						'entity_type_id'=> 18,
						'plant_type_id'=> 21,
						'total_capex'=> $cpx,
						'user_id'=> $userId,
						'form_completion'=> 20
					];
					if($bnf_details->operation_commenced=="Yes"){
						$projectInfo['plant_status_id'] = 24;
						$projectInfo['date_of_commissioning'] = date('Y-m-d', strtotime($bnf_details->plant_commission_date));
					}
					
					$insertProject = $projectModel->insert($projectInfo);
					$pid = $projectModel->insertID;
					if($pid){
						$resultArr = array("status"=>1,"message"=>"Project added successfully.","project_id"=>$pid);
					}
					else{
						$resultArr = array("status"=>0,"message"=>"Project added successfully.");
					}
				}else{
					$resultArr = array("status"=>0,"message"=>"Record not found.");
				}
				
			}else if($mcode==3){
				///MNRE
				$query = $this->db->query("select id,unique_id, ministry,org_name,project_name,contact_person_name,contact_number,email, org_state_code, org_district_code,	JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.designGasProductionCapacity')) as gas_production_capacity, JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.latitude_project')) as Latitude, JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.longitude_project')) as Longitude,
					JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.fom')) as fom,
					JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.lfom')) as lfom,
					JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.capex')) as capex,
					JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.project_state')) as project_state,
					JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.project_district')) as project_district,
					JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.project_pin_code')) as project_pin_code,
					JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.solidFeedStockCapacity')) as solidFeedStockCapacity,
					JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.construction_area')) as construction_area,
					JSON_UNQUOTE(JSON_EXTRACT(json_data, '$.date_commissioning')) as date_commissioning
					from ministry_data where ministry='3' and unique_id='".$ucode."' ");
				$bnf_details = $query->getRow();
				if($bnf_details){
					$orgModel = new OrganizationModel();
					$projectModel = new ProjectModel();
					$projectBenefitsModel = new ProjectBenefitsModel();
					$org = $orgModel->where('user_id',$userId)->first();
					$org_id = $org['id'];
					$projectInfo = [
						'ministry' => 'MNRE',
						'munique_id' => $bnf_details->unique_id,
						'organization_id'=> $org_id,
						'project_name'=> $bnf_details->project_name,
						'latitude'=> $bnf_details->Latitude,
						'longitude'=> $bnf_details->Longitude,
						'entity_type_id'=> 18,
						'plant_type_id'=> 21,
						'gas_production_capacity'=> $bnf_details->gas_production_capacity,
						'gpc_unit'=> 'Tons/day',
						'solid_feedstock_capacity'=> $bnf_details->solidFeedStockCapacity,
						'sfc_unit'=> 'Tons/day',
						'FOM_output'=> $bnf_details->fom,
						'FOM_unit'=> 'Tons/day',
						'LFOM_output'=> $bnf_details->lfom,
						'LFOM_unit'=> 'KLD',
						'state_id'=> $bnf_details->project_state,
						'district_id'=> $bnf_details->project_district,
						'pincode'=> $bnf_details->project_pin_code,
						'total_capex'=> $bnf_details->capex,
						'plant_area'=> $bnf_details->construction_area,
						'user_id'=> $userId,
						'form_completion'=> 20
					];
					$insertProject = $projectModel->insert($projectInfo);
					$pid = $projectModel->insertID;
					if($pid){
						$resultArr = array("status"=>1,"message"=>"Project added successfully.","project_id"=>$pid);
					}
					else{
						$resultArr = array("status"=>0,"message"=>"Project added successfully.");
					}
				}else{
					$resultArr = array("status"=>0,"message"=>"Record not found.");
				}
			}else{
				$resultArr = array("status"=>0,"message"=>"Invalid ministry.");
			}
		}
		else{
			$resultArr = array("status"=>0,"message"=>"All fields are required.");
		}
		
		echo json_encode($resultArr);
	}
	
	
	
}
