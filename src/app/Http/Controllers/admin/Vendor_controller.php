<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Vendors_model;
use App\Models\Material_types_model;
use App\Models\Material_model;
use App\Models\Users_model;

class Vendor_controller extends Controller
{
    public function index(Request $request)
    {       
        $result['vendors']=Users_model:: with( 
                    ['vendor_materials' => function($q) use($request) {
                        $q->select('*','materials.material_name','material_types.material_type'); 
                        $q->leftjoin('materials', 'vendors_detail.material_id', '=', 'materials.material_id');
                        $q->leftjoin('material_types', 'materials.material_type', '=', 'material_types.mtype_id');
                    }]
                )->withTrashed()->get()->toArray();

        
        $result['vendor_role_id']=2;
          
        $result['material_types'] = Material_types_model::with(
            ['materials' => function($q) use($request) {
                // Query the name field in status table
                // $q->where('material_id', '!=', 9); // '=' is optional
            }]
        )->withTrashed()->get()->toArray(); 
       
        return view('admin/vendors',$result);
    }

    public function add_vendors(Request $request)
    {   
      
        $fullname= !empty($request['vendor_name']) ? explode(" ",$request['vendor_name']) : "";
                
        $users_data=array();
        $users_data['first_name']=!empty($fullname[0]) ? $fullname[0] : "";
        $users_data['last_name']=!empty($fullname[1]) ? $fullname[1] : "";
        $users_data['shop_name']=!empty($request['shop_name']) ? $request['shop_name'] : "";
        $users_data['mobile']=!empty($request['mobile']) ? $request['mobile'] : "";
        $users_data['email_id']=!empty($request['email_id']) ? $request['email_id'] : "";
        $users_data['password']=Hash::make('123456'.config('global.passkey'));
        $users_data['user_role']=2;
       
        $users_data = array_filter($users_data, function($a) {
            return $a != '';
        });

                  
        if(empty($request['vendor_id']))
        {
            $user_added = Users_model::firstOrCreate(
                [
                    'email_id' => $users_data['email_id'],
                    'mobile'=>$request['mobile']
                ],
                $users_data
            );                     
            
            if($user_added->wasRecentlyCreated)    
            {
                $materials=Material_model::select('material_type','material_id')->whereIn('material_name', $request['material_name'])->get()->toArray();
                foreach($materials as $key=>$mat)
                {            
                    $materials[$key]['user_id']= $user_added->user_id;
                    Vendors_model::create($materials[$key]);
                }
               
                $result=array('status'=>true,'msg'=>'Vendor added successfully');
            } else {
                $result=array('status'=>false,'msg'=>'Vendor email or mobile already exists');
            }
            
        } else {

            if(!empty($request['delete']))
            {
                $deleted_data = Users_model::find($request['vendor_id'])->delete();
           
                $result=array('status'=>true,'msg'=>'Vendor deleted successfully');
               
            } else {
                $exists=Users_model::where('email_id',$users_data['email_id'])->where('user_id','!=',$request['vendor_id'])->get()->toArray();
                
                if(empty($exists))
                {
                    
                    Vendors_model::where('user_id', $request['vendor_id'])->forceDelete();
                    
                    $materials=Material_model::select('material_type','material_id')->whereIn('material_name', $request['material_name'])->get()->toArray();
                    foreach($materials as $key=>$mat)
                    {            
                        $materials[$key]['user_id']= $request['vendor_id'];
                        Vendors_model::create($materials[$key]);
                    }
                    
                    $users_update=Users_model::where('user_id', $request['vendor_id'])->update($users_data);
                  
                
                    if($users_update)    
                    {
                        $result=array('status'=>true,'msg'=>'Vendor details updated successfully');
                    } else {
                        $result=array('status'=>false,'msg'=>'Nothing Changed');
                    }
                } else {
                    $result=array('status'=>false,'msg'=>'Email already exists');
                }
               
            }
        }
      

        echo json_encode($result);
    }
}
