<?php 
namespace App\Models;
use CodeIgniter\Model;

class ProjectLinkageModel extends Model{
    protected $table      = 'forward_linkages';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true; 

    protected $allowedFields = ['option_list_id', 'quantity','project_id','organization_id','linkage_type','other_specify'];

}