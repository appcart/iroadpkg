<?php
namespace App\Traits;
use App\Models\Designations_model;

trait CommonTrait {
     
    public function company_detail($request="") {      

        $result = app('App\Http\Controllers\admin\Dashboard_controller')->logged_user();
        return $result['user']->company_id;

    }
}