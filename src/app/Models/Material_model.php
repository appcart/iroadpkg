<?php

namespace App\Models;
use Illuminate\Http\Request;
use App\Scopes\GlobeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material_model extends Model
{
    use HasFactory;
    
    use SoftDeletes;

    public $timestamps = true;  // will not take default column created_at and updated_at

   
    protected $table = 'materials'; 
    
    protected $primaryKey = 'material_id';   //make default primary key
    
    protected $guarded = []; //allow  fill all data in table  

    protected static function boot()
    {
        parent::boot(); 
        static::addGlobalScope(new GlobeScope);      
    }        
    
    public function material_type()
    {
        return $this->belongsTo(Material_types_model::class,'material_type');
    }

    public function companies()
    {
        return $this->belongsTo(Companies_model::class,'company_id');
    }
        
   
}
