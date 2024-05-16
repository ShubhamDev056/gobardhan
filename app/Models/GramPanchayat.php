<?php 
namespace App\Models;
use CodeIgniter\Model;

class GramPanchayat extends Model{
    protected $table      = 'gram_panchayat';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['state_code', 'district_code','block_code','gp_code','gp_name','map_code','status'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}