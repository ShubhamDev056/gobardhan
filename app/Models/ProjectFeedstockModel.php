<?php 
namespace App\Models;
use CodeIgniter\Model;

class ProjectFeedstockModel extends Model{
    protected $table      = 'source_type_feedstocks';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['option_list_id', 'project_id', 'organization_id','quantity','qty_unit','feedstock_source','source_type','others_category','others_fedstock_source'];

}