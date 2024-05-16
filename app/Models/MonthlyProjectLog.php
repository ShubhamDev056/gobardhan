<?php 
namespace App\Models;
use CodeIgniter\Model;

class MonthlyProjectLog extends Model{
    protected $table      = 'monthly_plants_log';
    protected $primaryKey = 'monthly_plants_log_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['StateCode', 'TotalBiogasPlantsTillDate','BiogasYettoStart','BiogasUnderConstruction','BiogasFunctional','BiogasCompleted','BiogasNonFunctional','BiogasDefunct','ddwsBiogasYettoStart','ddwsBiogasUnderConstruction','ddwsBiogasFunctional','ddwsBiogasCompleted','ddwsBiogasNonFunctional','ddwsBiogasDefunct','TotalCBGPlantsTillDate','CBGYettoStart','CBGPUnderConstruction','CBGFunctional','CBGCompleted','CBGNonFunctional','CBGDefunct','reporting_month','created_at'];

}