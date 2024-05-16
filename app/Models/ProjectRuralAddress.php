<?php 
namespace App\Models;
use CodeIgniter\Model;

class ProjectRuralAddress extends Model{
    protected $table      = 'project_rural_address';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['state_id', 'district_id', 'block_id', 'gp_id','village_id','pincode','organization_id','project_id'];

}