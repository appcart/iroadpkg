<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\GlobeScope;

class Machines_model extends Model
{
    use HasFactory;

    use SoftDeletes;

    public $timestamps = true;  // will not take default column created_at and updated_at

    protected $table = 'machines';

    protected $primaryKey = 'machine_id';   //make default primary key

    protected $guarded = []; //allow  fill all data in table  

    protected static function boot()
    {
        parent::boot(); 
        static::addGlobalScope(new GlobeScope);      
    }

    public function machine_type()
    {
        return $this->belongsTo(Machine_types_model::class,'machine_type'); //machine_type is foreign key in Machines_model (parent model)
    }
}
