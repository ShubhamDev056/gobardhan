<?php

namespace App\Controllers;
use App\Models\OptionList;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\GramPanchayat;
use App\Models\Village;
use App\Models\OrganizationModel;
use App\Models\ProjectModel;
use App\Models\ProjectBenefitsModel;
use App\Models\ProjectFeedstockModel;
use App\Models\ProjectFundingSourceModel;
use App\Models\ProjectLinkageModel;
use App\Models\ProjectRuralAddress;
use App\Models\ProjectBankModel;
use App\Models\MonthlyReportingModel;
use App\Models\MonthlyProjectLog;
use App\Models\ChangeStatusModel;

use DateTime;
class ProjectController extends BaseController
{
	private $db;
    public $per_page;

    public function __construct(){

        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session(); 
        $this->per_page = 10;
    }
    // public function index()
    // {
    //     return view('login');
    // }

    public function addProject()
    {
		$session = session();
		$userId = $session->get('user_id');
        $stateModel = new State();
        $districtModel = new District();
        $optionList = new OptionList();
		$orgModel = new OrganizationModel();
		$data['org'] = $orgModel->where('user_id',$userId)->first();
		if(empty($data['org'])){
			return redirect()->to(base_url().'profile');  
		}
        $data['reg_purposes'] = $optionList->where('parent','reg_purpose')->where('status','0')->orderBy('sequence','ASC')->findAll();
        $data['govschemes'] = $optionList->where('parent','reg_purpose')->where('unit_type','govschemes')->where('status','0')->orderBy('sequence','ASC')->findAll();
        
        $data['gasOutputs'] = $optionList->where('parent','gag_output')->orderBy('sequence','ASC')->findAll();
        $data['plant_status'] = $optionList->where('parent','plant_status')->where('status','0')->orderBy('sequence','ASC')->findAll();
        $data['biogas_plants'] = $optionList->where('parent','biogas_plant')->where('dependency',17)->orderBy('sequence','ASC')->findAll();
        $data['cbg_plants'] = $optionList->where('parent','cbg_plant')->where('dependency',18)->orderBy('sequence','ASC')->findAll();
        $data['feedstock_types'] = $optionList->where('parent','feedstock_type')->where('unit_type','solid')->where('dependency',0)->where('status','0')->orderBy('sequence','ASC')->findAll();
        $data['feedstock_types_liqd'] = $optionList->where('parent','feedstock_type')->where('unit_type','liquid')->where('dependency',0)->where('status','0')->orderBy('sequence','ASC')->findAll();
        $data['feedstock_sources'] = $optionList->where('parent','feedstock_source')->where('unit_type','solid')->where('dependency',0)->where('status','0')->orderBy('sequence','ASC')->findAll();
        //$data['feedstock_sources_liqd'] = $optionList->where('parent','feedstock_source')->where('unit_type','liquid')->where('dependency',0)->orderBy('sequence','ASC')->findAll();
        
        $data['technology_for_bioslurrys'] = $optionList->where('parent','technology_for_bioslurry')->where('dependency',0)->where('status',0)->orderBy('sequence','ASC')->findAll();
        $data['funding_sources'] = $optionList->where('parent','funding_source')->where('dependency',0)->where('status',0)->orderBy('sequence','ASC')->findAll();
        $data['loi_detailss'] = $optionList->where('parent','loi_details')->where('dependency',0)->where('status',0)->orderBy('sequence','ASC')->findAll();
        $data['plantLocations'] = $optionList->where('parent','plant_locations')->where('dependency',0)->where('status',0)->orderBy('sequence','ASC')->findAll();
		$data['land_ownerships'] = $optionList->where('parent','land_ownership')->orderBy('sequence','ASC')->findAll();
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll(); 
        //$data['districts'] = $districtModel->orderBy('district_name','ASC')->findAll();
        
    	return view('add-project', $data);
    }
	
	
	public function addProjectTest()
    {
		$session = session(); 
		$userId = $session->get('user_id');
        $stateModel = new State();
        $districtModel = new District();
        $optionList = new OptionList();
		$orgModel = new OrganizationModel();
		$data['org'] = $orgModel->where('user_id',$userId)->first();
		if(empty($data['org'])){
			return redirect()->to(base_url().'profile'); 
		}
        $data['reg_purposes'] = $optionList->where('parent','reg_purpose')->orderBy('sequence','ASC')->findAll();
        $data['govschemes'] = $optionList->where('parent','reg_purpose')->where('unit_type','govschemes')->where('status','0')->orderBy('sequence','ASC')->findAll();
        
        $data['gasOutputs'] = $optionList->where('parent','gag_output')->orderBy('sequence','ASC')->findAll();
        $data['plant_status'] = $optionList->where('parent','plant_status')->where('status','0')->orderBy('sequence','ASC')->findAll();
        $data['biogas_plants'] = $optionList->where('parent','biogas_plant')->where('dependency',17)->orderBy('sequence','ASC')->findAll();
        $data['cbg_plants'] = $optionList->where('parent','cbg_plant')->where('dependency',18)->orderBy('sequence','ASC')->findAll();
        $data['feedstock_types'] = $optionList->where('parent','feedstock_type')->where('unit_type','solid')->where('dependency',0)->where('status','0')->orderBy('sequence','ASC')->findAll();
        $data['feedstock_types_liqd'] = $optionList->where('parent','feedstock_type')->where('unit_type','liquid')->where('dependency',0)->where('status','0')->orderBy('sequence','ASC')->findAll();
        $data['feedstock_sources'] = $optionList->where('parent','feedstock_source')->where('unit_type','solid')->where('dependency',0)->where('status','0')->orderBy('sequence','ASC')->findAll();
        //$data['feedstock_sources_liqd'] = $optionList->where('parent','feedstock_source')->where('unit_type','liquid')->where('dependency',0)->orderBy('sequence','ASC')->findAll();
        
        $data['technology_for_bioslurrys'] = $optionList->where('parent','technology_for_bioslurry')->where('dependency',0)->where('status',0)->orderBy('sequence','ASC')->findAll();
        $data['funding_sources'] = $optionList->where('parent','funding_source')->where('dependency',0)->where('status',0)->orderBy('sequence','ASC')->findAll();
        $data['loi_detailss'] = $optionList->where('parent','loi_details')->where('dependency',0)->where('status',0)->orderBy('sequence','ASC')->findAll();
        $data['plantLocations'] = $optionList->where('parent','plant_locations')->where('dependency',0)->where('status',0)->orderBy('sequence','ASC')->findAll();
		$data['land_ownerships'] = $optionList->where('parent','land_ownership')->orderBy('sequence','ASC')->findAll();
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll(); 
        //$data['districts'] = $districtModel->orderBy('district_name','ASC')->findAll();
        
    	return view('add-project-test', $data);
    }

   
	public function projectInfo($pid)
	{
		$session = session(); 
		$userId = $session->get('user_id');
		$role = $session->get('role');
		$bname = $session->get('name');
		
		
		$projectModel = new ProjectModel();
		$orgModel = new OrganizationModel();
		$projectBenefitsModel = new ProjectBenefitsModel();
		$projectFeedstockModel = new ProjectFeedstockModel();
		$projectFundingSourceModel = new ProjectFundingSourceModel();
		$projectLinkageModel = new ProjectLinkageModel();
		$projectBankModel = new ProjectBankModel();
		
		/// BASIC INFORMATION
		$data['project'] = $projectModel->where('project_id',$pid)->first(); 
		$organization_id = $data['project']['organization_id'];
		$data['org'] = $orgModel->where('id',$organization_id)->first();
		
		if($role=='bank'){
			$projectBankModel->where('bank_name',$bname);
		}
		
		$data['project_banks'] = $projectBankModel->where('project_id',$pid)->where('status','1')->where('bankloan_applied','Yes')->orderBy('project_bank_id','desc')->findAll(); 
		
		if($userId=="5"){
			$query = $this->db->query("SELECT id, project_id, plant_status_id, plant_status_date FROM statusChangeLogDates WHERE project_id='".$pid."' AND plant_status_id IN(22,23,24,290) LIMIT 4 ");
			$statusLogs = $query->getResultArray();
			$plantsStatusLogs=[];
			foreach($statusLogs as $statusLog){
				$plantsStatusLogs[$statusLog['plant_status_id']] = $statusLog;
			}
			$data['plantsStatusLogs'] = $plantsStatusLogs;
		}
		
		/// PROJECT BENEFITS
		//$data['pbenefits'] = $projectBenefitsModel->where('project_id',$pid)->where('organization_id',$organization_id)->findAll();
		
		$projectBenefitsModel->select('project_benefits.*,option_list.title ');
		$projectBenefitsModel->join('option_list', 'project_benefits.option_list_id=option_list.id');
		$projectBenefitsModel->where('project_benefits.project_id', $pid);
		$projectBenefitsModel->where('project_benefits.organization_id', $organization_id);
		$data['pbenefits'] = $projectBenefitsModel->findAll();
		
		
		/// FEEDSTOCK SOURCE TYPE SOLID
		
		$projectFeedstockModel->select('source_type_feedstocks.*,option_list.title ');
		$projectFeedstockModel->join('option_list', 'source_type_feedstocks.option_list_id=option_list.id');
		$projectFeedstockModel->where('source_type_feedstocks.project_id', $pid);
		$projectFeedstockModel->where('source_type_feedstocks.organization_id', $organization_id);
		$projectFeedstockModel->where('source_type_feedstocks.source_type', 'solid');
		$data['solidFsSources'] = $projectFeedstockModel->findAll();
		
		/// FEEDSTOCK SOURCE TYPE LIQUID
		$projectFeedstockModel->select('source_type_feedstocks.*,option_list.title ');
		$projectFeedstockModel->join('option_list', 'source_type_feedstocks.option_list_id=option_list.id');
		$projectFeedstockModel->where('source_type_feedstocks.project_id', $pid);
		$projectFeedstockModel->where('source_type_feedstocks.organization_id', $organization_id);
		$projectFeedstockModel->where('source_type_feedstocks.source_type', 'liquid');
		$data['liquidFsSources'] = $projectFeedstockModel->findAll();
		
		/// FORWARD LINKAGE
		$projectLinkageModel->select('forward_linkages.*,option_list.title ');
		$projectLinkageModel->join('option_list', 'forward_linkages.option_list_id=option_list.id');
		$projectLinkageModel->where('forward_linkages.project_id', $pid);
		$projectLinkageModel->where('forward_linkages.organization_id', $organization_id);
		$data['fLinkages'] = $projectLinkageModel->findAll(); 
		
		/// FUNDING SOURCE
		$projectFundingSourceModel->select('project_funding_source.*,option_list.title ');
		$projectFundingSourceModel->join('option_list', 'project_funding_source.option_list_id=option_list.id');
		$projectFundingSourceModel->where('project_funding_source.project_id', $pid);
		$projectFundingSourceModel->where('project_funding_source.organization_id', $organization_id);
		$data['fSources'] = $projectFundingSourceModel->findAll();
		
		$data['conn'] = $this->db;
		return view('backend/project-details',$data);
	}
	
	public function certifyAuthority()
	{
		return view('backend/certifying-authority');
	}
	
	public function biogasStateReports()
	{
		$stateModel = new State();
		$minitry = $this->request->getVar('m');
		//$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll(); 
		//select state_code, state_name, (select count(distinct(district_id)) from project_details where project_details.state_id=state_code ) as districtCovered, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='22'  ) as yettostarted, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='23'  ) as underconstruction, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='24'  ) as functional from states
		
		if(!empty($minitry) && $minitry=='ddws'){
			$mnst = " and project_id IN(SELECT DISTINCT(project_id) FROM project_benefits WHERE option_list_id='255' )";
			$data['states'] = $stateModel->select("state_code, state_name, noofdistricts, (select count(distinct(district_id)) from project_details where project_details.state_id=state_code $mnst  and  entity_type_id='17' and plant_status_id!='22' ) as districtCovered, (select count(project_id) from project_details, organizations as o where project_details.organization_id=o.id and o.entity_type='1' and project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='22' $mnst  ) as yettostarted, (select count(project_id) from project_details, organizations AS o where project_details.organization_id=o.id and o.entity_type='1' and project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='23' $mnst ) as underconstruction, (select count(project_id) from project_details, organizations AS o where project_details.organization_id=o.id and o.entity_type='1' and project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='24' $mnst ) as functional, (select count(project_id) from project_details, organizations AS o where project_details.organization_id=o.id and o.entity_type='1' and project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='290' $mnst ) as completed ")->orderBy('state_name','ASC')->findAll();
		}else{
			$data['states'] = $stateModel->select("state_code, state_name, noofdistricts, (select count(distinct(district_id)) from project_details where project_details.state_id=state_code  and  entity_type_id='17' and plant_status_id!='22' ) as districtCovered, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='22'  ) as yettostarted, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='23'  ) as underconstruction, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='24'  ) as functional, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='290'  ) as completed ")->orderBy('state_name','ASC')->findAll();
		}
		
		
		$type = $this->request->getVar('t');
		$data['type'] = $type;
		$data['list_title'] = '';
		if($type=='registered'){
			$data['list_title'] = 'Biogas Plants Registered';
		}
		if($type=='functional'){
			$data['list_title'] = 'Biogas Plants Functional';
		}
		
		if($type=='construction'){
			$data['list_title'] = 'Biogas Plants – Construction in progress';
		}
		
		if($type=='districtscovered'){
			$data['list_title'] = 'Number of Districts covered with Biogas Plants ';
		}
		if($type=='state'){ 
			$data['list_title'] = 'Status of States/ UTs';
		}

		return view('biogas-state-report',$data);
	}
	
