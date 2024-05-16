<?php 
namespace App\Models;
use CodeIgniter\Model;

class MDAIssue extends Model{
    protected $table      = 'mda_issues';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['project_id', 'related_issues','ifms','other_ifms','mous','other_mou','pos_machines','other_pos','testingIssues','other_testing','remarks','added_by','dof_remarks','updated_by','status'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}