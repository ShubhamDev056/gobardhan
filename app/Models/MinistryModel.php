<?php 
namespace App\Models;
use CodeIgniter\Model;

class MinistryModel extends Model{
    protected $table      = 'ministry_data';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['ministry', 'system_id','unique_id','org_name','org_state_code','org_district_code','project_name','contact_person_name','contact_number','email','mail_status','mail_on','json_data'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}