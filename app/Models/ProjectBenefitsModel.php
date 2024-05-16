<?php 
namespace App\Models;
use CodeIgniter\Model;

class ProjectBenefitsModel extends Model{
    protected $table      = 'project_benefits';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['option_list_id', 'status','project_id','organization_id','other'];

}