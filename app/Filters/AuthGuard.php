<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $rolePermissions=[];
        $rolePermissions['admin']=['dashboard','loan-remarks-plants','plants-list','plant-list','project-edit','project-delete','circular','circular-delete','add-circular','p-details','applied-loan','all-reports','ministry-report','ddws-report','ddws-report-district','monthly-report-details','monthly-update-report','state-wise-monthly-report','monthly-update-report-cbg','state-wise-monthly-report-cbg','mda-issues','offtake-issues','duplicate-biogas','duplicate-cbg','project-details','change-password','profile'];
        $rolePermissions['state']=['state-dashboard','state-plant','ddws-report','monthly-report','monthly-update','','','','project-details','change-password','profile'];
        $rolePermissions['organization']=['monthly-cbg-report','monthly-update-cbg','update-profile','organization-edit','profile','add-project','project-details','project-edit','add-bank-details','add-mda-issue','add-offtake-issue','change-password','profile'];
        $rolePermissions['ministry']=['dashboard','plants-list','project-details','change-password','profile'];
        $rolePermissions['bank']=['plants-list','applied-loan','project-details','loan-remarks','change-loan-status','change-password','profile'];
        $rolePermissions['bankAdmin']=['plants-list','applied-loan','loan-remarks','project-details','change-loan-status','change-password','profile'];
        $rolePermissions['cbgLogin']=['cbg-plants','offtake-issues','offtake-issues-details','offtake-issues-remarks','monthly-update-report-cbg','change-password','profile'];
        $rolePermissions['DoFAdmin']=['mda-issues','mda-issues-details','mda-issues-remarks','change-password','profile'];
        
        if (!session()->get('logged_in'))
        {
            return redirect()->to(base_url().'login');
        }else{
            $loginRole = session()->get('role');
            $permissions = $rolePermissions[$loginRole];
            $uriString = uri_string();
            $currentRoute = explode("/",$uriString)[0];
            if(!in_array($currentRoute,$permissions)){
                return redirect()->to(base_url().'access-denied');
            }
            
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}