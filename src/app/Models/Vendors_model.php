<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendors_model extends Model
{
    use HasFactory;
    
    use SoftDeletes;

    public $timestamps = false;  // will not take default column created_at and updated_at

    protected $table = 'vendors_detail';

    protected $primaryKey = 'vd_id';   //make default primary key

    protected $guarded = []; //allow  fill all data in table  
}
