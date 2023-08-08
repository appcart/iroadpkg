<?php

namespace Appcart\Iroad\app\Models;
use Appcart\Iroad\app\Scopes\GlobeScope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Users_model extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    // use HasFactory;
    // use SoftDeletes;

    public $timestamps = true;  // will not take default column created_at and updated_at

    protected $table = 'users';

    protected $primaryKey = 'user_id';   //make default primary key

    protected $guarded = []; //allow  fill all data in table  

    // protected $fillable = [
    //     'email_id',
    //     'password',
    // ];


    protected $hidden = [
        'password',
        'token',
    ];
    

    protected static function booted()
    {
        // parent::boot(); 
     
        static::addGlobalScope(new GlobeScope); 
      
        static::addGlobalScope('vendoruser', function (Builder $builder) {    

            $result = app('Appcart\Iroad\app\Http\Controllers\admin\Dashboard_controller')->logged_user();
            
            if($result['route_name']=='vendors'){            
                $builder->where('user_role', 2);  //2 role is for vendor user
            }

        });
    }  

    public function vendor_materials()
    {
        return $this->hasMany(Vendors_model::class,'user_id');
    }

    
    public function vendor_material_type()
    {
        return $this->hasMany(Vendors_model::class,'user_id');
    }
    
    public function users_sites()
    {
        return $this->hasMany(User_sites_model::class,'user_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designations_model::class,'designation_id'); //machine_type is foreign key in Machines_model (parent model)
    }

    public function role()
    {
        return $this->belongsTo(Roles_model::class,'user_role'); //machine_type is foreign key in Machines_model (parent model)
    }
   
}
    