	public function biogasDistrictReports()
	{
		$stateModel = new State();
		$districtModel = new District();
		
		$type = $this->request->getVar('t');
		$stateId = $this->request->getVar('s');
		$minitry = $this->request->getVar('m');
		 
		$data['type'] = $type;
		$data['state'] = $stateModel->where('state_code',$stateId)->orderBy('state_name','ASC')->first();
		//$data['districts'] = $districtModel->where('state_code',$stateId)->orderBy('district_name','ASC')->findAll();
		
		//$data['districts'] = $districtModel->select("district_code, district_name, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='22'  ) as yettostarted, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='23'  ) as underconstruction, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='24'  ) as functional, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='290'  ) as completed")->where('state_code',$stateId)->orderBy('district_name','ASC')->findAll();
		
		if(!empty($minitry) && $minitry=='ddws'){
			$mnst = " and project_id IN(SELECT DISTINCT(project_id) FROM project_benefits WHERE option_list_id='255' )";
			$data['districts'] = $districtModel->select("district_code, district_name, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='22' $mnst ) as yettostarted, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='23' $mnst ) as underconstruction, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='24' $mnst ) as functional, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='290' $mnst ) as completed")->where('state_code',$stateId)->orderBy('district_name','ASC')->findAll();
			
		}else{
			$data['districts'] = $districtModel->select("district_code, district_name, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='22'  ) as yettostarted, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='23'  ) as underconstruction, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='24'  ) as functional, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='290'  ) as completed")->where('state_code',$stateId)->orderBy('district_name','ASC')->findAll();
		}
		
		$data['list_title'] = '';
		
		if($type=='state'){ 
			$data['list_title'] = 'District Status';
		}


		return view('biogas-district-report',$data);
	}
	
	
	
	public function cbgStateReports()
	{
		$stateModel = new State();
		//$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll(); 
		$data['states'] = $stateModel->select("state_code, state_name, noofdistricts, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='18' and plant_status_id='22'  ) as yettostarted, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='18' and plant_status_id='23'  ) as underconstruction, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='18' and plant_status_id='24'  ) as functional, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='18' and plant_status_id='290' ) as completed")->orderBy('state_name','ASC')->findAll();
		
		$type = $this->request->getVar('t');
		$data['type'] = $type;
		$data['list_title'] = '';
		if($type=='registered'){
			$data['list_title'] = 'CBG/ Bio CNG Plants Registered';
		}
		if($type=='functional'){
			$data['list_title'] = 'CBG/ Bio CNG Plants Functional';
		}
		if($type=='construction'){
			$data['list_title'] = 'CBG/ Bio CNG Plants – Construction in progress';
		}
		if($type=='districtscovered'){
			$data['list_title'] = 'Number of Districts covered  with CBG/ Bio CNG Plants';
		}
		if($type=='state'){ 
			$data['list_title'] = 'Status of States/ UTs';
		}
		return view('cbg-state-report',$data);
	}
	
	public function cbgDistrictReports()
	{
		$stateModel = new State();
		$districtModel = new District();
		
		$type = $this->request->getVar('t');
		$stateId = $this->request->getVar('s');
		
		$data['type'] = $type;
		$data['state'] = $stateModel->where('state_code',$stateId)->orderBy('state_name','ASC')->first();
		//$data['districts'] = $districtModel->where('state_code',$stateId)->orderBy('district_name','ASC')->findAll();
		$data['districts'] = $districtModel->select("district_code, district_name, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='18' and plant_status_id='22'  ) as yettostarted, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='18' and plant_status_id='23'  ) as underconstruction, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='18' and plant_status_id='24'  ) as functional, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='18' and plant_status_id='290'  ) as completed")->where('state_code',$stateId)->orderBy('district_name','ASC')->findAll();
		
		$data['list_title'] = '';
		if($type=='registered'){
			$data['list_title'] = 'Biogas Plants Registered';
		}
		
		if($type=='functional'){
			$data['list_title'] = 'Biogas Plants Functional';
		}
		
		if($type=='construction'){
			$data['list_title'] = 'Biogas Plants – Construction in progress';
		}
		if($type=='districtscovered'){
			$data['list_title'] = 'Number of Districts covered';
		}
		if($type=='state'){ 
			$data['list_title'] = 'District Status';
		}
		
		return view('cbg-district-report',$data);
	}
	
	public function locatePlant()
	{
		
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		$organizationModel = new OrganizationModel();
		//$districtModel = new District();
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll(); 
		$stateId = $this->request->getVar('state');
		$districtId = $this->request->getVar('district');
		$plant_type = $this->request->getVar('plant_type');
		$plant_status = $this->request->getVar('plant_status');
		$perpage = $this->request->getVar('per_page');
		
		if(trim($perpage) != ""){
			$this->per_page = $perpage;
		}
		
		$locateDetails=[];
		$districts=[];
		$pager=$prpage='';
		//select project_id, project_name, district_id, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address  FROM project_details WHERE state_id='22'
		if($stateId!=""){
			
			$districts = $districtModel->where('state_code',$stateId)->findAll();
			
			$projectModel->select("organizations.entity_name ,project_id,organization_id, project_name, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address ");
			$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
			$projectModel->where('project_details.state_id', $stateId);
			if(!empty($districtId)){
				$projectModel->where('project_details.district_id', $districtId);
			}
			if(!empty($plant_type)){
				$projectModel->where('entity_type_id', $plant_type);
			}
			if(!empty($plant_status)){
				$projectModel->where('plant_status_id', $plant_status);
			}
			
			$locateDetails = $projectModel->paginate($this->per_page);
			// print_r($projectModel);
			// die;
			$pager = $projectModel->pager;
			$prpage = $projectModel->per_page;
		}
		
		$data['pager'] = $pager;
		$data['per_page'] = $prpage;
		
		$data['locateDetails'] = $locateDetails;
		$data['districts'] = $districts;
		return view('locate-plants',$data);
	}
	
	public function regCertificate()
	{
		$organizationModel = new OrganizationModel();
		$projectModel = new ProjectModel();
		$data['test'] = '';
		$project=[];
		if($this->request->getMethod() === 'post'){
			$searchby = $this->request->getVar('searchby');
			$searchtxt = $this->request->getVar('searchtxt');
			if($searchby=="entity_name"){
				//$organizationModel->where('')->findAll();
			}
			if($searchby=="plant_name"){
				$project=$projectModel->like('project_name',$searchtxt,'after')->whereIn('plant_status_id',[22,23,24,290])->findAll();
			}
			if($searchby=="registration_number"){
				$project=$projectModel->where('project_registration_no',$searchtxt)->whereIn('plant_status_id',[22,23,24,290])->findAll();
			}
			
			
		}
		$data['projects'] = $project;
		return view('reg-certificate',$data);
	}
	
	public function allPlants()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		if($role!="admin"){
			return redirect()->to(base_url());
		}
		
		
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		$optionList = new OptionList();
		
		if($roleId==1){
			$stateId = $this->request->getVar('state');
		}
		$district = $this->request->getVar('district');
		$plant_type = $this->request->getVar('plant_type');
		$plant_status = $this->request->getVar('plant_status');
		$completion = $this->request->getVar('completion');
		$project_name = $this->request->getVar('project_name');
		$fdate = $this->request->getVar('fdate');
		$tdate = $this->request->getVar('tdate');
		$fstype = $this->request->getVar('fstype');
		$entity_type = $this->request->getVar('entity_type');
		
		//$projects=$projectModel->where('state_id',$stateId)->findAll();
		$projectModel->select("organizations.entity_name,organizations.entity_type ,project_id,organization_id, project_name, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address ");
		$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
		if(!empty($stateId)){
			$projectModel->where('project_details.state_id', $stateId);
		}
		if(!empty($district)){
			$projectModel->where('project_details.district_id', $district);
		}
		if(!empty($plant_type)){
			$projectModel->where('project_details.entity_type_id', $plant_type);
		}
		if(!empty($plant_status)){
			$projectModel->where('project_details.plant_status_id', $plant_status);
		}
		if(!empty($entity_type)){
			$projectModel->where('organizations.entity_type', $entity_type);
		}
		
		if(!empty($completion)){
			$projectModel->where('project_details.form_completion', $completion);
		}
		if(!empty($project_name)){
			$projectModel->like('project_details.project_name', $project_name,'both');
		}
		if(!empty($fdate) && !empty($tdate)){
			$projectModel->where("date(project_details.created_at) >= '".$fdate."' ");
			$projectModel->where("date(project_details.created_at) <= '".$tdate."' ");
		}
		if(!empty($fstype)){
			$projectModel->where("project_details.project_id in(SELECT DISTINCT(project_id) FROM source_type_feedstocks WHERE option_list_id='".$fstype."' AND source_type='solid') ");
		}
		
		$projects = $projectModel->paginate($this->per_page);
		$data['pager'] = $projectModel->pager;
		$data['per_page'] = $projectModel->per_page;
		$data['projects'] = $projects;
		
		
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		$data['districts'] = $districtModel->where('state_code',$stateId)->findAll();
		$data['fstypes'] = $optionList->where('parent','feedstock_type')->where('unit_type','solid')->where('status','0')->findAll();
		
