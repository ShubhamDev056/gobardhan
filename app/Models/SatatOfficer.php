<?php 
namespace App\Models;
use CodeIgniter\Model;

class SatatOfficer extends Model{
    protected $table      = 'satat_nodal_officer';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['state_name', 'ogmc','nodal_officer_name','designation','phone_number','email','status'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}