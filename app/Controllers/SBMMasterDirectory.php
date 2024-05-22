<?php

namespace App\Controllers;

use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\GramPanchayat;
use App\Models\Village;
use App\Models\SBMMasterDirectoryModel;
use CodeIgniter\API\ResponseTrait;
use DateTime;

class SBMMasterDirectory extends BaseController
{
    use ResponseTrait;
    
    private $db;
    public $per_page;
    private $stateModel;
    private $districtModel;
    private $blockModel;
    private $gpModel;
    private $villageModel;
    private $SBMMasterDirectoryModel;
    private $SBMMasterDirectoryModels;

    public function __construct(){
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session(); 
        $this->per_page = 10;
        $this->stateModel = new State(); // initialize state model
        $this->districtModel = new District(); // initialize District model
        $this->blockModel = new Block(); // initialize Block model
        $this->gpModel = new GramPanchayat(); // initialize GramPanchayat model
        $this->villageModel = new Village(); // initialize Village model
        $this->SBMMasterDirectoryModel = new SBMMasterDirectoryModel(); // initialize the model
        $this->SBMMasterDirectoryModels = new SBMMasterDirectoryModel(); // initialize the model
    }
    
    public function sbmMasterDirectoryReport()
    {
        $data['states'] = $this->SBMMasterDirectoryModel->select(['LGDStateCode','StateName'])->distinct()->orderBy('StateName','ASC')->findAll(); 
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
        
        $locateDetails = [];
        $districts = [];
        $blocks = [];
        $gps = [];
        $villages = [];
        $pager = $prpage = '';
    
        if($stateId != "") {
            $this->SBMMasterDirectoryModel->where('LGDStateCode', $stateId);
            $districts = $this->SBMMasterDirectoryModels->select(['LGDDistrictCode','DistrictName'])->distinct()->where('LGDStateCode', $stateId)->findAll();
            
            if(!empty($districtId)){
                $this->SBMMasterDirectoryModel->where('LGDDistrictCode', $districtId);
                $blocks = $this->SBMMasterDirectoryModels->select(['LGDBlockCode','BlockName'])->distinct()->where('LGDDistrictCode', $districtId)->findAll();
            }
            if(!empty($blockID)){
                $this->SBMMasterDirectoryModel->where('LGDBlockCode', $blockID);
                $gps = $this->SBMMasterDirectoryModels->select(['LGDGramPanchayatCode','GrampanchayatName'])->distinct()->where('LGDBlockCode', $blockID)->findAll();
            }
            if(!empty($gpID)){
                $this->SBMMasterDirectoryModel->where('LGDGramPanchayatCode', $gpID);
                $villages = $this->SBMMasterDirectoryModels->select(['LGDVillageCode','VillageName'])->distinct()->where('LGDGramPanchayatCode', $gpID)->findAll();
            }
            if(!empty($villageID)){
                $this->SBMMasterDirectoryModel->where('LGDVillageCode', $villageID);
            }
            
            $locateDetails = $this->SBMMasterDirectoryModel->paginate($this->per_page);
            $pager = $this->SBMMasterDirectoryModel->pager;
            $prpage = $this->SBMMasterDirectoryModel->per_page;
        }
        
        $data['pager'] = $pager;
        $data['per_page'] = $prpage;
        $data['locateDetails'] = $locateDetails;
        $data['districts'] = $districts;
        $data['blocks'] = $blocks;
        $data['gps'] = $gps;
        $data['villages'] = $villages;
        return view('sbm-master-directory', $data);
    }

