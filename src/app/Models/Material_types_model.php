<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material_types_model extends Model
{
    use HasFactory;

    use SoftDeletes;

    public $timestamps = true;  // will not take default column created_at and updated_at

    protected $table = 'material_types';

    protected $primaryKey = 'mtype_id';   //make default primary key

    protected $guarded = []; //allow  fill all data in table  

    public function materials()
    {
        return $this->hasMany(Material_model::class,'material_type');
    }
}
