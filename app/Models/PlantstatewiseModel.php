<?php 
namespace App\Models;
use CodeIgniter\Model;

class PlantstatewiseModel extends Model{
    protected $table      = 'plant_state_wise';
    protected $primaryKey = 'map_data_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['state_id', 'ddws','mnre','mpng','status','created_on'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}