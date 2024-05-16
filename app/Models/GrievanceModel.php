<?php 
namespace App\Models;
use CodeIgniter\Model;

class GrievanceModel extends Model{
    protected $table      = 'grievances';
    protected $primaryKey = 'grievance_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'grievance_code', 'contact_no','email','ministry','message','grievance_doc','status'];

}