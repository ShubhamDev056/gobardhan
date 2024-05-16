<?php

namespace App\Controllers;
use App\Models\District;
use App\Models\OrganizationModel;
use App\Models\OptionList;
use App\Models\State;
use App\Models\UserModel;
use App\Models\PartnerModel;
use App\Models\UlbModel;

class OrganizationController extends BaseController
{

    private $db;
    public $per_page;

    public function __construct(){

        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session(); 
        $this->per_page = 10;
    }
    

    public function index()
    {
    	return view('backend/entity-list');
    }

    public function ORGRegister()
    {
        $stateModel = new State();
        $districtModel = new District();
        $optionList = new OptionList();
        
		$session = session();
		$userId = $session->get('user_id');
		$orgModel = new OrganizationModel();
		$org = $orgModel->where('user_id', $userId)->first();
		if(!empty($org)){
			return redirect()->to(base_url().'add-project'); 
		}
		
		/// SAVE ORGANIZATION DATA INTO DATABASE
		if($this->request->getMethod() === 'post'){
			
		
			$entity_name = $this->request->getVar('entity_name');
			$entity_type = $this->request->getVar('entity_type');
			$sub_entity = $this->request->getVar('sub_entity');
			$other_subtype = $this->request->getVar('other_subtype');
			$ulb_code = $this->request->getVar('ulb_code');
			$authorised_person = $this->request->getVar('authorised_person');
			$mobile_number = $this->request->getVar('mobile_number');
			$entity_email = $this->request->getVar('entity_email');
			$entity_address = $this->request->getVar('entity_address');
			$entity_state = $this->request->getVar('entity_state');
			$entity_district = $this->request->getVar('entity_district');
			$entity_pincode = $this->request->getVar('entity_pincode');
			
			$entity_reg_no = $this->request->getVar('entity_reg_no');
			$entity_reg_date = $this->request->getVar('entity_reg_date');
			$entity_pan_no = $this->request->getVar('entity_pan_no');
			$entity_gst_no = $this->request->getVar('entity_gst_no');
			//$entity_reg_letter = $this->request->getFile('entity_reg_letter'); //FILE
			
			///2. Authorized Representative Details
			// $representitive_name = $this->request->getVar('representitive_name');
			// $representitive_designation = $this->request->getVar('representitive_designation');
			// $representitive_contact_number = $this->request->getVar('representitive_contact_number');
			// $representitive_email = $this->request->getVar('representitive_email');
			// $representitive_letter = $this->request->getFile('representitive_letter'); //FILE
			
			//3. Director (s) / Partner (s) detail
			// $nof_director = $this->request->getVar('nof_director');
			// $director_dinArr=[];
			// if($nof_director>0 && $this->request->getVar('director_din')!=""){
				// $director_dinArr = $this->request->getVar('director_din'); //arr
				// $director_nameArr = $this->request->getVar('director_name'); //arr
				// $director_genderArr = $this->request->getVar('director_gender'); //arr
				// $director_mobileArr = $this->request->getVar('director_mobile'); //arr
				// $director_emailArr = $this->request->getVar('director_email'); //arr
			// }
			
			
			
		
			
			///FORM VALIDATION
			$validation =  \Config\Services::validation();
			$rules = [
				"entity_name" => [
					"label" => "Entity Name", 
					"rules" => "required|min_length[3]|max_length[200]"
				],
				"entity_type" => [
					"label" => "entity_type", 
					"rules" => "required"
				],
				"sub_entity" => [
					"label" => "sub_entity", 
					"rules" => "required"
				],
				"authorised_person" => [
					"label" => "authorised_person", 
					"rules" => "required"
				],
				"entity_email" => [
					"label" => "entity_email", 
					"rules" => "required"
				],
				"entity_address" => [
					"label" => "entity_address", 
					"rules" => "required"
				],
				"entity_state" => [
					"label" => "entity_state", 
					"rules" => "required"
				],
				"entity_district" => [
					"label" => "entity_district", 
					"rules" => "required"
				],
				"entity_pincode" => [
					"label" => "entity_pincode", 
					"rules" => "required"
				],
				// "entity_reg_letter" => [
					// "label" => "entity_reg_letter",
					// "rules" => "uploaded[file]|max_size[file,1024]|ext_in[file,jpg,jpeg,docx,pdf],"
				// ]
				
			];
			
			if ($this->validate($rules)) {
				$errorsmsg=[];
				
				// if($entity_type=="2" && $nof_director==""){
					// $errorsmsg['noofdirector'] = "Please enter number of directors/ partners";
				// }else{
					// if($nof_director!=count($director_dinArr)){
						// $errorsmsg['partner_details'] = "Please enter partner details";
					// }
				// }
				
				//echo count($errorsmsg);
				if(count($errorsmsg)==0){
					// $newName='';
					// if($entity_reg_letter = $this->request->getFile('entity_reg_letter')){
						// if ($entity_reg_letter->isValid() && ! $entity_reg_letter->hasMoved()) {
							// $name = $entity_reg_letter->getName();
							// $ext = $entity_reg_letter->getClientExtension();
							// $newName = $entity_reg_letter->getRandomName(); 
							// $entity_reg_letter->move('public/uploads/entityletters/', $newName);
						// }
					// }
					
					// $ardAuthLetterNewName='';
					// if($representitiveletter = $this->request->getFile('representitive_letter')){
						// if ($representitiveletter->isValid() && ! $representitiveletter->hasMoved()) {
							// $name = $representitiveletter->getName();
							// $ext = $representitiveletter->getClientExtension();
							// $ardAuthLetterNewName = $representitiveletter->getRandomName(); 
							// $representitiveletter->move('public/uploads/authorizationletters/', $ardAuthLetterNewName);
						// }
					// }
					
					//$entityRegLetter = $newName;
					//$represntLetter = $ardAuthLetterNewName;
					$organizationInfo = [
						'entity_name'=>$entity_name,
						'entity_type'=>$entity_type,
						'entity_subtype'=>$sub_entity,
						'entity_subtype_other'=>$other_subtype,
						'ulb_code'=>$ulb_code,
						'authorised_person'=>$authorised_person,
						'mobile_no'=>$mobile_number,
						'email'=>$entity_email,
						'address'=>$entity_address,
						'state_id'=>$entity_state,
						'district_id'=>$entity_district,
						
						'pincode'=>$entity_pincode,
						'cin_reg_no'=>$entity_reg_no,
						'reg_date'=>$entity_reg_date,
						'pan_no'=>$entity_pan_no,
						'gst_no'=>$entity_gst_no,
						//'company_reg_letter'=>$entityRegLetter,
						
						// 'ard_name'=>$representitive_name,
						// 'ard_designation'=>$representitive_designation,
						// 'ard_contact_no'=>$representitive_contact_number,
						// 'ard_email'=>$representitive_email,
						// 'ard_authorization_letter'=>$represntLetter,
						// 'nof_director'=>$nof_director,
						'user_id'=>$userId,
					];
					// echo "<pre>";
					// print_r($organizationInfo);
					
					$orgModel = new OrganizationModel();
					$partnerModel = new PartnerModel();
					
					
					$result=$orgModel->insert($organizationInfo);
					$org_id = $orgModel->insertID;
					if($org_id){
						//$partnersDetails = [];
						/* foreach($director_dinArr as $key=>$director_din){
							$partners = [
								'name' => $director_nameArr[$key],
								'gender' => $director_genderArr[$key],
								'mobile' => $director_mobileArr[$key],
								'email' => $director_emailArr[$key],
								'din_no' => $director_din,
								'organization_id' => $org_id,
								'user_id' => $userId
							];
							//$partnersDetails[] = $partners;
							$result=$partnerModel->insert($partners);
						} */
						return redirect()->to(base_url().'add-project'); 
						
					}else{
						$errorsmsg['server_error'] = "Internal Server Error.";
					}
				}
				
			}else {
				$errorsmsg = $validation->getErrors();
			}
			$data["errors"] = $errorsmsg;
		}
		
		
		
		
        $data['entities'] = $optionList->where('parent','entity_type')->where('status','0')->orderBy('sequence','ASC')->findAll();
        $data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
        $data['districts'] = $districtModel->orderBy('district_name','ASC')->findAll();
        
    	return view('organization-registration', $data);
    }
	
	
	
