<?php

namespace App\Models;

use CodeIgniter\Model;

class OrganizationModel extends Model
{
    protected $table      = 'organizations';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['entity_name', 'entity_type', 'entity_subtype', 'ulb_code', 'entity_subtype_other', 'authorised_person', 'mobile_no', 'email', 'address', 'state_id', 'district_id', 'pincode', 'cin_reg_no', 'reg_date', 'pan_no', 'gst_no', 'company_reg_letter', 'ard_name', 'ard_designation', 'ard_contact_no', 'ard_email', 'ard_authorization_letter','user_id', 'status', 'created_at'];
}