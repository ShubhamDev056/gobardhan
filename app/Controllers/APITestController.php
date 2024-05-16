<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\State;
use App\Models\OptionList;
use App\Models\ProjectModel;
use App\Models\ProjectBenefitsModel;
use App\Models\ProjectFeedstockModel;
use App\Models\ProjectLinkageModel;
use App\Models\ProjectFundingSourceModel;
use App\Models\SatatOfficer;

 
class APITestController extends ResourceController
{	

    use ResponseTrait;
	
	private $db;
	
	public function __construct(){
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: POST,GET, OPTIONS");
		header("Access-Control-Allow-Headers: *");
		//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->db = \Config\Database::connect();
    }
    // get all product
    
	function biogasPlantStateWise()
	{
		$stateModel = new State();
		$minitry = $this->request->getVar('m');
		if(!empty($minitry) && $minitry=='ddws'){
			$mnst = " and project_id IN(SELECT DISTINCT(project_id) FROM project_benefits WHERE option_list_id='255' )";
			$states = $stateModel->select("state_code, state_name, noofdistricts, (select count(distinct(district_id)) from project_details where project_details.state_id=state_code $mnst  and  entity_type_id='17' and plant_status_id!='22' ) as districtCovered, (select count(project_id) from project_details, organizations as o where project_details.organization_id=o.id and o.entity_type='1' and project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='22' $mnst  ) as yettostarted, (select count(project_id) from project_details, organizations AS o where project_details.organization_id=o.id and o.entity_type='1' and project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='23' $mnst ) as underconstruction, (select count(project_id) from project_details, organizations AS o where project_details.organization_id=o.id and o.entity_type='1' and project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='24' $mnst ) as functional, (select count(project_id) from project_details, organizations AS o where project_details.organization_id=o.id and o.entity_type='1' and project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='290' $mnst ) as completed ")->orderBy('state_name','ASC')->findAll();
		}else{
			$states = $stateModel->select("state_code, state_name, noofdistricts, (select count(distinct(district_id)) from project_details where project_details.state_id=state_code  and  entity_type_id='17' and plant_status_id!='22' ) as districtCovered, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='22'  ) as yettostarted, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='23'  ) as underconstruction, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='24'  ) as functional, (select count(project_id) from project_details where project_details.state_id=state_code and  entity_type_id='17' and plant_status_id='290'  ) as completed ")->orderBy('state_name','ASC')->findAll();
		}
		
		$responseArr=array("status"=>0,"message"=>"Something went wrong.");
		if($states){
			$responseArr=array("status"=>1,"message"=>"Fetch data successfully.", "data"=>$states);
		}
		return $this->respond($responseArr);
	}
	
	function SATATNodalOfficer()
	{
		$satatOfficer = new SatatOfficer();
		$satatOfficers = $satatOfficer->where('status','0')->findAll();
		$responseArr=array("status"=>0,"message"=>"Something went wrong.");
		if($satatOfficers){
			$responseArr=array("status"=>1,"message"=>"Fetch data successfully.", "data"=>$satatOfficers);
		}
		return $this->respond($responseArr);
	}
	
	public function plantDetails()
	{
		$stateCode = $this->request->getVar('stateCode');
		$districtCode = $this->request->getVar('districtCode');
		$gpCode = $this->request->getVar('gpCode');
		$bgstatus = $this->request->getVar('bgstatus');
		$etype = $this->request->getVar('etype');
		$ministry = $this->request->getVar('m');
		$fdate = $this->request->getVar('fdate');
		$tdate = $this->request->getVar('tdate');
		$mnst = " project_id IN(SELECT DISTINCT(project_id) FROM project_benefits WHERE option_list_id='255' )";
		$plant_status_id='';
		if($bgstatus=="yettostart"){
			$plant_status_id=22;
		}
		if($bgstatus=="underconstct"){
			$plant_status_id=23;
		}
		if($bgstatus=="functional"){
			$plant_status_id=24;
		}
		if($bgstatus=="completed"){
			$plant_status_id=290;
		}
		$projectModel = new ProjectModel();
		$dd=[];
		if(!empty($stateCode)){
			$projectModel->select("project_name, organizations.entity_name, districts.district_name, blocks.block_name,gp_name, villages.village_name ,project_id,organization_id, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address ");
			$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
			$projectModel->join('districts', 'project_details.district_id=districts.district_code');
			$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
			$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
			$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
			$projectModel->where('project_details.entity_type_id', $etype);
			$projectModel->where('project_details.state_id', $stateCode);
			if(!empty($plant_status_id)){
				$projectModel->where('project_details.plant_status_id', $plant_status_id);
			}
			if($ministry=='ddws'){
				if(!empty($fdate) && !empty($tdate) ){
					$mnst.=" and plant_status_date>='".$fdate."' and plant_status_date<='".$tdate."' ";
				}
				$projectModel->where('organizations.entity_type', '1');
				$projectModel->where($mnst);
				
			}
			
			$projectModel->groupBy('project_details.village_id,project_details.created_at');
			$dd=$projectModel->findAll();
		}
		if(!empty($districtCode)){
			$projectModel->select("project_name, organizations.entity_name, districts.district_name, blocks.block_name,gp_name, villages.village_name ,project_id,organization_id, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address ");
			$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
			$projectModel->join('districts', 'project_details.district_id=districts.district_code');
			$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
			$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
			$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
			$projectModel->where('project_details.entity_type_id', $etype);
			$projectModel->where('project_details.district_id', $districtCode);
			if(!empty($plant_status_id)){
				$projectModel->where('project_details.plant_status_id', $plant_status_id);
			}
			if($ministry=='ddws'){
				if(!empty($fdate) && !empty($tdate) ){
					$mnst.=" and plant_status_date>='".$fdate."' and plant_status_date<='".$tdate."' ";
				}
				$projectModel->where('organizations.entity_type', '1');
				$projectModel->where($mnst);
			}
			$projectModel->groupBy('project_details.village_id,project_details.created_at');
			$dd=$projectModel->findAll();
		}
		
		if(!empty($gpCode)){
			$projectModel->select("organizations.entity_name ,project_id,organization_id, project_name, project_status, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address ");
			$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
			$projectModel->where('project_details.entity_type_id', $etype);
			$projectModel->where('project_details.gp_id', $gpCode);
			$dd=$projectModel->findAll();
		}
		
		$responseArr=array("status"=>0,"message"=>"Something went wrong.");
		if($dd){
			$responseArr=array("status"=>1,"message"=>"Fetch data successfully.", "data"=>$dd);
		}
		return $this->respond($responseArr);
	}







    // get single product
    /* public function show($id = null)
    {
        $model = new ProductModel();
        $data = $model->getWhere(['product_id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    } */
 
    // create a product
    /* public function create()
    {
        $model = new ProductModel();
        $data = [
            'product_name' => $this->request->getVar('product_name'),
            'product_price' => $this->request->getVar('product_price')
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
        return $this->respondCreated($response);
    } */
 
    // update product
    /* public function update($id = null)
    {
        $model = new ProductModel();
        $input = $this->request->getRawInput();
        $data = [
            'product_name' => $input['product_name'],
            'product_price' => $input['product_price']
        ];
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    } */
 
    // delete product
    /* public function delete($id = null)
    {
        $model = new ProductModel();
        $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    } */
 
}