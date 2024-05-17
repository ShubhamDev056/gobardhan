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
use App\Models\SBMMasterDirectoryModel;
use CodeIgniter\API\ResponseTrait;

use DateTime;
class SBMMasterDirectory extends BaseController
{
    use ResponseTrait;
	private $db;
    public $per_page;

    public function __construct(){

        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session(); 
        $this->per_page = 10;
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
		return view('sbm-master-directory',$data);
	}
	
	

    //------------------------- Sync SBM Master Directory Data via API Section Start --------------------------------
     public function upsertSBMMasterDirectoryData()
    {
        $SBMMasterDirectoryModel = new SBMMasterDirectoryModel(); // initialize the model
        $stateId = $this->request->getVar('state'); //get the state parameter
        // Fetch JSON data from the API
        $apiURL =   env('API_URL');
        $stateCode = ($stateId != null) ? $stateId : 30;
        $json_data = $this->fetchJsonDataFromAPI($apiURL,$stateCode);

        // Upsert batch data into database
        $batchSize = 1000;
      
        $result = $this->insertJsonDataInBatches($SBMMasterDirectoryModel,$json_data,$batchSize);
          if($result){
                 return $this->respond("Data successfully upserted!");
            }else{
                 return $this->respond("no data upserted");
            }
    }
	
	/*
	* --------------------------------------------------------------------
	* function for call SBM Master Directory API
	* --------------------------------------------------------------------
	*/
     private function fetchJsonDataFromAPI($url,$stateCode)
    {
        // Initialize the HTTP client
        $client = \Config\Services::curlrequest();

        $params = [
            'UserID' => env('UserID'),
            'Password' => env('Password'),
            'LGDStateCode' => $stateCode
        ];

        // Set headers
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => env('AuthorizationKey'),
        ];

        // Perform POST request
        $response = $client->request('POST', $url, [
            'form_params' => $params,
            'headers' => $headers
        ]);

        // Get response body
        $body = $response->getBody([]);

        // Decode the JSON response
        $json_data = json_decode($response->getBody(), true);

        $json_data = $json_data['Response'];

        return $json_data;
    }


	/*
	* --------------------------------------------------------------------
	* function forinsertJsonDataInBatches
	* --------------------------------------------------------------------
	*/
    private function insertJsonDataInBatches($model,$json_data, $batch_size)
    {
        // Batch insert JSON data into MySQL
        for ($i = 0; $i < count($json_data); $i += $batch_size) {
            $batch = array_slice($json_data, $i, $batch_size);
            return $model->updateOrInsertBatch($batch);
        }
    }

	//------------------------- Sync SBM Master Directory Data via API Section End --------------------------------

	public function getDistricts()
    {
        $districtModel = new District();
        $scode = $this->request->getVar('scode');
        $districts = $districtModel->where('state_code',$scode)->orderBy('district_name','ASC')->findAll();
        echo '<option value="">Select District </option>';
        foreach($districts as $district){
            $district_name = $district['district_name'];
            $id = $district['district_code'];
            echo '<option value="'.$id.'">'.$district_name.'</option>';
        }
    }
	
	public function getBlocks()
    {
        $blockModel = new Block();
       $dcode = $this->request->getVar('dcode');
        $blocks = $blockModel->where('district_code',$dcode)->where('block_code!=0')->orderBy('block_name','ASC')->findAll();
		//echo $blockModel->getLastQuery();
        echo '<option value="">Select Block </option>';
        foreach($blocks as $block){
            $block_name = $block['block_name'];
            $id = $block['block_code'];
            echo '<option value="'.$id.'">'.$block_name.'</option>';
        }
    }
	
	public function getGPs()
    {
        $gramPanchayat = new GramPanchayat();
        $bcode = $this->request->getVar('bcode');
        $gps = $gramPanchayat->where('block_code',$bcode)->where('gp_code!=0')->orderBy('gp_name','ASC')->findAll();
        echo '<option value="">Select GP </option>';
        foreach($gps as $gp){
            $gp_name = $gp['gp_name'];
            $id = $gp['gp_code'];
            echo '<option value="'.$id.'">'.$gp_name.'</option>';
        }
    }
	
	public function getVillages()
    {
        $villageModel = new Village();
        $gcode = $this->request->getVar('gcode');
        $villages = $villageModel->where('gp_code',$gcode)->where('village_code!=0')->orderBy('village_name','ASC')->findAll();
		//print_r($villages);
        echo '<option value="">Select village </option>';
        foreach($villages as $village){
            $village_name = $village['village_name'];
            $id = $village['village_code'];
            echo '<option value="'.$id.'">'.$village_name.'</option>';
        }
    }
    
}