	public function entityInfo()
	{
		return view('backend/entity-details');
	}
	
	public function ORGEdit()
	{
		$stateModel = new State();
        $districtModel = new District();
        $optionList = new OptionList();
        $ulbModel = new UlbModel();
        
		$session = session();
		$userId = $session->get('user_id');
		$orgModel = new OrganizationModel();
		$org = $orgModel->where('user_id', $userId)->first();
		$entity_type = $org['entity_type'];
		$state_id = $org['state_id'];
		$district_id = $org['district_id'];
		$org_id = $org['id'];
		
		if($this->request->getMethod() === 'post'){
			$entity_name = $this->request->getVar('entity_name');
			$entity_type = $this->request->getVar('entity_type');
			$sub_entity = $this->request->getVar('sub_entity');
			$other_subtype = $this->request->getVar('other_subtype');
			$ulb_code = $this->request->getVar('ulb_code');
			$authorised_person = $this->request->getVar('authorised_person');
			$mobile_number = $this->request->getVar('mobile_number');
			$entity_email = $this->request->getVar('entity_email');
			$entity_address = $this->request->getVar('entity_address');
			$entity_state = $this->request->getVar('entity_state');
			$entity_district = $this->request->getVar('entity_district');
			$entity_pincode = $this->request->getVar('entity_pincode');
			
			$entity_reg_no = $this->request->getVar('entity_reg_no');
			$entity_reg_date = $this->request->getVar('entity_reg_date');
			$entity_pan_no = $this->request->getVar('entity_pan_no');
			$entity_gst_no = $this->request->getVar('entity_gst_no');
			
			///FORM VALIDATION
			$validation =  \Config\Services::validation();
			$rules = [
				"entity_name" => [
					"label" => "Entity Name", 
					"rules" => "required|min_length[3]|max_length[200]"
				],
				"entity_type" => [
					"label" => "entity_type", 
					"rules" => "required"
				],
				"sub_entity" => [
					"label" => "sub_entity", 
					"rules" => "required"
				],
				"authorised_person" => [
					"label" => "authorised_person", 
					"rules" => "required"
				],
				"entity_email" => [
					"label" => "entity_email", 
					"rules" => "required"
				],
				"entity_address" => [
					"label" => "entity_address", 
					"rules" => "required"
				],
				"entity_state" => [
					"label" => "entity_state", 
					"rules" => "required"
				],
				"entity_district" => [
					"label" => "entity_district", 
					"rules" => "required"
				],
				"entity_pincode" => [
					"label" => "entity_pincode", 
					"rules" => "required"
				],
				// "entity_reg_letter" => [
					// "label" => "entity_reg_letter",
					// "rules" => "uploaded[file]|max_size[file,1024]|ext_in[file,jpg,jpeg,docx,pdf],"
				// ]
				
			];
			
			if ($this->validate($rules)) {
				$organizationInfo = [
					'entity_name'=>$entity_name,
					'entity_type'=>$entity_type,
					'entity_subtype'=>$sub_entity,
					'entity_subtype_other'=>$other_subtype,
					'ulb_code'=>$ulb_code,
					'authorised_person'=>$authorised_person,
					'mobile_no'=>$mobile_number,
					'email'=>$entity_email,
					'address'=>$entity_address,
					'state_id'=>$entity_state,
					'district_id'=>$entity_district,
					
					'pincode'=>$entity_pincode,
					'cin_reg_no'=>$entity_reg_no,
					'reg_date'=>$entity_reg_date,
					'pan_no'=>$entity_pan_no,
					'gst_no'=>$entity_gst_no,
					'user_id'=>$userId,
				];
				
				$orgModel = new OrganizationModel();
				
				
				$result=$orgModel->update($org_id,$organizationInfo);
				if($result){
					return redirect()->to(base_url().'profile'); 
					
				}else{
					$errorsmsg['server_error'] = "Internal Server Error.";
				}
			}
			
			
		}
		
		
		
		
		
		$data['entities'] = $optionList->where('parent','entity_type')->where('status','0')->orderBy('sequence','ASC')->findAll();
		$data['subtypes'] = $optionList->where('parent','sub_entity')->where('status','0')->where('dependency',$entity_type)->orderBy('sequence','ASC')->findAll();
        $data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
        $data['districts'] = $districtModel->orderBy('district_name','ASC')->where('state_code',$state_id)->findAll();
        $data['ulbs'] = $ulbModel->where('district_code',$district_id)->orderBy('ulb_name','ASC')->findAll();
		$data['org'] = $org;
		return view('organization-update',$data);
	}
}
