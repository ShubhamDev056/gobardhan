<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\OptionList;
use App\Models\ProjectModel;
use App\Models\ProjectBenefitsModel;
use App\Models\ProjectFeedstockModel;
use App\Models\ProjectLinkageModel;
use App\Models\ProjectFundingSourceModel;

 
class APIController extends ResourceController
{
    use ResponseTrait;
	
	private $db;
	
	public function __construct(){
        $this->db = \Config\Database::connect();
    }
    // get all product
    public function index()
    {
        $projectModel = new ProjectModel();
        $projectBenefitsModel = new ProjectBenefitsModel();
        $projectFeedstockModel = new ProjectFeedstockModel();
        $projectFundingSourceModel = new ProjectFundingSourceModel();
        $projectLinkageModel = new ProjectLinkageModel();
        $optionList = new OptionList();
		$certificate_no = $this->request->getVar('certificate_no');
		if(!empty($certificate_no)){
			$data = $projectModel->select('`project_id`, `project_registration_no`, `organization_id`, `project_name`, `entity_type_id`, `plant_type_id`, `plant_status_id`, `gas_production_capacity`, `gpc_unit`, `solid_feedstock_capacity`, `sfc_unit`, `liquid_feedstock_capacity`, `lfc_unit`, `bio_slurry_output`, `bso_unit`, `FOM_output`, `FOM_unit`, `LFOM_output`, `LFOM_unit`, `total_solid_feedstock`, `tsfs_unit`, `total_liquid_feedstock`, `tlfs_unit`, `loi_detail_id`, `distance_grid`, `loi_obtain_details`, `bioslurry_tech`, `bioslurry_tech_other`, `plant_location_id`, `plant_area`, `land_ownership_id`, `other_ownership`, `latitude`, `longitude`, `total_capex`, `state_id`, `district_id`, `block_id`, `gp_id`, `village_id`, `city`, `ward_no`, `pincode`, `date_of_commissioning`, `proposed_date`, `construction_date`, `street_area_address`, `plot_number`, `user_id`, `form_completion`, `project_status`, `updated_at`, `created_at`')->where('project_registration_no',$certificate_no)->first();
			if($data){
				$pid = $data['project_id'];
				//$pBenefits = $projectBenefitsModel->select('`id`, `option_list_id`, `status`, `project_id`, `organization_id`, `other`')->where('project_id',$pid)->findAll();
				//$pFeedstocks = $projectFeedstockModel->select('`id`, `option_list_id`, `project_id`, `organization_id`, `quantity`, `qty_unit`, `feedstock_source`, `source_type`, `others_category`, `others_fedstock_source`')->where('project_id',$pid)->findAll();
				//$pFundingSources = $projectFundingSourceModel->select('`id`, `option_list_id`, `quantity`, `other_specify`, `project_id`, `organization_id`')->where('project_id',$pid)->findAll();
				//$pforwardLinkages = $projectLinkageModel->select('`id`, `option_list_id`, `quantity`, `project_id`, `organization_id`, `linkage_type`, `other_specify`')->where('project_id',$pid)->findAll();
				//$optionLists = $optionList->select('`id` as option_code, `title` as option_value')->where('status','0')->findAll();
				
				$projectBenefitsModel->select('option_list.title,project_benefits.status, project_benefits.other');
				$projectBenefitsModel->join('option_list', 'project_benefits.option_list_id=option_list.id');
				$projectBenefitsModel->where('project_benefits.project_id', $pid);
				$pBenefits = $projectBenefitsModel->findAll();
				
				$projectFeedstockModel->select('option_list.title,source_type_feedstocks.quantity, source_type_feedstocks.qty_unit, source_type_feedstocks.feedstock_source, source_type_feedstocks.source_type, source_type_feedstocks.others_category, source_type_feedstocks.others_fedstock_source ');
				$projectFeedstockModel->join('option_list', 'source_type_feedstocks.option_list_id=option_list.id');
				$projectFeedstockModel->where('source_type_feedstocks.project_id', $pid);
				$pFeedstocks = $projectFeedstockModel->findAll();
				
				$projectFundingSourceModel->select('option_list.title,project_funding_source.quantity, project_funding_source.other_specify ');
				$projectFundingSourceModel->join('option_list', 'project_funding_source.option_list_id=option_list.id');
				$projectFundingSourceModel->where('project_funding_source.project_id', $pid);
				$pFundingSources = $projectFundingSourceModel->findAll();
				
				$projectLinkageModel->select('option_list.title,forward_linkages.quantity, forward_linkages.linkage_type, forward_linkages.other_specify ');
				$projectLinkageModel->join('option_list', 'forward_linkages.option_list_id=option_list.id');
				$projectLinkageModel->where('forward_linkages.project_id', $pid);
				$pforwardLinkages = $projectLinkageModel->findAll();
				
				
				$data['organization'] =  $this->getSingle($this->db, 'organizations', 'entity_name', 'id', $data['organization_id']);
				$data['entity_type'] =  $this->getSingle($this->db, 'option_list', 'title', 'id', $data['entity_type_id']);
				$data['plant_type'] =  $this->getSingle($this->db, 'option_list', 'title', 'id', $data['plant_type_id']);
				$data['plant_status'] =  $this->getSingle($this->db, 'option_list', 'title', 'id', $data['plant_status_id']);
				$data['loi_detail'] =  $this->getSingle($this->db, 'option_list', 'title', 'id', $data['loi_detail_id']);
				$data['bioslurry_tech'] =  $this->getMulti($this->db, 'option_list', 'title', 'id', explode(",",$data['bioslurry_tech']));
				$data['plant_location'] =  $this->getSingle($this->db, 'option_list', 'title', 'id', $data['plant_location_id']);
				$data['land_ownership'] =  $this->getSingle($this->db, 'option_list', 'title', 'id', $data['land_ownership_id']);
				$data['state'] =  $this->getSingle($this->db, 'states', 'state_name', 'state_code', $data['state_id']);
				$data['district'] =  $this->getSingle($this->db, 'districts', 'district_name', 'district_code', $data['district_id']);
				
				
				if($data['plant_location_id']=="83"){
					$data['block'] =  $this->getSingle($this->db, 'blocks', 'block_name', 'block_code', $data['block_id']);
					$data['gp'] =  $this->getSingle($this->db, 'gram_panchayat', 'gp_name', 'gp_code', $data['gp_id']);
					$data['village'] =  $this->getSingle($this->db, 'villages', 'village_name', 'village_code', $data['village_id']);
				}else{
					$data['block'] =  "";
					$data['gp'] =  "";
					$data['village'] =  "";
				}
				
				$data['user'] =  $this->getSingle($this->db, 'users', 'name', 'user_id', $data['user_id']);
				
				unset($data['organization_id']);
				unset($data['entity_type_id']);
				unset($data['plant_type_id']);
				unset($data['plant_status_id']);
				unset($data['loi_detail_id']);
				unset($data['plant_location_id']);
				unset($data['land_ownership_id']);
				unset($data['state_id']);
				unset($data['district_id']);
				unset($data['block_id']);
				unset($data['gp_id']);
				unset($data['village_id']);
				unset($data['user_id']);
				
				
				
				$responseArr=array(
					"status"=>200,
					"message"=>"Project Details",
					"project_details"=>$data,
					"project_benefits"=>$pBenefits,
					"project_feedstocks"=>$pFeedstocks,
					"project_funding_source"=>$pFundingSources,
					"project_forward_linkages"=>$pforwardLinkages,
				);
			}else{
				$responseArr=array("status"=>0,"message"=>"Invalid cetificate number.");
			}
		}else{
			$responseArr=array("status"=>0,"message"=>"Cetificate number are required");
		}
		return $this->respond($responseArr);
    }
	
