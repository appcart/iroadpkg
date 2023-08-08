<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity_model;

class Monitoring_controller extends Controller
{
    public function index()
    {       
        $result['activities']=Activity_model::get()->toArray();
        return view('admin/activities',$result);
    }

    
    public function add_activity(Request $request)
    {          
        if(empty($request['activity_id']))
        {
            if(empty($exist_activities))
            {            
                    $exist_activities=Activity_model::select('*')->whereIn('activity_name', $request['activity_name'])->get()->toArray();

                    foreach($request['activity_name'] as $key=>$act)
                    {   
                    
                        Activity_model::create(
                                [
                                    'activity_name'=>$act,
                                    'activity_description'=>$request['activity_description'][$key]
                                ]
                            );
                    }
                       $result=array('status'=>true,'msg'=>'Monitoring activities added successfully');

            } else {
            
                       $result=array('status'=>false,'msg'=>implode(', ', array_column($exist_activities,'activity_name')).' already exists');
            }
        } else {

            if(!empty($request['delete']))
            {
                        $deleted_data = Activity_model::find($request['activity_id'])->forceDelete();
                
                        $result=array('status'=>true,'msg'=>'Monitoring activity deleted successfully');
               
            } else {

                        $activity_update=Activity_model::where('activity_id', $request['activity_id'])->update([
                            'activity_name'=>$request['activity_name'][0],
                            'activity_description'=>$request['activity_description'][0],
                        ]);

                         if($activity_update)    
                        {
                            $result=array('status'=>true,'msg'=>'Monitoring activity details updated successfully');
                        } else {
                            $result=array('status'=>false,'msg'=>'Something went wrong');
                        }
            } 

        }

        echo json_encode($result);
       
    }

}
