<?php 
namespace App\Models;
use CodeIgniter\Model;

class LoginLog extends Model{
    protected $table      = 'login_log';
    protected $primaryKey = 'login_log_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['user_id', 'ip_address','login_time'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}