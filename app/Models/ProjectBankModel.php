<?php 
namespace App\Models;
use CodeIgniter\Model;

class ProjectBankModel extends Model{
    protected $table      = 'project_bank_details';
    protected $primaryKey = 'project_bank_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['project_id', 'bankloan_applied','availed_from', 'ifsc_code', 'bank_name', 'bank_state', 'bank_district', 'bank_city', 'bank_branch', 'loan_account_id', 'branch_contact','sanctioned_date','sanctioned_doc','reject_date','bank_reason', 'loan_ammount','sanctioned_amount', 'document_submitted', 'loan_apply_date', 'loan_status', 'remarks', 'status','reason','bank_remarks','updated_by', 'created_at'];

}