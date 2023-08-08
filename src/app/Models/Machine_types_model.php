<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine_types_model extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;  // will not take default column created_at and updated_at

    protected $table = 'machine_types';

    protected $primaryKey = 'mach_type_id';   //make default primary key

    protected $guarded = []; //allow  fill all data in table  
   
    public function machines()
    {
        return $this->hasMany(Machines_model::class,'machine_type'); //machine_type is foreign key in Machines_model (child model)
    }
}
