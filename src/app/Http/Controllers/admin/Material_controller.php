<?php

namespace App\Http\Controllers\admin;
use App\GlobalFacades\Facades\UserFacades;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MaterialImport;

use App\Models\Material_model;
use App\Models\Material_types_model;
use App\Models\Companies_model;

class Material_controller extends Controller
{

    public function index(Request $request)
    {
        // $objects = Material_types_model::with(
        //     ['materials' => function($q) use($request) {
        //         // Query the name field in status table
        //         // $q->where('material_id', '!=', 9); // '=' is optional
        //     }]
        // )->get()->toArray();            
        // $materials = Material_model::select('*','materials.material_type as mat_type')->with(
        // ['material_type','companies' => function($q) use($request) {
        //     // Query the name field in status table
        //     // $q->where('material_id', '!=', 9); // '=' is optional
        // }])->get()->toArray();   
        // echo "<pre>" ;
        // print_r($materials);
        // exit;       
        $result['materials']=Material_model::select('materials.*','material_types.material_type')
                            ->leftJoin("material_types", "materials.material_type", "=", "material_types.mtype_id")
                            ->get()->toArray();
        $result['material_types']=Material_types_model::withTrashed()->get()->toArray(); 

        return view('admin/materials',$result);
    }    

    public function upload_file(Request $request)
    {   
        Excel::import(new MaterialImport,request()->file('file'));
    }

    public function add_materials(Request $request)
    {        
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $material_type = !empty($request['material_type']) ? (Material_types_model::firstOrCreate(
            [
                'material_type' => $request['material_type']
            ],
            [
                'material_type' => $request['material_type']              
            ]
        ) ) : '' ;

        
        $material_data=array();
        $material_data['material_name']=!empty($request['material_name']) ? $request['material_name'] : "";
        $material_data['material_type']= !empty($material_type) ? ($material_type->vd_id ? $material_type->vd_id : $material_type->mtype_id) : 0 ;  //first time return vd_id then mtype_id
        $material_data['material_unit']=!empty($request['material_unit']) ? $request['material_unit'] : "";
        $material_data['material_cost']=!empty($request['material_cost']) ? $request['material_cost'] : "";
        $material_data['is_active']=!empty($request['is_active']) ? ($request['is_active']=="Yes" ? 1 : 0) : 1;
       
        $material_data = array_filter($material_data, function($a) {
            return $a != '';
        });

                   
        if(empty($request['material_id']))
        {    

            $material_added = Material_model::firstOrCreate(
                [
                    'material_type' => $material_data['material_type'],
                    'material_name'=>$request['material_name']
                ],
                $material_data
            );

           
            if($material_added->wasRecentlyCreated)    
            {
                $result=array('status'=>true,'msg'=>'Material added successfully');
            } else {
                $result=array('status'=>false,'msg'=>'Material name already exists');
            }
            
        } else {

                if(!empty($request['delete']))
                {
                            $deleted_data = Material_model::find($request['material_id'])->delete();
                    
                            $result=array('status'=>true,'msg'=>'Material deleted successfully');
                
                } else {

                $material_update=Material_model::where('material_id', $request['material_id'])->update($material_data);
            
                if($material_update)    
                {
                    $result=array('status'=>true,'msg'=>'Material updated successfully');
                } else {
                    $result=array('status'=>false,'msg'=>'Something went wrong');
                }
            }

        }     

        echo json_encode($result);
    }
}
