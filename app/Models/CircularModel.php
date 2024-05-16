<?php 
namespace App\Models;
use CodeIgniter\Model;

class CircularModel extends Model{
    protected $table      = 'important_circulars';
    protected $primaryKey = 'important_circular_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['title', 'file_path', 'sequence','ministry_id','circular_date','created_at','status','message','grievance_doc','status'];

}