	public function updateProject($id)
    {
		$ministry = $this->request->getVar('ministry');
		if(!empty($ministry)){
			$projectModel = new ProjectModel();
			$validation =  \Config\Services::validation();
			if($ministry=='AIF'){
				$project_name = $this->request->getVar('project_name');
				$latitude = $this->request->getVar('latitude');
				$longitude = $this->request->getVar('longitude');
				$total_capex = $this->request->getVar('total_capex');
				$state_code = $this->request->getVar('state_code');
				$district_code = $this->request->getVar('district_code');
				$rules = [
					"project_name" => [
						"label" => "project_name", 
						"rules" => "required"
					],
					"latitude" => [
						"label" => "latitude", 
						"rules" => "required"
					],
					"longitude" => [
						"label" => "longitude", 
						"rules" => "required"
					],
					"total_capex" => [
						"label" => "total_capex", 
						"rules" => "required"
					],
					"state_code" => [
						"label" => "state_code", 
						"rules" => "required"
					],
					"district_code" => [
						"label" => "district_code", 
						"rules" => "required"
					]
				];
				if ($this->validate($rules)) {
					$projectInfo = [
						'project_name'=>$project_name,
						'latitude'=>$latitude,
						'longitude'=>$longitude,
						'total_capex'=>$total_capex,
						'state_id'=>$state_code,
						'district_id'=>$district_code,
					];
					$res = $projectModel->where('ministry','AIF')->where('munique_id',$id)->set($projectInfo)->update();
					if($res){
						$response = array("status"=>1,"message"=>"Project updated successfully.");
					}else{
						$response = array("status"=>500,"message"=>"Internal server error.");
					}
				}else{
					$errorsmsg = $validation->getErrors();
					$response["status"] = 2;
					$response["message"] = 'All fields are required.';
					$response["errors"] = $errorsmsg;
				}
			}else if($ministry=='MoPNG'){
				$unique_id = $this->request->getVar('unique_id');
				$project_name = $this->request->getVar('project_name');
				$latitude = $this->request->getVar('latitude');
				$longitude = $this->request->getVar('longitude');
				$total_capex = $this->request->getVar('total_capex');
				$rules = [
					"project_name" => [
						"label" => "project name", 
						"rules" => "required"
					],
					"latitude" => [
						"label" => "latitude", 
						"rules" => "required"
					],
					"longitude" => [
						"label" => "longitude", 
						"rules" => "required"
					],
					"total_capex" => [
						"label" => "total capex", 
						"rules" => "required"
					],
					"unique_id" => [
						"label" => "unique id", 
						"rules" => "required"
					]
				];
				if ($this->validate($rules)) {
					$projectInfo = [
						'project_name'=>$project_name,
						'latitude'=>$latitude,
						'longitude'=>$longitude,
						'total_capex'=>$total_capex,
					];
					$id = $unique_id;
					$result = $projectModel->where('ministry','MoPNG')->where('munique_id',$id)->first();
					if($result){
						$res = $projectModel->where('ministry','MoPNG')->where('munique_id',$id)->set($projectInfo)->update();
						if($res){
							$response = array("status"=>1,"message"=>"Project updated successfully.");
						}else{
							$response = array("status"=>500,"message"=>"Internal server error.");
						}
					} 
					else{
						$response = array("status"=>0,"message"=>"Record not found.");
					}
				}else{ 
					$errorsmsg = $validation->getErrors();
					$response["status"] = 2;
					$response["message"] = 'All fields are required.';
					$response["errors"] = $errorsmsg;
				}
			}else if($ministry=='MNRE'){
				$project_name = $this->request->getVar('project_name');
				$latitude = $this->request->getVar('latitude');
				$longitude = $this->request->getVar('longitude');
				$gas_production_capacity = $this->request->getVar('gas_production_capacity');
				$rules = [
					"project_name" => [
						"label" => "project name", 
						"rules" => "required"
					],
					"latitude" => [
						"label" => "latitude", 
						"rules" => "required"
					],
					"longitude" => [
						"label" => "longitude", 
						"rules" => "required"
					],
					"gas_production_capacity" => [
						"label" => "total capex", 
						"rules" => "required"
					]
				];
				if ($this->validate($rules)) {
					$projectInfo = [
						'project_name'=>$project_name,
						'latitude'=>$latitude,
						'longitude'=>$longitude,
						'gas_production_capacity'=>$gas_production_capacity,
					];
					$res = $projectModel->where('ministry','MNRE')->where('munique_id',$id)->set($projectInfo)->update();
					if($res){
						$response = array("status"=>1,"message"=>"Project updated successfully.");
					}else{
						$response = array("status"=>500,"message"=>"Internal server error.");
					}
				}else{ 
					$errorsmsg = $validation->getErrors();
					$response["status"] = 2;
					$response["message"] = 'All fields are required.';
					$response["errors"] = $errorsmsg;
				}
			}else{
				$response = array("status"=>0,"message"=>"Invalid Ministry.");
			}
			
			
		}else{
			$response = array("status"=>0,"message"=>"Ministry is required.");
		}
        return $this->respond($response);
    }
	
	
	function stateWisePlants()
	{
		$plant_type = $this->request->getVar('plant_type');
		$plant_types = array('biogas'=>17,'cbg'=>18);
		if(!empty($plant_type) && $plant_type=='biogas' || $plant_type=='cbg'){
			$prevdate = date('Y-m-d', strtotime(' -1 day'));
			$plant_type = $plant_types[$plant_type];
			$query = $this->db->query("SELECT state_code, state_name, (SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=state_code AND project_details.entity_type_id='".$plant_type."' ) AS total_plants, (SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=state_code AND project_details.entity_type_id='".$plant_type."' AND date(project_details.created_at)='".$prevdate."' ) AS previous_day_plants FROM states ORDER BY state_name ASC;");
			$res = $query->getResultArray();
			$response = array("status"=>1,"message"=>"Success","data"=>$res);
		}else{
			$response = array("status"=>0,"message"=>"Invalid Plant Type.");
		}
		return $this->respond($response);
	}
	
	
	
