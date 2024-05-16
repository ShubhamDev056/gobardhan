<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\State;
use App\Models\District;
use App\Models\ProjectModel;
use App\Models\OrganizationModel;

class DashboardController extends BaseController
{
	private $db;
	public $per_page;
	public function __construct(){
		$this->db = \Config\Database::connect();
		$this->per_page = 10;
	}
	
    public function abc()
    {
		$session = session();
		$role_id = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		$hasPermissions = ['admin','ministry'];
// 		if($role!="admin"){
		if(!in_array($role,$hasPermissions)){
		    $accessDeniedURL = base_url().'access-denied';
			return redirect()->to($accessDeniedURL);
		}
		
		
		$stateModel = new State();
		$districtModel = new District(); 
		$projectModel = new ProjectModel();
		$organizationModel = new OrganizationModel();
		
		$stateId = $this->request->getVar('state');
		
		
		
		$districtId = $this->request->getVar('district');
		$plant_typeId = $this->request->getVar('plant_type');
		$plant_statusId = $this->request->getVar('plant_status');
		
		
		
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll(); 
		$districts=[];
		if(!empty($stateId)){
			$districts = $districtModel->where('state_code',$stateId)->findAll();
		}
		$data['districts'] = $districts;
		
		///ORGANIZATION
		$organizationModel->select('count(id) as totOrg');
		if(!empty($stateId)){
			$organizationModel->where('state_id',$stateId);
		}
		if(!empty($districtId)){
			$organizationModel->where('district_id',$districtId);
		}
		
		$data['org'] = $organizationModel->first();
		
		///BIOGAS
		$projectModel->select('count(project_id) as totBiogasProjects ');
		$projectModel->where('entity_type_id',17);
		$projectModel->where('state_id!=""');
		$projectModel->where('district_id!=""');
		if(!empty($stateId)){
			$projectModel->where('state_id',$stateId);
		}
		if(!empty($districtId)){
			$projectModel->where('district_id',$districtId);
		}
		if(!empty($plant_statusId)){
			$projectModel->where('plant_status_id',$plant_statusId);
		}
		$data['totBiogas'] = $projectModel->first();
		
		///CBG
		$projectModel->select('count(project_id) as totCBGProjects ');
		$projectModel->where('entity_type_id',18);
		$projectModel->where('state_id!=""');
		$projectModel->where('district_id!=""');
		if(!empty($stateId)){
			$projectModel->where('state_id',$stateId);
		}
		if(!empty($districtId)){
			$projectModel->where('district_id',$districtId);
		}
		if(!empty($plant_statusId)){
			$projectModel->where('plant_status_id',$plant_statusId);
		}
		$data['totCBG'] = $projectModel->first();
		
		
		///Organization Wise Projects
		$organizationModel->select('entity_type, COUNT(id) as totOrg');
		if(!empty($stateId)){
			$organizationModel->where('state_id',$stateId);
		}
		if(!empty($districtId)){
			$organizationModel->where('district_id',$districtId);
		}
		$organizationModel->groupBy('entity_type');
		$data['orgWiseProjects'] = $organizationModel->findAll();
		
		
		///SELECT plant_status_id, COUNT(project_id) as totProjects FROM `project_details` WHERE plant_status_id IS NOT null  GROUP BY plant_status_id;
		$projectModel->select('plant_status_id, COUNT(project_id) as totProjects');
		$projectModel->where('plant_status_id IS NOT null');
		if(!empty($stateId)){
			$projectModel->where('state_id',$stateId);
		}
		if(!empty($districtId)){
			$projectModel->where('district_id',$districtId);
		}
		if(!empty($plant_statusId)){
			$projectModel->where('plant_status_id',$plant_statusId);
		}
		$projectModel->groupBy('plant_status_id');
		$data['statusWiseProjects'] = $projectModel->findAll();
		
		
		///Location Wise Projects
		
		$projectModel->select('plant_location_id, COUNT(project_id) as totProjects');
		$projectModel->where('plant_location_id IS NOT null');
		if(!empty($stateId)){
			$projectModel->where('state_id',$stateId);
		}
		if(!empty($districtId)){
			$projectModel->where('district_id',$districtId);
		}
		if(!empty($plant_statusId)){
			$projectModel->where('plant_status_id',$plant_statusId);
		}
		$projectModel->groupBy('plant_location_id');
		$data['locationWiseProjects'] = $projectModel->findAll();
		
		///Type of Biogas Projects
		///SELECT plant_type_id, COUNT(project_id) as totProjects FROM project_details  WHERE plant_type_id IS NOT null AND entity_type_id='17'  GROUP BY plant_type_id;
		$projectModel->select('plant_type_id, COUNT(project_id) as totProjects');
		$projectModel->where('plant_type_id IS NOT null');
		$projectModel->where('entity_type_id',17);
		if(!empty($stateId)){
			$projectModel->where('state_id',$stateId);
		}
		if(!empty($districtId)){
			$projectModel->where('district_id',$districtId);
		}
		if(!empty($plant_statusId)){
			$projectModel->where('plant_status_id',$plant_statusId);
		}
		$projectModel->groupBy('plant_type_id');
		$data['biogasTypeWiseProjects'] = $projectModel->findAll();
		
		///SELECT SUM(gas_production_capacity) AS gas_production_capacity, SUM(solid_feedstock_capacity) as solid_feedstock_capacity, SUM(liquid_feedstock_capacity) AS liquid_feedstock_capacity, SUM(bio_slurry_output) AS bio_slurry_output, SUM(FOM_output) AS FOM_output, SUM(LFOM_output) AS LFOM_output FROM project_details WHERE entity_type_id='17';
		
		
		$projectModel->select('SUM(gas_production_capacity) AS gas_production_capacity, SUM(solid_feedstock_capacity) as solid_feedstock_capacity, SUM(liquid_feedstock_capacity) AS liquid_feedstock_capacity, SUM(bio_slurry_output) AS bio_slurry_output, SUM(FOM_output) AS FOM_output, SUM(LFOM_output) AS LFOM_output');
		$projectModel->where('entity_type_id',17);
		$projectModel->where('plant_status_id',24);
		if(!empty($stateId)){
			$projectModel->where('state_id',$stateId);
		}
		if(!empty($districtId)){
			$projectModel->where('district_id',$districtId);
		}
		
		if(!empty($plant_statusId)){
			$projectModel->where('plant_status_id',$plant_statusId);
		}
		$data['capacities'] = $projectModel->first();
		
		
		/// capacities CBG
		
		$ministryWiseQry='';
		
		$projectModel->select('SUM(gas_production_capacity) AS gas_production_capacity, SUM(solid_feedstock_capacity) as solid_feedstock_capacity, SUM(liquid_feedstock_capacity) AS liquid_feedstock_capacity, SUM(bio_slurry_output) AS bio_slurry_output, SUM(FOM_output) AS FOM_output, SUM(LFOM_output) AS LFOM_output');
		$projectModel->where('entity_type_id',18);
		$projectModel->where('plant_status_id',24);
		if(!empty($stateId)){
			$projectModel->where('state_id',$stateId);
			$ministryWiseQry.=" and project_details.state_id='".$stateId."' ";
		}
		if(!empty($districtId)){
			$projectModel->where('district_id',$districtId);
			$ministryWiseQry.=" and project_details.district_id='".$districtId."' ";
		}
		
		if(!empty($plant_statusId)){
			$projectModel->where('plant_status_id',$plant_statusId);
			$ministryWiseQry.=" and project_details.plant_status_id='".$plant_statusId."' ";
		}
		$data['capacitiescbg'] = $projectModel->first();
		
		
		
		$benefits = [253,254,256,257,258,259,255,260];
		$bnfStatuss = ['applied','availed','required'];
		$seriesData = "";
		foreach($bnfStatuss as $bnfStatus){
			$seriesData.="{ name: '".ucfirst($bnfStatus)."',  data: [ ";
			foreach($benefits as $benefit){ 
				$query = $this->db->query("SELECT COUNT(id) as totPlants FROM project_benefits INNER JOIN project_details ON project_details.project_id=project_benefits.project_id WHERE option_list_id='".$benefit."' AND status='".$bnfStatus."' $ministryWiseQry; ");
				$res = $query->getRow();
				$seriesData.=$res->totPlants.",";
			}
			$seriesData.="] },";
		}
		
		$data['seriesData'] = $seriesData;
		// print_r($capacities);
		// die;
		
		return view('backend/dashboard',$data);
    }
	
