<?php

namespace App\Controllers;

use App\Models\District;

class DistrictController extends BaseController
{
    public function index()
    {
		$districts = new District();
		$dd = $districts->findAll();
		
		echo "<pre>";
		print_r($dd);
		die;
    	$data['captcha'] = "Satyendra";
        return view('login',$data);
    }


}
