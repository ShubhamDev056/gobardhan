<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table      = 'users';
    protected $primaryKey = 'user_id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'contact_no','designation', 'email', 'username', 'password','password_version','role_id','reg_temp_no','reg_permanent_no','status','deleted_at'];
}