	function stateDashboard()
	{
		$session = session();
		$role_id = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		//die;
		$stateModel = new State();
		$districtModel = new District(); 
		$projectModel = new ProjectModel();
		$organizationModel = new OrganizationModel();
		
		$districtId = $this->request->getVar('district');
		$plant_typeId = $this->request->getVar('plant_type');
		$plant_statusId = $this->request->getVar('plant_status');
		
		
		$districts=[];
		if(!empty($stateId)){
			$districts = $districtModel->where('state_code',$stateId)->findAll();
		}
		$data['districts'] = $districts;
		
		///ORGANIZATION
		$organizationModel->select('count(id) as totOrg');
		if(!empty($stateId)){
			$organizationModel->where('state_id',$stateId);
		}
		if(!empty($districtId)){
			$organizationModel->where('district_id',$districtId);
		}
		
		$data['org'] = $organizationModel->first();
		
		///BIOGAS
		$projectModel->select('count(project_id) as totBiogasProjects ');
		$projectModel->where('entity_type_id',17);
		$projectModel->where('state_id!=""');
		$projectModel->where('district_id!=""');
		if(!empty($stateId)){
			$projectModel->where('state_id',$stateId);
		}
		if(!empty($districtId)){
			$projectModel->where('district_id',$districtId);
		}
		if(!empty($plant_statusId)){
			$projectModel->where('plant_status_id',$plant_statusId);
		}
		$data['totBiogas'] = $projectModel->first();
		
		///CBG
		$projectModel->select('count(project_id) as totCBGProjects ');
		$projectModel->where('entity_type_id',18);
		$projectModel->where('state_id!=""');
		$projectModel->where('district_id!=""');
		if(!empty($stateId)){
			$projectModel->where('state_id',$stateId);
		}
		if(!empty($districtId)){
			$projectModel->where('district_id',$districtId);
		}
		if(!empty($plant_statusId)){
			$projectModel->where('plant_status_id',$plant_statusId);
		}
		$data['totCBG'] = $projectModel->first();
		
		///SELECT SUM(gas_production_capacity) AS gas_production_capacity, SUM(solid_feedstock_capacity) as solid_feedstock_capacity, SUM(liquid_feedstock_capacity) AS liquid_feedstock_capacity, SUM(bio_slurry_output) AS bio_slurry_output, SUM(FOM_output) AS FOM_output, SUM(LFOM_output) AS LFOM_output FROM project_details WHERE entity_type_id='17';
		$projectModel->select('SUM(gas_production_capacity) AS gas_production_capacity, SUM(solid_feedstock_capacity) as solid_feedstock_capacity, SUM(liquid_feedstock_capacity) AS liquid_feedstock_capacity, SUM(bio_slurry_output) AS bio_slurry_output, SUM(FOM_output) AS FOM_output, SUM(LFOM_output) AS LFOM_output');
		$projectModel->where('entity_type_id',17);
		$projectModel->where('plant_status_id',24);
		if(!empty($stateId)){
			$projectModel->where('state_id',$stateId);
		}
		if(!empty($districtId)){
			$projectModel->where('district_id',$districtId);
		}
		
		// if(!empty($plant_statusId)){
			// $projectModel->where('plant_status_id',$plant_statusId);
		// }
		$data['capacities'] = $projectModel->first();
		
		/// capacities CBG
		$projectModel->select('SUM(gas_production_capacity) AS gas_production_capacity, SUM(solid_feedstock_capacity) as solid_feedstock_capacity, SUM(liquid_feedstock_capacity) AS liquid_feedstock_capacity, SUM(bio_slurry_output) AS bio_slurry_output, SUM(FOM_output) AS FOM_output, SUM(LFOM_output) AS LFOM_output');
		$projectModel->where('entity_type_id',18);
		$projectModel->where('plant_status_id',24);
		if(!empty($stateId)){
			$projectModel->where('state_id',$stateId);
		}
		if(!empty($districtId)){
			$projectModel->where('district_id',$districtId);
		}
		
		// if(!empty($plant_statusId)){
			// $projectModel->where('plant_status_id',$plant_statusId);
		// }
		$data['capacitiescbg'] = $projectModel->first();
		
		return view('backend/state-dashboard',$data);
	}

	
}