	function getSingle($conn, $tablename, $field = '*', $qryfeild = '', $value = ''){
		$builder = $conn->table($tablename);
		$builder->select($field);
		if($value != ""){
			$builder->where($qryfeild, $value);
		}else{
			return "NA";
		}
		$query = $builder->get();
		$data=$query->getRow();
		//echo $value;
		if($data){
			return $data->$field;
		}else{
			return "NA";
		}
	}
	
	function getMulti($conn, $tablename, $field = '*', $qryfeild = '', $values = []){
		$builder = $conn->table($tablename);
		$builder->select($field);
		if(count($values)>0){
			$builder->whereIn($qryfeild, $values);
		}else{
			return "NA";
		}
		$query = $builder->get();
		$data=$query->getResult();
		return $data;
	}
	
	
	function districtBiogasWisePlants($statecode){
		
		$query = $this->db->query("SELECT district_code, district_name, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='22'  ) as yettostarted, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='23'  ) as underconstruction, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='24'  ) as functional, (select count(project_id) from project_details where project_details.district_id=district_code and  entity_type_id='17' and plant_status_id='290'  ) as completed FROM districts WHERE state_code='".$statecode."' order by district_name asc ");
		$res = $query->getResultArray();
		$response = array("status"=>1,"message"=>"Success","data"=>$res);
		return $this->respond($response);
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