    // Sync SBM Master Directory Data via API Section Start
    public function upsertSBMMasterDirectoryData()
    {
        $stateId = $this->request->getVar('state'); //get the state parameter
        // Fetch JSON data from the API
        $apiURL = env('API_URL');
        $stateCode = ($stateId != null) ? $stateId : -1; // -1 means for all states.
        $json_data = $this->fetchJsonDataFromAPI($apiURL, $stateCode);

        $batch_size = 1000;
        $anyDataUpserted = false;
        // Batch insert JSON data into MySQL
        for ($i = 0; $i < count($json_data); $i += $batch_size) {
            $batch = array_slice($json_data, $i, $batch_size);
            $result =  $this->SBMMasterDirectoryModel->updateOrInsertBatch($batch);
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

    // Function for API calls
    private function fetchJsonDataFromAPI($url, $stateCode)
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

    public function upsertStatesUsingLGDCode()
    {
         // Fetch data from "sbm_master_directory" table
        $stateData = $this->SBMMasterDirectoryModel->select(['LGDStateCode','StateName'])->groupBy('LGDStateCode')->get()->getResultArray();
        echo $this->SBMMasterDirectoryModel->getLastQuery();
        echo '<pre>';
        print_r($stateData);
        die;

        $batch_size = 1000;
        $anyDataUpserted = false;
        // Batch insert JSON data into MySQL
        for ($i = 0; $i < count($stateData); $i += $batch_size) {
            $batch = array_slice($stateData, $i, $batch_size);
            $result =  $this->updateOrInsertStateData($batch);
            if ($result) {
                $anyDataUpserted = true;
            }
        }

        if (!$anyDataUpserted) {
            return $this->respond("No data upserted", 200);
        } else {
            return $this->respond("State data successfully upserted!", 200);
        }
       
    }

    public function upsertDistrictsUsingLGDCode()
    {
         // Fetch data from "sbm_master_directory" table
        $districtData = $this->SBMMasterDirectoryModel->select(['LGDStateCode','LGDDistrictCode','DistrictName'])->groupBy('LGDDistrictCode')->get()->getResultArray();
        //echo $this->SBMMasterDirectoryModel->getLastQuery();
       
        $batch_size = 1000;
        $anyDataUpserted = false;
        // Batch insert JSON data into MySQL
        for ($i = 0; $i < count($districtData); $i += $batch_size) {
            $batch = array_slice($districtData, $i, $batch_size);
            $result =  $this->updateOrInsertDistrictData($batch);
            if ($result) {
                $anyDataUpserted = true;
            }
        }

        if (!$anyDataUpserted) {
            return $this->respond("No data upserted", 200);
        } else {
            return $this->respond("District data successfully upserted!", 200);
        }
    }

    public function upsertBlocksUsingLGDCode()
    {
        // Fetch data from "sbm_master_directory" table
        $blockData = $this->SBMMasterDirectoryModel->select(['LGDStateCode','LGDDistrictCode','LGDBlockCode','BlockName'])->groupBy('LGDBlockCode')->get()->getResultArray();
        //echo $this->SBMMasterDirectoryModel->getLastQuery();die;

        $batch_size = 1000;
        $anyDataUpserted = false;
        // Batch insert JSON data into MySQL
        for ($i = 0; $i < count($blockData); $i += $batch_size) {
            $batch = array_slice($blockData, $i, $batch_size);
            $result =  $this->updateOrInsertBlockData($batch);
            if ($result) {
                $anyDataUpserted = true;
            }
        }

        if (!$anyDataUpserted) {
            return $this->respond("No data upserted", 200);
        } else {
            return $this->respond("Block data successfully upserted!", 200);
        }
    }

    public function upsertGPUsingLGDCode()
    {
        // Fetch data from "sbm_master_directory" table
        $GPData = $this->SBMMasterDirectoryModel->select(['LGDStateCode','LGDDistrictCode','LGDBlockCode','LGDGramPanchayatCode','GrampanchayatName'])->groupBy('LGDGramPanchayatCode')->get()->getResultArray();
        //echo $this->SBMMasterDirectoryModel->getLastQuery();die;

        $batch_size = 1000;
        $anyDataUpserted = false;
        // Batch insert JSON data into MySQL
        for ($i = 0; $i < count($GPData); $i += $batch_size) {
            $batch = array_slice($GPData, $i, $batch_size);
            $result =  $this->updateOrInsertGPData($batch);
            if ($result) {
                $anyDataUpserted = true;
            }
        }

        if (!$anyDataUpserted) {
            return $this->respond("No data upserted", 200);
        } else {
            return $this->respond("Gram panchayat data successfully upserted!", 200);
        }
    }

    public function upsertVillagesUsingLGDCode()
    {

        // $stateId = $this->request->getVar('state'); //get the state parameter
        // // Fetch JSON data from the API
        // $apiURL = env('API_URL');
        // $stateCode = ($stateId != null) ? $stateId : -1; // -1 means for all states.
        // $json_data = $this->fetchJsonDataFromAPI($apiURL, $stateCode);

        // Fetch all data from "sbm_master_directory" table
        $SBMVillageData = $this->SBMMasterDirectoryModel->select(['LGDStateCode','StateName','LGDDistrictCode','DistrictName','LGDBlockCode','BlockName','LGDGramPanchayatCode','GrampanchayatName','LGDVillageCode','VillageName'])->findAll();

        $batch_size = 1000;
        $anyDataUpserted = false;
        // Batch insert JSON data into MySQL
        for ($i = 0; $i < count($SBMVillageData); $i += $batch_size) {
            $batch = array_slice($SBMVillageData, $i, $batch_size);
            $result =  $this->updateOrInsertVillageData($batch);
            if ($result) {
                $anyDataUpserted = true;
            }
        }

        if (!$anyDataUpserted) {
            return $this->respond("No data upserted", 200);
        } else {
            return $this->respond("Village data successfully upserted!", 200);
        }
    }


    //---------------------- Private Methods for upsert data section start --------------------------------

    // private function updateOrInsertStateData($data)
    // {
    //     if (!$this->db->transStatus()) {
    //         // Roll back the transaction if it's in progress
    //         $this->db->transRollback();
    //     }else{
    //      // Start a transaction to ensure data integrity
    //      $this->db->transStart();

    //     // Retrieve existing id values from the database
    //     $existingIds = $this->gpModel->select('district_code')->whereIn('district_code', array_column($data, 'LGDDistrictCode'))->get()->getResultArray();
    //     //echo $this->gpModel->getLastQuery();die;

    //     // Prepare data for batch update and insert
    //     $updateData = [];
    //     $insertData = [];

    //     foreach ($data as $row) {
    //         // Check if 'id' exists in the existingIds array
    //         $idExists = false;
            
    //         foreach ($existingIds as $existingId) {
    //             if ($row['LGDDistrictCode'] == $existingId['district_code']) {
    //                 $idExists = true;
    //                 break;
    //             }
    //         }

    //         if ($idExists) {
    //             // If 'id' exists, add to update data
    //             $preparedUpdateData = array(
    //                 'state_code' => $row['LGDStateCode'],
    //                 'district_code' => $row['LGDDistrictCode'],
    //                 'district_name' => $row['DistrictName'],
    //                 'map_code' => $row['LGDDistrictCode']
    //             );
               
    //             $updateData[] = $preparedUpdateData;
    //             //  echo '<pre>';
    //             //  echo 'update data';
    //             //  print_r($updateData);
    //         } else {
    //             // If 'id' does not exist, add to insert data
    //             $preparedInserteData = array(
    //                 'state_code' => $row['LGDStateCode'],
    //                 'district_code' => $row['LGDDistrictCode'],
    //                 'district_name' => $row['DistrictName'],
    //                 'map_code' => $row['LGDDistrictCode']
    //             );
                
    //             $insertData[] = $preparedInserteData;
    //             // echo '<pre>';
    //             // echo '------------- insert data';
    //             // print_r($insertData);
    //         }
    //     }
    //     //die;
    //     // Perform batch update if there are records to update
    //     if (!empty($updateData)) {
    //         $this->villageModel->updateBatch($updateData, 'village_code');
    //         echo $this->villageModel->getLastQuery();
    //     }

    //     // Perform batch insert if there are records to insert
    //     if (!empty($insertData)) {
    //         $this->villageModel->insertBatch($insertData);
    //         echo $this->db->getLastQuery();
    //     }

    //     // Commit the transaction
    //     $this->db->transComplete();

    //     // Return true if transaction was successful, false otherwise
    //     return $this->db->transStatus();
    //     }
    // }

    private function updateOrInsertStateData($data)
    {
        if (!$this->db->transStatus()) {
            // Roll back the transaction if it's in progress
            $this->db->transRollback();
        } else {
            // Start a transaction to ensure data integrity
            $this->db->transStart();

            // Retrieve existing records from the database
            $existingRecords = $this->stateModel->select('*')
                ->whereIn('state_code', array_column($data, 'LGDStateCode'))
                ->get()
                ->getResultArray();

            // Create a map of existing records for quick lookup
            $existingRecordsMap = [];
            foreach ($existingRecords as $record) {
                $existingRecordsMap[$record['state_code']] = $record;
            }

            // Prepare data for batch update and insert
            $updateData = [];
            $insertData = [];

            foreach ($data as $row) {
                $stateCode = $row['LGDStateCode'];

                if (isset($existingRecordsMap[$stateCode])) {
                    // Check if there are differences between existing data and new data
                    $existingRecord = $existingRecordsMap[$stateCode];
                    $newRecord = [
                        'state_code' => $stateCode,
                        'district_code' => $row['LGDDistrictCode'],
                        'district_name' => $row['DistrictName'],
                        'map_code' => $row['LGDDistrictCode']
                    ];

                    if (array_diff_assoc($newRecord, $existingRecord)) {
                        // If there are differences, add to update data
                        $updateData[] = $newRecord;
                    }
                } else {
                    // If 'state_code' does not exist, add to insert data
                    $insertData[] = [
                        'state_code' => $stateCode,
                        'district_code' => $row['LGDDistrictCode'],
                        'district_name' => $row['DistrictName'],
                        'map_code' => $row['LGDDistrictCode']
                    ];
                }
            }

            // Perform batch update if there are records to update
            if (!empty($updateData)) {
                $this->stateModel->updateBatch($updateData, 'state_code');
            }

            // Perform batch insert if there are records to insert
            if (!empty($insertData)) {
                $this->stateModel->insertBatch($insertData);
            }

            // Commit the transaction
            $this->db->transComplete();

            // Return true if transaction was successful, false otherwise
            return $this->db->transStatus();
        }
    }

    // private function updateOrInsertDistrictData($data)
    // {
    //     if (!$this->db->transStatus()) {
    //         // Roll back the transaction if it's in progress
    //         $this->db->transRollback();
    //     }else{
    //      // Start a transaction to ensure data integrity
    //      $this->db->transStart();

    //     // Retrieve existing id values from the database
    //     $existingIds = $this->districtModel->select('district_code')->whereIn('district_code', array_column($data, 'LGDDistrictCode'))->get()->getResultArray();
    //     //echo $this->districtModel->getLastQuery();die;

    //     // Prepare data for batch update and insert
    //     $updateData = [];
    //     $insertData = [];

    //     foreach ($data as $row) {
    //         // Check if 'id' exists in the existingIds array
    //         $idExists = false;
            
    //         foreach ($existingIds as $existingId) {
    //             if ($row['LGDDistrictCode'] == $existingId['district_code']) {
    //                 $idExists = true;
    //                 break;
    //             }
    //         }

    //         if ($idExists) {
    //             // If 'id' exists, add to update data
    //             $preparedUpdateData = array(
    //                 'state_code' => $row['LGDStateCode'],
    //                 'district_code' => $row['LGDDistrictCode'],
    //                 'district_name' => $row['DistrictName'],
    //                 'map_code' => $row['LGDDistrictCode']
    //             );

    //             $updateData[] = $preparedUpdateData;
            
    //         } else {
    //             // If 'id' does not exist, add to insert data
    //             $preparedInserteData = array(
    //                 'state_code' => $row['LGDStateCode'],
    //                 'district_code' => $row['LGDDistrictCode'],
    //                 'district_name' => $row['DistrictName'],
    //                 'map_code' => $row['LGDDistrictCode']
    //             );
                
    //             $insertData[] = $preparedInserteData;
    //         }
    //     }

    //     // Perform batch update if there are records to update
    //     if (!empty($updateData)) {
    //         $this->districtModel->updateBatch($updateData, 'district_code');
    //     }

    //     // Perform batch insert if there are records to insert
    //     if (!empty($insertData)) {
    //         $this->districtModel->insertBatch($insertData);
    //     }

    //     // Commit the transaction
    //     $this->db->transComplete();

    //     // Return true if transaction was successful, false otherwise
    //     return $this->db->transStatus();
    //     }
    // }

    private function updateOrInsertDistrictData($data)
    {
        if (!$this->db->transStatus()) {
            // Roll back the transaction if it's in progress
            $this->db->transRollback();
        } else {
            // Start a transaction to ensure data integrity
            $this->db->transStart();

            // Retrieve existing records from the database
            $existingRecords = $this->districtModel->select('*')
                ->whereIn('district_code', array_column($data, 'LGDDistrictCode'))
                ->get()
                ->getResultArray();

            // Create a map of existing records for quick lookup
            $existingRecordsMap = [];
            foreach ($existingRecords as $record) {
                $existingRecordsMap[$record['district_code']] = $record;
            }

            // Prepare data for batch update and insert
            $updateData = [];
            $insertData = [];

            foreach ($data as $row) {
                $districtCode = $row['LGDDistrictCode'];

                if (isset($existingRecordsMap[$districtCode])) {
                    // Check if there are differences between existing data and new data
                    $existingRecord = $existingRecordsMap[$districtCode];
                    $newRecord = [
                        'state_code' => $row['LGDStateCode'],
                        'district_code' => $districtCode,
                        'district_name' => $row['DistrictName'],
                        'map_code' => $districtCode
                    ];

                    if (array_diff_assoc($newRecord, $existingRecord)) {
                        // If there are differences, add to update data
                        $updateData[] = $newRecord;
                    }
                } else {
                    // If 'district_code' does not exist, add to insert data
                    $insertData[] = [
                        'state_code' => $row['LGDStateCode'],
                        'district_code' => $districtCode,
                        'district_name' => $row['DistrictName'],
                        'map_code' => $districtCode
                    ];
                }
            }

            // Perform batch update if there are records to update
            if (!empty($updateData)) {
                $this->districtModel->updateBatch($updateData, 'district_code');
            }

            // Perform batch insert if there are records to insert
            if (!empty($insertData)) {
                $this->districtModel->insertBatch($insertData);
            }

            // Commit the transaction
            $this->db->transComplete();

            // Return true if transaction was successful, false otherwise
            return $this->db->transStatus();
        }
    }

    // private function updateOrInsertBlockData($data)
    // {
    //     if (!$this->db->transStatus()) {
    //         // Roll back the transaction if it's in progress
    //         $this->db->transRollback();
    //     }else{
    //      // Start a transaction to ensure data integrity
    //      $this->db->transStart();

    //     // Retrieve existing id values from the database
    //     $existingIds = $this->blockModel->select('block_code')->whereIn('block_code', array_column($data, 'LGDBlockCode'))->get()->getResultArray();

    //     // Prepare data for batch update and insert
    //     $updateData = [];
    //     $insertData = [];

    //     foreach ($data as $row) {
    //         // Check if 'id' exists in the existingIds array
    //         $idExists = false;
    //         foreach ($existingIds as $existingId) {
    //             if ($row['LGDBlockCode'] == $existingId['block_code']) {
    //                 $idExists = true;
    //                 break;
    //             }
    //         }

    //         if ($idExists) {
    //             // If 'id' exists, add to update data
    //             $preparedUpdateData = array(
    //                 'state_code' => $row['LGDStateCode'],
    //                 'district_code' => $row['LGDDistrictCode'],
    //                 'block_code' => $row['LGDBlockCode'],
    //                 'block_name' => $row['BlockName'],
    //                 'map_code' => $row['LGDBlockCode']
    //             );
               
    //             $updateData[] = $preparedUpdateData;
    //         } else {
    //             // If 'id' does not exist, add to insert data
    //             $preparedInserteData = array(
    //                 'state_code' => $row['LGDStateCode'],
    //                 'district_code' => $row['LGDDistrictCode'],
    //                 'block_code' => $row['LGDBlockCode'],
    //                 'block_name' => $row['BlockName'],
    //                 'map_code' => $row['LGDBlockCode']
    //             );
                
    //             $insertData[] = $preparedInserteData;
    //         }
    //     }
    //     // Perform batch update if there are records to update
    //     if (!empty($updateData)) {
    //         $this->blockModel->updateBatch($updateData, 'block_code');
    //     }

    //     // Perform batch insert if there are records to insert
    //     if (!empty($insertData)) {
    //         $this->blockModel->insertBatch($insertData);
    //     }

    //     // Commit the transaction
    //     $this->db->transComplete();

    //     // Return true if transaction was successful, false otherwise
    //     return $this->db->transStatus();
    //     }
    // }

    private function updateOrInsertBlockData($data)
    {
        if (!$this->db->transStatus()) {
            // Roll back the transaction if it's in progress
            $this->db->transRollback();
        } else {
            // Start a transaction to ensure data integrity
            $this->db->transStart();

            // Retrieve existing records from the database
            $existingRecords = $this->blockModel->select('*')
                ->whereIn('block_code', array_column($data, 'LGDBlockCode'))
                ->get()
                ->getResultArray();

            // Create a map of existing records for quick lookup
            $existingRecordsMap = [];
            foreach ($existingRecords as $record) {
                $existingRecordsMap[$record['block_code']] = $record;
            }

            // Prepare data for batch update and insert
            $updateData = [];
            $insertData = [];

            foreach ($data as $row) {
                $blockCode = $row['LGDBlockCode'];

                if (isset($existingRecordsMap[$blockCode])) {
                    // Check if there are differences between existing data and new data
                    $existingRecord = $existingRecordsMap[$blockCode];
                    $newRecord = [
                        'state_code' => $row['LGDStateCode'],
                        'district_code' => $row['LGDDistrictCode'],
                        'block_code' => $blockCode,
                        'block_name' => $row['BlockName'],
                        'map_code' => $blockCode
                    ];

                    if (array_diff_assoc($newRecord, $existingRecord)) {
                        // If there are differences, add to update data
                        $updateData[] = $newRecord;
                    }
                } else {
                    // If 'block_code' does not exist, add to insert data
                    $insertData[] = [
                        'state_code' => $row['LGDStateCode'],
                        'district_code' => $row['LGDDistrictCode'],
                        'block_code' => $blockCode,
                        'block_name' => $row['BlockName'],
                        'map_code' => $blockCode
                    ];
                }
            }

            // Perform batch update if there are records to update
            if (!empty($updateData)) {
                $this->blockModel->updateBatch($updateData, 'block_code');
            }

            // Perform batch insert if there are records to insert
            if (!empty($insertData)) {
                $this->blockModel->insertBatch($insertData);
            }

            // Commit the transaction
            $this->db->transComplete();

            // Return true if transaction was successful, false otherwise
            return $this->db->transStatus();
        }
    }


    // private function updateOrInsertGPData($data)
    // {
    //     if (!$this->db->transStatus()) {
    //         // Roll back the transaction if it's in progress
    //         $this->db->transRollback();
    //     }else{
    //      // Start a transaction to ensure data integrity
    //      $this->db->transStart();

    //     // Retrieve existing id values from the database
    //     $existingIds = $this->gpModel->select('gp_code')->whereIn('gp_code', array_column($data, 'LGDGramPanchayatCode'))->get()->getResultArray();
    //     //echo $this->gpModel->getLastQuery();die;

    //     // Prepare data for batch update and insert
    //     $updateData = [];
    //     $insertData = [];

    //     foreach ($data as $row) {
    //         // Check if 'id' exists in the existingIds array
    //         $idExists = false;
            
    //         foreach ($existingIds as $existingId) {
    //             if ($row['LGDGramPanchayatCode'] == $existingId['gp_code']) {
    //                 $idExists = true;
    //                 break;
    //             }
    //         }

    //         if ($idExists) {
    //             // If 'id' exists, add to update data
    //             $preparedUpdateData = array(
    //                 'state_code' => $row['LGDStateCode'],
    //                 'district_code' => $row['LGDDistrictCode'],
    //                 'block_code' => $row['LGDBlockCode'],
    //                 'gp_code' => $row['LGDGramPanchayatCode'],
    //                 'gp_name' => $row['GrampanchayatName'],
    //                 'map_code' => $row['LGDGramPanchayatCode']
    //             );
               
    //             $updateData[] = $preparedUpdateData;
    //             //  echo '<pre>';
    //             // echo "update into";
    //             // print_r($updateData);
    //         } else {
    //             // If 'id' does not exist, add to insert data
    //             $preparedInserteData = array(
    //                 'state_code' => $row['LGDStateCode'],
    //                 'district_code' => $row['LGDDistrictCode'],
    //                 'block_code' => $row['LGDBlockCode'],
    //                 'gp_code' => $row['LGDGramPanchayatCode'],
    //                 'gp_name' => $row['GrampanchayatName'],
    //                 'map_code' => $row['LGDGramPanchayatCode']
    //             );
                
    //             $insertData[] = $preparedInserteData;
    //             // echo '<pre>';
    //             // echo "insert into";
    //             // print_r($insertData);
                
    //         }
    //     }
    //     //die;
    //     // Perform batch update if there are records to update
    //     if (!empty($updateData)) {
    //         $this->gpModel->updateBatch($updateData, 'gp_code');
    //         //echo $this->gpModel->getLastQuery();
    //     }

    //     // Perform batch insert if there are records to insert
    //     if (!empty($insertData)) {
    //         $this->gpModel->insertBatch($insertData);
    //         //echo $this->gpModel->getLastQuery();
    //     }

    //     // Commit the transaction
    //     $this->db->transComplete();

    //     // Return true if transaction was successful, false otherwise
    //     return $this->db->transStatus();
    //     }
    // }

    private function updateOrInsertGPData($data)
    {
        if (!$this->db->transStatus()) {
            // Roll back the transaction if it's in progress
            $this->db->transRollback();
        } else {
            // Start a transaction to ensure data integrity
            $this->db->transStart();

            // Retrieve existing records from the database
            $existingRecords = $this->gpModel->select('*')
                ->whereIn('gp_code', array_column($data, 'LGDGramPanchayatCode'))
                ->get()
                ->getResultArray();

            // Create a map of existing records for quick lookup
            $existingRecordsMap = [];
            foreach ($existingRecords as $record) {
                $existingRecordsMap[$record['gp_code']] = $record;
            }

            // Prepare data for batch update and insert
            $updateData = [];
            $insertData = [];

            foreach ($data as $row) {
                $gpCode = $row['LGDGramPanchayatCode'];

                if (isset($existingRecordsMap[$gpCode])) {
                    // Check if there are differences between existing data and new data
                    $existingRecord = $existingRecordsMap[$gpCode];
                    $newRecord = [
                        'state_code' => $row['LGDStateCode'],
                        'district_code' => $row['LGDDistrictCode'],
                        'block_code' => $row['LGDBlockCode'],
                        'gp_code' => $gpCode,
                        'gp_name' => $row['GrampanchayatName'],
                        'map_code' => $gpCode
                    ];

                    if (array_diff_assoc($newRecord, $existingRecord)) {
                        // If there are differences, add to update data
                        $updateData[] = $newRecord;
                    }
                } else {
                    // If 'gp_code' does not exist, add to insert data
                    $insertData[] = [
                        'state_code' => $row['LGDStateCode'],
                        'district_code' => $row['LGDDistrictCode'],
                        'block_code' => $row['LGDBlockCode'],
                        'gp_code' => $gpCode,
                        'gp_name' => $row['GrampanchayatName'],
                        'map_code' => $gpCode
                    ];
                }
            }

            // Perform batch update if there are records to update
            if (!empty($updateData)) {
                //  echo '<pre>';
                //  echo "Update Data:\n";
                //  print_r($updateData);
                $this->gpModel->updateBatch($updateData, 'gp_code');
            }

            // Perform batch insert if there are records to insert
            if (!empty($insertData)) {
                  $this->gpModel->insertBatch($insertData);
                  //echo $this->gpModel->getLastQuery();
            }
           // die;
            // Commit the transaction
            $this->db->transComplete();

            // Return true if transaction was successful, false otherwise
            return $this->db->transStatus();
        }
    }


    // private function updateOrInsertVillageData($data)
    // {
    //     if (!$this->db->transStatus()) {
    //         // Roll back the transaction if it's in progress
    //         $this->db->transRollback();
    //     }else{
    //      // Start a transaction to ensure data integrity
    //      $this->db->transStart();

    //     // Retrieve existing id values from the database
    //     $existingIds = $this->villageModel->select('village_code')->whereIn('village_code', array_column($data, 'LGDVillageCode'))->get()->getResultArray();
    //     //echo $this->villageModel->getLastQuery();die;

    //     // Prepare data for batch update and insert
    //     $updateData = [];
    //     $insertData = [];

    //     foreach ($data as $row) {
    //         // Check if 'id' exists in the existingIds array
    //         $idExists = false;
            
    //         foreach ($existingIds as $existingId) {
    //             if ($row['LGDVillageCode'] == $existingId['village_code']) {
    //                 $idExists = true;
    //                 break;
    //             }
    //         }

    //         if ($idExists) {
    //             // If 'id' exists, add to update data
    //             $preparedUpdateData = array(
    //                 'state_code' => $row['LGDStateCode'],
    //                 'district_code' => $row['LGDDistrictCode'],
    //                 'block_code' => $row['LGDBlockCode'],
    //                 'gp_code' => $row['LGDGramPanchayatCode'],
    //                 'village_code' => $row['LGDVillageCode'],
    //                 'village_name' => $row['VillageName'],
    //                 'map_code' => $row['LGDVillageCode']
    //             );
               
    //             $updateData[] = $preparedUpdateData;
    //         } else {
    //             // If 'id' does not exist, add to insert data
    //             $preparedInserteData = array(
    //                 'state_code' => $row['LGDStateCode'],
    //                 'district_code' => $row['LGDDistrictCode'],
    //                 'block_code' => $row['LGDBlockCode'],
    //                 'gp_code' => $row['LGDGramPanchayatCode'],
    //                 'village_code' => $row['LGDVillageCode'],
    //                 'village_name' => $row['VillageName'],
    //                 'map_code' => $row['LGDVillageCode']
    //             );
                
    //             $insertData[] = $preparedInserteData;
    //         }
    //     }
    //     // Perform batch update if there are records to update
    //     if (!empty($updateData)) {
    //         $this->villageModel->updateBatch($updateData, 'village_code');
    //     }

    //     // Perform batch insert if there are records to insert
    //     if (!empty($insertData)) {
    //         $this->villageModel->insertBatch($insertData);
    //     }

    //     // Commit the transaction
    //     $this->db->transComplete();

    //     // Return true if transaction was successful, false otherwise
    //     return $this->db->transStatus();
    //     }
    // }

    private function updateOrInsertVillageData($data)
    {
       
            // Retrieve existing records from the database
            $existingRecords = $this->villageModel->select('*')
                ->whereIn('village_code', array_column($data, 'LGDVillageCode'))
                ->get()
                ->getResultArray();

            // Create a map of existing records for quick lookup
            $existingRecordsMap = [];
            foreach ($existingRecords as $record) {
                $existingRecordsMap[$record['village_code']] = $record;
            }

            // Prepare data for batch update and insert
            $updateData = [];
            $insertData = [];

            foreach ($data as $row) {
                $villageCode = $row['LGDVillageCode'];

                if (isset($existingRecordsMap[$villageCode])) {
                    // Check if there are differences between existing data and new data
                    $existingRecord = $existingRecordsMap[$villageCode];
                    $newRecord = [
                        'state_code' => $row['LGDStateCode'],
                        'district_code' => $row['LGDDistrictCode'],
                        'block_code' => $row['LGDBlockCode'],
                        'gp_code' => $row['LGDGramPanchayatCode'],
                        'village_code' => $villageCode,
                        'village_name' => $row['VillageName'],
                        'map_code' => $villageCode
                    ];

                    if (array_diff_assoc($newRecord, $existingRecord)) {
                        // If there are differences, add to update data
                        $updateData[] = $newRecord;
                    }
                } else {
                    // If 'village_code' does not exist, add to insert data
                    $insertData[] = [
                        'state_code' => $row['LGDStateCode'],
                        'district_code' => $row['LGDDistrictCode'],
                        'block_code' => $row['LGDBlockCode'],
                        'gp_code' => $row['LGDGramPanchayatCode'],
                        'village_code' => $villageCode,
                        'village_name' => $row['VillageName'],
                        'map_code' => $villageCode
                    ];
                }
            }

            echo '<pre>';
            echo 'update';
            print_r($updateData);
            echo 'insert data';
            print_r($insertData);

            // Check if there are any updates or inserts to be made
            if (empty($updateData) && empty($insertData)) {
                echo "failed to update";
                // No updates or inserts, no need to start a transaction
                return 'No updates or inserts were necessary';
            } die;
            // Start a transaction to ensure data integrity
            $this->db->transStart();
            // Perform batch update if there are records to update
            if (!empty($updateData)) {
                $this->villageModel->updateBatch($updateData, 'village_code');
                echo $this->villageModel->getLastQuery();
            }

            // Perform batch insert if there are records to insert
            if (!empty($insertData)) {
                $this->villageModel->insertBatch($insertData);
                echo $this->villageModel->getLastQuery();
            }

             // Commit the transaction
            $this->db->transComplete();

            // Return true if transaction was successful, false otherwise
            return $this->db->transStatus();
           
        
    }
    //---------------------- Private Methods for upsert data section end --------------------------------


   
    public function getDistricts()
    {
        $scode = $this->request->getVar('scode');
        $districts = $this->SBMMasterDirectoryModel->select(['LGDDistrictCode','DistrictName'])->distinct()->where('LGDStateCode', $scode)->orderBy('DistrictName', 'ASC')->findAll();
        echo '<option value="">Select District </option>';
        foreach ($districts as $district) {
            $DistrictName = $district['DistrictName'];
            $id = $district['LGDDistrictCode'];
            echo '<option value="' . $id . '">' . $DistrictName . '</option>';
        }
    }

    public function getBlocks()
    {
        $dcode = $this->request->getVar('dcode');
        $blocks = $this->SBMMasterDirectoryModel->select(['LGDBlockCode','BlockName'])->distinct()->where('LGDDistrictCode', $dcode)->where('LGDBlockCode!=0')->orderBy('BlockName', 'ASC')->findAll();
        echo '<option value="">Select Block </option>';
        foreach ($blocks as $block) {
            $BlockName = $block['BlockName'];
            $id = $block['LGDBlockCode'];
            echo '<option value="' . $id . '">' . $BlockName . '</option>';
        }
    }

    public function getGPs()
    {
        $bcode = $this->request->getVar('bcode');
        $gps = $this->SBMMasterDirectoryModel->select(['LGDGramPanchayatCode','GrampanchayatName'])->distinct()->where('LGDBlockCode', $bcode)->where('LGDGramPanchayatCode!=0')->orderBy('GrampanchayatName', 'ASC')->findAll();
        echo '<option value="">Select GP </option>';
        foreach ($gps as $gp) {
            $GrampanchayatName = $gp['GrampanchayatName'];
            $id = $gp['LGDGramPanchayatCode'];
            echo '<option value="' . $id . '">' . $GrampanchayatName . '</option>';
        }
    }

    public function getVillages()
    {
        $gcode = $this->request->getVar('gcode');
        $villages = $this->SBMMasterDirectoryModel->select(['LGDVillageCode','VillageName'])->distinct()->where('LGDGramPanchayatCode', $gcode)->where('LGDVillageCode!=0')->orderBy('VillageName', 'ASC')->findAll();
        echo '<option value="">Select village </option>';
        foreach($villages as $village){
            $VillageName = $village['VillageName'];
            $id = $village['LGDVillageCode'];
            echo '<option value="'.$id.'">'.$VillageName.'</option>';
        }
    }
}    