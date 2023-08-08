<?php

namespace App\Services;

use App\Models\Sites_model;
use App\Models\Road_components_model;
use App\Models\ComponentChainageModel;

class SiteService
{
    public function getall_sites($request)
    {
        $resposne = [];   
        
        $query = Sites_model::select('sites.*');  
        !empty($request['site_id']) ? $query->where('site_id', base64_decode($request['site_id'])) : '' ;

        $sites = $query->get();
        if(!empty($sites))
        {
            $resposne = $sites->toArray();
        } 
                
        return $resposne;
    }

    public function get_site($request)
    {              
        $resposne = [];   
        
        $query = Sites_model::select('sites.*');  
        !empty($request['site_id']) ? $query->where('site_id', base64_decode($request['site_id'])) : '' ;

        $site = $query->first();
        if(!empty($site))
        {
            $resposne = $site->toArray();
        } 
                
        return $resposne;
    }

    public function get_road_components($request)
    {              
        $resposne = [];  
        
        $query = Road_components_model::select('road_components.*');  
        $road_components = $query->orderBy('road_components.component_name', 'ASC')->get();
        if(!empty($road_components))
        {
            $resposne = $road_components->toArray();
        } 
        
        return $resposne;
    }
    
    public function add_component_chainage($request)
    {
        $resposne = ['status'=>false,'message'=>'Data not found']; 
        $componentsChainage=json_decode($request['chainage_data']); 
        if(!empty($componentsChainage))
        {  
          
            foreach($componentsChainage as $key=>$component_data)
            {                
                if(!empty($component_data))
                {
                    foreach($component_data as $key1=>$chainage_data)
                    {   
                        $componentChainage = ComponentChainageModel::firstOrCreate(
                            [
                                'site_id'=>$request['site_id'],
                                'component_id'=>$chainage_data->component,
                                'from_length'=>$chainage_data->chainage_from,
                                'to_length'=>$chainage_data->chainage_to
                            ],
                            [
                                'site_id'=>$request['site_id'],
                                'component_id'=>$chainage_data->component,
                                'from_length'=>$chainage_data->chainage_from,
                                'to_length'=>$chainage_data->chainage_to,                        
                            ]
                        );  
                    }
                }
               
            }

            $resposne = ['status'=>true,'message'=>'Chainage data added successfully'];  

        }
         
        // exit;  
        // $query = Road_components_model::select('road_components.*');  
        // $road_components = $query->orderBy('road_components.component_name', 'ASC')->get();
        // if(!empty($road_components))
        // {
        //     $resposne = $road_components->toArray();
        // } 
        
        return $resposne;
    }
   
}