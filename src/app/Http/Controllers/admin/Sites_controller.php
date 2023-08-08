<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Sites_model;
use App\Models\Coordinates_model;
use App\Models\Road_components_model;
use App\Services\SiteService;

class Sites_controller extends Controller
{
    protected $siteservice;
    public function __construct(SiteService $siteservice)
    {
        $this->siteservice = $siteservice;
    }

    public function index(Request $request)
    {  
        $result['sites']=$this->siteservice->getall_sites($request->all());
        
        return view('admin/sites',$result);
    }    
    
    public function project_datails(Request $request)
    {

    }

    public function add_component_chainage(Request $request)
    {
        $chainageResponse=$this->siteservice->add_component_chainage($request->all());
        return response()->json($chainageResponse);
    }

    public function add_project_datails(Request $request)
    {     
       
        $result['road_components']=$this->siteservice->get_road_components($request->all());
        $result['site']=$this->siteservice->get_site($request->all());
                               
        return view('admin/add-site-details',$result);
    }

    public function add_site(Request $request)
    {           
            $site_data=array();
            $site_data['site_name']=!empty($request['site_name']) ? $request['site_name'] : "";
            $site_data['road_name']=!empty($request['road_name']) ? $request['road_name'] : "";
            $site_data['no_of_junction']=!empty($request['no_of_junction']) ? $request['no_of_junction'] : "";
            $site_data['road_length']=!empty($request['road_length']) ? $request['road_length'] : "";
            $site_data['tender_budget']=!empty($request['tender_budget']) ? $request['tender_budget'] : "";
            $site_data['project_start_date']=!empty($request['project_start_date']) ? $request['project_start_date'] : "";
            $site_data['project_end_date']=!empty($request['project_end_date']) ? $request['project_end_date'] : "";
            $site_data['design_chainage']=!empty($request['design_chainage']) ? $request['design_chainage'] : "";
            
                
            if(empty($request['site_id']))
            {      
                $site_added = Sites_model::firstOrCreate(
                    [
                        'site_name'=>$request['site_name']
                    ],
                    $site_data
                );                
                
                if($site_added->wasRecentlyCreated)    
                {
                    Coordinates_model::where('site_id', $site_added->site_id)->forceDelete();
                    foreach(json_decode($request['coordinates']) as $coordkey=>$val)
                    {
                        $temp=(array)$val;
                        $temp['site_id']=$site_added->site_id;
    
                        Coordinates_model::create($temp);
                    }
                    $result=array('status'=>true,'msg'=>'Site added successfully');
                } else {
                    $result=array('status'=>false,'msg'=>'Site already exists');
                }
                
            } else {

                if(!empty($request['delete']))
                    {
                                $deleted_data = Sites_model::find($request['site_id'])->delete();
                        
                                $result=array('status'=>true,'msg'=>'Site deleted successfully');
                    
                    } else {

                    $site_update=Sites_model::where('site_id', $request['site_id'])->update($site_data);
                
                    if($site_update)    
                    {
                        $result=array('status'=>true,'msg'=>'Site updated successfully','site_update'=>$site_update);
                    } else {
                        $result=array('status'=>false,'msg'=>'Something went wrong');
                    }

                }
            }
        

        echo json_encode($result); 
    }
}
