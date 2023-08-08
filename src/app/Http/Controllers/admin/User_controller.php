<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Traits\CommonTrait;
use App\Models\Users_model;
use App\Models\Sites_model;
use App\Models\Roles_model;
use App\Models\Designations_model;
use App\Models\User_sites_model;

class User_controller extends Controller
{
    

    public function index(Request $request)
    {       
        $result['roles']=Roles_model::whereNotIn('role_id',[1,2])->get()->toArray(); // here we are not getting vendor and superadmin
        $result['designations']=Designations_model::get()->toArray();
        $result['sites']=Sites_model::get()->toArray();

        $result['users']=Users_model::with( 
                    ['users_sites' => function($q) use($request) {
                        $q->select('user_sites.*','sites.site_name'); 
                        $q->leftjoin('sites', 'user_sites.site_id', '=', 'sites.site_id');
                    },
                    'designation' => function($q) use($request) {                      
                    },
                    'role' => function($q) use($request) {                      
                    }
                    ]
                )->whereNotIn('user_role',[1,2])->withTrashed()->get()->toArray();  // here we are not getting vendor and superadmin 

                                        
        return view('admin/users',$result);
    }

    public function add_user(Request $request)
    {  
            $user_data=array();
            $user_data['user_id']=!empty($request['user_id']) ? $request['user_id'] : "";
            $user_data['first_name']=!empty($request['first_name']) ? $request['first_name'] : "";
            $user_data['last_name']=!empty($request['last_name']) ? $request['last_name'] : "";
            $user_data['email_id']=!empty($request['email_id']) ? $request['email_id'] : "";
            $user_data['mobile']=!empty($request['mobile']) ? $request['mobile'] : "";
            $user_data['user_role']=!empty($request['department']) ? $request['department'] : "";
            $user_data['designation_id']=!empty($request['designation']) ? $request['designation'] : "";
            $user_data['password']=!empty($request['password']) ? Hash::make($request['password'].config('global.passkey')) : "";

            $user_data = array_filter($user_data, function($a) {
                return $a != '';
            });

                          
            if(empty($request['user_id']))
            {   
                $user_added = Users_model::firstOrCreate(
                    [
                        'email_id'=>$request['email_id']
                    ],
                    $user_data
                );                
                
                if($user_added->wasRecentlyCreated)    
                {                   
                    foreach($request['sites'] as $skey=>$site)
                    {
                        $temp=array();
                        $temp['user_id']=$user_added->user_id;
                        $temp['site_id']=$site;
    
                        User_sites_model::create($temp);
                    }
                    $result=array('status'=>true,'msg'=>'User added successfully');
                } else {
                    $result=array('status'=>false,'msg'=>'User Email already exists');
                }
                
            } else {

                if(!empty($request['delete']))
                    {
                        $deleted_data = Users_model::find($request['user_id'])->delete();                        
                        $result=array('status'=>true,'msg'=>'User deleted successfully');                    
                    } else {

                    $user_update=Users_model::where('user_id', $request['user_id'])->update($user_data);

                    User_sites_model::where('user_id', $request['user_id'])->forceDelete();
                    foreach($request['sites'] as $skey=>$site)
                    {
                        $temp=array();
                        $temp['user_id']=$request['user_id'];
                        $temp['site_id']=$site;
    
                        User_sites_model::create($temp);
                    }
                
                    if($user_update)    
                    {
                        $result=array('status'=>true,'msg'=>'User updated successfully','user_update'=>$user_update);
                    } else {
                        $result=array('status'=>false,'msg'=>'Something went wrong');
                    }

                }
            }
        

        echo json_encode($result); 
    }
}
