<?php 
namespace App\Models;
use CodeIgniter\Model;

class BankModel extends Model{
    protected $table      = 'banks';
    protected $primaryKey = 'bank_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['bank_name', 'status'];

}