<?php 
namespace App\Models;
use CodeIgniter\Model;

class MonthlyReportingModel extends Model{
    protected $table      = 'project_monthly_monitoring';
    protected $primaryKey = 'monthly_monitoring_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['project_id','state_id','district_id', 'current_status', 'pre_status','reporting_date','functionality_date','functional_amount','functional_source','reporting_month','nofunctional_days','feedstock','biogas_generation','bioslurry_generation','defunct_date','reason','other_reason','user_id','fuctional_doc','verify_doc','status','plant_type','fom','lfom','created_at','updated_at'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}