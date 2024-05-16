<?php 
namespace App\Models;
use CodeIgniter\Model;

class ProjectModel extends Model{
    protected $table      = 'project_details';
    protected $primaryKey = 'project_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['ministry','munique_id','project_registration_no', 'organization_id','project_name','entity_type_id','plant_type_id','plant_status_id','plant_status_date','gas_production_capacity','gpc_unit','solid_feedstock_capacity','sfc_unit','liquid_feedstock_capacity','lfc_unit','bio_slurry_output','bso_unit','FOM_output','FOM_unit','LFOM_output','LFOM_unit','total_solid_feedstock','tsfs_unit','total_liquid_feedstock','tlfs_unit','loi_detail_id','distance_grid','loi_obtain_details','bioslurry_tech','bioslurry_tech_other','plant_location_id','plant_area','land_ownership_id','other_ownership','latitude','longitude','total_capex','date_of_commissioning','proposed_date','construction_date','state_id','district_id','block_id','gp_id','village_id','city','ward_no','pincode','street_area_address','plot_number','user_id','form_completion','project_status','created_at'];

}