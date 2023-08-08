<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MachineImport;

use App\Scopes\GlobeScope;
use App\Models\Machines_model;
use App\Models\Machine_types_model;
use PDF;

class Machine_controller extends Controller
{
    //

    public function index(Request $request)
    {                         
            // $objects = Machine_types_model::with('machines')->get()->toArray();
            
            // $machine_type = Machines_model::select('*','machines.machine_type as mach_type')->with('machine_type')->get()->toArray();
          
             $result['machines']=Machines_model::select('machines.*','machine_types.machine_type')
                                                ->leftJoin("machine_types", "machines.machine_type", "=", "machine_types.mach_type_id")
                                                ->get()->toArray();
                                                // ->toSql();                                             
             $result['machine_types']=Machine_types_model::get()->toArray(); 

            
            
            //  $pdf = PDF::loadView('admin/demo_mailer', $result);
            //  $output = $pdf->output();
            //  file_put_contents('assets/invoice.pdf', $output);
            // return $pdf->download('invoice.pdf');   //download in the desktop

             
     
             
             return view('admin/machines',$result);
    }

    public function machines_import(Request $request)
    {   
        $machine_import=Excel::import(new MachineImport,request()->file('file'));     
        echo json_encode(array());
    }

    public function add_machines(Request $request)
    {       
        $machine_type = !empty($request['machine_type']) ? (Machine_types_model::firstOrCreate(
            [
                'machine_type' => $request['machine_type']
            ],
            [
                 'machine_type' => $request['machine_type']
            ]
        )) : "";
      
        $machine_data=array();
        $machine_data['machine_name']=!empty($request['machine_name']) ? $request['machine_name'] : "";
        $machine_data['machine_type']=!empty($machine_type) ? ($machine_type->vd_id ? $machine_type->vd_id : $machine_type->mach_type_id) : "" ;
        $machine_data['machine_number']=!empty($request['machine_no']) ? $request['machine_no'] : "";
        $machine_data['machine_uid']=!empty($request['machine_uid']) ? $request['machine_uid'] : "";
        $machine_data['machine_hrs']=!empty($request['machine_hr']) ? $request['machine_hr'] : "";
        $machine_data['machine_cost']=!empty($request['machine_cost']) ? $request['machine_cost'] : "";
        
        $machine_data['machine_cost_per_hrs']=!empty($request['machine_cost']) ? round($request['machine_cost'] / $request['machine_hr']) : "";
        $machine_data['is_active']=!empty($request['is_active']) ? ($request['is_active']=="Yes" ? 1 : 0) : 1;
               
        if(empty($request['machine_id']))
        {          
           
            $machine_added = Machines_model::firstOrCreate(
                [
                    'machine_type' => $machine_data['machine_type'],
                    'machine_name'=>$request['machine_name']
                ],
                $machine_data
            );
           
            if($machine_added->wasRecentlyCreated)    
            {
                $result=array('status'=>true,'msg'=>'Machine added successfully');
            } else {
                $result=array('status'=>false,'msg'=>'Machines already exists');
            }
            
        } else {

            if(!empty($request['delete']))
                {
                            $deleted_data = Machines_model::find($request['machine_id'])->delete();
                    
                            $result=array('status'=>true,'msg'=>'Machine deleted successfully');
                
                } else {

                $machine_update=Machines_model::where('machine_id', $request['machine_id'])->update($machine_data);
            
                if($machine_update)    
                {
                    $result=array('status'=>true,'msg'=>'Machine updated successfully','machine_update'=>$machine_update);
                } else {
                    $result=array('status'=>false,'msg'=>'Something went wrong');
                }

            }
        }
      

    echo json_encode($result);

    }
}
