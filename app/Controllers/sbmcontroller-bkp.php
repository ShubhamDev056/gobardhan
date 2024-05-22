<?php

namespace App\Controllers;
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
    
	public function sbmMasterDirectoryReport()
	{
		$SBMMasterDirectoryModel = new SBMMasterDirectoryModel(); // initialize the model
		$SBMMasterDirectoryModels = new SBMMasterDirectoryModel(); // initialize the model
		$data['states'] = $SBMMasterDirectoryModel->select(['LGDStateCode','StateName'])->distinct()->orderBy('StateName','ASC')->findAll(); 
		$stateId = $this->request->getVar('state');
		$districtId = $this->request->getVar('district');
		$blockID = $this->request->getVar('block');
		$gpID = $this->request->getVar('gp');
		$villageID = $this->request->getVar('village');
		$plant_type = $this->request->getVar('plant_type');
		$plant_status = $this->request->getVar('plant_status');
		$perpage = $this->request->getVar('per_page');
		
		if(trim($perpage) != ""){
			$this->per_page = $perpage;
		}
		
		$locateDetails=[];
		$districts=[];
		$blocks=[];
		$gps=[];
		$villages=[];
		$pager=$prpage='';
	
		if($stateId!=""){

			$SBMMasterDirectoryModel->where('LGDStateCode', $stateId);
			$districts = $SBMMasterDirectoryModels->select(['LGDDistrictCode','DistrictName'])->distinct()->where('LGDStateCode', $stateId)->findAll();
			
			if(!empty($districtId)){
				$SBMMasterDirectoryModel->where('LGDDistrictCode', $districtId);

				$blocks = $SBMMasterDirectoryModels->select(['LGDBlockCode','BlockName'])->distinct()->where('LGDDistrictCode', $districtId)->findAll();
			}
			if(!empty($blockID)){
				$SBMMasterDirectoryModel->where('LGDBlockCode', $blockID);
				$gps = $SBMMasterDirectoryModels->select(['LGDGramPanchayatCode','GrampanchayatName'])->distinct()->where('LGDBlockCode', $blockID)->findAll();
			}
			if(!empty($gpID)){
				$SBMMasterDirectoryModel->where('LGDGramPanchayatCode', $gpID);
				$villages = $SBMMasterDirectoryModels->select(['LGDVillageCode','VillageName'])->distinct()->where('LGDGramPanchayatCode', $gpID)->findAll();
			}
			if(!empty($villageID)){
				$SBMMasterDirectoryModel->where('LGDVillageCode', $villageID);
			}
			
			$locateDetails = $SBMMasterDirectoryModel->paginate($this->per_page);
		
			$pager = $SBMMasterDirectoryModel->pager;
			$prpage = $SBMMasterDirectoryModel->per_page;
		}
		
		$data['pager'] = $pager;
		$data['per_page'] = $prpage;
		$data['locateDetails'] = $locateDetails;
		$data['districts'] = $districts;
		$data['blocks'] = $blocks;
		$data['gps'] = $gps;
		$data['villages'] = $villages;
		return view('sbm-master-directory',$data);
	}
	
	

    //Sync SBM Master Directory Data via API Section Start
    public function upsertSBMMasterDirectoryData()
    {
        $SBMMasterDirectoryModel = new SBMMasterDirectoryModel(); // initialize the model
        $stateId = $this->request->getVar('state'); //get the state parameter
        // Fetch JSON data from the API
        $apiURL =   env('API_URL');
        $stateCode = ($stateId != null) ? $stateId : -1; // -1 means for all states.
        $json_data = $this->fetchJsonDataFromAPI($apiURL,$stateCode);

        $batch_size = 1000;
	    $anyDataUpserted = false;
		// Batch insert JSON data into MySQL
        for ($i = 0; $i < count($json_data); $i += $batch_size) {
            $batch = array_slice($json_data, $i, $batch_size);
            $result =  $SBMMasterDirectoryModel->updateOrInsertBatch($batch);
			 if ($result) {
               $anyDataUpserted = true;
       		 }
        }

        if (!$anyDataUpserted) {
        return $this->respond("No data upserted", 200);
    	} else {
        return $this->respond("Data successfully upserted!", 200);
        }
	
    }
	
	//function for API calls
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

    public function upsertStatesUsingLGDCode(){

    }

    public function upsertDistrictsUsingLGDCode(){

    }

    public function upsertBlocksUsingLGDCode(){

    }

    public function upsertGPUsingLGDCode(){

    }

    public function upsertVillagesUsingLGDCode(){

    }

	public function getDistricts()
    {
		$SBMMasterDirectoryModel = new SBMMasterDirectoryModel();
        $scode = $this->request->getVar('scode');
        $districts = $SBMMasterDirectoryModel->select(['LGDDistrictCode','DistrictName'])->distinct()->where('LGDStateCode',$scode)->orderBy('DistrictName','ASC')->findAll();
		//echo $SBMMasterDirectoryModel->getLastQuery();die;
        echo '<option value="">Select District </option>';
        foreach($districts as $district){
            $DistrictName = $district['DistrictName'];
            $id = $district['LGDDistrictCode'];
            echo '<option value="'.$id.'">'.$DistrictName.'</option>';
        }
    }
	
	public function getBlocks()
    {
       $SBMMasterDirectoryModel = new SBMMasterDirectoryModel();
       $dcode = $this->request->getVar('dcode');
        $blocks = $SBMMasterDirectoryModel->select(['LGDBlockCode','BlockName'])->distinct()->where('LGDDistrictCode',$dcode)->where('LGDBlockCode!=0')->orderBy('BlockName','ASC')->findAll();
		//echo $SBMMasterDirectoryModel->getLastQuery();
        echo '<option value="">Select Block </option>';
        foreach($blocks as $block){
            $BlockName = $block['BlockName'];
            $id = $block['LGDBlockCode'];
            echo '<option value="'.$id.'">'.$BlockName.'</option>';
        }
    }
	
	public function getGPs()
    {
        $SBMMasterDirectoryModel = new SBMMasterDirectoryModel();
        $bcode = $this->request->getVar('bcode');
        $gps = $SBMMasterDirectoryModel->select(['LGDGramPanchayatCode','GrampanchayatName'])->distinct()->where('LGDBlockCode',$bcode)->where('LGDGramPanchayatCode!=0')->orderBy('GrampanchayatName','ASC')->findAll();
        echo '<option value="">Select GP </option>';
        foreach($gps as $gp){
            $GrampanchayatName = $gp['GrampanchayatName'];
            $id = $gp['LGDGramPanchayatCode'];
            echo '<option value="'.$id.'">'.$GrampanchayatName.'</option>';
        }
    }
	
	public function getVillages()
    {
        $SBMMasterDirectoryModel = new SBMMasterDirectoryModel();
        $gcode = $this->request->getVar('gcode');
        $villages = $SBMMasterDirectoryModel->select(['LGDVillageCode','VillageName'])->distinct()->where('LGDGramPanchayatCode',$gcode)->where('LGDVillageCode!=0')->orderBy('VillageName','ASC')->findAll();
        echo '<option value="">Select village </option>';
        foreach($villages as $village){
            $VillageName = $village['VillageName'];
            $id = $village['LGDVillageCode'];
            echo '<option value="'.$id.'">'.$VillageName.'</option>';
        }
    }
    
}
