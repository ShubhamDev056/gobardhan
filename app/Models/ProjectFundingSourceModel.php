<?php 
namespace App\Models;
use CodeIgniter\Model;

class ProjectFundingSourceModel extends Model{
    protected $table      = 'project_funding_source';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['option_list_id', 'quantity','project_id','organization_id','other_specify'];

}