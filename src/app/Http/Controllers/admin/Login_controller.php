<?php
namespace Appcart\Iroad\app\Http\Controllers\admin;

use Appcart\Iroad\app\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Support\Facades\Hash;
use Appcart\Iroad\app\Models\Users_model;


class Login_controller extends Controller
{
    //
   
        public function index(Request $request)
        {  
            return view('blogpackage::admin.login',['user_role'=>1]);
        }

        public function login_old(Request $request)
        {
                      
            switch( $request->route()->getPrefix() ) {
                case '/admin': $role=1; break;
                case '/manager':  $role=2; break;
                case '/employee': $role=""; break;
                case '/vendor':   $role=""; break;
                case '/store':   $role=7; break;
                case '/purchase':   $role=8; break;
                default: $role="";
            }         

                    
            $validator = Validator::make($request->all(),
            [
                'username' => 'required',
                'password' => 'required'
            ], [ 
                'username.required' => 'username field is required.',
                'password.required' => 'Password field is required.'
            ]);
          
    
            if ($validator->fails()) {
                echo json_encode(["status"=>false,"msg"=>"Insufficient data",'error' => $validator->errors()->all()]);
            } else {
                $logged_user=Users_model::select('user_id','password')->where(['user_role'=>$role,'email_id'=>$request['username']])->first();
                // echo $role;
                // echo$request['username'];

                if(!empty($logged_user))
                {                   
                       if (Hash::check($request['password'].config('global.passkey'), $logged_user->password)) {
                            $token=sha1(date('Y-m-d:H:i:s').$logged_user->user_id);
                            $token_update=Users_model::where('user_id', $logged_user->user_id)->update(['token'=>$token]);
                            if($token_update)
                            {
                                switch( $request->route()->getPrefix() ) {
                                    case '/admin':  $request->session()->put('admin_token', $token); break;
                                    case '/manager':  $request->session()->put('manager_token', $token); break;
                                    case '/employee': $role=""; break;
                                    case '/vendor':   $role=""; break;
                                    case '/store':   $request->session()->put('store_token', $token); break;
                                    case '/purchase':   $request->session()->put('purchase_token', $token); break;
                                    default: $role="";
                                }
                               
                                echo json_encode(["status"=>true,"msg"=>"Logged In successful"]);                            
                            } else {
                                echo json_encode(["status"=>false,"msg"=>"Something went wrong"]);                            
                            }                           
                        } else {
                            echo json_encode(["status"=>false,"msg"=>"Invalid credentials"]);
                        }
                } else {
                    echo json_encode(["status"=>false,"msg"=>"User not found"]);
                }
            }
        }

        public function login(Request $request)
        {                      
            switch( $request->route()->getPrefix() ) {
                case '/admin': $role=1; break;
                case '/manager':  $role=2; break;
                case '/employee': $role=""; break;
                case '/vendor':   $role=""; break;
                case '/store':   $role=7; break;
                case '/purchase':   $role=8; break;
                default: $role="";
            }         

                    
            $validator = Validator::make($request->all(),
            [
                'username' => 'required',
                'password' => 'required'
            ], [ 
                'username.required' => 'username field is required.',
                'password.required' => 'Password field is required.'
            ]);
          
    
            if ($validator->fails()) {
                echo json_encode(["status"=>false,"msg"=>"Insufficient data",'error' => $validator->errors()->all()]);
            } else {   
               
                $logged_user=Users_model::withoutGlobalScopes()->select('user_id','password')->where(['user_role'=>$role,'email_id'=>$request['username']])->first();
                // echo $role;
                // echo$request['username'];

                if(!empty($logged_user))
                {              
                                     
                    // if(auth()->attempt(array('email_id' => $request['username'],'password'=>'123456')))
                    // {
                    //     echo "true";
    
                    // } else {
                    //     echo "false";
                    // }
                    // exit;

                       if (Hash::check($request['password'].config('global.passkey'), $logged_user->password)) {
                            $token=sha1(date('Y-m-d:H:i:s').$logged_user->user_id);
                            $token_update=Users_model::where('user_id', $logged_user->user_id)->update(['token'=>$token]);
                            if($token_update)
                            {
                                switch( $request->route()->getPrefix() ) {
                                    case '/admin':  $request->session()->put('admin_token', $token); break;
                                    case '/manager':  $request->session()->put('manager_token', $token); break;
                                    case '/employee': $role=""; break;
                                    case '/vendor':   $role=""; break;
                                    case '/store':   $request->session()->put('store_token', $token); break;
                                    case '/purchase':   $request->session()->put('purchase_token', $token); break;
                                    default: $role="";
                                }
                               
                                echo json_encode(["status"=>true,"msg"=>"Logged In successful"]);                            
                            } else {
                                echo json_encode(["status"=>false,"msg"=>"Something went wrong"]);                            
                            }                           
                        } else {
                            echo json_encode(["status"=>false,"msg"=>"Invalid credentials"]);
                        }
                } else {
                    echo json_encode(["status"=>false,"msg"=>"User not found"]);
                }
            }
        }
       
}
