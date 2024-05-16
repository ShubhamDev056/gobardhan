<?php 
namespace App\Models;
use CodeIgniter\Model;

class ChangeStatusModel extends Model{
    protected $table      = 'change_status_log';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['project_id', 'status_id', 'updated_by', 'created_at'];

}