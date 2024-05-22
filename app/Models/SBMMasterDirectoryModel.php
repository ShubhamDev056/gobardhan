<?php

namespace App\Models;

use CodeIgniter\Model;

class SBMMasterDirectoryModel extends Model
{
    protected $table      = 'sbm_master_directory';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['BlockName', 'DistrictName', 'GrampanchayatName', 'LGDBlockCode', 'LGDDistrictCode', 'LGDGramPanchayatCode', 'LGDStateCode', 'LGDVillageCode', 'StateName', 'VillageName'];

     public function updateOrInsertBatch($data)
    {


        if (!$this->db->transStatus()) {
            // Roll back the transaction if it's in progress
            $this->db->transRollback();
        }else{
         // Start a transaction to ensure data integrity
         $this->db->transStart();

        // Retrieve existing id values from the database
        $existingIds = $this->builder()->select('LGDVillageCode')->whereIn('LGDVillageCode', array_column($data, 'LGDVillageCode'))->get()->getResultArray();

        // Prepare data for batch update and insert
        $updateData = [];
        $insertData = [];

        foreach ($data as $row) {
     
            // Check if 'id' exists in the existingIds array
            $idExists = false;
            
            foreach ($existingIds as $existingId) {
                if ($row['LGDVillageCode'] == $existingId['LGDVillageCode']) {
                    $idExists = true;
                    break;
                }
            }

            if ($idExists) {
                // If 'id' exists, add to update data
                $updateData[] = $row;
            } else {
                // If 'id' does not exist, add to insert data
                $insertData[] = $row;
            }
        }

        // Perform batch update if there are records to update
        if (!empty($updateData)) {
            $this->builder()->updateBatch($updateData, 'LGDVillageCode');
        }

        // Perform batch insert if there are records to insert
        if (!empty($insertData)) {
            $this->builder()->insertBatch($insertData);
            //echo $this->db->getLastQuery();
        }

        // Commit the transaction
        $this->db->transComplete();

        // Return true if transaction was successful, false otherwise
        return $this->db->transStatus();
        }
    }
}