		return view('backend/plant-list',$data);
	} 
	
	
	public function allPlantsMinistry()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		$optionList = new OptionList();
		
		$stateId = $this->request->getVar('state');
		
		$district = $this->request->getVar('district');
		$plant_type = $this->request->getVar('plant_type');
		$plant_status = $this->request->getVar('plant_status');
		// $completion = $this->request->getVar('completion');
		$ministry = $this->request->getVar('ministry');
		$bnf_status = $this->request->getVar('bnf_status');
		$fstype = $this->request->getVar('fstype');
		$entity_type = $this->request->getVar('entity_type');
		$sub_entity_type = $this->request->getVar('sub_entity_type');
		$pt_location = $this->request->getVar('pt_location');
		$fromdate = $this->request->getVar('fdate');
		$todate = $this->request->getVar('todate');
		
		
		$subTypes=[];
		//$projects=$projectModel->where('state_id',$stateId)->findAll();
		$projectModel->select("organizations.entity_name, organizations.entity_type, states.state_name, districts.district_name, blocks.block_name, gram_panchayat.gp_name, villages.village_name ,project_details.project_id,project_details.organization_id, project_name, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address, plant_status_date ");
		$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
		$projectModel->join('states', 'project_details.state_id=states.state_code');
		$projectModel->join('districts', 'project_details.district_id=districts.district_code');
		$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
		$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
		$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
		$projectModel->where('project_details.state_id is not null');
		$projectModel->where('project_details.district_id is not null');
		$projectModel->where('project_details.entity_type_id is not null');
		
		 
		// if(!empty($ministry)){
			// $projectModel->join('project_benefits', 'project_details.project_id=project_benefits.project_id');
			// $projectModel->where('project_benefits.option_list_id', $ministry);
		// }
		
		
		if(!empty($stateId)){
			$projectModel->where('project_details.state_id', $stateId);
		}
		if(!empty($district)){
			$projectModel->where('project_details.district_id', $district);
		}
		if(!empty($plant_type)){
			$projectModel->where('project_details.entity_type_id', $plant_type);
		}
		
		if(!empty($pt_location)){
			$projectModel->where('project_details.plant_location_id', $pt_location);
		}
		
		if(!empty($entity_type)){
			$subTypes = $optionList->where('parent','sub_entity')->where('dependency',$entity_type)->where('status','0')->findAll();
			$projectModel->where('organizations.entity_type', $entity_type);
		}
		
		if(!empty($sub_entity_type)){
			$projectModel->where('organizations.entity_subtype', $sub_entity_type);
		}
		
		if(!empty($fstype)){
			$projectModel->where("project_details.project_id in(SELECT DISTINCT(project_id) FROM source_type_feedstocks WHERE option_list_id='".$fstype."' AND source_type='solid') ");
		}
		if(!empty($fromdate) && !empty($todate)){
			$projectModel->where("project_details.plant_status_date >= '".$fromdate."' and project_details.plant_status_date<= '".$todate."' ");
		}
		
		if(!empty($ministry) && !empty($bnf_status)){
			$c = count($ministry); 
			$m = implode(",",$ministry); 
			$projectModel->where("project_details.project_id in(SELECT project_id FROM project_benefits where option_list_id in($m) and project_benefits.status in('$bnf_status') GROUP by project_id having count(*)>=$c )  ");
		}
		
		if(!empty($plant_status)){
			$projectModel->where('project_details.plant_status_id', $plant_status);
			$projectModel->orderBy('project_details.plant_status_date', 'desc');
		}else{
			$projectModel->orderBy('project_details.created_at', 'desc');
		}
		
		$projectModel->groupBy('project_details.project_id');
		
		
		$projects = $projectModel->paginate($this->per_page);
		$data['pager'] = $projectModel->pager;
		$data['per_page'] = $projectModel->per_page;
		$data['projects'] = $projects;
		
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		$data['districts'] = $districtModel->where('state_code',$stateId)->findAll();
		$data['fstypes'] = $optionList->where('parent','feedstock_type')->where('unit_type','solid')->where('status','0')->findAll();
		$data['subTypes'] = $subTypes;
		return view('backend/plants-list',$data);
	} 
	
	
	public function allCbgPlants()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		$optionList = new OptionList();
		
		$stateId = $this->request->getVar('state');
		
		$district = $this->request->getVar('district');
		$plant_type = $this->request->getVar('plant_type');
		$plant_status = $this->request->getVar('plant_status');
		// $completion = $this->request->getVar('completion');
		$ministry = $this->request->getVar('ministry');
		$bnf_status = $this->request->getVar('bnf_status');
		$fstype = $this->request->getVar('fstype');
		//$entity_type = $this->request->getVar('entity_type');
		//$sub_entity_type = $this->request->getVar('sub_entity_type');
		$pt_location = $this->request->getVar('pt_location');
		//$fromdate = $this->request->getVar('fdate');
		//$todate = $this->request->getVar('todate');
		
		
		$subTypes=[];
		//$projects=$projectModel->where('state_id',$stateId)->findAll();
		$projectModel->select("organizations.entity_name, organizations.entity_type, states.state_name, districts.district_name, blocks.block_name, gram_panchayat.gp_name, villages.village_name ,project_details.project_id,project_details.organization_id, project_name, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address, plant_status_date ");
		$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
		$projectModel->join('states', 'project_details.state_id=states.state_code');
		$projectModel->join('districts', 'project_details.district_id=districts.district_code');
		$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
		$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
		$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
		$projectModel->where('project_details.state_id is not null');
		$projectModel->where('project_details.district_id is not null');
		$projectModel->where('project_details.entity_type_id is not null');
		
		$projectModel->where('project_details.entity_type_id', '18');
		
		if(!empty($stateId)){
			$projectModel->where('project_details.state_id', $stateId);
		}
		if(!empty($district)){
			$projectModel->where('project_details.district_id', $district);
		}
		
		if(!empty($pt_location)){
			$projectModel->where('project_details.plant_location_id', $pt_location);
		}
		
		
		if(!empty($fstype)){
			$projectModel->where("project_details.project_id in(SELECT DISTINCT(project_id) FROM source_type_feedstocks WHERE option_list_id='".$fstype."' AND source_type='solid') ");
		}
		// if(!empty($fromdate) && !empty($todate)){
			// $projectModel->where("project_details.plant_status_date >= '".$fromdate."' and project_details.plant_status_date<= '".$todate."' ");
		// }
		
		if(!empty($ministry) && !empty($bnf_status)){
			$c = count($ministry); 
			$m = implode(",",$ministry); 
			$projectModel->where("project_details.project_id in(SELECT project_id FROM project_benefits where option_list_id in($m) and project_benefits.status in('$bnf_status') GROUP by project_id having count(*)>=$c )  ");
		}
		
		if(!empty($plant_status)){
			$projectModel->where('project_details.plant_status_id', $plant_status);
			$projectModel->orderBy('project_details.plant_status_date', 'desc');
		}else{
			$projectModel->orderBy('project_details.created_at', 'desc');
		}
		
		$projectModel->groupBy('project_details.project_id');
		
		
		$projects = $projectModel->paginate($this->per_page);
		$data['pager'] = $projectModel->pager;
		$data['per_page'] = $projectModel->per_page;
		$data['projects'] = $projects;
		
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		$data['districts'] = $districtModel->where('state_code',$stateId)->findAll();
		$data['fstypes'] = $optionList->where('parent','feedstock_type')->where('unit_type','solid')->where('status','0')->findAll();
		$data['subTypes'] = $subTypes;
		return view('backend/cbg-plants-list',$data);
	} 
	
	
	public function projectDelete($id = null)
	{
		$session = session();
		$userId = $session->get('user_id');
		$role = $session->get('role');
		if($role!="admin"){
			return redirect()->to(base_url());
		}
		
		$projectModel = new ProjectModel();
		$projectBenefitsModel = new ProjectBenefitsModel();
		$projectFeedstockModel = new ProjectFeedstockModel();
		$projectFundingSourceModel = new ProjectFundingSourceModel();
		$projectLinkageModel = new ProjectLinkageModel();
		$projectRuralAddress = new ProjectRuralAddress();
		
		$data['project'] = $projectModel->where('project_id', $id)->delete();
	
		$projectBenefitsModel->where('project_id', $id)->delete();
		$projectFeedstockModel->where('project_id', $id)->delete();
		$projectFundingSourceModel->where('project_id', $id)->delete();
		$projectLinkageModel->where('project_id', $id)->delete();
		$projectRuralAddress->where('project_id', $id)->delete();
		
		
		return redirect()->to(base_url().'plant-list'); 
	}
	
	public function projectEdit($id = null)
	{
		$session = session();
		$userId = $session->get('user_id');
        $stateModel = new State();
        $districtModel = new District();
        $blocktModel = new Block();
        $optionList = new OptionList();
		$orgModel = new OrganizationModel();
		$projectModel = new ProjectModel();
		$projectInfo = $projectModel->where('project_id',$id)->first();
		$orgid = $projectInfo['organization_id'];
		$plantstatusId = $projectInfo['plant_status_id'];
		$data['org'] = $orgModel->where('id',$orgid)->first();
		if(empty($data['org'])){
			return redirect()->to(base_url().'profile'); 
		}
		
		$role = $session->get('role');
		if($role!="admin" && ($plantstatusId=="292" || $plantstatusId=="293")){
			return redirect()->to(base_url().'profile'); 
		}
		
        $data['reg_purposes'] = $optionList->where('parent','reg_purpose')->where('status','0')->orderBy('sequence','ASC')->findAll();
        $data['govschemes'] = $optionList->where('parent','reg_purpose')->where('unit_type','govschemes')->where('status','0')->orderBy('sequence','ASC')->findAll();
        $data['gasOutputs'] = $optionList->where('parent','gag_output')->orderBy('sequence','ASC')->findAll();
        $data['plant_status'] = $optionList->where('parent','plant_status')->where('status','0')->orderBy('sequence','ASC')->findAll();
        $data['biogas_plants'] = $optionList->where('parent','biogas_plant')->where('dependency',17)->orderBy('sequence','ASC')->findAll();
        $data['cbg_plants'] = $optionList->where('parent','cbg_plant')->where('dependency',18)->orderBy('sequence','ASC')->findAll();
        $data['feedstock_types'] = $optionList->where('parent','feedstock_type')->where('unit_type','solid')->where('dependency',0)->where('status','0')->orderBy('sequence','ASC')->findAll();
        $data['feedstock_types_liqd'] = $optionList->where('parent','feedstock_type')->where('unit_type','liquid')->where('dependency',0)->where('status','0')->orderBy('sequence','ASC')->findAll();
        $data['feedstock_sources'] = $optionList->where('parent','feedstock_source')->where('unit_type','solid')->where('dependency',0)->where('status','0')->orderBy('sequence','ASC')->findAll();
        $data['technology_for_bioslurrys'] = $optionList->where('parent','technology_for_bioslurry')->where('dependency',0)->where('status',0)->orderBy('sequence','ASC')->findAll();
        $data['funding_sources'] = $optionList->where('parent','funding_source')->where('dependency',0)->where('status',0)->orderBy('sequence','ASC')->findAll();
        $data['loi_detailss'] = $optionList->where('parent','loi_details')->where('dependency',0)->where('status',0)->orderBy('sequence','ASC')->findAll();
        $data['plantLocations'] = $optionList->where('parent','plant_locations')->where('dependency',0)->where('status',0)->orderBy('sequence','ASC')->findAll();
		$data['land_ownerships'] = $optionList->where('parent','land_ownership')->orderBy('sequence','ASC')->findAll();
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll(); 
        
		
		
		$projectBenefitsModel = new ProjectBenefitsModel();
		$projectFeedstockModel = new ProjectFeedstockModel();
		$projectFundingSourceModel = new ProjectFundingSourceModel();
		$projectLinkageModel = new ProjectLinkageModel();
		$projectRuralAddress = new ProjectRuralAddress();
		//$gramPanchayatModel = new GramPanchayat();
		
		
		
		
		$entity_type_id = $projectInfo['entity_type_id'];
		$stateId = $projectInfo['state_id'];
		$districtId = $projectInfo['district_id'];
		$block_id = $projectInfo['block_id'];
		$data['proBenefits'] = $projectBenefitsModel->where('project_id',$id)->findAll();
		$data['plantTypes'] = $optionList->where('parent','plant_type')->where('dependency',$entity_type_id)->where('status',0)->where('dependency',$entity_type_id)->orderBy('sequence','ASC')->findAll();
		$data['proSolidFss'] = $projectFeedstockModel->where('source_type','solid')->where('project_id',$id)->findAll();
		$data['proLiquidFss'] = $projectFeedstockModel->where('source_type','liquid')->where('project_id',$id)->findAll();
		$data['proBiogasLnkges'] = $projectLinkageModel->where('linkage_type','Biogas')->where('project_id',$id)->findAll();
		$data['proBCGLnkges'] = $projectLinkageModel->where('linkage_type','CBG')->where('project_id',$id)->findAll();
		$data['proFundingSources'] = $projectFundingSourceModel->where('project_id',$id)->findAll();
		$data['proRuralAddress'] = $projectRuralAddress->where('project_id',$id)->findAll();
		$districts=[];
		$blocks=[];
		if($stateId>0){
			$districts = $districtModel->where('state_code',$stateId)->findAll();
		}
		if($districtId>0){
			$blocks = $blocktModel->where('district_code',$districtId)->where('block_code!=0')->findAll();
		}
		
		$data['districts'] = $districts;
		$data['blocks'] = $blocks;
		
		//$data['rdistricts'] = $districtModel->orderBy('district_name')->findAll();
		//$data['rblocks'] = $blocktModel->orderBy('block_name')->findAll();
		//$data['rgps'] = $gramPanchayatModel->orderBy('gp_name')->findAll();
		//$data['rdistricts']=[];
		//$data['rblocks']=[];
		//$data['rgps']=[];
		$data['conn']=$this->db;
		$data['projectInfo'] = $projectInfo;
		return view('edit-project',$data);
	}
	
	
	public function DuplicateBiogas()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		if($role!="admin"){
			return redirect()->to(base_url());
		}
		$query = $this->db->query("SELECT project_details.gp_id as gp, states.state_name, districts.district_name, gram_panchayat.gp_name, COUNT(DISTINCT(project_id)) as noofPlants, (SELECT COUNT(project_id) FROM project_details WHERE project_details.gp_id=gp AND project_details.project_status IS null AND entity_type_id='17' ) as pending FROM project_details INNER JOIN gram_panchayat ON project_details.gp_id=gram_panchayat.gp_code inner join states on project_details.state_id=states.state_code inner join districts on project_details.district_id=districts.district_code WHERE  entity_type_id='17' AND gp_id>0 GROUP BY project_details.gp_id HAVING noofPlants>1;");
		$data['gpWiseDuplicateBiogass'] = $query->getResult();
		return view('backend/duplicate-biogas',$data);
	}
	
	public function DuplicateCBG()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		if($role!="admin"){
			return redirect()->to(base_url());
		}
		$query = $this->db->query("SELECT project_details.district_id as dist ,states.state_name, districts.district_name, COUNT(DISTINCT(project_id)) as noofPlants, (SELECT COUNT(project_id) FROM project_details WHERE project_details.district_id=dist AND project_details.project_status IS null AND entity_type_id='18'  ) as pending FROM project_details INNER JOIN districts ON project_details.district_id=districts.district_code INNER JOIN states ON project_details.state_id=states.state_code WHERE entity_type_id='18'  GROUP BY project_details.district_id HAVING noofPlants>1;");
		$data['distWiseDuplicateCbgs'] = $query->getResult();
		return view('backend/duplicate-cbg',$data);
	}
	
	
	function exportAllProjects()
	{
		$session = session(); 
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		// if($role!="admin"){
			// return redirect()->to(base_url());
		// }
		
		
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		
		$ministrywise = $this->request->getVar('m'); // ministry
		if(!empty($ministrywise)){
			$stateId = $this->request->getVar('state');
			$district = $this->request->getVar('district');
			$plant_type = $this->request->getVar('plant_type');
			$plant_status = $this->request->getVar('plant_status');
			$ministry = $this->request->getVar('ministry');
			$bnf_status = $this->request->getVar('bnf_status');
			$entity_type = $this->request->getVar('entity_type');
			
			$fstype = $this->request->getVar('fstype');
			$sub_entity_type = $this->request->getVar('sub_entity_type');
			$pt_location = $this->request->getVar('pt_location');
			$fromdate = $this->request->getVar('fdate');
			$todate = $this->request->getVar('todate');
			
			$projectModel->select("plant_location_id, project_id, project_details.state_id, project_details.district_id, project_details.block_id, state_name, district_name, block_name, gp_name, village_name, organizations.entity_name,organizations.entity_type, project_name, entity_type_id, plant_status_id, plant_status_date, gas_production_capacity, solid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output");
			$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
			$projectModel->join('states', 'project_details.state_id=states.state_code');
			$projectModel->join('districts', 'project_details.district_id=districts.district_code');
			$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
			$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
			$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
			$projectModel->where('project_details.state_id is not null');
			$projectModel->where('project_details.district_id is not null');
			$projectModel->where('project_details.entity_type_id is not null');
			/* if(!empty($ministry)){
				$projectModel->join('project_benefits', 'project_details.project_id=project_benefits.project_id');
				$projectModel->where('project_benefits.option_list_id', $ministry);
			}
			if(!empty($ministry) && !empty($bnf_status)){
				$projectModel->where('project_benefits.status', $bnf_status);
			} */
			
			if(!empty($stateId)){
				$projectModel->where('project_details.state_id', $stateId);
			}
			if(!empty($district)){
				$projectModel->where('project_details.district_id', $district);
			}
			if(!empty($plant_type)){
				$projectModel->where('project_details.entity_type_id', $plant_type);
			}
			if(!empty($entity_type)){
				$projectModel->where('organizations.entity_type', $entity_type);
			}
			if(!empty($plant_status)){
				$projectModel->where('project_details.plant_status_id', $plant_status);
			}
			
			if(!empty($pt_location)){
				$projectModel->where('project_details.plant_location_id', $pt_location);
			}
			if(!empty($sub_entity_type)){
				$projectModel->where('organizations.entity_subtype', $sub_entity_type);
			}
			
			if(!empty($fstype)){
				$projectModel->where("project_details.project_id in(SELECT DISTINCT(project_id) FROM source_type_feedstocks WHERE option_list_id='".$fstype."' AND source_type='solid') ");
			}
			if(!empty($fromdate) && !empty($todate)){
				$projectModel->where("project_details.plant_status_date >= '".$fromdate."' and project_details.plant_status_date<= '".$todate."' ");
			}
			
			if(!empty($ministry) && !empty($bnf_status)){
				$c = count($ministry); 
				$m = implode(",",$ministry); 
				$projectModel->where("project_details.project_id in(SELECT project_id FROM project_benefits where option_list_id in($m) and project_benefits.status in('$bnf_status') GROUP by project_id having count(*)>=$c )  ");
				
			}
			
			$projectModel->groupBy('project_details.project_id');
			$projects = $projectModel->findAll();
			// echo $this->db->getLastQuery();
			// die;
			
			$headers = array('State Name','District Name','Block Name','GP Name','Village Name','Entity Name', 'Entity Type', 'Project Name', 'Project Type', 'Plant Status', 'Status Date', 'Gas Production Capacity', 'Solid Feedstock Capacity', 'Bio Slurry Output', 'FOM Output', 'LFOM Output');
		}
		else{
			$stateId = $this->request->getVar('state');
			$district = $this->request->getVar('district');
			$plant_type = $this->request->getVar('plant_type');
			$plant_status = $this->request->getVar('plant_status');
			$completion = $this->request->getVar('completion');
			$project_name = $this->request->getVar('project_name');
			$entity_type = $this->request->getVar('entity_type');
			$projectModel->select("plant_location_id, project_id, project_details.state_id, project_details.district_id,project_details.block_id, state_name, district_name, organizations.entity_name,organizations.entity_type, project_name, entity_type_id, plant_status_id, plant_status_date, gas_production_capacity, solid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output ");
			$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
			$projectModel->join('states', 'project_details.state_id=states.state_code','left');
			$projectModel->join('districts', 'project_details.district_id=districts.district_code','left');
			if(!empty($stateId)){
				$projectModel->where('project_details.state_id', $stateId);
			}
			if(!empty($district)){
				$projectModel->where('project_details.district_id', $district);
			}
			if(!empty($plant_type)){
				$projectModel->where('project_details.entity_type_id', $plant_type);
			}
			if(!empty($plant_status)){
				$projectModel->where('project_details.plant_status_id', $plant_status);
			}
			if(!empty($entity_type)){
				$projectModel->where('organizations.entity_type', $entity_type);
			}
			if(!empty($completion)){
				$projectModel->where('project_details.form_completion', $completion);
			}
			if(!empty($project_name)){
				$projectModel->like('project_details.project_name', $project_name,'both');
			}
			$projectModel->groupBy('project_details.project_id');
			$projects = $projectModel->findAll();
			$headers = array('State Name','District Name','Entity Name', 'Entity Type', 'Project Name', 'Project Type', 'Plant Status', 'Status Date', 'Gas Production Capacity', 'Solid Feedstock Capacity', 'Bio Slurry Output', 'FOM Output', 'LFOM Output');
		}	
		
		
		
		
		/// EXPORT DATA 
		$entTypes = [''=>'','17'=>'Biogas plant','18'=>'Compressed Bio Gas/ Bio CNG plant'];
		$entityTypes = [''=>'','0'=>'','1'=>'Government including Co-operatives','2'=>'Private'];
		$plntStatus = [''=>'','22'=>'Yet to start construction','23'=>'Under Construction','24'=>'Functional','290'=>'Completed','292'=>'Temporary Nonfunctional','293'=>'Defunct'];
		
		 
		$output = fopen("php://output", "w");  
		fputcsv($output, $headers);  
		//echo "<pre>";
		foreach($projects as $project)  
		{  
			$solidUnit = 'Tons/day'; 
			$liquidUnit = 'KLD';
			if($project['entity_type_id']=="17"){
				$solidUnit='Kg/day';
				$liquidUnit='Liters/day';
			} 
			$u='';
			if($project['entity_type_id']=="17"){ $u = "m³/day"; }else{  $u = "Tons/day"; }
			
		
			$project['state_name'] = $project['state_name'];
			$project['district_name'] = $project['district_name'];
			
			if($project['plant_location_id']=="83"){
				$sid= $project['state_id']; 
				$did= $project['district_id'];
				$bid= $project['block_id'];
				$project['gp_name'] = $this->getMultipledata($project['project_id'], $sid, $did, $bid, 'gps');
				$project['village_name'] = $this->getMultipledata($project['project_id'], $sid, $did, $bid, 'villages');
			}
			$status_date="";
			if(!empty($project['plant_status_date'])){
				$status_date = date('d-m-Y', strtotime($project['plant_status_date']));
			}
			
			$project['entity_type'] = $entityTypes[$project['entity_type']];
			$project['entity_type_id'] = $entTypes[$project['entity_type_id']];
			$project['plant_status_id'] = $plntStatus[$project['plant_status_id']];
			$project['plant_status_date'] = $status_date;
			$project['gas_production_capacity'] = $project['gas_production_capacity']." ".$u;
			$project['solid_feedstock_capacity'] = $project['solid_feedstock_capacity']." ".$solidUnit;
			$project['bio_slurry_output'] = $project['bio_slurry_output']." ".$liquidUnit;
			$project['FOM_output'] = $project['FOM_output']." ".$solidUnit;
			$project['LFOM_output'] = $project['LFOM_output']." ".$liquidUnit;
			
			unset($project['plant_location_id']);
			unset($project['state_id']);
			unset($project['district_id']);
			unset($project['block_id']);
			unset($project['project_id']);
			//print_r($project);
			fputcsv($output, $project);  
		} 
		
		fclose($output);
		header('Content-Type: text/csv; charset=utf-8');  
		header('Content-Disposition: attachment; filename=Projects.csv'); 
		die;
	}
	
	function exportAllCbgProjects()
	{
		$session = session(); 
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		// if($role!="admin"){
			// return redirect()->to(base_url());
		// }
		
		
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		
		$stateId = $this->request->getVar('state');
		$district = $this->request->getVar('district');
		$plant_type = $this->request->getVar('plant_type');
		$plant_status = $this->request->getVar('plant_status');
		$ministry = $this->request->getVar('ministry');
		$bnf_status = $this->request->getVar('bnf_status');
		$entity_type = $this->request->getVar('entity_type');
		
		$fstype = $this->request->getVar('fstype');
		$sub_entity_type = $this->request->getVar('sub_entity_type');
		$pt_location = $this->request->getVar('pt_location');
		$fromdate = $this->request->getVar('fdate');
		$todate = $this->request->getVar('todate');
		
		$projectModel->select("plant_location_id, project_id, project_details.state_id, project_details.district_id, project_details.block_id, state_name, district_name, block_name, gp_name, village_name, organizations.entity_name,organizations.entity_type, project_name, entity_type_id, plant_status_id, plant_status_date, gas_production_capacity, solid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output");
		$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
		$projectModel->join('states', 'project_details.state_id=states.state_code');
		$projectModel->join('districts', 'project_details.district_id=districts.district_code');
		$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
		$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
		$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
		$projectModel->where('project_details.state_id is not null');
		$projectModel->where('project_details.district_id is not null');
		$projectModel->where('project_details.entity_type_id is not null');
		
		$projectModel->where('project_details.entity_type_id', '18');
		
		/* if(!empty($ministry)){
			$projectModel->join('project_benefits', 'project_details.project_id=project_benefits.project_id');
			$projectModel->where('project_benefits.option_list_id', $ministry);
		}
		if(!empty($ministry) && !empty($bnf_status)){
			$projectModel->where('project_benefits.status', $bnf_status);
		} */
		
		if(!empty($stateId)){
			$projectModel->where('project_details.state_id', $stateId);
		}
		if(!empty($district)){
			$projectModel->where('project_details.district_id', $district);
		}
		
		// if(!empty($entity_type)){
			// $projectModel->where('organizations.entity_type', $entity_type);
		// }
		if(!empty($plant_status)){
			$projectModel->where('project_details.plant_status_id', $plant_status);
		}
		
		if(!empty($pt_location)){
			$projectModel->where('project_details.plant_location_id', $pt_location);
		}
		// if(!empty($sub_entity_type)){
			// $projectModel->where('organizations.entity_subtype', $sub_entity_type);
		// }
		
		if(!empty($fstype)){
			$projectModel->where("project_details.project_id in(SELECT DISTINCT(project_id) FROM source_type_feedstocks WHERE option_list_id='".$fstype."' AND source_type='solid') ");
		}
		// if(!empty($fromdate) && !empty($todate)){
			// $projectModel->where("project_details.plant_status_date >= '".$fromdate."' and project_details.plant_status_date<= '".$todate."' ");
		// }
		
		// if(!empty($ministry) && !empty($bnf_status)){
			// $c = count($ministry); 
			// $m = implode(",",$ministry); 
			// $projectModel->where("project_details.project_id in(SELECT project_id FROM project_benefits where option_list_id in($m) and project_benefits.status in('$bnf_status') GROUP by project_id having count(*)>=$c )  ");
			
		// }
		
		$projectModel->groupBy('project_details.project_id');
		$projects = $projectModel->findAll();
		// echo $this->db->getLastQuery();
		// die;
		
		$headers = array('State Name','District Name','Block Name','GP Name','Village Name','Entity Name', 'Entity Type', 'Project Name', 'Project Type', 'Plant Status', 'Status Date', 'Gas Production Capacity', 'Solid Feedstock Capacity', 'Bio Slurry Output', 'FOM Output', 'LFOM Output');
	
		
		/// EXPORT DATA 
		$entTypes = [''=>'','17'=>'Biogas plant','18'=>'Compressed Bio Gas/ Bio CNG plant'];
		$entityTypes = [''=>'','0'=>'','1'=>'Government including Co-operatives','2'=>'Private'];
		$plntStatus = [''=>'','22'=>'Yet to start construction','23'=>'Under Construction','24'=>'Functional','290'=>'Completed','292'=>'Temporary Nonfunctional','293'=>'Defunct'];
		
		 
		$output = fopen("php://output", "w");  
		fputcsv($output, $headers);  
		//echo "<pre>";
		foreach($projects as $project)  
		{  
			$solidUnit = 'Tons/day'; 
			$liquidUnit = 'KLD';
			if($project['entity_type_id']=="17"){
				$solidUnit='Kg/day';
				$liquidUnit='Liters/day';
			} 
			$u='';
			if($project['entity_type_id']=="17"){ $u = "m³/day"; }else{  $u = "Tons/day"; }
			
		
			$project['state_name'] = $project['state_name'];
			$project['district_name'] = $project['district_name'];
			
			if($project['plant_location_id']=="83"){
				$sid= $project['state_id']; 
				$did= $project['district_id'];
				$bid= $project['block_id'];
				$project['gp_name'] = $this->getMultipledata($project['project_id'], $sid, $did, $bid, 'gps');
				$project['village_name'] = $this->getMultipledata($project['project_id'], $sid, $did, $bid, 'villages');
			}
			$status_date="";
			if(!empty($project['plant_status_date'])){
				$status_date = date('d-m-Y', strtotime($project['plant_status_date']));
			}
			
			$project['entity_type'] = $entityTypes[$project['entity_type']];
			$project['entity_type_id'] = $entTypes[$project['entity_type_id']];
			$project['plant_status_id'] = $plntStatus[$project['plant_status_id']];
			$project['plant_status_date'] = $status_date;
			$project['gas_production_capacity'] = $project['gas_production_capacity']." ".$u;
			$project['solid_feedstock_capacity'] = $project['solid_feedstock_capacity']." ".$solidUnit;
			$project['bio_slurry_output'] = $project['bio_slurry_output']." ".$liquidUnit;
			$project['FOM_output'] = $project['FOM_output']." ".$solidUnit;
			$project['LFOM_output'] = $project['LFOM_output']." ".$liquidUnit;
			
			unset($project['plant_location_id']);
			unset($project['state_id']);
			unset($project['district_id']);
			unset($project['block_id']);
			unset($project['project_id']);
			//print_r($project);
			fputcsv($output, $project);  
		} 
		
		fclose($output);
		header('Content-Type: text/csv; charset=utf-8');  
		header('Content-Disposition: attachment; filename=Projects.csv'); 
		die;
	}
	
	function getMultipledata($pid, $sid, $did, $bid, $parent)
	{
		if($parent=='gps'){
			$sql="SELECT GROUP_CONCAT(gp_name) AS allgp FROM gram_panchayat WHERE state_code='".$sid."' and district_code='".$did."' and block_code='".$bid."' and gp_code IN(SELECT DISTINCT(gp_id) FROM project_rural_address WHERE state_id='".$sid."' and district_id='".$did."' and project_id='".$pid."');";
			$qry = $this->db->query($sql);
			return $data = $qry->getRow()->allgp;
		}
		if($parent=='villages'){
			$sql="SELECT GROUP_CONCAT(village_name) AS allvillages FROM villages WHERE state_code='".$sid."' and district_code='".$did."' and block_code='".$bid."' and village_code IN(SELECT DISTINCT(village_id) FROM project_rural_address WHERE state_id='".$sid."' and district_id='".$did."'  and project_id='".$pid."');";
			$qry = $this->db->query($sql);
			return $data = $qry->getRow()->allvillages;
		}
		
	}
	
	function statePlants()
	{
		$session = session();
		$role_id = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		
		$districtId = $this->request->getVar('district');
		$plant_type = $this->request->getVar('plant_type');
		$plant_status = $this->request->getVar('plant_status');
		$entity_type = $this->request->getVar('entity_type');
		
		$projectModel = new ProjectModel();
		
		$districtModel = new District(); 
		$districts=[];
		if(!empty($stateId)){
			$districts = $districtModel->where('state_code',$stateId)->findAll();
		}
		$data['districts'] = $districts;
		
		$dd=[];
		
		$projectModel->select("project_name, organizations.entity_name, organizations.entity_type, districts.district_name, blocks.block_name,gp_name, villages.village_name ,project_id,organization_id, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address ");
		$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
		$projectModel->join('districts', 'project_details.district_id=districts.district_code');
		$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
		$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
		$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
		$projectModel->where('project_details.state_id', $stateId);
		if(!empty($entity_type)){
			$projectModel->where('organizations.entity_type', $entity_type);
		}
		if(!empty($districtId)){
			$projectModel->where('project_details.district_id', $districtId);
		}
		if(!empty($plant_type)){
			$projectModel->where('project_details.entity_type_id', $plant_type);
		}
		
		if(!empty($plant_status)){
			$projectModel->where('project_details.plant_status_id', $plant_status);
		}
		$projectModel->groupBy('project_details.village_id,project_details.created_at');
		
		$dd = $projectModel->paginate($this->per_page);
		$data['pager'] = $projectModel->pager;
		$data['per_page'] = $projectModel->per_page;
		// $dd=$projectModel->findAll();
		$data['reports'] = $dd;
		return view('backend/state-plant',$data);
	}
	
	function exportStatePlants()
	{
		$session = session();
		$role_id = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		
		$districtId = $this->request->getVar('district');
		$plant_type = $this->request->getVar('plant_type');
		$plant_status = $this->request->getVar('plant_status');
		
		$projectModel = new ProjectModel();
		
		$districtModel = new District(); 
		$districts=[];
		if(!empty($stateId)){
			$districts = $districtModel->where('state_code',$stateId)->findAll();
		}
		$data['districts'] = $districts;
		
		$dd=[];
		
		$projectModel->select("districts.district_name, blocks.block_name,gp_name, villages.village_name , project_name, organizations.entity_name, organizations.entity_type, entity_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output ");
		$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
		$projectModel->join('districts', 'project_details.district_id=districts.district_code');
		$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
		$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
		$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
		$projectModel->where('project_details.state_id', $stateId);
		if(!empty($districtId)){
			$projectModel->where('project_details.district_id', $districtId);
		}
		if(!empty($plant_type)){
			$projectModel->where('project_details.entity_type_id', $plant_type);
		}
		if(!empty($plant_status)){
			$projectModel->where('project_details.plant_status_id', $plant_status);
		}
		$projectModel->groupBy('project_details.village_id,project_details.created_at');
		$projects=$projectModel->findAll();
		
		/// EXPORT DATA 
		$entTypes = [''=>'','0'=>'','17'=>'Biogas plant operator','18'=>'Compressed Bio Gas/ Bio CNG plant operator'];
		$entityTypes = [''=>'','0'=>'','1'=>'Government including Co-operatives','2'=>'Private'];
		$plntStatus = [''=>'','0'=>'','22'=>'Yet to start construction','23'=>'Under Construction','24'=>'Functional','290'=>'Completed','292'=>'Temporary Nonfunctional','293'=>'Defunct'];
		
		$headers = array('District Name','Block Name','GP Name','Village Name', 'Name of the Plant', 'Name of the Entity','Type of the Entity', 'Type of the Plant', 'Status of the Plant', 'Gas Production Capacity', 'Solid Feedstock Capacity', 'Bio Slurry Output', 'FOM Output', 'LFOM Output');
		
		header('Content-Type: text/csv; charset=utf-8');  
		header('Content-Disposition: attachment; filename=state-Report.csv');  
		$output = fopen("php://output", "w");  
		fputcsv($output, $headers);  
		foreach($projects as $project)  
		{
			$u= "Tons/day";
			$solidUnit = 'Tons/day';
			$liquidUnit = 'KLD';
			if($project['entity_type_id']=="17"){
				$u= "m³/day"; 
				$solidUnit='Kg/day';
				$liquidUnit='Liters/day';
			}
			$project['entity_type'] = $entityTypes[$project['entity_type']];
			$project['entity_type_id'] = $entTypes[$project['entity_type_id']];
			$project['plant_status_id'] = $plntStatus[$project['plant_status_id']];
			$project['gas_production_capacity'] = $project['gas_production_capacity']." ".$u;
			$project['solid_feedstock_capacity'] = $project['solid_feedstock_capacity']." ".$solidUnit;
			$project['bio_slurry_output'] = $project['bio_slurry_output']." ".$liquidUnit;
			$project['FOM_output'] = $project['FOM_output']." ".$solidUnit;
			$project['LFOM_output'] = $project['LFOM_output']." ".$liquidUnit;
			fputcsv($output, $project); 
		}
		fclose($output);
		die;
	}
	
	
	function stateReport()
	{
		$data['heading'] = "State Wise Report";
		return view('backend/state-report',$data);
	}
	
	function mReport()
	{
		$stateModel = new State();
		$projectModel = new ProjectModel();
		
		$stateId = $this->request->getVar('state');
		$plant_type = $this->request->getVar('plant_type');
		$plant_status = $this->request->getVar('plant_status');
		
		$projectModel->select("project_id, project_name, organizations.entity_name, gas_production_capacity, gpc_unit, plant_status_id,
			(SELECT pb.status FROM project_benefits AS pb WHERE pb.option_list_id='253' AND pb.project_id = project_details.project_id ) as dahdStatus,
			(SELECT pb.status FROM project_benefits AS pb WHERE pb.option_list_id='254' AND pb.project_id = project_details.project_id ) as aifStatus,
			(SELECT pb.status FROM project_benefits AS pb WHERE pb.option_list_id='256' AND pb.project_id = project_details.project_id ) as mnreStatus,
			(SELECT pb.status FROM project_benefits AS pb WHERE pb.option_list_id='257' AND pb.project_id = project_details.project_id ) as mohuaStatus,
			(SELECT pb.status FROM project_benefits AS pb WHERE pb.option_list_id='258' AND pb.project_id = project_details.project_id ) as mopngStatus,
			(SELECT pb.status FROM project_benefits AS pb WHERE pb.option_list_id='259' AND pb.project_id = project_details.project_id ) as mdaStatus,
			(SELECT GROUP_CONCAT(pb.other) FROM project_benefits AS pb WHERE pb.option_list_id='260' AND pb.project_id = project_details.project_id ) as otherStatus ");
		$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
		$projectModel->where("project_details.entity_type_id!=''");
		//$projectModel->where("project_details.entity_type_id","18");
		$projectModel->where("project_details.state_id!=''");
		$projectModel->where("project_details.district_id!=''");
		$projectModel->where("organizations.entity_type","2");
		if(!empty($stateId)){
			$projectModel->where('project_details.state_id', $stateId);
		}
		if(!empty($plant_type)){
			$projectModel->where('project_details.entity_type_id', $plant_type);
		}
		if(!empty($plant_status)){
			$projectModel->where('project_details.plant_status_id', $plant_status);
		}
		$projectModel->groupBy("project_details.project_id");
		$projects = $projectModel->paginate($this->per_page);
		$data['pager'] = $projectModel->pager;
		$data['per_page'] = $projectModel->per_page;
		
		$data['projects'] = $projects;
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		$data['heading'] = "State Wise Report";
		return view('backend/ministry-report',$data);
	}
	
	function ddwsReport()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$stateQry = '';
		if($roleId=="2"){
			$stateQry=" and state_code='".$stateId."' ";
		}
		
		$fdate = $this->request->getVar('fdate');
		$tdate = $this->request->getVar('tdate');
		$mnst = " and project_id IN(SELECT DISTINCT(project_id) FROM project_benefits WHERE option_list_id='255' )";
		$qry=$mnst;
		if(!empty($fdate) && !empty($tdate) ){
			$qry.=" and plant_status_date>='".$fdate."' and plant_status_date<='".$tdate."' ";
		}
		$sql = "SELECT states.state_code, states.state_name, 
			(SELECT COUNT(project_id) FROM project_details AS p, organizations AS o WHERE p.organization_id=o.id AND p.state_id=states.state_code AND p.entity_type_id='17' AND p.plant_status_id='22' AND o.entity_type='1' $qry AND p.deleted_at IS null ) as yettostarted, 
			(SELECT COUNT(project_id) FROM project_details AS p, organizations AS o WHERE p.organization_id=o.id AND p.state_id=states.state_code AND p.entity_type_id='17' AND p.plant_status_id='23' AND o.entity_type='1' $qry AND p.deleted_at IS null ) as underconstruction, 
			(SELECT COUNT(project_id) FROM project_details AS p, organizations AS o  WHERE p.organization_id=o.id AND p.state_id=states.state_code AND p.entity_type_id='17' AND p.plant_status_id='24' AND o.entity_type='1' $qry AND p.deleted_at IS null ) as functional,
			(SELECT COUNT(project_id) FROM project_details AS p, organizations AS o WHERE p.organization_id=o.id AND p.state_id=states.state_code AND p.entity_type_id='17' AND p.plant_status_id='290' AND o.entity_type='1' $qry AND p.deleted_at IS null ) as completed 
			FROM states where 1=1 $stateQry  ORDER BY state_name;";
			
		$query = $this->db->query($sql);
		$ddwsReports = $query->getResultArray();
		$data['heading'] = "State Wise DDWS Report";
		$data['ddwsReports'] = $ddwsReports;
		return view('backend/ddws-report',$data);
	}
	
	function ddwsReportDistrictWise($stateCode)
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$stateQry = '';
		if($roleId=="2"){
			$stateCode=$stateId;
			//$stateQry=" and state_code='".$stateId."' ";
		}
		
		$fdate = $this->request->getVar('fdate');
		$tdate = $this->request->getVar('tdate');
		$mnst = " and project_id IN(SELECT DISTINCT(project_id) FROM project_benefits WHERE option_list_id='255' )";
		$qry=" $mnst "; 
		$qry.=" and p.state_id='".$stateCode."' ";
		if(!empty($fdate) && !empty($tdate) ){
			$qry.=" and plant_status_date>='".$fdate."' and plant_status_date<='".$tdate."' ";
		}
		$query = $this->db->query("SELECT d.district_code, d.district_name, 
		(SELECT COUNT(project_id) FROM project_details AS p, organizations AS o WHERE p.organization_id=o.id AND p.district_id = d.district_code AND p.entity_type_id = '17' AND p.plant_status_id='22' AND o.entity_type='1' $qry AND p.deleted_at IS null ) as yettostarted,
		(SELECT COUNT(project_id) FROM project_details AS p, organizations AS o WHERE p.organization_id=o.id AND p.district_id = d.district_code AND p.entity_type_id = '17' AND p.plant_status_id='23' AND o.entity_type='1' $qry AND p.deleted_at IS null ) as underconstruction,
		(SELECT COUNT(project_id) FROM project_details AS p, organizations AS o WHERE p.organization_id=o.id AND p.district_id = d.district_code AND p.entity_type_id = '17' AND p.plant_status_id='24' AND o.entity_type='1' $qry AND p.deleted_at IS null ) as functional,
		(SELECT COUNT(project_id) FROM project_details AS p, organizations AS o WHERE p.organization_id=o.id AND p.district_id = d.district_code AND p.entity_type_id = '17' AND p.plant_status_id='290' AND o.entity_type='1' $qry AND p.deleted_at IS null ) as completed
		FROM districts AS d WHERE d.state_code='".$stateCode."';");
		$ddwsReports = $query->getResultArray(); 
		$data['heading'] = "State Wise DDWS Report";
		$data['ddwsReports'] = $ddwsReports;
		return view('backend/ddws-report-district',$data);
	}
	
	function updatePDate()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		if($roleId!=1){
			return redirect()->to(base_url());  
		}
		
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		
		$stateId = $this->request->getVar('state');
		
		$district = $this->request->getVar('district');
		$plant_type = $this->request->getVar('plant_type');
		$plant_status = $this->request->getVar('plant_status');
		// $completion = $this->request->getVar('completion');
		$ministry = $this->request->getVar('ministry');
		$bnf_status = $this->request->getVar('bnf_status');
		$entity_type = $this->request->getVar('entity_type');
		$sub_entity_type = $this->request->getVar('sub_entity_type');
		$pt_location = $this->request->getVar('pt_location');
		
		
		$subTypes=[];
		//$projects=$projectModel->where('state_id',$stateId)->findAll();
		$projectModel->select("organizations.entity_name, plant_status_date, construction_date, proposed_date, date_of_commissioning, organizations.entity_type, states.state_name, districts.district_name, blocks.block_name, gram_panchayat.gp_name, villages.village_name ,project_details.project_id,project_details.organization_id, project_name, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address ");
		$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
		$projectModel->join('states', 'project_details.state_id=states.state_code');
		$projectModel->join('districts', 'project_details.district_id=districts.district_code');
		$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
		$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
		$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
		$projectModel->where('project_details.state_id is not null');
		$projectModel->where('project_details.district_id is not null');
		$projectModel->where('project_details.entity_type_id is not null');
		
		
		if(!empty($stateId)){
			$projectModel->where('project_details.state_id', $stateId);
		}
		if(!empty($district)){
			$projectModel->where('project_details.district_id', $district);
		}
		if(!empty($plant_type)){
			$projectModel->where('project_details.entity_type_id', $plant_type);
		}
		if(!empty($plant_status)){
			$projectModel->where('project_details.plant_status_id', $plant_status);
		}
		if(!empty($pt_location)){
			$projectModel->where('project_details.plant_location_id', $pt_location);
		}
		
		if(!empty($entity_type)){
			
			$projectModel->where('organizations.entity_type', $entity_type);
		}
		if(!empty($sub_entity_type)){
			$projectModel->where('organizations.entity_subtype', $sub_entity_type);
		}
		$projectModel->where("project_details.project_id in(SELECT DISTINCT(project_id) FROM project_benefits WHERE option_list_id='255' ) ");
		
		$projectModel->groupBy('project_details.project_id');
		// $projects = $projectModel->paginate($this->per_page);
		// $data['pager'] = $projectModel->pager;
		// $data['per_page'] = $projectModel->per_page;
		// $data['projects'] = $projects;
		
		$projects = $projectModel->findAll();
		$data['pager'] = "";
		$data['per_page'] = "";
		$data['projects'] = $projects;
		
		
		
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		$data['districts'] = $districtModel->where('state_code',$stateId)->findAll();
		
		
		
		$data['heading'] = "State Wise Report";
		return view('backend/update-status-date',$data);
	}
	
	function changeDate()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		if($roleId!=1){
			return redirect()->to(base_url());  
		}
		
		
		$pid = $this->request->getVar('pid');
		$plant_status_id = $this->request->getVar('plant_status_id');
		$oldDate = $this->request->getVar('oldDate');
		$psdate = $this->request->getVar('psdate');
		$pstatus = $this->request->getVar('pstatus');
		if(!empty($pid) && !empty($plant_status_id) && !empty($oldDate) && !empty($psdate) && !empty($pstatus) ){
			$projArr = [
				'plant_status_date' => $psdate,
				'plant_status_id' => $pstatus,
			];
			
			if($plant_status_id=="22"){
				$projArr['construction_date']=$oldDate;
			}
			if($plant_status_id=="23"){
				$projArr['proposed_date']=$oldDate;
			}
			
			if($plant_status_id=="24" || $plant_status_id=="290"){
				$projArr['date_of_commissioning']=$oldDate;
			}
			
			$projectModel = new ProjectModel();
			$changeStatusModel = new ChangeStatusModel();
			
			date_default_timezone_set("Asia/Calcutta");
			$created_at = date('Y-m-d H:i:s');
			$statusLogArr = ['project_id'=>$pid,'status_id'=>$plant_status_id,'updated_by'=>$userId,'created_at'=>$created_at];
			
			$res = $projectModel->update($pid,$projArr);
			if($res){
				$changeStatusModel->insert($statusLogArr);
				$resArr = array("status"=>1,"msg"=>"success");
			}else{
				$resArr = array("status"=>0,"msg"=>"failed");
			}
			return json_encode($resArr);
		}
	}
	
	
	function pushDataSbm()
	{
		$resArr = [];
		$cdate = date('Y-m-d', strtotime('-1 day'));
		$query = $this->db->query("SELECT state_code as StateLGDCode, 
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateLGDCode AND project_details.entity_type_id='17' AND project_details.plant_status_id IN(22,23,24,290) ) AS TotalBiogasPlantsTillDate, 
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateLGDCode AND project_details.entity_type_id='17' AND date(project_details.created_at)='".$cdate."' ) AS BiogasPlantsRegisteredYesterday,

		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateLGDCode AND project_details.entity_type_id='18' AND project_details.plant_status_id IN(22,23,24,290) ) AS TotalCBGPlantsTillDate, 
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateLGDCode AND project_details.entity_type_id='18' AND date(project_details.created_at)='".$cdate."' ) AS CBGPlantsRegisteredYesterday,
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateLGDCode AND project_details.entity_type_id='17' AND project_details.plant_status_id='24' ) AS FunctionalTotalBiogasPlantsTillDate,
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateLGDCode AND project_details.entity_type_id='18' AND project_details.plant_status_id='24' ) AS FunctionalTotalCBGPlantsTillDate

		FROM states ORDER BY state_name ASC;");
		$res = $query->getResultArray();
		
		// echo $this->db->getLastQuery();
		// die;
		
		$resArr['ParamCase'] = "GobardhanStateWise";
		$resArr['data'] = $res;
		$pushJsonData = json_encode($resArr);
		//die;
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://sbm.gov.in/UMANG_API/API/SubmitGobardhanStateWiseData',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>$pushJsonData,
		  CURLOPT_HTTPHEADER => array(
			'Authorization: fcb982bab42391f5030aa8f8c5b8e339b3037cf0e7df9ec704c40f5d0b285f8b',
			'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		echo $response;
		
		
	}
	
	
	function pushDataSbmVillageWise()
	{
		$resArr = [];
		$cdate = date('Y-m-d', strtotime('-1 day'));
		$query = $this->db->query("SELECT state_id as StateLGDCode, district_id as DistrictLGDCode, block_id as BlockLGDCode, gp_id as GrampanchayatLGDCode, village_id as VillageLGDCode, 
			(SELECT COUNT(project_id) FROM project_details AS p WHERE entity_type_id='17' AND plant_status_id IN(22,23,24,290) AND p.village_id=VillageLGDCode  ) AS TotalBiogasPlantsTillDate,
			(SELECT COUNT(project_id) FROM project_details AS p WHERE entity_type_id='17' AND p.village_id=VillageLGDCode AND date(created_at)='".$cdate."' ) AS BiogasPlantsRegisteredYesterday,
			(SELECT COUNT(project_id) FROM project_details AS p WHERE entity_type_id='18' AND plant_status_id IN(22,23,24,290) AND p.village_id=VillageLGDCode  ) AS TotalCBGPlantsTillDate,
			(SELECT COUNT(project_id) FROM project_details AS p WHERE entity_type_id='18' AND p.village_id=VillageLGDCode AND date(created_at)='".$cdate."' ) AS CBGPlantsRegisteredYesterday,
			(SELECT COUNT(project_id) FROM project_details AS p WHERE entity_type_id='17' AND plant_status_id='24' AND p.village_id=VillageLGDCode  ) AS FunctionalTotalBiogasPlantsTillDate,
            (SELECT COUNT(project_id) FROM project_details AS p WHERE entity_type_id='18' AND plant_status_id='24' AND p.village_id=VillageLGDCode  ) AS FunctionalTotalCBGPlantsTillDate
			FROM project_details 
			WHERE village_id!='0' AND village_id IS NOT null  GROUP BY village_id;");
		$res = $query->getResultArray();
		$resArr['ParamCase'] = "GobardhanVillageWise";
		$resArr['data'] = $res;
		$pushJsonData = json_encode($resArr);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://sbm.gov.in/UMANG_API/API/SubmitGobardhanVillageWiseData',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>$pushJsonData,
		  CURLOPT_HTTPHEADER => array(
			'Authorization: fcb982bab42391f5030aa8f8c5b8e339b3037cf0e7df9ec704c40f5d0b285f8b',
			'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		echo $response;
	}
	
	
	function monthlyUpdate()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		// if($role!="admin"){
			// return redirect()->to(base_url());
		// }
		
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		
		$district = $this->request->getVar('district');
		$plant_status = $this->request->getVar('plant_status');
		$project_name = $this->request->getVar('project_name');
		
		$month_ini = new DateTime("first day of last month"); 
		$reportingMonth1 = $month_ini->format('Y-m');
		$reportingMonth = date('Y-m', strtotime(date($reportingMonth1)." -1 month"));
		
		
		$query = $this->db->query("SELECT GROUP_CONCAT(project_id) as project_id FROM project_monthly_monitoring WHERE reporting_month='".$reportingMonth1."' AND user_id='".$userId."' AND status='1' ");
		$res = $query->getRowArray();
		// echo $this->db->getLastQuery();
		// die;
		$projIds = explode(",",$res['project_id']);
		
		//, (SELECT GROUP_CONCAT(title) FROM option_list WHERE id IN(SELECT GROUP_CONCAT(option_list_id) AS option_list_id FROM source_type_feedstocks WHERE project_id=pid AND source_type='solid')) AS title
		$projectModel->select("organizations.entity_name, organizations.entity_type, states.state_name, districts.district_name, blocks.block_name, gram_panchayat.gp_name, villages.village_name ,project_details.project_id,project_details.plant_status_date,project_details.organization_id, project_name, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, updated_at, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address, project_details.project_id as pid ");
		$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
		$projectModel->join('states', 'project_details.state_id=states.state_code');
		$projectModel->join('districts', 'project_details.district_id=districts.district_code');
		$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
		$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
		$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
		$projectModel->where('organizations.entity_type','1');
		$projectModel->where('project_details.entity_type_id','17');
		$projectModel->whereIn('project_details.plant_status_id',[24,292,293]);
		if(count($projIds)>0){
			$projectModel->whereNotIn('project_details.project_id',$projIds);
		}
		
		$projectModel->where('project_details.state_id is not null');
		$projectModel->where('project_details.district_id is not null');
		
		
		$month_ini = new DateTime("first day of last month"); 
		$reportingMonth1 = $month_ini->format('Y-m-d');
		
		$dd=date('Y-m-d', strtotime(date($reportingMonth1)));  ///$reportingMonth."-01";
		$month = date("Y-m-d", strtotime($dd)); //date('Y-m-01');
		$monthsql=" plant_status_date<'".$month."'";
		$projectModel->where($monthsql);
		 
		$projectModel->where("project_details.project_id in(SELECT DISTINCT(project_id) FROM project_benefits WHERE option_list_id='255' ) ");
		
		if(!empty($stateId)){
			$projectModel->where('project_details.state_id', $stateId);
		}
		if(!empty($district)){
			$projectModel->where('project_details.district_id', $district);
		}
		// if(!empty($plant_type)){
			// $projectModel->where('project_details.entity_type_id', $plant_type);
		// }
		if(!empty($plant_status)){
			$projectModel->where('project_details.plant_status_id', $plant_status);
		}
		
		if(!empty($project_name)){
			$projectModel->where('project_details.project_name', $project_name);
		}
		
		$projectModel->groupBy('project_details.project_id');
		
		
		$projects = $projectModel->paginate($this->per_page);
		$data['pager'] = $projectModel->pager;
		$data['per_page'] = $projectModel->per_page;
		$data['projects'] = $projects;
		
		// echo $this->db->getLastQuery();
		// die;
		//$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		$data['districts'] = $districtModel->where('state_code',$stateId)->findAll();
		
		
		
		return view('backend/monthly-update',$data);
	}
	
	function monthlyReported()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		
		$projectId = $this->request->getVar('pid');
		$current_status = $this->request->getVar('cstatus');
		
		$reporting_date = $this->request->getVar('rdate');
		$feedstock = $this->request->getVar('feedstock');
		$monthlyBiogasGen = $this->request->getVar('monthlyBiogasGen');
		$monthlyBioSlurry = $this->request->getVar('monthlyBioSlurry');
		
		$sinceDate = $this->request->getVar('sinceDate');
		$other_reason = $this->request->getVar('other_reason');
		$reporting_month = $this->request->getVar('reporting_month');
		$workingDay = $this->request->getVar('workingDay');
		$allReason = $this->request->getVar('allReason');
		$pre_status = $this->request->getVar('pre_status');
		$functionality_date = $this->request->getVar('functionality_date');
		$functional_amount = $this->request->getVar('functional_amount');
		$functional_source = $this->request->getVar('functional_source');
		
		$prmmId = $this->request->getVar('prmmId');
		
		$projectModel = new ProjectModel();
		$monthlyReportingModel = new MonthlyReportingModel();
		
		$projectModel->select("project_id,state_id,district_id,entity_type_id");
		$projectModel->where("project_id",$projectId);
		$pr = $projectModel->first();
		$stateId = $pr['state_id'];
		$districtId = $pr['district_id'];
		$entity_type_id = $pr['entity_type_id'];
		
		$changeStatusModel = new ChangeStatusModel();
		date_default_timezone_set("Asia/Calcutta");
		$created_at = date('Y-m-d H:i:s');
		
		$resArr=[];
		$validation =  \Config\Services::validation();
		$docVerify=true;
		if($current_status==24){
			$rules = [
				"pid" => [
					"label" => "Project", 
					"rules" => "required"
				],
				"cstatus" => [
					"label" => "Current Status", 
					"rules" => "required"
				],
				"rdate" => [
					"label" => "Reporting Date", 
					"rules" => "required"
				],
				"feedstock" => [
					"label" => "Feedstock", 
					"rules" => "required"
				],
				"monthlyBiogasGen" => [
					"label" => "Biogas Generation", 
					"rules" => "required"
				],
				"monthlyBioSlurry" => [
					"label" => "Bio Slurry Generation", 
					"rules" => "required"
				]
			];
			
			if($pre_status!="24"){
				// $rules["doc"] = [
					// "label" => "Document", 
					// "rules" => "required"
				// ];
				$file = $this->request->getFile('doc');
				if(empty($file->getName())){
					$docVerify=false;
				}
			}
			
			if($entity_type_id=="18"){
				$rules["fom"] = [
					"label" => "FOM", 
					"rules" => "required"
				];
				$rules["lfom"] = [
					"label" => "LFOM", 
					"rules" => "required"
				];
			}
			
			
			
			$reporting_data = [
				'project_id'=>$projectId,
				'state_id'=>$stateId,
				'district_id'=>$districtId,
				'current_status'=>$current_status,
				'reporting_date'=>$reporting_date,
				'feedstock'=>$feedstock,
				'biogas_generation'=>$monthlyBiogasGen,
				'bioslurry_generation'=>$monthlyBioSlurry,
				'user_id'=>$userId,
				'reporting_month'=>$reporting_month,
				'nofunctional_days'=>$workingDay,
				'pre_status'=>$pre_status,
				'functionality_date'=>$functionality_date,
				'functional_amount'=>$functional_amount,
				'functional_source'=>$functional_source,
			];
			
			$randomName='';
			$file = $this->request->getFile('doc');
			if(isset($file) && !empty($file->getName())){
				$randomName = $projectId."_".$file->getRandomName();
				$file->move(ROOTPATH.'fuctional_docs/', $randomName);
				$reporting_data['fuctional_doc'] = $randomName;
			}
			
		}else{
			$rules = [
				"pid" => [
					"label" => "Project", 
					"rules" => "required"
				],
				"cstatus" => [
					"label" => "Current Status", 
					"rules" => "required"
				],
				"rdate" => [
					"label" => "Reporting Date", 
					"rules" => "required"
				],
				"sinceDate" => [
					"label" => "Since Date", 
					"rules" => "required"
				],
				"functionality_date" => [
					"label" => "functionality_date", 
					"rules" => "required"
				],
				"functional_amount" => [
					"label" => "functional_amount", 
					"rules" => "required"
				],
			];
			
			$reporting_data = [
				'project_id'=>$projectId,
				'state_id'=>$stateId,
				'district_id'=>$districtId,
				'current_status'=>$current_status,
				'reporting_date'=>$reporting_date,
				'defunct_date'=>$sinceDate,
				'other_reason'=>$other_reason,
				'user_id'=>$userId,
				'reporting_month'=>$reporting_month,
				'reason'=>$allReason,
				'pre_status'=>$pre_status,
				'functionality_date'=>$functionality_date,
				'functional_amount'=>$functional_amount,
				'functional_source'=>$functional_source,
			];
		}
		
		if ($this->validate($rules) && $docVerify==true) {
			
			if($entity_type_id=="18"){
				$reporting_data['plant_type'] = 2;
				$reporting_data['fom'] = $this->request->getVar('fom');
				$reporting_data['lfom'] = $this->request->getVar('lfom');
			}
			
			if(!empty($prmmId)){
				unset($reporting_data['pre_status']);
				$result = $monthlyReportingModel->update($prmmId,$reporting_data);
				if($result){
					$resArr = ['status'=>200,'message'=>'Data submitted successfully.'];
					if($current_status!=24){
						$projectModel = new ProjectModel();
						$plant_status_date = date('Y-m-d');
						$pdetails = [
							'plant_status_id'=>$current_status
							];
						$projectModel->update($projectId, $pdetails);
						
						$statusLogArr = ['project_id'=>$projectId,'status_id'=>$current_status,'updated_by'=>$userId,'created_at'=>$created_at];
						$changeStatusModel->insert($statusLogArr);
					}
				}else{
					$resArr = ['status'=>0,'message'=>'Something went wrong.'];
				}
				echo json_encode($resArr);
				exit;
			}
			
			$result = $monthlyReportingModel->insert($reporting_data);
			if($result){
				$resArr = ['status'=>200,'message'=>'Data submitted successfully.'];
				if($current_status!=24){
					$projectModel = new ProjectModel();
					$pdetails = ['plant_status_id'=>$current_status];
					$projectModel->update($projectId, $pdetails);
					
					$statusLogArr = ['project_id'=>$projectId,'status_id'=>$current_status,'updated_by'=>$userId,'created_at'=>$created_at];
					$changeStatusModel->insert($statusLogArr);
				}
			}else{
				$resArr = ['status'=>0,'message'=>'Something went wrong.'];
			}
			
		}else {
			$errorsmsg = $validation->getErrors();
			$resArr = ['status'=>2,'message'=>'Something went wrong.','errors'=>$errorsmsg];
		}
		echo json_encode($resArr);
		// $reporting_data = $this->request->getVar();
		//print_r($reporting_data);
	}
	
	function monthlyReport()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		// if($role!="admin"){
			// return redirect()->to(base_url());
		// }
		
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		$monthlyReportingModel = new MonthlyReportingModel();
		
		$month_ini = new DateTime("first day of last month"); 
		$reportingMonth = $month_ini->format('Y-m');
		
		$district = $this->request->getVar('district');
		$plant_status = $this->request->getVar('plant_status');
		$reporting_month = $this->request->getVar('reporting_month');
		if(!empty($reporting_month)){
			$reportingMonth = $reporting_month;
		}
		
		
		$monthlyReportingModel->select("monthly_monitoring_id, project_monthly_monitoring.updated_at, pre_status, current_status, nofunctional_days, feedstock, biogas_generation, bioslurry_generation, fuctional_doc, verify_doc, reporting_date, project_details.project_name, states.state_name, districts.district_name ");
		$monthlyReportingModel->join('project_details','project_details.project_id=project_monthly_monitoring.project_id');
		$monthlyReportingModel->join('states', 'project_details.state_id=states.state_code');
		$monthlyReportingModel->join('districts', 'project_details.district_id=districts.district_code');		
		$monthlyReportingModel->where('reporting_month',$reportingMonth);
		$monthlyReportingModel->where('project_monthly_monitoring.state_id',$stateId);
		if(!empty($plant_status)){
			$monthlyReportingModel->where('current_status',$plant_status);
		}
		if(!empty($district)){
			$monthlyReportingModel->where('project_details.district_id',$district);
		}
		$monthlyReportingModel->where('project_monthly_monitoring.status','1');
		$monthlyReportingModel->where('project_monthly_monitoring.plant_type','1');
		$data['reports'] = $monthlyReportingModel->findAll();
		// echo "<pre>";
		// print_r($reports);
		// die;
		
		$data['reporting_month'] = $reportingMonth;
		//$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		$data['districts'] = $districtModel->where('state_code',$stateId)->findAll();		
		return view('backend/monthly-report',$data);
		
	}
	
	function monthlyUpdtateReport()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		if($role!="admin"){
			return redirect()->to(base_url());
		}
		
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		$monthlyReportingModel = new MonthlyReportingModel();
		
		$month_ini = new DateTime("first day of last month"); 
		$reportingMonth = $month_ini->format('Y-m');
		
		$state = $this->request->getVar('state');
		$district = $this->request->getVar('district');
		$plant_status = $this->request->getVar('plant_status');
		$reporting_month = $this->request->getVar('reporting_month');
		if(!empty($reporting_month)){
			$reportingMonth = $reporting_month;
		}
		$alldistrict=[];
		
		$monthlyReportingModel->select("monthly_monitoring_id, project_monthly_monitoring.updated_at, pre_status, current_status, nofunctional_days, feedstock, biogas_generation, bioslurry_generation, fuctional_doc, verify_doc, reporting_date, project_details.project_name, project_details.gas_production_capacity, states.state_name, districts.district_name ");
		$monthlyReportingModel->join('project_details','project_details.project_id=project_monthly_monitoring.project_id');
		$monthlyReportingModel->join('states', 'project_details.state_id=states.state_code');
		$monthlyReportingModel->join('districts', 'project_details.district_id=districts.district_code');		
		$monthlyReportingModel->where('reporting_month',$reportingMonth);
		if(!empty($plant_status)){
			$monthlyReportingModel->where('current_status',$plant_status);
		}
		if(!empty($district)){
			$monthlyReportingModel->where('project_details.district_id',$district);
		}
		if(!empty($state)){
			$monthlyReportingModel->where('project_details.state_id',$state);
			$alldistrict = $districtModel->where('state_code',$state)->findAll();
		}
		$monthlyReportingModel->where('project_monthly_monitoring.status','1');
		$monthlyReportingModel->where('project_monthly_monitoring.plant_type','1');
		$data['reports'] = $monthlyReportingModel->findAll();
		
		$data['reporting_month'] = $reportingMonth;
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		$data['districts'] = $alldistrict;
		return view('backend/monthly-update-report',$data);
		
	}
	
	function monthlyUpdtateReportCBG()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		if($role!="admin" && $role!="cbgLogin"){
			return redirect()->to(base_url());
		}
		
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		$monthlyReportingModel = new MonthlyReportingModel();
		
		$month_ini = new DateTime("first day of last month"); 
		$reportingMonth = $month_ini->format('Y-m');
		
		$state = $this->request->getVar('state');
		$district = $this->request->getVar('district');
		$plant_status = $this->request->getVar('plant_status');
		$reporting_month = $this->request->getVar('reporting_month');
		if(!empty($reporting_month)){
			$reportingMonth = $reporting_month;
		}
		$alldistrict=[];
		
		$monthlyReportingModel->select("monthly_monitoring_id, project_monthly_monitoring.updated_at, pre_status, current_status, nofunctional_days, feedstock, biogas_generation, bioslurry_generation, fuctional_doc, verify_doc, reporting_date, project_details.project_name, project_details.gas_production_capacity, states.state_name, districts.district_name ");
		$monthlyReportingModel->join('project_details','project_details.project_id=project_monthly_monitoring.project_id');
		$monthlyReportingModel->join('states', 'project_details.state_id=states.state_code');
		$monthlyReportingModel->join('districts', 'project_details.district_id=districts.district_code');		
		$monthlyReportingModel->where('reporting_month',$reportingMonth);
		if(!empty($plant_status)){
			$monthlyReportingModel->where('current_status',$plant_status);
		}
		if(!empty($district)){
			$monthlyReportingModel->where('project_details.district_id',$district);
		}
		if(!empty($state)){
			$monthlyReportingModel->where('project_details.state_id',$state);
			$alldistrict = $districtModel->where('state_code',$state)->findAll();
		}
		$monthlyReportingModel->where('project_monthly_monitoring.status','1');
		$monthlyReportingModel->where('project_monthly_monitoring.plant_type','2');
		$data['reports'] = $monthlyReportingModel->findAll();
		
		$data['reporting_month'] = $reportingMonth;
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		$data['districts'] = $alldistrict;
		return view('backend/monthly-update-report-cbg',$data);
		
	}
	
	/// PLANT Temporary NON-FUNCTIONAL TO FUNCTIONAL
	function monthlyTmpFun()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		if($role!="admin"){
			return redirect()->to(base_url());
		}
		
		$changeStatusModel = new ChangeStatusModel();
		date_default_timezone_set("Asia/Calcutta");
		$created_at = date('Y-m-d H:i:s');
			
		$mmid = $this->request->getVar('mmid');
		$monthlyReportingModel = new MonthlyReportingModel();
		$monthlyReportingModel->where('monthly_monitoring_id',$mmid);
		$monthlyReportingModel->where('project_monthly_monitoring.status','1');
		$reportdetails = $monthlyReportingModel->first();
		$project_id = $reportdetails['project_id'];
		$pre_status = $reportdetails['pre_status'];
		$functionality_date = $reportdetails['functionality_date'];
		$current_status = $reportdetails['current_status'];
		if($pre_status!="24" && $current_status=="24" ){
			$projectModel = new ProjectModel();
			$projArr = [
				"plant_status_id"=>24,
			];
			$res = $projectModel->update($project_id, $projArr);
			
			$statusLogArr = ['project_id'=>$project_id,'status_id'=>24,'updated_by'=>$userId,'created_at'=>$created_at];
			$changeStatusModel->insert($statusLogArr);
			if($res){
				
				$monthlyReportingModel->update($mmid, ['verify_doc'=>1]);
				$cirtPath = base_url()."make-certificate/".$project_id;
				file_get_contents($cirtPath);
				$resArr = array("status"=>200,"message"=>"success");
			}else{
				$resArr = array("status"=>500,"message"=>"error");
			}
		}
		echo json_encode($resArr);
	}
	
	
	
	function monthlyReportDetails($mmid)
	{
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		$monthlyReportingModel = new MonthlyReportingModel();
		
		$monthlyReportingModel->select("project_monthly_monitoring.*, project_details.project_name, project_details.gas_production_capacity,project_details.solid_feedstock_capacity, project_details.bio_slurry_output, states.state_name, districts.district_name ");
		$monthlyReportingModel->join('project_details','project_details.project_id=project_monthly_monitoring.project_id');
		$monthlyReportingModel->join('states', 'project_details.state_id=states.state_code');
		$monthlyReportingModel->join('districts', 'project_details.district_id=districts.district_code');		
		$monthlyReportingModel->where('monthly_monitoring_id',$mmid);
		$monthlyReportingModel->where('project_monthly_monitoring.status','1');
		$reportdetails = $monthlyReportingModel->first();
		$reasons = $reportdetails['reason'];
		$reasonArr=[];
		if(!empty($reasons))
		{
			$reasons = explode(",", $reasons);
			foreach($reasons as $reason){
				$reasonArr[] = getNameFromId('defunct_reason', $reason);
			}
		}
		$allReasons = implode(", ", $reasonArr);
		//die;
		$reportdetails['reason'] = $allReasons;
		$reportdetails['reporting_month'] = date('M-Y', strtotime($reportdetails['reporting_month']));
		echo json_encode($reportdetails);
	}
	
	
	function monthlyreportState()
	{
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		$monthlyReportingModel = new MonthlyReportingModel();
		$monthlyProjectLog = new MonthlyProjectLog();
		
		$month_ini = new DateTime("first day of last month"); 
		$reportingMonth = $month_ini->format('Y-m');
		
		//$state = $this->request->getVar('state');
		//$district = $this->request->getVar('district');
		//$plant_status = $this->request->getVar('plant_status');
		$reporting_month = $this->request->getVar('reporting_month');
		if(!empty($reporting_month)){
			$reportingMonth = $reporting_month;
		}
		$alldistrict=[];
		$stateReportings=[];
		
		
		
		// $mnst = " and project_id IN(SELECT DISTINCT(project_id) FROM project_benefits WHERE option_list_id='255' )";
		// $stateModel->select("state_code, state_name,  (select count(project_id) from project_details, organizations as o where project_details.organization_id=o.id and o.entity_type='1' and project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='292' $mnst  ) as nonfunctional, (select count(project_id) from project_details, organizations AS o where project_details.organization_id=o.id and o.entity_type='1' and project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='293' $mnst ) as defunct, (select count(project_id) from project_details, organizations AS o where project_details.organization_id=o.id and o.entity_type='1' and project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='24' $mnst ) as functional ");
		// $stateModel->orderBy('state_name','ASC');
		// $data['allstates'] = $stateModel->findAll();
		
		$reportingMonthOfTilldatePlants = date('Y-m',strtotime(date($reportingMonth)." -1 month"));
		$monthlyProjectLog->select('states.state_code, states.state_name, ddwsBiogasFunctional as functional,ddwsBiogasNonFunctional as nonfunctional,ddwsBiogasDefunct as defunct,reporting_month');
		$monthlyProjectLog->join('states','states.state_code=monthly_plants_log.StateCode');
		$monthlyProjectLog->where('reporting_month',$reportingMonthOfTilldatePlants);
		$monthlyProjectLog->orderBy('state_name','ASC');
		$data['allstates'] = $monthlyProjectLog->findAll();
		
		$allstatesReportings = $monthlyReportingModel->select("state_code as sid, (SELECT COUNT(monthly_monitoring_id) FROM project_monthly_monitoring WHERE state_id=sid AND current_status='292' AND plant_type='1' and status='1' AND reporting_month='".$reportingMonth."' ) AS nonfunctional, (SELECT COUNT(monthly_monitoring_id) FROM project_monthly_monitoring WHERE state_id=sid AND current_status='293' AND plant_type='1' and status='1' AND reporting_month='".$reportingMonth."' ) AS defunct, (SELECT COUNT(monthly_monitoring_id) FROM project_monthly_monitoring WHERE state_id=sid AND current_status='24' AND plant_type='1' and status='1' AND reporting_month='".$reportingMonth."' ) AS functional ")->join('states','project_monthly_monitoring.state_id = states.state_code','right')->groupBy('sid')->findAll();
		// echo $this->db->getLastQuery();
		// die;
		foreach($allstatesReportings as $allstateReporting){
			$stateReportings[$allstateReporting['sid']]= $allstateReporting;
		}
		// echo "<pre>";
		// print_r($data['allstates']);
		// print_r($stateReportings);
		// die;
		$data['allstatesReportings'] = $stateReportings;
		//$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		$data['districts'] = [];
		$data['reporting_month'] = $reportingMonth;
		return view('backend/state-monthly-report',$data);
	}
	
	function monthlyreportStateCBG()
	{
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		$monthlyReportingModel = new MonthlyReportingModel();
		$monthlyProjectLog = new MonthlyProjectLog();
		
		$month_ini = new DateTime("first day of last month"); 
		$reportingMonth = $month_ini->format('Y-m');
		
		$reporting_month = $this->request->getVar('reporting_month');
		if(!empty($reporting_month)){
			$reportingMonth = $reporting_month;
		}
		$alldistrict=[];
		$stateReportings=[];
		
		$monthlyProjectLog->select('states.state_code, states.state_name, CBGFunctional as functional,CBGNonFunctional as nonfunctional,CBGDefunct as defunct,reporting_month');
		$monthlyProjectLog->join('states','states.state_code=monthly_plants_log.StateCode');
		$monthlyProjectLog->where('reporting_month',$reportingMonth);
		$monthlyProjectLog->orderBy('state_name','ASC');
		$data['allstates'] = $monthlyProjectLog->findAll();
		
		$allstatesReportings = $monthlyReportingModel->select("state_code as sid, (SELECT COUNT(monthly_monitoring_id) FROM project_monthly_monitoring WHERE state_id=sid AND current_status='292' AND plant_type='2' AND reporting_month='".$reportingMonth."' ) AS nonfunctional, (SELECT COUNT(monthly_monitoring_id) FROM project_monthly_monitoring WHERE state_id=sid AND current_status='293' AND plant_type='2' AND reporting_month='".$reportingMonth."' ) AS defunct, (SELECT COUNT(monthly_monitoring_id) FROM project_monthly_monitoring WHERE state_id=sid AND current_status='24' AND plant_type='2' AND reporting_month='".$reportingMonth."' ) AS functional ")->join('states','project_monthly_monitoring.state_id = states.state_code','right')->groupBy('sid')->findAll();
		// echo $this->db->getLastQuery();
		// die;
		foreach($allstatesReportings as $allstateReporting){
			$stateReportings[$allstateReporting['sid']]= $allstateReporting;
		}
		$data['allstatesReportings'] = $stateReportings;
		$data['districts'] = [];
		$data['reporting_month'] = $reportingMonth;
		return view('backend/state-monthly-report-cbg',$data);
	}
	
	function monthlyUpdateDetails($prmid)
	{
		$projectModel = new ProjectModel();
		$monthlyReportingModel = new MonthlyReportingModel();
		
		$month_ini = new DateTime("first day of last month"); 
		$reportingMonth = $month_ini->format('Y-m');
		
		// echo "<pre>";
		$mmdetails = $monthlyReportingModel->where('monthly_monitoring_id',$prmid)->where('status','1')->first();
		
		$project_id = $mmdetails['project_id'];
		//$project = $projectModel->where('project_id',$project_id)->first();
		$projectModel->select("organizations.entity_name, organizations.entity_type, districts.district_name, blocks.block_name, gram_panchayat.gp_name, villages.village_name ,project_details.project_id,project_details.organization_id, project_name, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, updated_at, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address, project_details.project_id as pid ");
		$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
		//$projectModel->join('states', 'project_details.state_id=states.state_code');
		$projectModel->join('districts', 'project_details.district_id=districts.district_code');
		$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
		$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
		$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
		$projectModel->where('organizations.entity_type','1');
		$projectModel->where('project_details.entity_type_id','17');
		$projectModel->whereIn('project_details.plant_status_id',[24,292,293]);
		$projectModel->where('project_details.project_id',$project_id);
		$projectModel->groupBy('project_details.project_id');
		$data['projects'] = $projectModel->findAll();
		$data['prmid']=$prmid;
		$data['mmdetails']=$mmdetails;
		$data['project_id']=$project_id;
		// print_r($data['projects']);
		// die;
		return view('backend/monthly-update-edit',$data);
	}
	
	
	function monthlyPlants()
	{
		date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
		$created_at = date('Y-m-d H:i:s');
		
		$month_ini = new DateTime("first day of last month"); 
		$reportingMonth = $month_ini->format('Y-m');
		
		
		$monthlyProjectLog = new MonthlyProjectLog();
		
		$month = date('Y-m-01');
		
		$mnst = " and plant_status_date< '".$month."' and project_id IN(SELECT DISTINCT(project_id) FROM project_benefits WHERE option_list_id='255' )";
		$query = $this->db->query("SELECT state_code as StateCode, 
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateCode AND project_details.entity_type_id='17' ) AS TotalBiogasPlantsTillDate, 
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateCode AND project_details.entity_type_id='17' AND project_details.plant_status_id='22' ) AS BiogasYettoStart,
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateCode AND project_details.entity_type_id='17' AND project_details.plant_status_id='23' ) AS BiogasUnderConstruction,
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateCode AND project_details.entity_type_id='17' AND project_details.plant_status_id='24' ) AS BiogasFunctional,
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateCode AND project_details.entity_type_id='17' AND project_details.plant_status_id='290' ) AS BiogasCompleted,
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateCode AND project_details.entity_type_id='17' AND project_details.plant_status_id='292' ) AS BiogasNonFunctional,
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateCode AND project_details.entity_type_id='17' AND project_details.plant_status_id='293' ) AS BiogasDefunct,

		(SELECT COUNT(project_id) FROM project_details , organizations as o where project_details.organization_id=o.id and o.entity_type='1' AND project_details.state_id=StateCode AND project_details.entity_type_id='17' AND project_details.plant_status_id='22' $mnst ) AS ddwsBiogasYettoStart,
		(SELECT COUNT(project_id) FROM project_details , organizations as o where project_details.organization_id=o.id and o.entity_type='1' AND project_details.state_id=StateCode AND project_details.entity_type_id='17' AND project_details.plant_status_id='23' $mnst ) AS ddwsBiogasUnderConstruction,
		(SELECT COUNT(project_id) FROM project_details , organizations as o where project_details.organization_id=o.id and o.entity_type='1' AND project_details.state_id=StateCode AND project_details.entity_type_id='17' AND project_details.plant_status_id='24' $mnst ) AS ddwsBiogasFunctional,
		(SELECT COUNT(project_id) FROM project_details , organizations as o where project_details.organization_id=o.id and o.entity_type='1' AND project_details.state_id=StateCode AND project_details.entity_type_id='17' AND project_details.plant_status_id='290' $mnst ) AS ddwsBiogasCompleted,
		(SELECT COUNT(project_id) FROM project_details , organizations as o where project_details.organization_id=o.id and o.entity_type='1' AND project_details.state_id=StateCode AND project_details.entity_type_id='17' AND project_details.plant_status_id='292' $mnst ) AS ddwsBiogasNonFunctional,
		(SELECT COUNT(project_id) FROM project_details , organizations as o where project_details.organization_id=o.id and o.entity_type='1' AND project_details.state_id=StateCode AND project_details.entity_type_id='17' AND project_details.plant_status_id='293' $mnst ) AS ddwsBiogasDefunct,

		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateCode AND project_details.entity_type_id='18' ) AS TotalCBGPlantsTillDate,
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateCode AND project_details.entity_type_id='18' AND project_details.plant_status_id='22' ) AS CBGYettoStart,
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateCode AND project_details.entity_type_id='18' AND project_details.plant_status_id='23' ) AS CBGPUnderConstruction,
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateCode AND project_details.entity_type_id='18' AND project_details.plant_status_id='24' ) AS CBGFunctional,
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateCode AND project_details.entity_type_id='18' AND project_details.plant_status_id='290' ) AS CBGCompleted,
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateCode AND project_details.entity_type_id='18' AND project_details.plant_status_id='292' ) AS CBGNonFunctional,
		(SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=StateCode AND project_details.entity_type_id='18' AND project_details.plant_status_id='293' ) AS CBGDefunct

		FROM states ORDER BY state_name ASC;");
		$results = $query->getResultArray();
		echo $this->db->getLastQuery(); 
		die;
		
		$monthlyProjectLog->where('reporting_month',$reportingMonth)->delete();
		foreach($results as $result){
			$result['reporting_month']=$reportingMonth;
			$result['created_at']=$created_at;
			$monthlyProjectLog->insert($result);
		}
		
		echo "success";
	}
	
	
	function monthlyUpdateCBG()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		
		// $stateModel = new State();
		// $districtModel = new District();
		$projectModel = new ProjectModel();
		
		// $district = $this->request->getVar('district');
		// $project_name = $this->request->getVar('project_name');
		
		// $month_ini = new DateTime("first day of last month"); 
		// $reportingMonth = $month_ini->format('Y-m');
		
		$reportingMonth = date("Y-m");
		
		$query = $this->db->query("SELECT GROUP_CONCAT(project_id) as project_id FROM project_monthly_monitoring WHERE reporting_month='".$reportingMonth."' AND user_id='".$userId."' and plant_type='2'");
		$res = $query->getRowArray();
		$projIds = explode(",",$res['project_id']);
		
		$projectModel->select(" states.state_name, districts.district_name, project_details.project_id,project_details.organization_id, project_name, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, updated_at, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address, project_details.project_id as pid ");
		//$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
		$projectModel->join('states', 'project_details.state_id=states.state_code');
		$projectModel->join('districts', 'project_details.district_id=districts.district_code');
		//$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
		//$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
		//$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
		//$projectModel->where('organizations.entity_type','1');
		$projectModel->where('project_details.entity_type_id','18');
		$projectModel->whereIn('project_details.plant_status_id',[24]);
		if(count($projIds)>0){
			$projectModel->whereNotIn('project_details.project_id',$projIds);
		}
		
		// $month = date('Y-m-01');
		// $monthsql=" plant_status_date<'".$month."'";
		// $projectModel->where($monthsql);
		
		$projectModel->where('project_details.state_id is not null');
		$projectModel->where('project_details.district_id is not null');
		$projectModel->where('project_details.user_id',$userId);
		
		//$projectModel->where("project_details.project_id in(SELECT DISTINCT(project_id) FROM project_benefits WHERE option_list_id='255' ) ");
		
		// if(!empty($stateId)){
			// $projectModel->where('project_details.state_id', $stateId);
		// }
		// if(!empty($district)){
			// $projectModel->where('project_details.district_id', $district);
		// }
		
		// if(!empty($project_name)){
			// $projectModel->where('project_details.project_name', $project_name);
		// }
		
		$projectModel->groupBy('project_details.project_id');
		
		
		$projects = $projectModel->paginate($this->per_page);
		$data['pager'] = $projectModel->pager;
		$data['per_page'] = $projectModel->per_page;
		$data['projects'] = $projects;
		
		// echo $this->db->getLastQuery();
		// die;
		
		
		//$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		//$data['districts'] = $districtModel->where('state_code',$stateId)->findAll();
		
		
		 
		return view('backend/monthly-update-cbg',$data);
	}
	
	function monthlyUpdateCBGReport($prmid)
	{
		$projectModel = new ProjectModel();
		$monthlyReportingModel = new MonthlyReportingModel();
		
		$month_ini = new DateTime("first day of last month"); 
		$reportingMonth = $month_ini->format('Y-m');
		
		// echo "<pre>";
		$mmdetails = $monthlyReportingModel->where('monthly_monitoring_id',$prmid)->where('status','1')->first();
		
		$project_id = $mmdetails['project_id'];
		//$project = $projectModel->where('project_id',$project_id)->first();
		$projectModel->select("districts.district_name, project_details.project_id,project_details.organization_id, project_name, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, updated_at, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address, project_details.project_id as pid ");
		//$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
		//$projectModel->join('states', 'project_details.state_id=states.state_code');
		$projectModel->join('districts', 'project_details.district_id=districts.district_code');
		//$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
		//$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
		//$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
		//$projectModel->where('organizations.entity_type','1');
		$projectModel->where('project_details.entity_type_id','18');
		$projectModel->whereIn('project_details.plant_status_id',[24,292,293]);
		$projectModel->where('project_details.project_id',$project_id);
		$projectModel->groupBy('project_details.project_id');
		$data['projects'] = $projectModel->findAll();
		$data['prmid']=$prmid;
		$data['mmdetails']=$mmdetails;
		$data['project_id']=$project_id;
		// print_r($data['projects']);
		// die;
		return view('backend/monthly-update-cbg-edit',$data);
	}
	
	
	function monthlyCBGReport()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		$monthlyReportingModel = new MonthlyReportingModel();
		
		$month_ini = new DateTime("first day of last month"); 
		$reportingMonth = $month_ini->format('Y-m');
		
		// $district = $this->request->getVar('district');
		// $plant_status = $this->request->getVar('plant_status');
		$reporting_month = $this->request->getVar('reporting_month');
		if(!empty($reporting_month)){
			$reportingMonth = $reporting_month;
		}
		
		
		$monthlyReportingModel->select("monthly_monitoring_id, project_monthly_monitoring.updated_at, pre_status, current_status, nofunctional_days, feedstock, biogas_generation, bioslurry_generation, fuctional_doc, verify_doc, reporting_date, project_details.project_name, states.state_name, districts.district_name ");
		$monthlyReportingModel->join('project_details','project_details.project_id=project_monthly_monitoring.project_id');
		$monthlyReportingModel->join('states', 'project_details.state_id=states.state_code');
		$monthlyReportingModel->join('districts', 'project_details.district_id=districts.district_code');		
		$monthlyReportingModel->where('reporting_month',$reportingMonth);
		$monthlyReportingModel->where('project_monthly_monitoring.user_id',$userId);
		// if(!empty($plant_status)){
			// $monthlyReportingModel->where('current_status',$plant_status);
		// }
		// if(!empty($district)){
			// $monthlyReportingModel->where('project_details.district_id',$district);
		// }
		$monthlyReportingModel->where('project_monthly_monitoring.status','1');
		$monthlyReportingModel->where('project_monthly_monitoring.plant_type','2');
		$data['reports'] = $monthlyReportingModel->findAll();
		
		$data['reporting_month'] = $reportingMonth;
		//$data['districts'] = $districtModel->where('state_code',$stateId)->findAll();		
		return view('backend/monthly-cbg-report',$data);
		
	}
	
	function reportMenu()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		if($role!="admin"){
			return redirect()->to(base_url());
		}
		$data['test'] = "";
		return view('backend/report-menu',$data);
	}
}
