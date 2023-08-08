<?php

namespace Appcart\Iroad\app\Http\Controllers\admin;

use Appcart\Iroad\app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

use Appcart\Iroad\app\Models\Users_model;
use Appcart\Iroad\app\Models\Machines_model;
use Appcart\Iroad\app\Models\Material_model;
use Appcart\Iroad\app\Models\Activity_model;
use Appcart\Iroad\app\Models\Sites_model;
use Appcart\Iroad\app\Scopes\GlobeScope;


class Dashboard_controller extends Controller
{
    //
    public function index()
    {       
        $result['users']=Users_model::withTrashed()->get()->count();
        $result['vendors']=Users_model::where('user_role',2)->withTrashed()->get()->count();
        $result['machines']=Machines_model::withTrashed()->get()->count();
        $result['materials']=Material_model::withTrashed()->get()->count();
        $result['activities']=Activity_model::withTrashed()->get()->count();
        $result['sites']=Sites_model::withTrashed()->get()->count();
        // $pdf = PDF::loadView('admin/demo_mailer', $result);
        // $pdf->set_paper("a4", "portrait");
        // $output = $pdf->output();
        // file_put_contents('assets/invoice.pdf', $output);
        // PDF::loadView('admin/demo_mailer')
        // ->save('assets/invoice.pdf');
        // return $pdf->download('invoice.pdf');   //download in the desktop
        
        return view('admin/dashboard',$result);
    }

    public function logout(Request $request)
    {
       
        switch( $request->route()->getPrefix() ) {
                case '/admin': 
                                $request->session()->forget('admin_token');
                                return redirect('admin');
                                break;
                case '/manager': 
                                $request->session()->forget('manager_token');
                                return redirect('manager');
                                break;
                case '/store': 
                                $request->session()->forget('store_token');
                                return redirect('store');
                                break;
                case '/purchase': 
                                $request->session()->forget('purchase_token');
                                return redirect('purchase');
                                break;
                case '/employee': $role=""; break;
                case '/vendor':   $role=""; break;
                default: $role="";
        }
        
    }   

    public function logged_user()
    {  
        $request = app(\Illuminate\Http\Request::class);    
       
        switch( $request->route()->getPrefix() ) {
            case '/admin': 
                  $role=1;
                  $token=$request->session()->get('admin_token');
                  break;
            case '/manager':
                  $role=2; 
                  $token=$request->session()->get('manager_token');
                  break;
            case '/store':
                 $role=7; 
                 $token=$request->session()->get('store_token');
                 break;
            case '/purchase':
                 $role=8; 
                 $token=$request->session()->get('purchase_token');
                 break;
            case '/employee': $role=""; break;
            case '/vendor':   $role=""; break;
            default: $role="";
        }  

        
        $logged_user['user']=Users_model::withoutGlobalScopes([
                                            GlobeScope::class,'vendoruser'
                                        ])->select('*')->where(['token'=>$token])->first();
      
        $logged_user['route_name']=$request->route()->getName();

        return $logged_user;
    }
}
