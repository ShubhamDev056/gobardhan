<?php 
namespace App\Models;
use CodeIgniter\Model;

class OfftakeIssue extends Model{
    protected $table      = 'offtake_issues';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['project_id','satat_scheme', 'ogmc','gail','prod_capacity','com_agre_signed','com_agre_signed_cbg_cdg','avg_actual_prod','actual_offtake','cbg_supplied_sync','other_sale','internal_consumption','flaring_wastage','remarks','added_by','cbg_ogmc_remarks','gail_remarks','updated_by','status'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}